
<style>
	.collapse a{
		text-indent:10px;
	}
	nav#sidebar{
		/*background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>) !important*/
	}
</style>

	<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow">
  <div class="container-fluid">
    <strong><a class="navbar-brand" href="?"><img class="img-fluid" src="https://axcora.com/img/axcora%20design%20pembuatan%20website%20blogspot%20template.gif"/></a></strong>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
 <ul class="navbar-nav">
 <?php if($_SESSION['login_type'] == 1): ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=home"><span class='icon-field'>
		  <i class="fa fa-home "></i></span> Home</a></li>
		  
 <li class="nav-item">	
				<a href="index.php?page=categories" class="nav-link nav-categories"><span class='icon-field'><i class="fa fa-list-alt "></i></span> Categories</a>
				</li>
 <li class="nav-item">				
				<a href="index.php?page=products" class="nav-link nav-products"><span class='icon-field'><i class="fa fa-box "></i></span> Products</a>
				</li>				
				 <li class="nav-item">
				<a href="billing/index.php" class="nav-link nav-takeorders"><span class='icon-field'><i class="fa fa-desktop "></i></span> Cashier</a>
				</li>		
				 <li class="nav-item">
				<a href="https://www.hockeycomputindo.com/2021/01/axcora-cashier-apps-free-download.html" class="nav-link nav-takeorders"><span class='icon-field'><i class="fas fa-file-pdf"></i></span> Documentation</a>
				</li>		
				 <li class="nav-item">
				<a href="https://youtu.be/uC-tLKl6ges" class="nav-link nav-takeorders"><span class='icon-field'><i class="fas fa-film"></i></span> Video</a>
				</li>
				 <li class="nav-item">
                <a class="nav-link " href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Logout</a>
				</li>
				<?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
