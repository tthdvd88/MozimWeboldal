<header class="major">
    <h2>Regisztráció</h2>
</header>
<div>
<form action="<?= SITE_ROOT ?>login_registration" method="post">
    <label for="vezeteknev">Vezetéknév:</label><input type="text" name="vezeteknev" id="vezeteknev" required><br>
    <label for="keresztnev">Keresztnév:</label><input type="text" name="keresztnev" id="keresztnev" required><br>
    <label for="felhasznalonev">Felhasználónév:</label><input type="text" name="felhasznalonev" id="felhasznalonev" required pattern="[a-zA-Z][\-\.a-zA-Z0-9_]{3}[\-\.a-zA-Z0-9_]+"><br>
    <label for="jelszo">Jelszó:</label><input type="password" name="jelszo" id="jelszo" required pattern="[\-\.a-zA-Z0-9_]{4}[\-\.a-zA-Z0-9_]+"><br>
    <br>
    <input type="submit" value="Regisztrál">
</form>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $vezeteknev = trim($_POST["vezeteknev"]);
    $keresztnev = trim($_POST["keresztnev"]);
    $felhasznalonev = trim($_POST["felhasznalonev"]);
    $jelszo = trim($_POST["jelszo"]);


    if (!empty($vezeteknev) && !empty($keresztnev) && !empty($felhasznalonev) && !empty($jelszo)) {

        $registerInstance = new Register_Model();
        $registerResult = $registerInstance->register_user($vezeteknev, $keresztnev, $felhasznalonev, $jelszo);

        if ($registerResult) {
            echo "<p>Regisztráció sikeres!</p>";
        } else {
            echo "<p>Regisztráció sikertelen, kérjük próbálja meg újra!</p>";
        }
    } else {
        echo "<p>Minden mező kitöltése kötelező</p>";
    }
}
?>
</div>