<header class="major">
    <h2>Bejelentkezés</h2>
</header>
<form id="loginform" action="<?= SITE_ROOT ?>loginauth" method="post">
    <label for="felhasznalonev">Felhasználónév:</label><input type="text" name="felhasznalonev" id="felhasznalonev" required pattern="[a-zA-Z][\-\.a-zA-Z0-9_]{3}[\-\.a-zA-Z0-9_]+"><br>
    <label for="jelszo">Jelszó:</label><input type="jelszo" name="jelszo" id="jelszo" required pattern="[\-\.a-zA-Z0-9_]{4}[\-\.a-zA-Z0-9_]+"><br>
    <input type="submit" value="Login">
</form>
<h2><br><?= (isset($viewData['uzenet']) ? $viewData['uzenet'] : "") ?><br></h2>