<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
ob_start();
if(!isset($_SESSION['system'])){
	$system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
	foreach($system as $k => $v){
		$_SESSION['system'][$k] = $v;
	}
}
ob_end_flush();
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $_SESSION['system']['name'] ?></title>
 	

<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    position: fixed;
	    top:0;
	    left: 0
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		display: flex;
	}
.front{
	position: absolute;
	text-align: center;
	padding-bottom: 20px;

	top:10%;
	width: 100%;
	height: 100%;
	color: white;
}


</style>

<body class="bg-dark">


  <main id="main" >
  	<?php if(isset($_POST['next'])){?>
  		<div class="align-self-center w-100">
		<h4 class="text-white text-center"><b><?php echo $_SESSION['system']['name'] ?></b></h4>
  		<div id="login-center" class="bg-dark row justify-content-center">
  			<div class="card col-md-4">
  				<div class="card-body">
  					<form id="login-form" >
  						<div class="form-group">
  							<label for="username" class="control-label">Username</label>
  							<input type="text" id="username" name="username" class="form-control">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label">Password</label>
  							<input type="password" id="password" name="password" class="form-control">
  						</div>
  						<center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
  					</form>
  				</div>
  			</div>
  		</div>
  		</div>
  	<?php }else{?>
  		<div class="front">
  		<h1>University of Visveswaraya College of Engineering</h1><br/>

  		<h3>Attendance Management Systeam</h3><br/><br/>
  		<!--<h5>Created by</h5><br/><br/>
  		<h3 ><p style="font-size: 20px;position: relative;left:-220px">Omkar Sutar (20GANSD003) </p><p style="font-size: 20px;position: relative;left:220px;top:-40px">Rakshit Belagali (19GANSE033)</p></h3><br/>
  		<h5>Under Guidence of</h5><br/><br/>
  		<h3 ><p style="font-size: 20px;position: relative;left:-250px">Dr. Samyama 
  		Gunjal </p><p style="font-size: 20px;position: relative;left:200px;top:-40px">Shruti Gupta</p></h3><br/>-->


  		<form method="post" action="login.php">
  		
  		<center><button id="next" class="btn-sm btn-block btn-wave col-md-4 btn-primary" type='submit' name='next' style="width: 100px;height: 30px">Go to login</button></center>
  		</form>
  	</div>
  	<?php } ?>
  </main>
  
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>	
</html>