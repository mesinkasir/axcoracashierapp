<?php include('db_connect.php');?>
<?php require 'functions.php';
$cat = query ("SELECT * FROM categories");
if( isset($_POST["submit"]) ) {
if( tambahcat($_POST) > 0 ) {
	echo "
	<script>
	alert('data berhasil ditambahkan');
	document.location.href ='index.php?page=categories';
	</script>
	
	";
	} else {
	echo "
	<script>
	alert('data gagal ditambahkan');
	document.location.href ='index.php?page=categories';
	</script>
	
	";
		
}

	
}

?>
<div class="container-fluid">
	
	<div class="col-lg-12 col-12 p-3 p-md-5">
		<div class="row">
			<div class="col-md-12 col-12 p-3 p-md-5">
				<div class="card">
					
					<div class="card-body">
<div class="text-center p-3">
<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#addnewModal">
  Add New
</button>
</div>
						<table class="table ">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Category.</th>
									<th class="text-center"></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$category = $conn->query("SELECT * FROM categories order by id asc");
								while($row=$category->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<p><b><?php echo $row['name'] ?></b></p>
										</td>
									<td class="text-center">
									<a href="editcat.php?id=<?=$row['id'];?>" type="button" class="btn btn-outline-danger btn-sm edit_category">Edit</a>
										<a href="hapuscat.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-danger delete_category" type="button">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<?php include('newcat.php');?>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p {
		margin:unset;
	}
</style>
<script>
	$('#manage-category').on('reset',function(){
		$('input:hidden').val('')
	})
	
	$('table').dataTable()
</script>