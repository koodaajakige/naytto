<?php $this->layout('template', ['title' => 'Hae tiedot']); ?>


  <h1>Tietojen tulostus tietokannasta</h1>
  <p>Tilinpäätöstiedot ja sijoitustiedot</p>


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
    $osaketuotto = osaketuotto($tilikaudenVoitto, $osakkeidenMaara); #tilikaudenvoitto/osakkeidenmaara
    $osakkeetAlussa = osakkeetAlussa($sijoitus, $osakehinta); #sijoiitus/osakehinta
    $tulos = sipo($osaketuotto, $osakkeetAlussa, $sijoitus); #palauttaa listan $tulos jossa tuotto€ja tuottoPros
    $tuotto€ = $tulos[0]; #poimitaan listasta eka indeksi 
    $tuottoPros = $tulos[1]; #toinen indeksi
    $uudetOsakkeet = tuottoVuosittain($tuotto€, $osakehinta);  #lasketaan uusien osakkeiden määrä
    $yhtmaara = yhteismaara($osakkeetAlussa, $uudetOsakkeet); #lasketaan sijoittajan osakkeiden yhteismäärä

    echo "<table>";
    echo "<tr>";
    echo "<th>TIEDOT OSAKKEISTA</th>";
    for ($i=0; $i<3; $i++) {   #otsikot, nimi, vuodet
    echo "<th>$nimi</th>"; 
    };
    echo "</tr>";

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

    #nämä lisätiedot napin taakse! ja tulostus vierekkäin!
    echo "<table>";
    echo "<tr>";
    echo "<th>$nimi</th>";
    for ($i=2; $i<6; $i++) {   #otsikot, nimi, vuodet
    echo "<th>$i. vuosi</th>"; 
    }
    echo "</tr>";

    $maara = array(); #alustetaan listat joiden avulla lasketaan sijotustiedot
    $euro = array();
    $pros= array();
    echo "<tr>";
    echo "<td>Edellisen vuoden tuotolla hankitut osakkeet (kpl)</td>";
    for ($i=0; $i<4; $i++) {
    array_push($maara, ROUND($uudetOsakkeet,2));  #lisätään listaan uusien osakkeiden määrä
    echo "<td>$maara[$i]</td>";
    $tulos = sipo($osaketuotto, $yhtmaara, $sijoitus); #lasketaan uudet tuottoluvut osakkeiden määrän muututtua
    array_push($euro, ROUND($tulos[0],2));    # lasketaan uudet tuotto€ luvut  
    array_push($pros, ROUND($tulos[1],2));  #uudet tuottoPros luvut
    $uudetOsakkeet = tuottoVuosittain($tulos[0], $osakehinta); #lasketaan uusien osakkeiden määrä
    $yhtmaara += $uudetOsakkeet;  #sijoittajan osakkeiden yhteistmäärä
    }
    "</tr>";

    echo "<tr>";
    echo "<td>Osakkeiden yhteismäärä (kpl)</td>"; 
    $yht = $osakkeetAlussa;
    for ($i=0; $i<4; $i++) {  #iteroidaan uusien osakkeiden määärä vuosittain
    $yht += $maara[$i];
    echo "<td>" . ROUND($yht,2). "</td>";
    }
    echo "</tr>";

    echo "<tr>";
    echo "<td>Tuotto (€)</td>"; #iteroidaan tuotto€ vuosittain
    for ($i=0; $i<4; $i++) {
    echo "<td>$euro[$i]</td>";
    }
    echo "</tr>";

    echo "<tr>";
    echo "<td>Tuotto suhteessa alkusijoitukseen (%)</td>";
    for ($i=0; $i<4; $i++) {  #iteroidaan tuottoPros vuosittain
    echo "<td>$pros[$i]</td>";
    }
    echo "</tr>";
    echo "</table>"; 
    echo "<br>";
}

?>
</div>
