<?php
	$id = $_GET["id"];
	$invoice_id = $_GET["invoice_id"];
?>
<!DOCTYPE html>
<html>
<head>
	<title>	</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="styles.css">
</head>
<script>
	var siscoIP = 'http://192.168.0.126';
	function load(){
  		document.getElementById("id").value = <?php echo $id; ?>;
  		
  		$("#pln").hide();
  		$("#pdam").show();
  	}
</script>
<body onload="load()">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle navbar-toggle-sidebar collapsed">
			MENU
			</button>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">
				Administrator
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      
			<form class="navbar-form navbar-left" method="GET" role="search">
				<div class="form-group">
					<input type="text" name="q" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="http://www.pingpong-labs.com" target="_blank">Visit Site</a></li>
				<li class="dropdown ">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						Account
						<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li class="dropdown-header">SETTINGS</li>
							<li class=""><a href="#">Other Link</a></li>
							<li class=""><a href="#">Other Link</a></li>
							<li class=""><a href="#">Other Link</a></li>
							<li class="divider"></li>
							<li><a href="#">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>  	<div class="container-fluid main-container">
  		<div class="col-md-2 sidebar">
  			<div class="row">
	<!-- uncomment code for absolute positioning tweek see top comment in css -->
	<div class="absolute-wrapper"> </div>
	<!-- Menu -->
	<div class="side-menu">
		<nav class="navbar navbar-default" role="navigation">
			<!-- Main Menu -->
			<div class="side-menu-container">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-plane"></span> Active Link</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-cloud"></span> Link</a></li>

					<!-- Dropdown-->
					<li class="panel panel-default" id="dropdown">
						<a data-toggle="collapse" href="#dropdown-lvl1">
							<span class="glyphicon glyphicon-user"></span> Sub Level <span class="caret"></span>
						</a>

						<!-- Dropdown level 1 -->
						<div id="dropdown-lvl1" class="panel-collapse collapse">
							<div class="panel-body">
								<ul class="nav navbar-nav">
									<li><a href="#">Link</a></li>
									<li><a href="#">Link</a></li>
									<li><a href="#">Link</a></li>

									<!-- Dropdown level 2 -->
									<li class="panel panel-default" id="dropdown">
										<a data-toggle="collapse" href="#dropdown-lvl2">
											<span class="glyphicon glyphicon-off"></span> Sub Level <span class="caret"></span>
										</a>
										<div id="dropdown-lvl2" class="panel-collapse collapse">
											<div class="panel-body">
												<ul class="nav navbar-nav">
													<li><a href="#">Link</a></li>
													<li><a href="#">Link</a></li>
													<li><a href="#">Link</a></li>
												</ul>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</li>

					<li><a href="#"><span class="glyphicon glyphicon-signal"></span> Link</a></li>

				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>

	</div>
</div>  		</div>
  		<div class="col-md-10 content">
  			  <div class="panel panel-default">
	<div class="panel-heading">
		Run Script
	</div>
	<div class="panel-body">
		<form action="#" enctype="multipart/form-data">
			<div class="form-group row">
		    <label for="id" class="col-sm-2 col-form-label">ID</label>
		    <div class="col-sm-10">
		      <input type="number" name="id" id="id" required disabled>
		    </div>
		  </div> 
		  <div class="form-group row">
		  	<label for="radio" class="col-sm-2 col-form-label"></label>
		    <div class="col-sm-10">
		      <input type="radio" name="tipe" value="pdam" checked>PDAM
		      <input type="radio" name="tipe" value="pln">PLN
		    </div>
		  </div>
		  <div id='pdam'>
			  <div class="form-group row">
			    <label for="noMeteranPDAM" class="col-sm-2 col-form-label">No Meteran PDAM</label>
			    <div class="col-sm-10">
			      <input type="number" name="noMeteranPDAM" id="noMeteranPDAM" required>
			    </div>
			  </div>  
			  <div class="form-group row">
			    <label for="noMeteranPDAM" class="col-sm-2 col-form-label"></label>
			    <div class="col-sm-10">
			      <button type="button" id="submit-pdam-btn" class="btn btn-primary">Submit</button>
			    </div>
			  </div> 
		  </div>
		</form>

		<form action="#" method="get" enctype="multipart/form-data">
		  <div id="pln">
			  <div class="form-group row">
			    <label for="noMeteranPLN" class="col-sm-2 col-form-label">No Meteran PLN</label>
			    <div class="col-sm-10">
			      <input type="number" name="noMeteranPLN" id="noMeteranPLN" required>
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="noMeteranPDAM" class="col-sm-2 col-form-label"></label>
			    <div class="col-sm-10">
			      <button type="button" id="submit-pln-btn" class="btn btn-primary">Submit</button>
			    </div>
			  </div> 
		  </div>
		</form>

		<table id="user-list" class="table table-striped">
			
		</table>

	</div>
</div>
  		</div>
  		<footer class="pull-left footer">
  			<p class="col-md-12">
  				<hr class="divider">
  				Copyright &COPY; 2018 <a href="http://www.pingpong-labs.com">Gravitano</a>
  			</p>
  		</footer>
  	</div>

  	<script>
  		$(document).ready(function(){
  			$(function(){
			  	$('.navbar-toggle-sidebar').click(function () {
			  		$('.navbar-nav').toggleClass('slide-in');
			  		$('.side-body').toggleClass('body-slide-in');
			  		$('#search').removeClass('in').addClass('collapse').slideUp(200);
			  	});

			  	$('#search-trigger').click(function () {
			  		$('.navbar-nav').removeClass('slide-in');
			  		$('.side-body').removeClass('body-slide-in');
			  		$('.search-input').focus();
			  	});
		    });
  		});
  	</script>

  	<script>
  			
	  		$(document).ready(function(){
				$("#submit-pdam-btn").click(function(){
					var tempID= document.getElementById("id").value;
					var tempNoMeter = document.getElementById("noMeteranPDAM").value;
					
					var send_data={
						'id' : tempID,
						'meteranPDAM' : tempNoMeter
					};		
					
					$.ajax({
						url:'/api/billing_pdam/'+tempID+'/'+tempNoMeter,
						headers:{
							'Content-Type':'application/json'
						},
						method:'GET',
						data: JSON.stringify(send_data),
						success:function(data){	
							var foreign_id;
							var total;
							/*var item = '<thead><th>id</th><th>user_id</th><th>no_pdam</th><th>biaya</th><th>tanggal_invoice</th><th>tanggal_mulai</th><th>tanggal_akhir</th><th>status</th></thead>';

							data.forEach(function(value,index){
								item += '<tbody><tr><td>'+value['id']+'</td><td>'+value['user_id']+ '</td><td>'+ value['no_pdam'] + '</td><td>'+ value['biaya'] + '</td><td>'+ value['tanggal_invoice'] + '</td><td>'+ value['tanggal_mulai'] + '</td><td>'+ value['tanggal_akhir'] + '</td><td>'+ value['status'] + '</tr></tbody>';
								$('#user-list').append(item);
							});*/


							data.forEach(function(value,index){
								foreign_id = value['id'];
								total = value['biaya'];
							});
							
							var invoice_id = <?php echo $invoice_id ; ?>;
							var tipe = 'pdam';

							var payload_data = {
								'foreign_id' : foreign_id,
								'total' : total,
								'invoice_id' : invoice_id,
								'tipe' : tipe
							}
							var json_payload = JSON.stringify(payload_data);
							$.ajax({
								url: "send_api_data_sisco.php",
								method:'POST',
								data: {data : json_payload},
								success:function(data){
									console.log(data);/*
									window.location.href= siscoIP + "/view/index.php";*/
								}
							})
							

						}
					});
				});

				$("input[type=radio][name=tipe]").change(function(){
					if (this.value == 'pdam') {
				        $("#pln").hide();
				        $("#pdam").show();
				    }
				    else if (this.value == 'pln') {
				     	$("#pdam").hide();
				     	 $("#pln").show();   
				    }
				});

				$("#submit-pln-btn").click(function(){
					var tempID= document.getElementById("id").value;
					var tempNoMeter = document.getElementById("noMeteranPLN").value;

					var send_data={
						'id' : tempID,
						'meteranPLN' : tempNoMeter
					};

					$.ajax({
						url:'../api/billing_pln/'+tempID+'/'+tempNoMeter,
						headers:{
							'Content-Type':'application/json'
						},
						method:'GET',
						data: JSON.stringify(send_data),
						success:function(data){
							
							/*var item = '<thead><th>id</th><th>user_id</th><th>no_pln</th><th>biaya</th><th>tanggal_invoice</th><th>tanggal_mulai</th><th>tanggal_akhir</th><th>status</th></thead>';

							data.forEach(function(value,index){
								item += '<tbody><tr><td>'+value['id']+'</td><td>'+value['user_id']+ '</td><td>'+ value['no_pln'] + '</td><td>'+ value['biaya'] + '</td><td>'+ value['tanggal_invoice'] + '</td><td>'+ value['tanggal_mulai'] + '</td><td>'+ value['tanggal_akhir'] + '</td><td>'+ value['status'] + '</tr></tbody>';
								$('#user-list').append(item);
							});*/

							var no_meteran = data['no_pln'];

							
						}
					});
				});
			});	
	</script>
</body>
</html>