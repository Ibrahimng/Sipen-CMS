<?
	$form = new Form();
	$form->attributes = "name='createuserform' id='createuserform'";
?>

<div id="mainpage">
	<? $form->start(); ?>
	<table border='0'>
		<tr>
			<td colspan='2'>
				<font size='+1' color='#0000cc'>
					<b>Create User Account</b><br><br>
				</font>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('newfirstname', "First Name: "); ?>
			</td>
			<td>
				<? $form->attributes = "maxlength='32' size='15'"; ?>
				<? $form->element('newfirstname', 'text', $newUser->firstname); ?>
			</td>
		</tr>
			<td>
				<? $form->label('newlastname', "Last Name: "); ?>
			</td>
			<td>
				<? $form->attributes = "maxlength='32' size='15'"; ?>
				<? $form->element('newlastname', 'text', $newUser->lastname); ?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('newusername', "Username: "); ?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='32' size='25'";
					$form->element('newusername', 'text', $newUser->username);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<?
					$form->label('newpassword', "Password: ", "slabel");
				?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='32' size='25'";
					$form->element('newpassword', 'password');
					$form->element('newcid', 'hidden', '1000');
				?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<?
					$form->attributes = "class='sbutton'";
					$form->element('submitButton', 'submit', 'Login');
				?>
			</td>
		</tr>
	</table>
	<? $form->end(); ?>
</div>
