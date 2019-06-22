<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'database.php';

$app = new \Slim\App;

//Get user by ID
$app->get('/api/user/{id}',function(Request $request, Response $response, array $args){
	global $con;

	$data = [];
	$id = $args['id'];
	$sql = "SELECT * FROM user WHERE id_user=".$id;
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

//Get PDAM data
$app->get('/api/billing_pdam/{id}/{meteranPDAM}', function(Request $request, Response $response, array $args){
	global $con;



	$data = [];
	$id = $args['id'];
	$meteran = $args['meteranPDAM'];
	$sql = "SELECT * FROM pdam WHERE no_pdam=".$meteran." and user_id=".$id;
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

//Get PLN data
$app->get('/api/billing_pln/{id}/{meteranPLN}', function(Request $request, Response $response, array $args){
	global $con;

	$data = [];
	$id = $args['id'];
	$meteran = $args['meteranPLN'];
	$sql = "SELECT * FROM pln WHERE no_pln=".$meteran." and user_id=".$id;
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

//Update PDAM billing date
$app->put('/api/billing_pdam/{id}', function(Request $request, Response $response, array $args){
	global $con;

	$obj = $request->getParsedBody();
	$status = array(
		'err' => 0,
		'msg' => ''
	);

	//Update from database
	$sql = "UPDATE pdam SET status='".$obj['status']."' WHERE user_id = ".$args['id'];

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

//Update PLN billing date
$app->put('/api/billing_pln/{id}', function(Request $request, Response $response, array $args){
	global $con;

	$obj = $request->getParsedBody();
	$status = array(
		'err' => 0,
		'msg' => ''
	);

	//Update from database
	$sql = "UPDATE pln SET status='".$obj['status']."' WHERE user_id = ".$args['id'];

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

//Send payment data
$app->post('/api/payment_billing', function(Request $request, Response $response, array $args){
	global $con;
    $obj = $request->getParsedBody();
    $status = array(
        'err' => 0,
        'msg' => ''
    );

    //table name assumption: invoice
    //PDAM
    $sql = "INSERT INTO invoice VALUES(default, ".$obj['user_id'].", 'pdam', ".$obj['no_pdam'].", Rp ".$obj['biaya'].",".$obj['tanggal'].",'".$obj['status']."')";
    $res = mysqli_query($con, $sql);

    //PLN
    $sql = "INSERT INTO invoice VALUES(default, ".$obj['user_id'].", 'pln', ".$obj['no_pln'].", Rp ".$obj['biaya'].",".$obj['tanggal'].",'".$obj['status']."')";
    $res = mysqli_query($con, $sql);

    if(!$res){
        $status['err'] = 1;
        $status['msg'] = 'cannot insert to database';
    }

    $response = $response->withHeader('Content-type', 'application/json');

    $response->getBody()->write(json_encode($status));

    return $response;
});

$app->run();