<?
	include("header.php");
  try
  {
		if (!$user->level)
			throw new LoginException("You must be logged in to use this feature.");
		if ($user->level < 2)
			throw new LoginException("You do not have permission to use this feature.  Please log into the Administrator account.");
		include("../views/administration.php");
	}
	catch (LoginException $e)
	{
		$redirect = "welcome.php";
		include("../views/login.php");
		throw ($e);
	}
	catch (Exception $e)
	{
		include("../views/welcome.php");
		throw($e);
	}
?>
