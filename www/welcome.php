<?
	include("header.php");
  try
  {
		if (!$user->level)
			throw new LoginException("You must be logged in to use this system.");
		include("../views/welcome.php");
	}
	catch (LoginException $e)
	{
		$redirect = "welcome.php";
		include("../views/login.php");
		throw ($e);
	}
	catch (Exception $e)
	{
		include("../views/createuser.php");
		throw($e);
	}
?>
