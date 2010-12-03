<?
	include("header.php");
  try
  {
		if (!$user->authenticated)
		{
			throw new LoginException("You must be logged in to use this feature.");
		}
		list ($temp, $searchType) = $input->getInputValues('searchtext', 
			'searchtype');
/*
		if ($newUser->username && $newUser->password)
		{
			$input->minMax($newUser->firstname, 1, 32, 'First Name');
			$input->minMax($newUser->lastname, 1, 32, 'Last Name');
			$input->password($newUser->password, 'Password');
			$input->minMax($newUser->password, 5, 30, 'Password');
			$input->minMax($newUser->username, 3, 16, 'Username');
				$newUser->createUser();
				flash("New User (".$newUser->username.") Created Successfully");
			}
			else
			{
				throw new Exception("That user already exists.");		
			}
		}
*/
		include("../views/customersearch.php");
	}
	catch (LoginException $e)
	{
		$redirect = "customersearch.php";
		include("../views/login.php");
		throw ($e);
	}
	catch (InputException $e)
	{
		include("../views/customersearch.php");
		throw($e);
	}
	catch (Exception $e)
	{
		include("../views/customersearch.php");
		throw($e);
	}
?>
