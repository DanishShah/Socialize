
<?php
	
	ob_start();

	include($_SERVER['DOCUMENT_ROOT'] . '/Socialize/include/DBConnect.php');
	$con = new DB_Connect();
    $db = $con->connect();

    function pluralize( $count, $text ) {
	    return $count . ( ( $count <= 1 ) ? ( " $text" ) : ( " ${text}s" ) );
	}

    $post_id = $_GET['post_id'];    

    $query = "SELECT DISTINCT `user_name` FROM  `likes` WHERE `likes`.`post_id` = ".$post_id;
	$row = mysqli_query($db, $query);

	$row_count = mysqli_num_rows($row);
	$row_count = pluralize($row_count, "like");

	ob_clean();
	echo trim($row_count);

	mysqli_close($db);

?>

