<?php

ob_start();

$conn = Database::getConnection();

// Fetch data for dropdowns
$opciok1 = $conn->query("SELECT mozinev FROM mozi");
$opciok2 = $conn->query("SELECT filmcim FROM film");
$opciok3 = $conn->query("SELECT mufaj FROM film WHERE filmcim='".$opciok2."'");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('tcpdf/tcpdf.php'); // Include TCPDF library

    // Get selected options
    $valasztott1 = $_POST['opcio1'];
    $valasztott2 = $_POST['opcio2'];
    $valasztott3 = $_POST['opcio3'];

    // Create new PDF document
    $pdf = new TCPDF();
    $pdf->AddPage();

    // Set some content to print
    $html = <<<_EOD
    <h1>Selected Options</h1>
    <p>Opcio 1: {$valasztott1}</p>
    <p>Opcio 2: {$valasztott2}</p>
    <p>Opcio 3: {$valasztott3}</p>
_EOD;

    // Print text using writeHTML
    $pdf->writeHTML($html, true, false, true, false, '');

    // Close and output PDF document
    $pdf->Output('selected_options.pdf', 'D'); // D forces download

    exit; // Stop script execution
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

<form method="POST" action="">
    <label for="opcio1">Mozi:</label>
    <select name="opcio1" id="opcio1" required>
        <?php while ($row = $opciok1
    ->fetch(PDO::FETCH_ASSOC)): ?>
            <option value="<?php echo $row['mozinev']; ?>"><?php echo $row['mozinev']; ?></option>
        <?php endwhile; ?>
    </select>
    <br>
    <label for="opcio2">Film:</label>
    <select name="opcio2" id="opcio2" required>
        <?php while ($row = $opciok2->fetch(PDO::FETCH_ASSOC)): ?>
            <option value="<?php echo $row['filmcim']; ?>"><?php echo $row['filmcim']; ?></option>
        <?php endwhile; ?>
    </select>
    <br>
    <label for="opcio3">Műfaj:</label>
    <select name="opcio3" id="opcio3" required>
        <?php while ($row = $opciok3->fetch(PDO::FETCH_ASSOC)): ?>
            <option value="<?php echo $row['mufaj']; ?>"><?php echo $row['mufaj']; ?></option>
        <?php endwhile; ?>
    </select>
            <br>
    <input type="submit" value="PDF Generálás">
</form>

</body>
</html>