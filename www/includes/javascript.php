<script language="javascript">
	// Obtained this snippet from
	// http://dojocampus.org/content/2008/03/14/functional-ajax-with-dojo/
  function loadIntoNode(data, xhr){
    if(xhr.args.node){
      xhr.args.node.innerHTML = data;
    }
  }

	function confirmDelete()
	{
		return confirm("This action cannot be undone.  Are you sure you wish to delete this object?");
	}

  function showForm(formid)
  {
		document.getElementById(formid).style.display = 'block';
  }

  function hideForm(formid)
  {
		document.getElementById(formid).style.display = 'none';
  }

	function verifyEmail(emailAddress)
	{
		var regex = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		return regex.test(emailAddress);
	}

	function requireField(fieldName)
	{
		if (document.getElementById(fieldName).value.length == 0)
			return false;
		else
			return true;
	}

  function selectFieldValue(fieldName, fieldValue)
  {
    var menuName = document.getElementById(fieldName);
    var optionsCount = menuName.options.length;
    var i = 0;
    for (i = 0; i < optionsCount; i++)
    {
      if (menuName.options[i].value == fieldValue)
      {
        menuName.options[i].selected = true;
      }
    }
  }
</script>

