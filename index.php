<?php

// This REST web API was developed by Federico Fabre
// Argentina, September 2017.
//
// Check my work on https://federicofabre.com

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;

require 'vendor/autoload.php';
require 'includes/mongodb.php';

$app = new \Slim\App;
$container = $app->getContainer();
$container['renderer'] = new PhpRenderer("templates/");

$app->get('/list', function (Request $request, Response $response, $args) {
    $page = $request->getParam('page');
    $mongo = new dbHandler($page);
    $args = $mongo->getAllTasks();

    return $this->renderer->render($response, "/list.php", $args);
});

$app->post('/list', function (Request $request, Response $response, $args) {
    $page = $request->getParam('page');
    $complete = $request->getParam('completed');
    if($complete == "false"){ $completed = false; }elseif($complete == 'true') { $completed = true; }

    $parameters = array(
        "due_date" => $request->getParam('due_date'),
        "created_at" => $request->getParam('created_at'),
        "updated_at" => $request->getParam('updated_at'),
        "completed" => $completed
    );

    $mongo = new dbHandler($page);
    $args = $mongo->getFilterTasks($parameters);

    return $this->renderer->render($response, "/list.php", $args);
});

$app->get('/show/{id}', function (Request $request, Response $response) {
    $page = $request->getParam('page');
    $id = intval($request->getAttribute('id'));
    $mongo = new dbHandler($page);
    $args = $mongo->getOneTask($id);

    return $this->renderer->render($response, "/show.php", $args);
});

$app->get('/edit/{id}', function (Request $request, Response $response) {
    $page = $request->getParam('page');
    $id = intval($request->getAttribute('id'));
    $mongo = new dbHandler($page);
    $args = $mongo->getOneTask($id);

    return $this->renderer->render($response, "/edit.php", $args);
});

$app->post('/edit/{id}', function (Request $request, Response $response) {
    $page = $request->getParam('page');
    $id = intval($request->getAttribute('id'));
    $complete = $request->getParam('completed');
    $completed = ($complete === 'true');

    $parameters = array(
        "title" => $request->getParam('title'),
        "description" => $request->getParam('description'),
        "due_date" => $request->getParam('due_date'),
        "updated_at" => date("Y-m-d"),
        "completed" => $completed
    );

    if(!$parameters['title'] || !$parameters['due_date']) {
      $response->getBody()->write("You must declare title and due date");
      return $response;
    }

    $mongo = new dbHandler($page);
    $tmp = $mongo->editTask($id,$parameters);

    return $response->withRedirect("/show/$id");
});

$app->get('/insert', function (Request $request, Response $response, $args) {
    return $this->renderer->render($response, "/insert.php", $args);
});

$app->post('/insert', function (Request $request, Response $response) {
    $page = $request->getParam('page');
    $parameters = array(
        "title" => $request->getParam('title'),
        "description" => $request->getParam('description'),
        "due_date" => $request->getParam('due_date'),
        "completed" => false,
        "created_at" => date("Y-m-d"),
        "updated_at" => date("Y-m-d")
    );

    if(!$parameters['title'] || !$parameters['due_date']) {
      $response->getBody()->write("You must declare title and due date");
      return $response;
    }

    $mongo = new dbHandler($page);
    $id = $mongo->insertTask($parameters);

    return $response->withRedirect("/show/$id");
});

$app->get('/remove/{id}', function (Request $request, Response $response) {
    $page = $request->getParam('page');
    $id = intval($request->getAttribute('id'));
    $mongo = new dbHandler($page);
    $tmp = $mongo->removeTask($id);
    return $response->withRedirect('/list');
});

$app->get('/', function (Request $request, Response $response) {
return $response->withRedirect('/list');
});

$app->run();
?>
