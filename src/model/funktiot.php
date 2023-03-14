<?php

function liikevoitto($liikevaihto, $materiaalit, $henkilosto, $poistot, $muutkulut) {
    return $liikevaihto-$materiaalit-$henkilosto-$poistot-$muutkulut;
   
}

function voittoEnnenVeroja ($liikevoitto, $rahoitus) {
    return $liikevoitto-$rahoitus;
}

function tilikaudenVoitto ($voittoEnnenVeroja, $verot) {
    return $voittoEnnenVeroja-$verot;
}

function osaketuotto($tilikaudenVoitto, $osakkeidenMaara) {
    #if ($om>0) {
        return $tilikaudenVoitto/$osakkeidenMaara;
    #}
}

function osakkeetAlussa($sijoitus, $osakehinta) {
    #if ($oh>0) {
        return $sijoitus/$osakehinta;
    #}
}

function sipo ($osaketuotto, $osakkeetAlussa, $sijoitus) {
    $tuotto€ = $osaketuotto * $osakkeetAlussa;
    $tuottoPros= (($osaketuotto * $osakkeetAlussa)/$sijoitus)*100;
    $tulos = array($tuotto€, $tuottoPros);
    return $tulos;
}

function tuottoVuosittain ($tuotto€, $osakehinta ) {
    return $tuotto€/$osakehinta;
}

function yhteismaara ($osakkeetAlussa, $uudetOsakkeet) {
    return $osakkeetAlussa + $uudetOsakkeet;
}


/*
function liikevoitto($lv, $ma, $h, $p,$mk) {
    return $lv-$ma-$h-$p-$mk;
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
*/

?>