<?
	$form = new Form();
	$form->attributes = "name='registerform' id='registerform'";
?>

<div id="centerpage">
	<? $form->start('login.php', 'post'); ?>
	<table border='0'>
		<tr>
			<td colspan='2'>
				<img border="0" src="images/sipenlogo.gif" width="374" height="64"><br>
				<font size='+1' color='#0000cc'>
					<b>Sipen Account Login</b><br><br>
				</font>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('username', "Username: ", "slabel"); ?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='32' size='25'";
					$form->element('username', 'text', $username);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<?
					$form->label('password', "Password: ", "slabel");
				?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='32' size='25'";
					$form->element('password', 'password');
					$form->element('redirect', 'hidden', $redirect);
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
