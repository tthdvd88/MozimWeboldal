<?php
$url = "http://weboldal.tothdavidmozimusor.nhely.hu/mozimusor/views/rest_restserver_main.php";
$result = "";
if(isset($_POST['moziazon']))
{
  $_POST['moziazon'] = trim($_POST['moziazon']);
  $_POST['mozinev'] = trim($_POST['mozinev']);
  $_POST['irszam'] = trim($_POST['irszam']);
  $_POST['cim'] = trim($_POST['cim']);
  $_POST['telefon'] = trim($_POST['telefon']);
  
  if($_POST['moziazon'] == "" && $_POST['mozinev'] != "" && $_POST['irszam'] != "" && $_POST['cim'] != "" && $_POST['telefon'] != "")
  {
      $data = Array("mozinev" => $_POST["mozinev"], "irszam" => $_POST["irszam"], "cim" => $_POST["cim"], "telefon" => ($_POST["telefon"]));
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  elseif($_POST['moziazon'] == "")
  {
    $result = "Hiba: Hiányos adatok!";
  }
  
  elseif($_POST['moziazon'] >= 1 && ($_POST['mozinev'] != "" || $_POST['irszam'] != "" || $_POST['cim'] != "" || $_POST['telefon'] != ""))
  {
      $data = Array("moziazon" => $_POST["moziazon"], "mozinev" => $_POST["mozinev"], "irszam" => $_POST["irszam"], "cim" => $_POST["cim"], "telefon" => $_POST["telefon"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  elseif($_POST['moziazon'] >= 1)
  {
      $data = Array("moziazon" => $_POST["moziazon"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  else
  {
    echo "Hiba! Rossz moziazonosító: ".$_POST['moziazon']."<br>";
  }
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$tabla = curl_exec($ch);
curl_close($ch);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <?= $result ?>
    <p></p>
    <h1>Mozik</h1>
    <?= $tabla ?>
    <br>
    <h3>Meglévő mozi módosítása / Új mozi hozzáadása</h3>
    <form method="post">
    Moziazonosító: <input type="text" name="moziazon" maxlength="4"><br>
    Mozinév: <input type="text" name="mozinev" maxlength="45"><br>
    Irányítószám: <input type="text" name="irszam" maxlength="4"><br>
    Cim: <input type="text" name="cim" maxlength="20"><br>
    Telefon: <input type="text" name="telefon" maxlength="10"><br>
    <input type="submit" value = "Küldés">
    </form>
</body>
</html>
