<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Show task</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  </head>
  <body>

<div class="container">

    <h1 class="mt-3 mb-3">Task ID <?php echo $data['id']?></h1>

	<table class="table">
	  <thead>
	    <tr>
	      <th>ID</th>
	      <th>Title</th>
	      <th>Description</th>
	      <th>Due date</th>
	      <th>Completed</th>
	      <th>Created at</th>
	      <th>Updated at</th>
        <th>Edit</th>
        <th>Delete</th>

	    </tr>
	  </thead>
	  <tbody>
		<?php
    if($data['completed']){$complete="Yes";}else{$complete="No";}
		echo '<tr>';
		echo '<td>'.$data['id'].'</td>';
		echo '<td>'.$data['title'].'</td>';
		echo '<td>'.$data['description'].'</td>';
		echo '<td>'.$data['due_date'].'</td>';
		echo '<td>'.$complete.'</td>';
		echo '<td>'.$data['created_at'].'</td>';
		echo '<td>'.$data['updated_at'].'</td>';
    echo '<td><a href="/edit/'.$data['id'].'">Edit</a></td>';
    echo '<td><a href="/remove/'.$data['id'].'">Remove</a></td>';
		echo '</tr>';
		?>
	  </tbody>
	</table>

	<a href="/insert" class="btn btn-primary">Create new task</a>
  <a href="/list" class="btn btn-success">Return to list</a>

  <div class="row">
    <div class="col">
        <hr>
        <p>REST web api PHP-MongoDB developed by <a href="https://federicofabre.com">Federico Fabre</a>. Check this code on my <a href="#">Github</a>. </p>
    </div>
  </div>

</div>

  </body>
</html>
