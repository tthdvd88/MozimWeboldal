<?php


class Register_Model {
function register_user($vezeteknev, $keresztnev, $felhasznalonev, $jelszo)
{
    try {
		$connection = Database::getConnection();
		$jelszo = sha1($jelszo, PASSWORD_DEFAULT); 
		
		$sql = "INSERT INTO users (vezeteknev, keresztnev, felhasznalonev, jelszo) 
				VALUES (:vezeteknev, :keresztnev, :felhasznalonev, :jelszo)";
		$stmt = $connection->prepare($sql);
		$stmt->bindParam(':vezeteknev', $vezeteknev);
		$stmt->bindParam(':keresztnev', $keresztnev);
		$stmt->bindParam(':felhasznalonev', $felhasznalonev);
		$stmt->bindParam(':jelszo', $jelszo);
		return $stmt->execute(); 
	} catch (PDOException $e) {
		die("Error registering user: " . $e->getMessage());
	}
}
}

?>