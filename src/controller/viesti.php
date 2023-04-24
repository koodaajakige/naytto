<?php

# tarkistetaan lomaakkeella syötettyjen tietojen oikeellisuus
# email ja nimi oikeaa muotoa

function tarkistaViesti ($formdata, $baseurl='') {
    $error = [];

    #lomaketietojen tarkistus, jos muoto ei ole oikea, virhelistaan virhekuvaus
    #jos kaikki läpi virhelista lopus tyhjä
    if (!isset($formdata['nimi']) || !$formdata['nimi']) {
        $virhe['nimi'] = "Anna nimesi.";
    } else {
        if (!preg_match("/^[- '\p{L}]+$/u", $formdata['nimi'])) {
            $virhe['nimi'] = "Syötä nimesi ilman erikoismerkkejä";
        }
    }

    //tarkistetaan sposti määritelty ja oikea muoto
    if (!isset($formdata['email']) || !$formdata['email']) {
        $error['email'] = "Anna sähköpostiosoitteesi.";
    } else {
        if (!filter_var($formdata['email'], FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "Sähköpostiosoite on virheellisessä muodossa";
        }   else {
            if (haeTiliSahkopostilla($formdata['email'])) {
                $error['email'] = "Sähköpostiosoite on jo käytössä.";
            }         
        }
    }

    if (!$error) {
    // Haetaan lomakkeen tiedot omiin muuttujiinsa.
    $nimi = $formdata['nimi'];
    $email = $formdata['email'];

    // Palautetaan JSON-tyyppinen taulukko, jossa:
    //  status   = Koodi, joka kertoo lisäyksen onnistumisen.
    //             Hyvin samankaltainen kuin HTTP-protokollan
    //             vastauskoodi.
    //             200 = OK
    //             400 = Bad Request
    //             500 = Internal Server Error
    //  formdata = Lisättävän henkilön lomakedata. Sama, mitä
    //             annettiin syötteenä.
    //  error    = Taulukko, jossa on lomaketarkistuksessa
    //             esille tulleet virheet.

} else {
    // Lomaketietojen tarkistuksessa ilmeni virheitä.
    return [
      "status" => 400,
      "data"   => $formdata,
      "error"  => $error
    ];
  }
}

?>