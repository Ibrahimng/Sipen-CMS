<?
  /***** DATABASE FUNCTIONS *****/
	function useDatabase($username, $password, $host = 'localhost', $selected_database = 'sipen_cms_production')
	{
		if (mysql_connect ($host, $username, $password))
		{
		  return mysql_select_db ($selected_database);
		}
		return false;
	}
	  
  function database($sql_query)
  {
    $queryResult = mysql_query($sql_query);
    return $queryResult;
  }

	function esc($value, $allowHTML = 0)
	{
		$value = stripslashes($value); // Prevents double escaping
		if (!$allowHTML)
			$value = formEncode($value);		
	  return mysql_real_escape_string($value);
	}

  /*
    Found online at
    http://www.breathteching.com/2008/03/24/function-for-dealing-with-quotes-in
  */
  function formEncode($string)
  {
    return str_replace("&amp;", "&",
      (htmlentities(stripslashes($string), ENT_QUOTES)));
  }
?>
