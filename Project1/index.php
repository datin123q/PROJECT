<?php
	header('location: view/login.php');

?>
<form action='' method='get' class='formContainer'>
	Red<input type='checkbox' name='color[]' value='red'>
	Green<input type='checkbox' name='color[]' value='green'>
	Blue<input type='checkbox' name='color[]' value='blue'>
	Cyan<input type='checkbox' name='color[]' value='cyan'>
	Magenta<input type='checkbox' name='color[]' value='Magenta'>
	Yellow<input type='checkbox' name='color[]' value='yellow'>
	Black<input type='checkbox' name='color[]' value='black'>
	<input type='submit' value='submit'>
<br>  
		<input type='button' onclick='selects()' value='Select All'/>  
		<input type='button' onclick='deSelect()' value='Deselect All'/>  
</form>