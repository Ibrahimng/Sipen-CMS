<?
  class CustomerException extends Exception {};

  class Customer extends DatabaseObject
  {
		public $plans;

    public function __construct()
    {
			// This is required or this constructor will override the
			// database object
			parent::__construct();
			$this->plans = new CustomerPlan();
		}

		public function validate()
		{
			$input = new Input();
			$input->maximum($this->address, 64, 'Address');
			$input->maximum($this->city, 32, 'City');
			$input->digits($this->zip, 'Zip Code');
			$input->maximum($this->lastname, 32, 'Last Name');
			$input->maximum($this->firstname, 32, 'First Name');
			$input->maximum($this->companyname, 64, 'Company Name');
			return true;
		}

  }
?>
