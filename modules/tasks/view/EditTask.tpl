<form action="." method="post">

	<ul id="task_details">
		<li>
        	<label class="task_label" for="name">Name:</label>
        	<input class="task_value" type="text" id="name" name="name" value="<?php echo $this->model->getName() ?>"></input><br />
		</li>
		<li>
        	<label class="task_label" for="start_date">Start Date:</label>
        	<input class="task_value" type="text" id="start_date" name="start_date" value="<?php echo $this->model->getStartDate() ?>"></input><br />
		</li>
		<li>
        	<label class="task_label" for="description">Description:</label>
        	<textarea style="height: 12em;" class="task_value" id="description" name="description"><?php echo $this->model->getDescription() ?></textarea><br />
		</li>
		<li>
        	<input type="hidden" name="id" value="<?php echo $this->model->getId() ?>"></input>
        	<input type="hidden" name="command" value="update"></input>    
        	<input type="submit" value="Save"></input>
        	<input type="button" value="Cancel" onclick="window.location = '/task/?task_id=<?php echo $this->model->getId()?>'"></input>
		</li>
	</ul>

</form>
