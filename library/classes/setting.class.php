<?
	/* Controls standard configurations that are contained within the database. */
  class Setting extends DatabaseObject
  {
    public function __construct()
    {
      // This is required or this constructor will override the
      // database object
      parent::__construct();
			$this->loadSettings();
		}

		private function loadSettings()
		{
			$this->load_all();
			$totalVars = count($this->name);
			for ($i = 0; $i < $totalVars; $i++)
			{
				$this->{$this->name[$i]} = $this->value[$i];
			}
		}
  }
?>
