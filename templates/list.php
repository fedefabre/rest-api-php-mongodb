<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tasks list</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  </head>
  <body>

<div class="container">

    <h1 class="mt-3 mb-3">Tasks list</h1>

        <form class="" action="/list" method="post">

        <?php foreach ($data as $row) { if($row['filter']){?>

        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="exampleInputPassword1">Due date</label>
              <input type="date" class="form-control" name="due_date" id="due_date" placeholder="Due date" value="<?php echo $row["due_date"]?>">
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="exampleInputPassword1">Created at</label>
              <input type="date" class="form-control" name="created_at" id="created_at" placeholder="Created at" value="<?php echo $row["created_at"]?>">
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="exampleInputPassword1">Updated at</label>
              <input type="date" class="form-control" name="updated_at" id="updated_at" placeholder="Updated at" value="<?php echo $row["updated_at"]?>">
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="exampleSelect1">Completed</label>
              <select class="form-control" id="completed" name="completed">
                <option value="" selected>Select one</option>
                <option <?php if($row['completed'] === false){ echo 'selected'; } ?> value="false">No</option>
                <option <?php if($row['completed']){ echo 'selected'; } ?> value="true">Yes</option>
              </select>
            </div>
          </div>
          <div class="col" style="margin-top:32px;">
            <button type="submit" class="btn btn-warning">Filter</button>
            <a href="/list" class="btn btn-danger">Clean filters</a>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <?php }
              if($row['page'] > 1){
              echo '<button type="submit" name="page" value="' . $row['prev'] . '" class="btn btn-info">Previous Page</button>';
                if($row['page'] * $row['limit'] < $row['total']) {
                    echo ' <button type="submit" name="page" value="' . $row['next'] . '" class="btn btn-info">Next Page</button>';
                }
              } else {
                if($row['page'] * $row['limit'] < $row['total']) {
                    echo ' <button type="submit" name="page" value="' . $row['next'] . '" class="btn btn-info">Next Page</button>';
                }
              }
            } ?>

            <a href="/insert" class="btn btn-success float-right">Create new task</a>
          </div>
        </div>

    </form>


	<table class="table mt-4">
	  <thead>
	    <tr>
	      <th>ID</th>
	      <th>Title</th>
	      <th>Description</th>
	      <th>Due date</th>
	      <th>Completed</th>
	      <th>Created at</th>
	      <th>Updated at</th>
        <th>Show</th>
        <th>Edit</th>
        <th>Delete</th>

	    </tr>
	  </thead>
	  <tbody>
		<?php
		foreach ($data as $row) {
    if($row['completed']){$complete="Yes";}else{$complete="No";}
    if($row['id']){
      echo '<tr>';
      echo '<td>'.$row['id'].'</td>';
      echo '<td>'.$row['title'].'</td>';
      echo '<td>'.$row['description'].'</td>';
      echo '<td>'.$row['due_date'].'</td>';
      echo '<td>'.$complete.'</td>';
      echo '<td>'.$row['created_at'].'</td>';
      echo '<td>'.$row['updated_at'].'</td>';
      echo '<td><a href="/show/'.$row['id'].'">Show</a></td>';
      echo '<td><a href="/edit/'.$row['id'].'">Edit</a></td>';
      echo '<td><a href="/remove/'.$row['id'].'">Remove</a></td>';
      echo '</tr>';
    }
		}
		?>
	  </tbody>
	</table>

  <div class="row">
    <div class="col">
        <hr>
        <p>REST web api PHP-MongoDB developed by <a href="https://federicofabre.com">Federico Fabre</a>. Check this code on my <a href="https://github.com/fedefabre/rest-api-php-mongodb">GitHub</a>. </p>
    </div>
  </div>

  </div>

  </body>
</html>
