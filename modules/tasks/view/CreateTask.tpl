<form action="." method="post">

	<ul id="task_details">
		<li>
        	<label class="task_label" for="name">Name:</label>
        	<input class="task_value" type="text" id="name" name="name" value="Untitled Task"></input><br />
        </li>
		<li>
        	<label class="task_label" for="start_date">Start Date:</label>
        	<input class="task_value" type="text" id="start_date" name="start_date" value="<?php echo date('Y-m-d'); ?>"></input><br />
        </li>
		<li>
        	<label class="task_label" for="description">Description:</label>
        	<textarea style="height: 12em;" class="task_value" id="description" name="description"></textarea><br />
        </li>
		<li>
        	<input type="hidden" name="command" value="create"></input>
        	<input type="submit" value="Save"></input>
        	<input type="button" value="Cancel" onclick="window.location = '/'"></input>
        </li>
	</ul>

</form>
