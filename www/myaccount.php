<?
	include("header.php");
  try
  {
		if (!$user->level)
			throw new LoginException("You must be logged in to use this feature.");
		if ($_REQUEST['update'])
		{
			list ($user->phone, $user->address, $user->city,
				$user->state, $user->zip, $user->email, $newpassword,
				$confirmpassword) =
				$input->getInputValues('phone', 'address', 'city',
				'state', 'zip', 'email', 'newpassword',
				'confirmpassword');
			$user->validate();
			if ($newpassword != $confirmpassword)
				throw new Exception("The new password does not match the confirmed password.");
			if ($newpassword) $input->password($newpassword);
			if ($user->updateUser($newpassword))
				flash("User Information Updated");
			else
				throw new Exception("Could Not Save To Database.");
		}
		include("../views/myaccount.php");
	}
	catch (LoginException $e)
	{
		$redirect = "myaccount.php";
		include("../views/login.php");
		throw ($e);
	}
	catch (InputException $e)
	{
		include("../views/myaccount.php");
		throw($e);
	}
	catch (Exception $e)
	{
		include("../views/myaccount.php");
		throw($e);
	}
?>
