<?php

function getNextId($name) {
  global $db;
  global $m;
  $retval = $db->command(array(
    "findandmodify" => "counters",
    "query" => array("_id"=> $name),
    "update" => array('$inc'=> array("seq"=> 1))
    )
  );
  $collection = $m->todolist->counters;
  $id = $collection->findOne(array('_id' => $name));
  return $id["seq"];
}

?>
