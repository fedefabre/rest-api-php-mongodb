<?php

class pagination {
  public $page;
  public $total;
  public $limit;
  public $filter;

  function __construct($_total,$_page,$filter) {

    $this->page = $_page;
    $this->total = $_total;
    $this->limit = 5;
    $this->filter = $filter;

  }

  //Get All Tasks
  public function getPagination()
  {

    $next  = ($this->page + 1);
    $prev  = ($this->page - 1);

    if ($this->filter) {
      $pagination = array(
        "page" => $this->page,
        "prev" => $prev,
        "next" => $next,
        "limit" => $this->limit,
        "total" => $this->total,
        "filter" => 1
      );
    } else {
      $pagination = array(
        "page" => $this->page,
        "prev" => $prev,
        "next" => $next,
        "limit" => $this->limit,
        "total" => $this->total
      );
    }




    return $pagination;

  }
}

?>
