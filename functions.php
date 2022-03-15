<?php
$conn = mysqli_connect("localhost','root','pass','axcoracashier");
function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}
function tambahpro($data) { 
global $conn;
	$category_id = htmlspecialchars($data["category_id"]);
	$name = htmlspecialchars($data["name"]);
	$price = htmlspecialchars($data["price"]);
	$status = htmlspecialchars($data["status"]);
	$query = "INSERT INTO products
	VALUES
	('','$category_id','$name','$price','$status')
	";
			mysqli_query($conn, $query);
			
			return mysqli_affected_rows($conn);
}
function tambahcat($data) { 
global $conn;
	$name = htmlspecialchars($data["name"]);
	$query = "INSERT INTO categories
	VALUES
	('','$name')
	";
			mysqli_query($conn, $query);
			
			return mysqli_affected_rows($conn);
}
function hapuscat($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM categories WHERE id = $id");
			return mysqli_affected_rows($conn);
}
function hapuspro($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM products WHERE id = $id");
			return mysqli_affected_rows($conn);
}
function ubahcat($data){
	global $conn;

	$id = $data["id"];
	$name = htmlspecialchars($data["name"]);
	
	$query = "UPDATE categories SET
	name = '$name' WHERE id = $id
";
	mysqli_query($conn, $query);
			
			return mysqli_affected_rows($conn);
}
function ubahpro($data){
	global $conn;

	$id = $data["id"];
	$category_id = $data["category_id"];
	$name = htmlspecialchars($data["name"]);
	$price = htmlspecialchars($data["price"]);
	$status = htmlspecialchars($data["status"]);
	
	$query = "UPDATE products SET
	category_id = '$category_id', name = '$name', price = '$price', status = '$status' WHERE id = $id ";
	mysqli_query($conn, $query);
			
			return mysqli_affected_rows($conn);
}
?>