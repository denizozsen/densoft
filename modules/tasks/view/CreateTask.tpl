<form action="." method="post">

	<ul id="task_details">
		<li>
        	<label class="tasklabel" for="name">Name:</label>
        	<input class="taskvalue" type="text" id="name" name="name" value="Untitled Task"></input><br />
        </li>
		<li>
        	<label class="tasklabel" for="start_date">Start Date:</label>
        	<input class="taskvalue" type="text" id="start_date" name="start_date" value="<?php echo date('d-m-Y'); ?>"></input><br />
        </li>
		<li>
        	<label class="tasklabel" for="description">Description:</label>
        	<textarea style="height: 12em;" class="taskvalue" id="description" name="description"></textarea><br />
        </li>
		<li>
        	<input type="hidden" name="command" value="create"></input>
        	<input type="submit" value="Save"></input>
        	<input type="button" value="Cancel" onclick="window.location = '/'"></input>
        </li>
	</ul>

</form>
