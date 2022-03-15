<?php
require 'functions.php';
$id = $_GET["id"];
if( hapuspro($id) > 0 ) {
	echo "
	<script>
	alert('data berhasil dihapus');
	document.location.href ='index.php?page=products';
	</script>
	
	";
		
	
} else {
	echo "
	<script>
	alert('data gagal dihapus');
	document.location.href ='index.php?page=products';
	</script>
	
	";
		
	
}

?>