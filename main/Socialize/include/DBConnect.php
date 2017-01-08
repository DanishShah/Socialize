<!DOCTYPE html>
<html>
<body>
<?php

	class DB_Connect{

		private $conn;		

		public function connect() {

        $servername = "mysql.hostinger.in";
		$user = "u218526953_root";
		$pass = "123456";
		$db_name = "u218526953_socio";
        
        $this->conn = new mysqli($servername, $user, $pass, $db_name);
		
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysql_connect_error());
			exit();
		}
        
        return $this->conn;    
		}
	}

?>
</body>
</html>



				