<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'database.php';

$app = new \Slim\App;

$app->get('/api/user',function(Request $request, Response $response, array $args){
	global $con;

	$data = [];
	$sql = "SELECT * FROM mahasiswa";
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

$app->get('/api/user/{nrp}', function (Request $request, Response $response, array $args) {
    global $con;

    
    $nrp = $args['nrp'];
   	$sql = "SELECT * FROM mahasiswa WHERE nrp = ".$nrp;
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



$app->post('/api/user', function(Request $request, Response $response, array $args){
	global $con;

	$obj = $request->getParsedBody();
	$status = array(
		'err' => 0,
		'msg' => ''
	);

	// Insert to Database
	$sql = "INSERT INTO mahasiswa VALUES(default,".$obj['nrp'].", '".$obj['nama']."')";
	$res = mysqli_query($con,$sql);

	if(!$res){
		$status['err'] = 1;
		$status['msg'] = "Cannot insert to database";
	}

	$response=$response->withHeader('Content-Type','application/json');

	$response->getBody()->write(json_encode($status));

	return $response;

});

$app->delete('/api/user/{nrp}', function(Request $request, Response $response, array $args){
	global $con;

	$obj = $request->getParsedBody();
	$status = array(
		'err' => 0,
		'msg' => ''
	);

	//Delete from database
	$sql = "DELETE FROM mahasiswa WHERE nrp=".$args['nrp'];
	$res = mysqli_query($con,$sql);

	if(!$res){
		$status['err'] = 1;
		$status['msg'] = "Cannot delete";
	}

	$response=$response->withHeader('Content-Type','application/json');

	$response->getBody()->write(json_encode($status));

	return $response;
});

$app->put('/api/user/{nrp}', function(Request $request, Response $response, array $args){
	global $con;

	$obj = $request->getParsedBody();
	$status = array(
		'err' => 0,
		'msg' => ''
	);

	//Update from database
	$sql = "UPDATE mahasiswa SET nama='".$obj['nama']."' WHERE nrp LIKE ".$args['nrp'];
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

$app->get('/api/barang',function(Request $request, Response $response, array $args){
	global $con;


	$data = [
		array(
			'id' => '1',
			'nama' => 'Nuka Cola',
			'quantity' => '25'
		),
		array(
			'id' => '2',
			'nama' => 'Bottlecaps',
			'quantity' => '500'
		),
		array(
			'id' => '3',
			'nama' => 'Stimpacks',
			'quantity' => '15'
		),
	];

	//Set Header
	$response=$response->withHeader('Content-Type','application/json');

	//Set Body
	$response->getBody()->write(json_encode($data));

	return $response;
});

$app->get('/api/barang/{id}',function(Request $request, Response $response, array $args){
	$id = $args['id'];
	//Set Header
	

	$data = [
		array(
			'id' => '1',
			'nama' => 'Nuka Cola',
			'quantity' => '25'
		),
		array(
			'id' => '2',
			'nama' => 'Bottlecaps',
			'quantity' => '500'
		),
		array(
			'id' => '3',
			'nama' => 'Stimpacks',
			'quantity' => '15'
		),
	];

	$res=[];
	foreach ($data as $key) {
		if($key['id'] == $id){
			//$response->getBody()->write(json_encode($key));
			$res = $key;
		}
	}

	//Set Header
	$response=$response->withHeader('Content-Type','application/json');

	//Set Body
	$response->getBody()->write(json_encode($res));

	return $response;
});



$app->run();