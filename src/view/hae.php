<?php $this->layout('template', ['title' => 'Hae tiedot']); ?>

<h1>Tietojen tulostus tietokannasta</h1>

<p>Printtaa sie tietos tähä hei.</p>

<div class='hae'>
<?php
require_once MODEL_DIR . 'funktiot.php'; #model vai controller???

foreach ($hae as $haku) {
    $nimi = $haku['nimi'];
    $liikevaihto = $haku['liikevaihto'];
    $materiaalit = $haku['materiaalit'];
    $henkilosto = $haku['henkilosto'];
    $poistot = $haku['poistot'];
    $muutkulut = $haku['muutkulut'];
    $rahoitus = $haku['rahoitus'];
    $verot = $haku['verot'];
    $osakkeidenMaara = $haku['kokonaismaara'];
    $osakehinta = $haku['osakehinta'];
    $sijoitus = $haku['sijoitus'];

    $liikevoitto = liikevoitto($liikevaihto, $materiaalit, $henkilosto, $poistot, $muutkulut);
    $voittoEnnenVeroja = voittoEnnenVeroja($liikevoitto, $rahoitus);
    $tilikaudenVoitto = tilikaudenVoitto($voittoEnnenVeroja, $verot);
    $osaketuotto = osaketuotto($tilikaudenVoitto, $osakkeidenMaara);
    $osakkeetAlussa = osakkeetAlussa($sijoitus, $osakehinta);
    $tulos = sipo($osaketuotto, $osakkeetAlussa, $sijoitus); #palauttaa listan $tulos jossa tuotto€ja tuottoPros
    $tuotto€ = $tulos[0];
    $tuottoPros = $tulos[1];
    $uudetOsakkeet = tuottoVuosittain($tuotto€, $osakehinta);
    $yhtmaara = yhteismaara($osakkeetAlussa, $uudetOsakkeet);

    echo "TIEDOT OSAKKEISTA";
    echo "<br>";
    echo "Yrityksen nimi $nimi";
    echo "<br>";
    echo "Osakkeiden kokonaismäärä $osakkeidenMaara kpl";
    echo "<br>";
    echo "Osakkeen hinta $osakehinta €/osake";
    echo "<br>";
    echo "Osaketuotto" . " " . ROUND($osaketuotto, 2) . " €/osake"; 
    echo "<br>";
    echo "<br>";

    echo "SIJOITUSLASKURI"; 
    echo "<br>";
    echo "Sijoitettava summa $sijoitus €";
    echo "<br>";
    echo "Sijoituksella saadut osakkeet" . " " . ROUND($osakkeetAlussa,2) . " kpl";
    echo "<br>";
    echo "<br>";

    echo "SIJOITETUN PÄÄOMAN TUOTTO"; 
    echo "<br>";
    echo "Tuotto" . " " . ROUND($tulos[0],2) . " €";
    echo "<br>";
    echo "Tuotto suhteessa sijoitukseen" . " " . ROUND($tulos[1],2) . " %";
    echo "<br>";
    echo "<br>";


    echo "<table>";
    echo "<tr>";
    echo "<th>$nimi</th>";
    for ($i=2; $i<6; $i++) {
    echo "<th>$i. vuosi</th>"; 
    }
    echo "</tr>";

    $maara = array();
    $euro = array();
    $pros= array();
    echo "<tr>";
    echo "<td>Edellisen vuoden tuotolla hankitut osakkeet (kpl)</td>";
    for ($i=0; $i<4; $i++) {
    array_push($maara, ROUND($uudetOsakkeet,2));  #lisätään listaan uusien osakkeiden määrä
    echo "<td>$maara[$i]</td>";
    $tulos = sipo($osaketuotto, $yhtmaara, $sijoitus); #lasketaan uudet tuottoluvut osakkeiden määrän muututtua
    array_push($euro, ROUND($tulos[0],2));    # vai $tuotto€ = ROUND($tulos[0], 2); array_push($euro, $tuotto€);    
    array_push($pros, ROUND($tulos[1],2));  #vai $tuottoPros= ROUND($tulos[1], 2); array_push($pros, $tuottoPros);
    $uudetOsakkeet = tuottoVuosittain($tulos[0], $osakehinta); 
    $yhtmaara += $uudetOsakkeet;
    }
    "</tr>";

    echo "<tr>";
    echo "<td>Osakkeiden yhteismäärä (kpl)</td>"; 
    $yht = $osakkeetAlussa;
    for ($i=0; $i<4; $i++) {
    $yht += $maara[$i];
    echo "<td>" . ROUND($yht,2). "</td>";
    }
    echo "</tr>";

    echo "<tr>";
    echo "<td>Tuotto (€)</td>";
    for ($i=0; $i<4; $i++) {
    echo "<td>$euro[$i]</td>";
    }
    echo "</tr>";

    echo "<tr>";
    echo "<td>Tuotto suhteessa alkusijoitukseen (%)</td>";
    for ($i=0; $i<4; $i++) {
    echo "<td>$pros[$i]</td>";
    }
    echo "</tr>";
    echo "</table>"; 
    echo "<br>";
}
/*foreach ($hae as $haku) {
        echo "TIEDOT OSAKKEISTA";
        echo "<br>";
        echo "<div>";
        echo "<div>$haku[nimi]</div>";
        echo "<div>$haku[liikevaihto]</div>";
        echo "<div>$haku[materiaalit]</div>";
        echo "<div>$haku[henkilosto]</div>";
        echo "<div>$haku[poistot]</div>";
        echo "<div>$haku[muutkulut]</div>";
        echo "<div>$haku[rahoitus]</div>";
        echo "<div>$haku[verot]</div>";
        echo "<div>$haku[kokonaismaara]</div>";
        echo "<div>$haku[osakehinta]</div>";
        echo "<div>$haku[sijoitus]</div>";
        echo "<br>";
}
*/
/*
$nimi = $_POST['nimi'];
$liikevaihto = $_POST['liikevaihto'];
$materiaalit = $_POST['materiaalit'];
$henkilosto = $_POST['henkilosto'];
$poistot = $_POST['poistot'];
$muutkulut = $_POST['muutkulut'];
$rahoitus = $_POST['rahoitus'];
$verot = $_POST['verot'];
$osakkeidenMaara = $_POST['kokonaismaara'];
$osakehinta = $_POST['osakehinta'];
$sijoitus = $_POST['sijoitus'];

foreach ($hae as $haku) {
        echo "TIEDOT OSAKKEISTA";
        echo "<br>";
        echo "<div>";
        echo "<div>$haku[nimi]</div>";
        echo "<div>$haku[liikevaihto]</div>";
        echo "<div>$haku[materiaalit]</div>";
        echo "<div>$haku[henkilosto]</div>";
        echo "<div>$haku[poistot]</div>";
        echo "<div>$haku[muutkulut]</div>";
        echo "<div>$haku[rahoitus]</div>";
        echo "<div>$haku[verot]</div>";
        echo "<div>$haku[kokonaismaara]</div>";
        echo "<div>$haku[osakehinta]</div>";
        echo "<div>$haku[sijoitus]</div>";
        echo "<br>";
echo "TIEDOT OSAKKEISTA";
echo "<br>";
echo "Yrityksen nimi $nimi";
echo "<br>";
echo "Osakkeiden kokonaismäärä $osakkeidenMaara";
echo "<br>";
echo "Osakkeen hinta $osakehinta";
echo "<br>";
echo "Osaketuotto $osaketuotto";
echo "<br>";

echo "SIJOITUSLASKURI"; 
echo "<br>";
echo "Sijoitettava summa $sijoitus";
echo "<br>";
echo "Sijoituksella saadut osakkeet $osakkeetAlussa";
echo "<br>";

echo "SIJOITETUN PÄÄOMAN TUOTTO"; 
echo "<br>";
echo "Tuotto $tulos[0]";
echo "<br>";
echo "Tuotto suhteessa sijoitukseen $tulos[1]";
echo "<br>";

echo "<table>";
echo "<tr>";
echo "<th></th>";
for ($i=2; $i<6; $i++) {
    echo "<th>$i. vuosi</th>"; 
}
echo "</tr>";

$maara = array();
$euro = array();
$pros= array();
echo "<tr>";
echo "<td>Edellisen vuoden tuotolla hankitut osakkeet (kpl)</td>";
for ($i=0; $i<4; $i++) {
    array_push($maara, ROUND($uudetOsakkeet,2));
    echo "<td>$maara[$i]</td>";
    $tulos = sipo($osaketuotto, $yhtmaara, $sijoitus);
    array_push($euro, ROUND($tulos[0],2));    # vai $tuotto€ = ROUND($tulos[0], 2); array_push($euro, $tuotto€);    
    array_push($pros, ROUND($tulos[1],2));  #vai $tuottoPros= ROUND($tulos[1], 2); array_push($pros, $tuottoPros);
    $uudetOsakkeet = tuottoVuosittain($tulos[0], $osakehinta); 
    $yhtmaara += $uudetOsakkeet;
}
"</tr>";

echo "<tr>";
echo "<td>Osakkeiden yhteismäärä (kpl)</td>"; 
$yht = $osakkeetAlussa;
for ($i=0; $i<4; $i++) {
    $yht += $maara[$i];
    echo "<td>$yht</td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>Tuotto (€)</td>";
for ($i=0; $i<4; $i++) {
    echo "<td>$euro[$i]</td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>Tuotto suhteessa alkusijoitukseen (%)</td>";
for ($i=0; $i<4; $i++) {
    echo "<td>$pros[$i]</td>";
}
echo "</tr>";
echo "</table>"; 
*/
?>
</div>
