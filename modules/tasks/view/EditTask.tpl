<form action="." method="post">

	<label for="name">Name:</label>
	<input type="text" id="name" name="name" value="<?php echo $model->getName() ?>"></input><br />

	<label for="start_date">Start Date:</label>
	<input type="text" id="start_date" name="start_date" value="<?php echo $model->getStartDate() ?>"></input><br />

	<label for="description">Description:</label>
	<textarea id="description" name="description"><?php echo $model->getDescription() ?></textarea><br />

	<input type="hidden" name="id" value="<?php echo $model->getId() ?>"></input>
	<input type="hidden" name="command" value="edit"></input>

	<input type="submit" value="Save"></input>

</form>
