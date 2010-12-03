<?
	include("header.php");
  try
  {
	  list ($user->username, $user->password, $redirect, $logout) = 
          $input->getInputValues('username', 'password', 'redirect', 'logout');
		if ($logout)
		{
			$user->reset();
			$user->killSession();
			throw new Exception ("You have been logged out.");
		}
		if ($user->username || $user->password)
		{
			// Attempt to log into the system
			// Returns false on failure
			if ($user->login(false, $setting->failedLoginLimit))
			{
				if ($redirect) redirect($redirect);
				else redirect("welcome.php");
			}
			else
			{
				throw new Exception("The username or password you entered is invalid.");
			}
		}
		include("../views/login.php");
	}
	catch (Exception $e)
	{
		include("../views/login.php");
		throw ($e);
	}
?>
