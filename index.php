<?php

// Use Loader() to autoload our model
$loader = new \Phalcon\Loader();

$loader->registerDirs(array(
  __DIR__ . '/models/'
))->register();

$di = new \Phalcon\DI\FactoryDefault();

//Set up the database service
$di->set('db', function(){
  return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
      "host" => "localhost",
      "username" => "sp",
      "password" => "password",
      "dbname" => "stored-procedures"
  ));
});

//Create and bind the DI to the application

$app = new \Phalcon\Mvc\Micro($di);

//Retrieves all robots
$app->get('/api/robots', function() use ($app) {

  $robots = Robots::getAll();

  $data = array();
  foreach ($robots as $robot) {
      $data[] = array(
          'id' => $robot->id,
          'name' => $robot->name,
      );
  }

  echo json_encode($data);
});

//Searches for robots with $name in their name
$app->get('/api/robots/search/{name}', function($name) use ($app) {

	$robots = Robots::getByName($name);

  $data = array();
  foreach ($robots as $robot) {
      $data[] = array(
          'id' => $robot->id,
          'name' => $robot->name,
      );
  }

  echo json_encode($data);

});

//Retrieves robots based on primary key
$app->get('/api/robots/{id:[0-9]+}', function($id) use ($app) {

  $robots = Robots::getById($id);

  $data = array();
  foreach ($robots as $robot) {
      $data[] = array(
          'id' => $robot->id,
          'name' => $robot->name,
      );
  }

  echo json_encode($data);
});

//Adds a new robot
$app->post('/api/robots', function() use ($app) {
	$robot = $app->request->getJsonRawBody();
	Robots::addRobot($robot);
});

//Updates robots based on primary key
$app->put('/api/robots/{id:[0-9]+}', function($id) use($app) {
	$robot = $app->request->getJsonRawBody();
	var_dump($robot);
	Robots::updateRobot($robot, $id);

});

//Deletes robots based on primary key
$app->delete('/api/robots/{id:[0-9]+}', function($id) use ($app) {
	Robots::deleteRobot($id);
});

$app->handle();