<form action="." method="post">

	<ul id="task_details">
		<li>
        	<label class="task_label_bold" for="name">Name:</label>
        	<div   class="task_editable" id="name"><?php echo $this->model->getName() ?></div><br />
		</li>
		<li>
        	<label class="task_label_bold" for="start_date">Start Date:</label>
        	<div   class="task_editable" id="start_date"><?php echo $this->model->getStartDate() ?></div><br />
		</li>
		<li>
        	<label class="task_label_bold" for="description">Description:</label>
        	<p id="description"><?php echo $this->model->getDescription() ?></p><br />
		</li>
		<li>
        	<input type="button" value="Edit" onclick="window.location = '/task/?task_id=<?php echo $this->model->getId()?>&edit'"></input>
		</li>
	</ul>

</form>
