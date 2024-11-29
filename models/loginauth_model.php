<?php

class Loginauth_Model
{
	public function get_data($vars)
	{
		$retData['eredmeny'] = "";
		try {
			$connection = Database::getConnection();
			$sql = "select id, vezeteknev, keresztnev, jogosultsag from users where felhasznalonev='".$vars['felhasznalonev']."' and jelszo='".$vars['jelszo']."'";
			$stmt = $connection->query($sql);
			$felhasznalo = $stmt->fetchAll(PDO::FETCH_ASSOC);
			switch(count($felhasznalo)) {
				case 0:
					$retData['eredmeny'] = "ERROR";
					$retData['uzenet'] = "Helytelen felhasználói név vagy jelszó!";
					break;
				case 1:
					$retData['eredmény'] = "OK";
					$retData['uzenet'] = "Kedves ".$felhasznalo[0]['vezeteknev']." ".$felhasznalo[0]['keresztnev']."!<br><br>
					                      Üdvözöljük";
					$_SESSION['userid'] =  $felhasznalo[0]['id'];
					$_SESSION['userlastname'] =  $felhasznalo[0]['vezeteknev'];
					$_SESSION['userfirstname'] =  $felhasznalo[0]['keresztnev'];
					$_SESSION['userlevel'] = $felhasznalo[0]['jogosultsag'];
					Menu::setMenu();
					break;
				default:
					$retData['eredmény'] = "ERROR";
					$retData['uzenet'] = "Ezekhez az adatokhoz több felhasználó is tartozik, kérjük vegye fel a kapcsolatot a rendszer üzemeltetőjével";
			}
		}
		catch (PDOException $e) {
					$retData['eredmény'] = "ERROR";
					$retData['uzenet'] = "Adatbázis kapcsolat hiba: ".$e->getMessage()."!";
		}
		return $retData;
	}
}

?>