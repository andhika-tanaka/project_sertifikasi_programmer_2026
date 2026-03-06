<?php
	namespace Config;
	
	class Conf{
		private $host 		= "localhost";
		private $username 	= "root";
		private $password 	= "";
		private $db 		= "books_db";
		private $conn;

		public function connect(){
			$this->conn = mysqli_connect($this->host,
										$this->username,
										$this->password, 
										$this->db) 
							or die("Koneksi Gagal");
			
			if (mysqli_connect_errno())
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}

			return $this->conn;
		}
	}
		
?>