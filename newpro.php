<div class="modal fade" id="addnewModal" tabindex="-1" aria-labelledby="addnewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="addnewModalLabel">Tambah Products</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="form-group">
							<label class="control-label">Category</label>
							<select name="category_id" id="category_id" class="custom-select select2">
								<option value="category_id">Select Categories</option>
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
  <input type="text" name="name" class="form-control" id="name" required>
  <hr/>
     <label class="control-label" for="price">Price : </label>
  <input type="number" name="price" class="form-control" id="price" required>
  <hr/>
								<div class="form-group">
								<div class="custom-control custom-switch">
								  <input type="checkbox" class="custom-control-input" id="status" name="status" checked value="1">
								  <label class="custom-control-label" for="status">Activ</label>
								</div>
							</div>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-danger">
Tambah Data
</button>
      </div>
      
  </form>
  </div>
      
  </div>
</div>