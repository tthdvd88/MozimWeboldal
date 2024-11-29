<?php
ob_start();
$conn = Database::getConnection();

$selectedMozi = isset($_POST['mozi']) ? $_POST['mozi'] : '';
$selectedFilm = isset($_POST['film']) ? $_POST['film'] : '';

$moziQuery = $conn->query("SELECT DISTINCT moziazon, mozinev FROM mozi");
$moziOptions = $moziQuery->fetchAll();

$filmOptions = [];
if ($selectedMozi) {
    $filmQuery = $conn->prepare("
        SELECT filmcim, mufaj 
        FROM film AS f
        JOIN hely AS h ON f.fkod = h.fkod
        WHERE h.moziazon = ?
    ");
    $filmQuery->bindValue(1, $selectedMozi, PDO::PARAM_STR);
    if ($filmQuery->execute()) {
        $filmOptions = $filmQuery->fetchAll(PDO::FETCH_ASSOC);
    }
}

if (isset($_POST['generate_pdf'])) {

    require_once('tcpdf/tcpdf.php'); 

    $pdf = new TCPDF();
    $pdf->AddPage();

    $html = <<<_EOD
    <h1>Selected Options</h1>
    <p>Mozi: {$selectedMozi}</p>
    <p>Film: {$selectedFilm}</p>
_EOD;


    $pdf->writeHTML($html, true, false, true, false, '');


    $pdf->Output('selected_options.pdf', 'D');
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Generálás</title>
</head>
<body>

<form method="post">
    <label for="mozi">Válasszon mozit</label>
    <select name="mozi" id="mozi">
        <?php foreach ($moziOptions as $option): ?>
            <option value="<?= htmlspecialchars($option['moziazon']); ?>" <?= ($option['moziazon'] == $selectedMozi) ? 'selected' : ''; ?>>
                <?= htmlspecialchars($option['mozinev']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>
    <input type="submit" value="Kiválaszt">
</form>

<?php if ($selectedMozi): ?>
    <form method="post">
        <label for="film">Válasszon filmet:</label>
        <select name="film" id="film" required>
            <option value="">-- Válasszon egy filmet --</option>
            <?php if (empty($filmOptions)): ?>
                <option value="">Film nem elérhető</option>
            <?php else: ?>
                <?php foreach ($filmOptions as $film): ?>
                    <option value="<?= htmlspecialchars($film['filmcim']); ?>">
                        <?= htmlspecialchars($film['filmcim']); ?> - <?= htmlspecialchars($film['mufaj']); ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <input type="hidden" name="mozi" value="<?= htmlspecialchars($selectedMozi); ?>"> 
        <br>
        <input type="submit" value="Kiválaszt"> 
    </form>
    
  
    <?php if ($selectedFilm): ?>
        <form method="post">
            <input type="hidden" name="mozi" value="<?= htmlspecialchars($selectedMozi); ?>"> 
            <input type="hidden" name="film" value="<?= htmlspecialchars($selectedFilm); ?>"> 
            <input type="submit" name="generate_pdf" value="PDF Generálás"> 
        </form>
    <?php endif; ?>
<?php endif; ?>

</body>
</html>