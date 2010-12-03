<?
	class Input extends InputValidation
	{
    public function getInputValues()
    {
      // Usage: list($myvariable1, $myvariable2) = getInputValuesByName('myvariable1', 'myothervariable');
      $numArgs = func_num_args();
      $arrValues = array();
      for ($i = 0; $i < $numArgs; $i++)
      {
        $argVal = func_get_arg($i);
        $currentValue = $_REQUEST["$argVal"];
        $arrValues[] = formEncode($currentValue);
      }
      return $arrValues;
    }
	}
?>
