<!DOCTYPE html>
<html lang="en">
	
<?php session_start(); ?>
<head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo isset($_SESSION['system']['name']) ? $_SESSION['system']['name'] : '' ?></title>
  <link rel="icon" type="image/x-icon" href="https://axcora.com/img/angular.png" /> 
<?php
 include('./header.php'); 
 // include('./auth.php'); 
 ?>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow">
  <div class="container-fluid">
    <strong><a class="navbar-brand" href="../index.php?page=home">	
	<img class="img-fluid" src="https://axcora.com/img/axcora%20design%20pembuatan%20website%20blogspot%20template.gif"/></a></strong>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
 <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../index.php?page=home"><span class='icon-field'>
		  <i class="fa fa-home "></i></span> Home</a></li>
      </ul>
    </div>
  </div>
</nav>
      <?php $page = isset($_GET['page']) ? $_GET['page'] :'home'; ?>
      <?php include $page.'.php' ?>

</body>
<script src='https://cdn.jsdelivr.net/npm/vue/dist/vue.js'></script><script src='https://mesinkasir.github.io/larapos/pos/gallerya.js'></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</html>