<?php
/*
require once MODEL . dir hae.php
$tiedot = haeTiedot();
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
*/

function liikevoitto($l, $ma, $h, $mk, $p) {
    return $l-$ma-$h-$mk-$p;
}
$liikevoitto = liikevoitto($liikevaihto, $materiaalit, $henkilosto, $muutkulut, $poistot);

function voittoEnnenVeroja ($lv, $r) {
    return $lv-$r;
}
$voittoEnnenVeroja = voittoEnnenVeroja($liikevoitto, $rahoitus);

function tilikaudenVoitto ($vev, $ve) {
    return $vev-$ve;
}
$tilikaudenVoitto = tilikaudenVoitto ($voittoEnnenVeroja, $verot);

function osaketuotto($tkv, $om) {
    #if ($om>0) {
        return $tkv/$om;
    #}
}
$osaketuotto = osaketuotto($tilikaudenVoitto, $osakkeidenMaara);

function osakkeetAlussa($si, $oh) {
    #if ($oh>0) {
        return $si/$oh;
    #}
}
$osakkeetAlussa = osakkeetAlussa($sijoitus, $osakehinta);

function sipo ($ostu, $osal, $si) {
    return array($ostu * $osal, (($ostu * $osal)/$si)*100); 
}
$tulos = sipo($osaketuotto, $osakkeetAlussa, $sijoitus);
$tuotto€ = $tulos[0];
$tuottoPros= $tulos[1];

function tuottoVuosittain ($t€, $oh ) {
    return $t€/$oh;
}
$uudetOsakkeet = tuottoVuosittain($tuotto€, $osakehinta);

function yhteismaara ($osal, $uudos) {
    return $osal + $uudos;
}
$yhtmaara = yhteismaara($osakkeetAlussa, $uudetOsakkeet);


?>