<?
	$form = new Form();
	$form->attributes = "name='searchform' id='searchform'";
?>

<div id="mainpage">
	<? $form->start('customersearch.php', 'POST'); ?>
	<table border='0'>
		<tr>
			<td colspan='2'>
				<font size='+1' color='#0000cc'>
					<b>Customer Search</b><br><br>
				</font>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('searchtext', "Search: "); ?>
				<? $form->attributes = "maxlength='64' size='20'"; ?>
				<? $form->element('searchtext', 'text', $searchText); ?>
				<? $form->startSelect('searchtype'); ?>
				<? $form->addSelectOption('lastname', 'Last Name'); ?>
				<? $form->addSelectOption('firstname', 'First Name'); ?>
				<? $form->addSelectOption('telephone', 'Phone Number'); ?>
				<? $form->addSelectOption('email', 'Email Address'); ?>
				<? $form->endSelect(); ?>
				<?
					$form->attributes = "class='sbutton'";
					$form->element('submitButton', 'submit', 'Search');
				?>
			</td>
		</tr>
	</table>
	<? $form->end(); ?>
</div>
