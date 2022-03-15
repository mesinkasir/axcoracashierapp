<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
ob_start();
// if(!isset($_SESSION['system'])){
	$system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
	foreach($system as $k => $v){
		$_SESSION['system'][$k] = $v;
	}
// }
ob_end_flush();
?>
<head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $_SESSION['system']['name'] ?></title>
 	<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>

</head>
<body>
<div class="col-12 p-3 p-md-1"></div>
  		<div id="login-center" class="row justify-content-center">
  			<div class="card col-md-4">
  				<div class="card-body text-center">
				<img class="img-fluid" src="https://axcora.com/img/angular.png"/>
				<h3>Axcora <span class="text-danger">Cashier</span> Apps</h3>
				<p>Free & Open Source Code Project.</p>
				<p><small>login info user: axcora / pass : axcorapos</small></p>
  					<form id="login-form" >
  						<div class="form-group">
  							<label for="username" class="control-label"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</svg></label>
  							<input type="text" id="username" name="username" class="form-control">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
  <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
</svg></label>
  							<input type="password" id="password" name="password" class="form-control">
  						</div>
  						<center><button class="btn-block btn-danger btn-lg">Login</button></center>
  					</form>
  				</div>
<div class="text-center p-1">
<a href="https://axcora.my.id/axcoracashier/">Home Page</a>
</div>
  			</div>
  		</div>
</body>
<script src="https://mesinkasir.github.io/larapos/pos/cashierax.js"></script>
</html>
