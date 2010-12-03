<?
	$hideheader = 1;
	include("header.php");
//	$search404 = new Search();
//	$usernameURL = getUsernameFromURL();
/*
	if ($search404->loadUserIDByUsername($usernameURL))
	{
		echo "<br><br><br>";
		echo "<center><img src='images/processing.gif' border='0'></center>";
		redirect("visit.php?userid=" . $search404->uid);
	}
	else
	{
*/
		include("404errormsg.php");
/*
	}
*/
?>

<?
	function getUsernameFromURL()
	{
		// Request_URI only returns the GET portion not the host portion
		$url = $_SERVER['REQUEST_URI'];
		if (preg_match('/^\/([A-Z]{1,64})$/i', $url, $matches))
		{
			$username = $matches[1];
			return $username;
		}
	}
?>
