<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Insert task</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  </head>
  <body>

<style>
.form-group.required label:after {
    content: " *" !important;
    color: red !important;
}
</style>

<div class="container">

    <h1 class="mt-3 mb-3">Insert task</h1>

    <form class="" action="/insert" method="post">

      <div class="form-group required">
        <label for="exampleInputEmail1">Task title</label>
        <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp" placeholder="Enter task title" required>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Task description</label>
        <input type="text" class="form-control" name="description" id="description" placeholder="Describe the task">
      </div>
      <div class="form-group required">
        <label for="exampleInputPassword1">Due date</label>
        <input type="date" class="form-control" name="due_date" id="due_date" placeholder="Due date" required>
      </div>

      <button type="submit" class="btn btn-success">Submit</button>

    </form>

    <a href="/list" class="btn btn-primary mt-3">Return to task list</a>


    <div class="row">
      <div class="col">
          <hr>
          <p>REST web api PHP-MongoDB developed by <a href="https://federicofabre.com">Federico Fabre</a>. Check this code on my <a href="https://github.com/fedefabre/rest-api-php-mongodb">GitHub</a>. </p>
      </div>
    </div>

</div>

  </body>
</html>
