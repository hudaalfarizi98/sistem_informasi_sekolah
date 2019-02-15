<?php
session_start();
if($_SESSION['Level'] != '3'){

	header('location:../index.php');

}

require_once('../class/C_admin.php');

$admin = new C_Admin;
$id = $_SESSION['IdMember'];
require_once('template/header.php');

;?>
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
	<li class="header">MAIN NAVIGATION</li>
	<li class="active">
		<a href="dashboard.php">
			<i class="fa fa-user"></i> <span>Master Member</span>
		</a>
	</li>
	<li class="">
		<a href="MasterMapel.php">
			<i class="fa fa-book"></i> <span>Master Mapel</span>
		</a>
	</li>
	<li class="">
		<a href="MasterSoal.php">
			<i class="fa fa-book"></i> <span>Master Soal</span>
		</a>
	</li>
	<li class="header">SETTING</li>
	<li>
		<a href="../logout.php">
			<i class="fa fa-lock"></i> <span>LOGOUT</span>
		</a>
	</li>
</ul>
</section>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Admin
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Admin</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">


		<div class="panel panel-default panel-info">

			<div class="panel panel-heading panel-info">
				<span class="glyphicon glyphicon-user"></span> Member
			</div>

			<div class="panel panel-body">

				<div class="row">

					<div class='col-md-3'> 
						<button type='button' class="btn btn-primary" name='add_button' id='add_button' data-toggle="modal" data-target="#userModal"> Add </button>
					</div>

					<div class="col-md-8">
						<div class="table-responsive">
							<table id="user_data" class="ui celled table" style="width:100%">
								<thead>
									<tr>
										<th>Id</th>
										<th>Nama</th>
										<th>Level</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>

							</table>
						</div>
					</div>
				</div>
			</div>



		</div>
	</section>
	<!-- content wrapper -->
</div>


<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add User</h4>
				</div>
				<div class="modal-body">
					<label id="test">Id</label>
					<input type="text" name="Id" id="Id" class="form-control test"/>
					<br />
					<label>Username</label>
					<input type="text" name="Username" id="Username" class="form-control" />
					<br />
					<label>Password</label>
					<input type="password" name="Password" id="Password" class="form-control" />
					<br />
					<label>Level</label>
					<select class="form-control" name="Level" id="Level">
						<option>1</option>
						<option>2</option>
						<option>3</option>
					</select>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="user_id" id="user_id" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>

</body>
<script type="text/javascript" language="javascript" >
	$(document).ready(function(){
		$('#add_button').click(function(){
			$('#user_form')[0].reset();
			$('.modal-title').text("Add User");
			$("#Id").show();
			$("#test").show();
			$('#action').val("Add");
			$('#operation').val("Add");
			$('#user_uploaded_image').html('');
		});

		var dataTable = $('#user_data').DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"model_member/fetch.php",
				type:"POST"
			},
			"columnDefs":[
			{
				"orderable":false,
			},
			],

		});

		$(document).on('submit', '#user_form', function(event){
			event.preventDefault();
			var Id = $('#Id').val();
			var Username = $('#Username').val();
			var Password = $('#Password').val();
			var Level = $('#Level').val();
			if(Id != '' && Username != '' && Password != '' && Level != '')
			{
				$.ajax({
					url:"model_member/insert.php",
					method:'POST',
					data:new FormData(this),
					contentType:false,
					processData:false,
					success:function(data)
					{
						alert(data);
						$('#user_form')[0].reset();
						$('#userModal').modal('hide');
						dataTable.ajax.reload();
					}
				});
			}
			else
			{
				alert("Both Fields are Required");
			}
		});

		$(document).on('click', '.update', function(){
			var user_id = $(this).attr("id");
			$.ajax({
				url:"model_member/fetch_single.php",
				method:"POST",
				data:{user_id:user_id},
				dataType:"json",
				success:function(data)
				{
					$("#Id").hide();
					$("#test").hide();
					$('#userModal').modal('show');
					$('#Id').val(data.Id);
					$('#Username').val(data.Username);
					$('#Password').val(data.Password);
					$('#Level').val(data.Level);
					$('.modal-title').text("Edit User");
					$('#user_id').val(user_id);
					$('#action').val("Edit");
					$('#operation').val("Edit");
				}
			})
		});

		$(document).on('click', '.delete', function(){
			var user_id = $(this).attr("id");
			if(confirm("Are you sure you want to delete this?"))
			{
				$.ajax({
					url:"model_member/delete.php",
					method:"POST",
					data:{user_id:user_id},
					success:function(data)
					{
						alert(data);
						dataTable.ajax.reload();
					}
				});
			}
			else
			{
				return false;	
			}
		});


	});
</script>
<?php include 'template/footer.php';
