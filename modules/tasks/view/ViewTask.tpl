<form action="." method="post">

	<ul>
		<li>
        	<label class="tasklabel" for="name">Name:</label>
        	<div class="taskvalue" id="name" name="name"><?php echo $model->getName() ?></div><br />
		</li>
		<li>
        	<label class="tasklabel" for="start_date">Start Date:</label>
        	<div class="taskvalue" id="start_date"><?php echo $model->getStartDate() ?></div><br />
		</li>
		<li>
        	<label class="tasklabel" for="description">Description:</label>
        	<p id="description"><?php echo $model->getDescription() ?></p><br />
		</li>
		<li>
        	<a href="/task/<?php echo $model->getId()?>/edit/">Edit</a>
		</li>
	</ul>

</form>
