<?php
require 'functions.php';
$id = $_GET["id"];
$cat = query("SELECT * FROM categories WHERE ID = $id")[0];
if( isset($_POST["submit"]) ) {
if( ubahcat($_POST) > 0 ) {
	echo "
	<script>
	alert('data berhasil di update');
	document.location.href ='index.php?page=categories';
	</script>
	
	";
	} else {
	echo "
	<script>
	alert('data gagal diupdate');
	document.location.href ='index.php?page=categories';
	</script>
	
	";
		
}

	
}

?>

<?php include('dev/head.php');?>
<div class="container p-3">
<div class="row mt-5">
<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-6 p-3 p-md-5">
    <div class="card p-3 p-md-5">
        <h5 class="modal-title">Update Kategori</h5>
       <form action="" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= $cat["id"];?>">
     <label for="id">Name : </label>
  <input type="text" name="name" class="form-control" id="name" required value="<?= $cat["name"];?>"><hr/>
     <button type="submit" name="submit" class="btn btn-danger">Save changes</button>
     </form>
    </div>
  </div>
</div>
</div>


<?php include('dev/footer.php');?>