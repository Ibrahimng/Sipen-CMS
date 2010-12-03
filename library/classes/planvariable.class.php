<?
  class PlanVariable extends DatabaseObject
  {
    public function __construct()
    {
      // This is required or this constructor will override the
      // database object
      parent::__construct();
			$this->orderby = "planid";
    }

		// Overloaded function for more complex sql query
		public function load_all()
		{
			$this->_columns[] = "planname";
	    $this->sql("SELECT v.*, p.name AS planname FROM planvariables v
  	    LEFT JOIN plans p ON v.planid = p.id");
		}

		public function validate()
		{
			if (is_array($this->name))
				return $this->validate_all();
			$input = new Input();
			if ($this->required)
				$this->required = 1;
			else
				$this->required = 0;
			$input->alpha($this->name, 'Variable Name');
			$input->minMax($this->name, 1, 64, 'Variable Name');
      $input->minMax($this->description, 1, 64, 'Variable Description');
			$input->digits($this->planid, 'Plan ID');
			return true;
		}

		private function validate_all()
		{
			$input = new Input();
			$elements = count($this->name);
			for ($i = 0; $i < $elements; $i++)
			{
				if ($this->required[$i])
					$this->required[$i] = 1;
				else
					$this->required[$i] = 0;
				$input->alpha($this->name[$i], 'Variable Name '.$i);
				$input->minMax($this->name[$i], 'Variable Name '.$i);
				$input->minMax($this->description[$i], 1, 64, 'Variable Description '.$i);
				$input->digits($this->planid[$i], 'Plan ID '.$i);
			}
			return true;
		}
	}
?>
