<?
	include("header.php");
	$edituser = new User();
	$currentuser = new User();
  try
  {
		if (!$user->level)
			throw new LoginException("You must be logged in to use this feature.");
		if ($user->level < 2)
			throw new LoginException("You do not have permission to use this feature.  Please log into the Administrator account.");
		list ($id, $edituser->firstname, $edituser->lastname, $edituser->phone,
			$edituser->email, $edituser->address, $edituser->city, $edituser->state,
			$edituser->zip, $newpassword) = $input->getInputValues('id', 'firstname',
			'lastname', 'phone', 'email', 'address', 'city', 'state', 'zip',
			'newpassword');
		$input->digits($id, 'User ID');
		if (!$currentuser->load($id))
			throw new DBException("User not found or could not load user $id.");
		if ($edituser->firstname)
		{
			$input->password($newpassword, 'New User Password');
			$edituser->id = $id;
			$edituser->validate();
			if ($edituser->updateUser($newpassword)) flash("User Updated.");
			$edituser->username = $currentuser->username;
			$edituser->level = $currentuser->level;

			$currentuser = $edituser;
		}
		include("../views/edituser.php");
	}
	catch (LoginException $e)
	{
		$redirect = "edituser.php";
		include("../views/login.php");
		throw ($e);
	}
	catch (InputException $e)
	{
		include("../views/edituser.php");
		throw($e);
	}
	catch (DBException $e)
	{
		include("../views/administration.php");
		throw($e);
	}
	catch (Exception $e)
	{
		include("../views/edituser.php");
		throw($e);
	}
?>
