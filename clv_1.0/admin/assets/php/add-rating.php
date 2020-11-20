<?php
include 'db/config.php';
$rating_query = "INSERT INTO `rating` ( `flavor_id`, `rating`) VALUES ( '".$_POST['flavor_id']."', '".$_POST['rating2']."')";
$rating_result = mysqli_query($conn, $rating_query);
if( $rating_result ){
	echo json_encode(array(
		'success' => true
	));
	die;
}
echo json_encode(array(
	'success' => false
));
die;
?>