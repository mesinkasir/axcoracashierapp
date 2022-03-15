<?php
require 'functions.php';
$id = $_GET["id"];
$cat = query("SELECT * FROM products WHERE ID = $id")[0];
if( isset($_POST["submit"]) ) {
if( ubahpro($_POST) > 0 ) {
	echo "
	<script>
	alert('data berhasil di update');
	document.location.href ='index.php?page=products';
	</script>
	
	";
	} else {
	echo "
	<script>
	alert('data gagal diupdate');
	document.location.href ='index.php?page=products';
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
        <h5 class="modal-title">Update Produk</h5><hr/>
       <form action="" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= $cat["id"];?>">
<div class="form-group">
							<label class="control-label">Category</label>
							<select name="category_id" id="category_id" class="custom-select select2">
								<option value="<?= $cat["category_id"];?>"></option>
								<?php
								$qry = $conn->query("SELECT * FROM categories order by name asc");
								while($row=$qry->fetch_assoc()):
									$cname[$row['id']] = ucwords($row['name']);
								?>
								<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
							<?php endwhile; ?>
							</select>
						</div>
									<hr/>
     <label class="control-label" for="name">Name : </label>
  <input type="text" name="name" class="form-control" id="name" required value="<?= $cat["name"];?>">
  <hr/>
     <label class="control-label" for="price">Price : </label>
  <input type="text" name="price" class="form-control" id="price" required value="<?= $cat["price"];?>"><hr/>

								<div class="form-group">
								<div class="custom-control custom-switch">
								  <input type="checkbox" class="custom-control-input" id="status" name="status" checked value="1">
								  <label class="custom-control-label" for="status">Activ</label>
								</div>
							</div>
  
 
 <hr/>
  
     <button type="submit" name="submit" class="btn btn-danger">Save changes</button>
     </form>
    </div>
  </div>
</div>
</div>


<?php include('dev/footer.php');?>