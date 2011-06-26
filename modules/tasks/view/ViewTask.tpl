<form action="." method="post">

	<ul>
		<li>
        	<label style="width: 20%; float:left" for="name">Name:</label>
        	<span style="width: 20%;"  type="text" id="name" name="name" value="<?php echo $model->getName() ?>"></span><br />
		</li>
		<li>
        	<label style="width: 20%; float:left" for="start_date">Start Date:</label>
        	<span style="width: 20%;" type="text" id="start_date" name="start_date" value="<?php echo $model->getStartDate() ?>"></span><br />
		</li>
		<li>
        	<label for="description">Description:</label>
        	<p id="description" name="description"><?php echo $model->getDescription() ?></p><br />
		</li>
		<li>
        	<a href="/task/<?php echo $model->getId()?>/edit/">Edit</a>
		</li>
	</ul>

</form>
