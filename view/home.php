<?php
	require 'database.php';
	$sql = "SELECT * FROM mahasiswa";
	$res = mysqli_query($con,$sql);
	while($row = mysqli_fetch_assoc($res)){
		$object_list[] = $row;
	}
	
	if (isset($_POST['submit'])){
		$name = $_POST['name'];
		$qty = $_POST['qty'];

		header("Location: home.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>SOA</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-6">
								<h1>Mahasiswa</h1>		
							</div>
							<div class="col-lg-6">
								<div class="text-right">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#lol">
									  Add Mahasiswa
									</button>	
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#lol2">
									  Delete Mahasiswa
									</button>	
								</div>	
							</div>
						</div>
						
						<table class="table table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>NRP</th>
									<th>Nama</th>
								</tr>
							</thead>
							<tbody id="user-list">
								<!--
								<?php foreach($object_list as $key=> $obj){ ?>
									<tr>
										<td><?php echo $obj['id']; ?></td>
										<td><?php echo $obj['nrp']; ?></td>
										<td><?php echo $obj['nama']; ?></td>
									</tr>
								<?php } ?>
								-->
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>

	<!-- Modal -->
	<div class="modal fade" id="lol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add Mahasiswa</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form action="" method="POST">
		      <div class="modal-body">
		        <div class="form-group">
		        	<label for="nrp">NRP: </label>
		        	<input type="text" name="nrp" id="nrp" class="form-control" placeholder="NRP">
		        </div>
		        <div class="form-group">
		        	<label for="nama">Nama: </label>
		        	<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama">
		        </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" id="post-btn" name="post-btn" class="btn btn-primary">Add</button>
		      </div>
	      </form>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="lol2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add Mahasiswa</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form action="" method="POST">
		      <div class="modal-body">
		        <div class="form-group">
		        	<label for="nrp">NRP: </label>
		        	<input type="text" name="nrp_delete" id="nrp_delete" class="form-control" placeholder="NRP">
		        </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" id="post-btn" name="post-btn" class="btn btn-primary">Add</button>
		      </div>
	      </form>
	    </div>
	  </div>
	</div>

	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script>

		function load(){
			$("#user-list").html("");
			$.ajax({
				url: '/api/user',
				method: 'GET',
				success: function(data){
					data.forEach(function(value,index){
						var item='<tr>';
						item+='<td>'+value['id']+'</td><td>'+value['nrp']+ '</td> <td>'+ value['nama'] +'</td>';
						item+='</tr>';
						$('#user-list').append(item);
					});
				}
			});
		}

		$(document).ready(function(){
			load();
			$("#post-btn").click(function(){
				alert("clicked");
				var send_data = {
					'nrp' : $("#nrp").val(),
					'nama' : $("#nama").val()
				};

				$.ajax({
					url:'/api/user',
					headers:{
						'Content-Type':'application/json'
					},
					method:'POST',
					data: JSON.stringify(send_data),
					success:function(data){
						if(data['err'] == 0){
							load();
						}else{
							
						}
					}
				});
			});
			$("#del-btn").click(function(){
				alert("del-click");
				var send_data={
					'nrp': $("#nrp_delete").val()
				};

				$.ajax({
					url:'/api/user/'+$("#nrp_delete").val(),
					headers:{
						'Content-Type':'application/json'
					},
					method:'DELETE',
					data: JSON.stringify(send_data),
					success:function(data){
						if(data['err'] == 0){
							load();
						}else{
							
						}
					}
				});
			});

			$("#upd-btn").click(function(){
				alert("upd-click");
				var send_data={
					'nama' : $("#name_update").val()
				};

				$.ajax({
					url:'/api/user/'+$("#nrp_update").val(),
					headers:{
						'Content-Type':'application/json'
					},
					method:'PUT',
					data: JSON.stringify(send_data),
					success:function(data){
						alert(data['msg']);
						if(data['err'] == 0){
							load();
						}else{
							
						}
					}
				});
			});
		});	
	</script>

</body>
</html>