<?
	include("header.php");
	$newUser = new User();
  try
  {
		if (!$user->level)
			throw new LoginException("You must be logged in to use this feature.");
		if ($user->level < 2)
			throw new LoginException("You do not have permission to use this feature.  Please log into the Administrator account.");
		list ($newUser->username, $newUser->password, $newUser->firstname,
			$newUser->lastname) = $input->getInputValues('newusername', 
			'newpassword', 'newfirstname', 'newlastname');
		if ($newUser->username && $newUser->password)
		{
			$newUser->level = 1;
			$input->minMax($newUser->firstname, 1, 32, 'First Name');
			$input->minMax($newUser->lastname, 1, 32, 'Last Name');
			$input->password($newUser->password, 'Password');
			$input->minMax($newUser->password, 5, 30, 'Password');
			$input->minMax($newUser->username, 3, 16, 'Username');
			if ($newUser->isUnique('username'))
			{
				$newUser->createUser();
				flash("New User (".$newUser->username.") Created Successfully");
				include("../views/administration.php");
			}
			else
			{
				throw new Exception("That user already exists.");		
			}
		}
		else
		{
			include("../views/createuser.php");
		}
	}
	catch (LoginException $e)
	{
		$redirect = "createuser.php";
		include("../views/login.php");
		throw ($e);
	}
	catch (InputException $e)
	{
		include("../views/createuser.php");
		throw($e);
	}
	catch (Exception $e)
	{
		include("../views/createuser.php");
		throw($e);
	}
?>
