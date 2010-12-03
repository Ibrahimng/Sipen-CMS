<?
	include("header.php");
	$users = new User();
  try
  {
		if (!$user->level)
			throw new LoginException("You must be logged in to use this feature.");
		if ($user->level < 2)
			throw new LoginException("You do not have permission to use this feature.  Please log into the Administrator account.");
		list ($delete, $unlock) = $input->getInputValues('delete', 'unlock');
		if ($delete)
		{
			$input->digits($delete, 'Deletion ID of User');
			if ($users->delete($delete))
				flash("User (".$delete.") Deleted Successfully");
			else
				throw new Exception("The specified user could not be removed.");		
		}
		if ($unlock)
		{
			// Unlock the user
			$updateUser = new User();
			$input->digits($unlock, 'Unlock ID of User');
			$updateUser->id = $unlock;
			$updateUser->failed = 0;
			if ($updateUser->save())
				flash ("User failed logins count reset.");
			$updateUser->reset();
		}
		$users->load_all();
		include("../views/manageusers.php");
	}
	catch (LoginException $e)
	{
		$redirect = "manageusers.php";
		include("../views/login.php");
		throw ($e);
	}
	catch (InputException $e)
	{
		include("../views/manageusers.php");
		throw($e);
	}
	catch (Exception $e)
	{
		include("../views/manageusers.php");
		throw($e);
	}
?>
