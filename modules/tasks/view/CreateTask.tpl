<form action="." method="post">

	<label for="name">Name:</label>
	<input type="text" id="name" name="name" value="Untitled Task"></input><br />

	<label for="start_date">Start Date:</label>
	<input type="text" id="start_date" name="start_date" value="<?php echo date('d:m:Y'); ?>"></input><br />

	<label for="description">Description:</label>
	<textarea id="description" name="description"></textarea><br />

	<input type="hidden" name="command" value="create"></input>

	<input type="submit" value="Save"></input>

</form>
