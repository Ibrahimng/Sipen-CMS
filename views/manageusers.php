<div id="mainpage">
	<h1>System Users</h1>
	<a href="createuser.php">Create User</a>
	<table border='1' class='s_table'>
		</tr>
			<td>
				&nbsp
			</td>
			<td>
				<b>Full Name</b>
			</td>
			<td>
				<b>Username</b>
			</td>
			<td>
				<b>Phone</b>
			</td>
			<td>
				<b>Email</b>
			</td>
			<td>
				<b>Created</b>
			</td>
			<td>
				<b>Last Login</b>
			</td>
			<td>
				&nbsp
			</td>
		</tr>
<?
	$totalUsers = count($users->firstname);
	for ($i = 0; $i < $totalUsers; $i++)
	{
		if ($users->failed[$i] > $setting->failedLoginLimit)
			$locked = 1;
		else
			$locked = 0;
?>
		<tr <? if ($locked) echo " bgcolor='#9f3333'"; ?>>
			<td><a href="edituser.php?id=<? echo $users->id[$i]; ?>">Edit</a></td>
			<td><? echo $users->firstname[$i] . " " . $users->lastname[$i]; ?></td>
			<td><? echo $users->username[$i]; ?></td>
			<td><? echo $users->phone[$i]; ?></td>
			<td><? echo $users->email[$i]; ?></td>
			<td><? echo $users->created_at[$i]; ?></td>
			<td><? echo $users->last_login[$i]; ?></td>
			<td>
				<? if ($locked)  { ?>
					<a href="manageusers.php?unlock=<? echo $users->id[$i]; ?>">Unlock</a><br>
				<? } ?>
				<a onClick="return confirmDelete();" href="manageusers.php?delete=<? echo $users->id[$i]; ?>"><img src="images/deletex.png" border="0" width="16" height="16"></a>
			</td>
		</tr>
<?
	}
?>
	</table>
</div>
