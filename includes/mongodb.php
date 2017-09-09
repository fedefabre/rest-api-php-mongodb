<?php

class dbHandler {

  private $db;
  private $collection;

  public $page;
  public $limit;
  public $skip;

  function __construct($_page) {
    $m = new MongoDB\Client("mongodb://localhost:27017");
    $this->db = $m->todolist;
    $this->collection = $m->todolist->todo;

    $this->page = $_page;
    if(!$this->page){$this->page = '1';}
    $this->limit = 5;
    $this->skip = ($this->page - 1) * $this->limit;
  }

  //Get All Tasks created
  public function getAllTasks()
  {
    $cursor = $this->collection->find([], [ 'limit' => $this->limit, 'skip' => $this->skip ]);
    $total = $this->collection->count();
    $args = array();
    foreach ($cursor as $document) {
      $temp = array(
           "id" => $document["_id"],
           "title" => $document["title"],
           "description" => $document["description"],
           "due_date" => $document["due_date"],
           "completed" => $document["completed"],
           "created_at" => $document["created_at"],
           "updated_at" => $document["updated_at"]
        );
      array_push($args,$temp);
    }

    $args['filter'] = array( 'filter' => 1);
    array_push($args,self::pagination($total));

    return $args;
  }

  // Receive filter parameters and send tasks that match
  public function getFilterTasks($array)
  {
    $filters = array();

    foreach(array_keys($array) as $key){
      if($array[$key] || ($key=='completed' && $array[$key] === false)){
        $filters[$key] = $array[$key];
        $c++;
      }
     }

     if(!$c) {
       $cursor = $this->collection->find([], [ 'limit' => $this->limit, 'skip' => $this->skip ]);
       $total = $this->collection->count();
     }else{
       $condition = array('$and' => array($filters));
       $cursor = $this->collection->find($condition, [ 'limit' => $this->limit, 'skip' => $this->skip ]);
       $total = $this->collection->count($condition);
     }

    $args = array();
    foreach ($cursor as $document) {
      $temp = array(
	         "id" => $document["_id"],
           "title" => $document["title"],
           "description" => $document["description"],
           "due_date" => $document["due_date"],
           "completed" => $document["completed"],
           "created_at" => $document["created_at"],
           "updated_at" => $document["updated_at"]
        );
      array_push($args,$temp);
    }

    $filters['filter'] = 1;
    array_push($args,$filters);
    array_push($args,self::pagination($total));

    return $args;
  }

  // Show an specific task determinated by id
  public function getOneTask($id)
  {
    $document = $this->collection->findOne(array('_id' => $id));
    $args = array(
         "id" => $document["_id"],
         "title" => $document["title"],
         "description" => $document["description"],
         "due_date" => $document["due_date"],
         "completed" => $document["completed"],
         "created_at" => $document["created_at"],
         "updated_at" => $document["updated_at"]
      );

    return $args;
  }

  // Edit an specific task determinated by id
  public function editTask($id,$parameters)
  {
    $this->collection->updateOne(
    array('_id' => $id),
    array('$set' => $parameters),
    array("upsert" => true)
    );

    return 1;
  }

  // Insert a new task
  public function insertTask($parameters)
  {
    $id = self::getNextId("taskid");
    $parameters['_id'] = $id;
    $this->collection->insertOne($parameters);

    return $id;
  }

  // Remove a task by a given id
  public function removeTask($id)
  {
    $this->collection->deleteOne(array('_id' => $id));
    return 1;
  }

  // - This method creates the pagination system and works only inside the object
  private function pagination($total)
  {
    $next  = ($this->page + 1);
    $prev  = ($this->page - 1);

      $pagination = array(
        "page" => $this->page,
        "prev" => $prev,
        "next" => $next,
        "limit" => $this->limit,
        "total" => $total
      );

    return $pagination;
  }

  // This method get the next id creating an auto_incremet identificator for any task
  private function getNextId($name) {
    $retval = $this->db->command(array(
      "findandmodify" => "counters",
      "query" => array("_id"=> $name),
      "update" => array('$inc'=> array("seq"=> 1))
      )
    );
    $counters = $this->db->counters;
    $id = $counters->findOne(array('_id' => $name));
    return $id["seq"];
  }
}
?>
