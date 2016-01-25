<?php 	
		$servername = 'localhost';
	    $username = 'root';
	    $password = "";
	    $database = "tv_department_db";
	    $db = new mysqli($servername, $username, $password);

	    $db->query('CREATE DATABASE '.$database);
	    $db->select_db($database);

		$clients = "CREATE TABLE clients (
								clients_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
								company_name VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
								c_name VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
								c_surname VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
								telephone_number VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci,
								promotional_product VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci,
								card_number VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci
								) CHARACTER SET utf8 COLLATE utf8_general_ci;";
				
		$tv_program = "CREATE TABLE tv_program (
								program_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
								rating INT(10),
								tv_duration INT(10),
								day VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci
								) CHARACTER SET utf8 COLLATE utf8_general_ci;";	
	
		$advertisement = "CREATE TABLE advertisement (
								a_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
								c_id INT,
								p_duration INT(10),
								p_id INT,
								FOREIGN KEY (c_id) REFERENCES clients(clients_id),
								FOREIGN KEY (p_id) REFERENCES tv_program(program_id)
								) CHARACTER SET utf8 COLLATE utf8_general_ci;";


		if ($db->query($clients) && $db->query($tv_program) && $db->query($advertisement)) {
			$w_string = '<?php
							define ("DB_SERVER",   "'.$servername.'"); 
							define ("DB_LOGIN",    "'.$username.'"); 
							define ("DB_PASSWORD", "'.$password.'"); 
							define ("DB_NAME",     "'.$database.'");
						?>';
			$fp = fopen($_SERVER["DOCUMENT_ROOT"]."/config.php", "w");
			fwrite($fp, $w_string);
			fclose($fp);
		}
		$clients_data_json = file_get_contents($_SERVER['DOCUMENT_ROOT']."/data/clients_data.json");
		$tv_program_data_json = file_get_contents($_SERVER['DOCUMENT_ROOT']."/data/tv_program_data.json");
		$advertisement_data_json = file_get_contents($_SERVER['DOCUMENT_ROOT']."/data/advertisement_data.json");

		$clients_data = json_decode($clients_data_json, true);
		$tv_program_data = json_decode($tv_program_data_json, true);
		$advertisement_data = json_decode($advertisement_data_json, true);

		insertToDB($clients_data, 'clients', $db);
		insertToDB($tv_program_data, 'tv_program', $db);
		insertToDB($advertisement_data, 'advertisement', $db);

	function insertToDB($data, $table, $db) {
		$str = "";
		for($i = 0, $l = count($data); $i < $l; $i++) {
			foreach($data[$i] as $key => $value) { 
				$str .= "'".$value."',";
			}
			$db->query("INSERT ".$table." VALUES (".trim($str, ",").")");
			echo trim($str, ",")."</br>";
			$str = "";
		} 
	}
	
?>