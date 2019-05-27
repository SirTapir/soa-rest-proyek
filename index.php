<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'database.php';

$app = new \Slim\App;

//CRUD user
$app->get('/user/{id}',function(Request $request, Response $response, array $args){
	global $con;

	$data = [];
	$id = $args['id'];
	$sql = "SELECT * FROM user WHERE id=".$id;
	$res = mysqli_query($con,$sql);

	while($row = mysqli_fetch_assoc($res)){
		$data[] = $row;
	}

	//Set Header
	$response=$response->withHeader('Content-Type','application/json');

	//Set Body
	$response->getBody()->write(json_encode($data));

	return $response;
});

$app->post('/user', function(Request $request, Response $response, array $args){
	global $con;

	$obj = $request->getParsedBody();
	$status = array(
		'err' => 0,
		'msg' => ''
	);

	// Insert to Database
	$sql = "INSERT INTO user VALUES(default, '".$obj['name']."', '".$obj['username']."', '".$obj['password']."')";
	$res = mysqli_query($con,$sql);

	if(!$res){
		$status['err'] = 1;
		$status['msg'] = "Cannot insert to database";
	}

	$response=$response->withHeader('Content-Type','application/json');

	$response->getBody()->write(json_encode($status));

	return $response;

});

$app->delete('/user/{id}', function(Request $request, Response $response, array $args){
	global $con;

	$obj = $request->getParsedBody();
	$status = array(
		'err' => 0,
		'msg' => ''
	);

	//Delete from database
	$sql = "DELETE FROM user WHERE id=".$args['id'];
	$res = mysqli_query($con,$sql);

	if(!$res){
		$status['err'] = 1;
		$status['msg'] = "Cannot delete";
	}

	$response=$response->withHeader('Content-Type','application/json');

	$response->getBody()->write(json_encode($status));

	return $response;
});

$app->put('/user/{id}', function(Request $request, Response $response, array $args){
	global $con;

	$obj = $request->getParsedBody();
	$status = array(
		'err' => 0,
		'msg' => ''
	);

	//Update from database
	$sql = "UPDATE user SET nama='".$obj['name']."', username='".$obj['username']."', password='".$obj['password']."' WHERE id_user = ".$args['id'];

	$res = mysqli_query($con,$sql);

	if(!$res){
		$status['err'] = 1;
		//$status['msg'] = "Cannot update";
		$status['msg'] = $sql;
	}

	$response=$response->withHeader('Content-Type','application/json');

	$response->getBody()->write(json_encode($status));

	return $response;
});

$app->get('/billing_pdam/{id_user}',function(Request $request, Response $response, array $args){
	global $con;

	$data = [];
	$id = $args['id_user'];
	$sql = "SELECT * FROM pdam WHERE user_id=".$id;
	$res = mysqli_query($con,$sql);

	while($row = mysqli_fetch_assoc($res)){
		$data[] = $row;
	}

	//Set Header
	$response=$response->withHeader('Content-Type','application/json');

	//Set Body
	$response->getBody()->write(json_encode($data));

	return $response;
});

$app->get('/billing_pln/{id_user}',function(Request $request, Response $response, array $args){
	global $con;

	$data = [];
	$id = $args['id_user'];
	$sql = "SELECT * FROM pln WHERE user_id=".$id;
	$res = mysqli_query($con,$sql);

	while($row = mysqli_fetch_assoc($res)){
		$data[] = $row;
	}

	//Set Header
	$response=$response->withHeader('Content-Type','application/json');

	//Set Body
	$response->getBody()->write(json_encode($data));

	return $response;
});

$app->post('/payment_billing/', function(Request $request, Response $response, array $args){
	global $con;

	$obj = $request->getParsedBody();
	$status = array(
		'err' => 0,
		'msg' => ''
	);

	// Insert to Database
	$sql = "INSERT INTO billing VALUES(default, '".$obj['name']."', '".$obj['birthdate']."', '".$obj['gender']."', '".$obj['email']."', '".$obj['address']."', '".$obj['username']."', '".$obj['password']."')";
	$res = mysqli_query($con,$sql);

	if(!$res){
		$status['err'] = 1;
		$status['msg'] = "Cannot insert to database";
	}

	$response=$response->withHeader('Content-Type','application/json');

	$response->getBody()->write(json_encode($status));

	return $response;

});



$app->run();