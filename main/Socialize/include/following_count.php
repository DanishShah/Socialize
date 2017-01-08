
<?php
	
	ob_start();

	include($_SERVER['DOCUMENT_ROOT'] . '/Socialize/include/DBConnect.php');
	$con = new DB_Connect();
    $db = $con->connect();

    function pluralize( $count, $text ) {
	    return $count . ( ( $count <= 1 ) ? ( " $text" ) : ( " ${text}s" ) );
	}

    $user = $_GET['user'];    

    $query = "SELECT DISTINCT `following` FROM  `following` WHERE `following`.`user_name` = '".$user."'";
	$row = mysqli_query($db, $query);

	if ($row==null) {
		$row_count = 0;
	}else{
		$row_count = mysqli_num_rows($row);
	}

	ob_clean();

	echo $row_count;

	mysqli_close($db);

?>

