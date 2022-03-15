<?php include('db_connect.php');?>
<?php require 'functions.php';
$cat = query ("SELECT * FROM products");

if( isset($_POST["submit"]) ) {
if( tambahpro($_POST) > 0 ) {
	echo "
	<script>
	alert('data berhasil ditambahkan');
	document.location.href ='index.php?page=products';
	</script>
	
	";
	} else {
	echo "
	<script>
	alert('data gagal ditambahkan');
	document.location.href ='index.php?page=products';
	</script>
	
	";
		
}
}
?>
<div class="container-fluid">
	
	<div class="col-lg-12 p-3 p-md-5">
		<div class="row">
			<div class="col-md-12 p-3 p-md-5">
				<div class="card">
					<div class="card-body">
					    <div class="text-center p-3">
<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#addnewModal">
  Add New
</button>
</div>

						<table class="table">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Product</th>
									<th class="text-center"></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$product = $conn->query("SELECT * FROM products order by id asc");
								while($row=$product->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
								
									<td class="">
										<p><b><?php echo $row['name'] ?> <br/> Price: <?php echo number_format($row['price'],2) ?></b></small></p>
										<!--<p><small>Status: <b><?php echo $row['status'] == 1 ? " Available" : "Unavailable" ?></b></small></p>
										<p><small>Description: <b><?php echo $row['description'] ?></b></small></p>-->
									</td>
									<td class="text-center">
										
									<a href="editproduct.php?id=<?=$row['id'];?>" type="button" class="btn btn-outline-danger btn-sm edit_category">Edit</a>
									<a href="hapuspro.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-danger delete_category" type="button">Delete</button>
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

<?php include('newpro.php');?>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p {
		margin:unset;
	}
	.custom-switch{
		cursor: pointer;
	}
	.custom-switch *{
		cursor: pointer;
	}
</style>
<script>
	$('#manage-product').on('reset',function(){
		$('input:hidden').val('')
		$('.select2').val('').trigger('change')
	})
	
	$('#manage-product').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_product',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	$('.edit_product').click(function(){
		start_load()
		var cat = $('#manage-product')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='description']").val($(this).attr('data-description'))
		cat.find("[name='price']").val($(this).attr('data-price'))
		cat.find("[name='category_id']").val($(this).attr('data-category_id')).trigger('change')
		if($(this).attr('data-status') == 1)
			$('#status').prop('checked',true)
		else
			$('#status').prop('checked',false)
		end_load()
	})
	$('.delete_product').click(function(){
		_conf("Are you sure to delete this product?","delete_product",[$(this).attr('data-id')])
	})
	function delete_product($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_product',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
	$('table').dataTable()
</script>