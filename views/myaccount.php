<?
	$form = new Form();
?>

<div id="mainpage">
	<? $form->start(); ?>
	<table border='0'>
		<tr>
			<td colspan='2'>
				<font size='+1' color='#0000cc'>
					<b>Update Your Account</b><br><br>
				</font>
			</td>
		</tr>
		</tr>
			<td>
				<? $form->label('address', "Address: "); ?>
			</td>
			<td>
				<? $form->attributes = "maxlength='32' size='25'"; ?>
				<? $form->element('address', 'text', $user->address); ?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('city', "City: "); ?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='32' size='20'";
					$form->element('city', 'text', $user->city);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('state', "State: "); ?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='32' size='6'";
					$form->element('state', 'text', $user->state);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('zip', "Zip Code: "); ?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='14' size='6'";
					$form->element('zip', 'text', $user->zip);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('phone', "Telephone: "); ?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='15' size='12'";
					$form->element('phone', 'text', $user->phone);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('email', "Email: "); ?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='64' size='20'";
					$form->element('email', 'text', $user->email);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('newpassword', "Update Password: "); ?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='250' size='30'";
					$form->element('newpassword', 'password');
				?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('confirmpassword', "Confirm Password: "); ?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='250' size='30'";
					$form->element('confirmpassword', 'password');
				?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<?
					$form->attributes = "class='sbutton'";
					$form->element('update', 'submit', 'Update');
				?>
			</td>
		</tr>
	</table>
	<? $form->end(); ?>
</div>
