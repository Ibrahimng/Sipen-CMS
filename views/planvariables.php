<div id="mainpage">
	<h1>Plan Variables</h1>
	<a href="createplanvariable.php">Create Plan Variable</a>
<?
	$form = new Form();
	$form->start();
	$totalVars = count($planVariable->id);
	if ($totalVars)
	{
?>
		<table border='1' class='s_table'>
			</tr>
				<td>
					<b>Name</b>
				</td>
				<td>
					<b>Default Value</b>
				</td>
				<td width="200">
					<b>Plan Name</b>
				</td>
				<td>
					<b>Description</b>
				</td>
				<td>
					<b>Req?</b>
				</td>
				<td>
					<b>Validation</b>
				</td>
				<td>
					&nbsp
				</td>
			</tr>
<?
		for ($i = 0; $i < $totalVars; $i++)
		{
?>
			<tr>
				<td><? echo $planVariable->name[$i]; ?></td>
				<td>
				<?
					$form->element('name[]', 'hidden', $planVariable->name[$i]);
					$form->element('id[]', 'hidden', $planVariable->id[$i]);
				  $form->attributes = "maxlength='64' size='15'";
          $form->element('defaultvalue[]', 'text', $planVariable->defaultvalue[$i]);
				?>
				</td>
				<td><? echo $planVariable->planname[$i]; ?></td>
				<td>
				<?
					$form->attributes = "maxlength='200' size='20'";
					$form->element('description[]', 'text', $planVariable->description[$i]);
				?>
				</td>
				<td><?
					if ($planVariable->required[$i])
						$form->attributes = "checked";
					$form->element('required['.$i.']', 'checkbox', '1', 's_checkbox');
				?></td>
				<td><? echo $planVariable->validation[$i]; ?></td>
				<td><a onClick="return confirmDelete();" href="planvariables.php?delete=<? echo $planVariable->id[$i]; ?>"><img src="images/deletex.png" border="0" width="16" height="16"></a></td>
			</tr>
<?
		}
?>
		</table>
<?
	}
	else
	{
		echo "<br><b>There are currently no plan variables.</b>";
	}
	$form->attributes = "class='sbutton'";
	$form->element('submitButton', 'submit', 'Update');
	$form->end();
?>
</div>
