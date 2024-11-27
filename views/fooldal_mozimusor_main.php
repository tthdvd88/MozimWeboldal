<?php 

$filmModel = new Mozimusor_Model();
$filmek = $filmModel->get_data();

if (!empty($filmek)) {
    echo '<table>'; 
    echo '<tr><th>Filmcím</th><th>Szinkron</th><th>Származás</th><th>Műfaj</th><th>Hossz</th></tr>';

    foreach ($filmek as $film) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($film['filmcim']) . '</td>';  
        echo '<td>' . htmlspecialchars($film['szinkron']) . '</td>';  
        echo '<td>' . htmlspecialchars($film['szarmazas']) . '</td>';  
        echo '<td>' . htmlspecialchars($film['mufaj']) . '</td>';
        echo '<td>' . htmlspecialchars($film['hossz']) . '</td>';
        echo '</tr>';
    }

    echo '</table>'; 
} else {
    echo "<p>Nincs vetített film jelenleg</p>";
}
?>