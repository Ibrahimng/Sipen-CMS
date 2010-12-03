<?
  class LoginException extends Exception {};

  class User extends DatabaseObject
  {
		public $redirect = NULL;
		public $level = 0;
		public $last_login = NULL;

    public function __construct()
    {
      // This is required or this constructor will override the
      // database object
      parent::__construct();
		}

		public function changePassword($newPassword)
		{
			if (!$newPassword) return false;
			$this->password = $newPassword;
			$this->encryptPassword();
			if ($this->update())
				$this->saveSession();
			else
				throw new Exception("Your password could not be changed at this time.");
			return true;
		}

		public function createUser()
		{
			$this->encryptPassword();
			return $this->save();
		}

    public function killSession()
    {
      // Unset all of the session variables.
      $_SESSION = array();
      session_destroy();
      return true;
    }

    public function loadSession()
    {
      $this->username = $_SESSION['username'];
      $this->password = $_SESSION['password'];
      if ($this->username && $this->password) $this->login(true);
    }

		public function login($fromSession = false, $failedLoginsLimit = 5)
		{
			// Session passwords are already in encrypted form
			if (!$fromSession) $this->encryptPassword();
			$this->find('username', 'password');
			if ($this->id)
			{
				if ($this->failed > $failedLoginsLimit)
					return false;
				$this->saveSession();
				if (!$fromSession)
				{
					$this->failed = 0;
					$this->last_login = date("Y-m-d H:i:s");
					$this->update();
					$this->last_login = NULL; // Just to be safe
				}
				return true;
			}
			if ($this->find('username'))
			{
				$this->failed++;
				$this->update();
			}
			if ($this->level) $this->killSession();
			$this->reset();
			return false;
		}

		public function updateUser($newPassword = '')
		{	
			if ($newPassword)
			{
				$this->password = $newPassword;
				$this->encryptPassword();
			}
			return $this->update();
		}

		public function validate()
		{
			$input = new Input();
      $input->maximum($this->address, 64, 'Address');
      $input->maximum($this->city, 32, 'City');
      $input->maximum($this->state, 32, 'State');
      $input->maximum($this->zip, 14, 'Zip Code');
      $input->phone($this->phone, 'Telephone Number');
      $input->digits($this->zip, 'Zip Code');
      $input->maximum($this->phone, 16, 'Telephone Number');
      $input->email($this->email, 'Email Address');
			$input->maximum($this->email, 128, 'Email Address');
		}

		private function encryptPassword()
		{
			$salt1 = substr($this->password, 1, 2);
			$salt2 = substr($this->password, -2, 2);
			$this->password = md5($salt1.$this->password.$salt2);
		}

    private function saveSession()
    {
      $_SESSION["username"] = $this->username;
      $_SESSION["password"] = $this->password;
      if ($this->username && !$_SESSION["username"]) return false;
        else return true;
    }
  }
?>
