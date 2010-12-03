<?
  class Company extends DatabaseObject
  {
    public function __construct()
    {
			// This is required or this constructor will override the
			// database object
			parent::__construct();
		}

		public function validate()
		{
			$input = new Input();
      $input->minMax($this->name, 1, 32, 'Company Name');
      $input->minMax($this->address, 1, 64, 'Address');
      $input->minMax($this->city, 1, 32, 'City');
      $input->minMax($this->state, 1, 32, 'State');
      $input->minMax($this->zip, 1, 14, 'Zip Code');
      $input->phone($this->phone, 'Telephone Number');
      $input->digits($this->zip, 'Zip Code');
      $input->maximum($this->phone, 32, 'Telephone Number');
      $input->maximum($this->logo, 128, 'Logo URL');
			return true;
		}
  }
?>
