<?php

# tarkistetaan lomaakkeella syötettyjen tietojen oikeellisuus
# email oikeaa muotoa ja salasanat täsmää

function lisaaTili ($formdata, $baseurl='') {
    #tuodaaan uusi_tili funktiot, joilla voidaan lisätä tili tk:aan
    require_once  (MODEL_DIR . 'henkilo.php');
    #alustetaan virhetaulukko, palautuu tyhjänä tai virheillä täytettynä
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

    // tark salasanat annettu ja keskennään samat JOS KAKSI SALASANAA!
    if (isset($formdata['salasana1']) && $formdata['salasana1'] &&
        isset($formdata['salasana2']) && $formdata['salasana2']) {
        if ($formdata['salasana1'] != $formdata['salasana2']) {
            $error['salasana'] = "Salasanasi eivät täsmää";
        } 
    }else {
        $error['salasana'] = "Syötä salasanasi kahteen kertaan.";
    }

    // Lisätään tiedot tietokantaan, jos edellä syötettyissä
    // tiedoissa ei ollut virheitä eli error-taulukosta ei
    // löydy virhetekstejä.
    if (!$error) {

    // Haetaan lomakkeen tiedot omiin muuttujiinsa.
    // Salataan salasana myös samalla.
    $nimi = $formdata['nimi'];
    $email = $formdata['email'];
    $salasana = password_hash($formdata['salasana1'], PASSWORD_DEFAULT);

    // Lisätään henkilö tietokantaan. Jos lisäys onnistui,
    // tulee palautusarvona lisätyn henkilön id-tunniste.
    $idhenkilo = lisaaHenkilo($nimi,$email,$salasana);

    // Palautetaan JSON-tyyppinen taulukko, jossa:
    //  status   = Koodi, joka kertoo lisäyksen onnistumisen.
    //             Hyvin samankaltainen kuin HTTP-protokollan
    //             vastauskoodi.
    //             200 = OK
    //             400 = Bad Request
    //             500 = Internal Server Error
    //  id       = Lisätyn rivin id-tunniste.
    //  formdata = Lisättävän henkilön lomakedata. Sama, mitä
    //             annettiin syötteenä.
    //  error    = Taulukko, jossa on lomaketarkistuksessa
    //             esille tulleet virheet.

    // Tarkistetaan onnistuiko henkilön tietojen lisääminen.
    // Jos idhenkilo-muuttujassa on positiivinen arvo,
    // onnistui rivin lisääminen. Muuten liäämisessä ilmeni
    // ongelma.
    if ($idhenkilo) {

    // Luodaan käyttäjälle aktivointiavain ja muodostetaan
    // aktivointilinkki.
    require_once(HELPERS_DIR . "salainen.php");
    $avain = generateActivationCode($email);
    $url = 'https://' . $_SERVER['HTTP_HOST'] . $baseurl . "/vahvista?key=$avain";

    // Päivitetään aktivointiavain tietokantaan ja lähetetään
    // käyttäjälle sähköpostia. Jos tämä onnistui, niin palautetaan
    // palautusarvona tieto tilin onnistuneesta luomisesta. Muuten
    // palautetaan virhekoodi, joka ilmoittaa, että jokin
    // lisäyksessä epäonnistui.
    if (paivitaVahvavain($email,$avain) && lahetaVahvavain($email,$url)) {
      return [
        "status" => 200,
        "id"     => $idhenkilo,
        "data"   => $formdata
      ];
    } else {
      return [
        "status" => 500,
        "data"   => $formdata
      ];
    }
  } else {
    return [
      "status" => 500,
      "data"   => $formdata
    ];
  }

} else {

    // Lomaketietojen tarkistuksessa ilmeni virheitä.
    return [
      "status" => 400,
      "data"   => $formdata,
      "error"  => $error
    ];

  }
}

function lahetaVahvavain($email,$url) {
  $message = "Terve!\n\n" . 
             "Olet luonut tilin sijoutuskoneeseen tällä\n" . 
             "sähköpostiosoitteella. Klikkaamalla alla olevaa\n" . 
             "linkkiä vahvistat käyttämäsi sähköpostiosoitteen\n" .
             "ja pääset laskemaan sijoituksiasi koneella.\n\n" . 
             "$url\n\n";
             
  return mail($email,'Sijoituskoneen aktivointilinkki',$message);
}

function lahetaVaihtoavain($email,$url) {
  $message = "Terve!\n\n" .
             "Pyysit uutta salasanaa, klikkaamalla\n" .
             "alla olevaa linkkiä pääset vaihtamaan salasanasi.\n" .
             "Linkki on voimassa 30 minuuttia.\n\n" .
             "$url\n\n";
  return mail($email,'Salasanan vaihto sijoituskonepalveluun',$message);
}

function luoVaihtoavain($email, $baseurl='') {
  require_once(HELPERS_DIR . "salainen.php");
  $avain = generateResetCode($email);
  $url = 'https://' . $_SERVER['HTTP_HOST'] . $baseurl . "/reset?key=$avain";
  require_once(MODEL_DIR . 'henkilo.php');
  if (asetaVaihtoavain($email,$avain) && lahetaVaihtoavain($email,$url)) {
    return [
      "status"   => 200,
      "email"    => $email,
      "resetkey" => $avain
    ];
  } else {
    return [
      "status" => 500,
      "email"   => $email
    ];
  }

}

function resetoiSalasana($formdata, $resetkey='') {
  require_once(MODEL_DIR . 'henkilo.php');
  $error = "";
  if (isset($formdata['salasana1']) && $formdata['salasana1'] &&
      isset($formdata['salasana2']) && $formdata['salasana2']) {
    if ($formdata['salasana1'] != $formdata['salasana2']) {
      $error = "Salasanasi eivät olleet samat!";
    }
  } else {
    $error = "Syötä salasanasi kahteen kertaan.";
  }
  if (!$error) {
    $salasana = password_hash($formdata['salasana1'], PASSWORD_DEFAULT);

    $rowcount = vaihdaSalasanaAvaimella($salasana,$resetkey);
    if ($rowcount) {

      return [
        "status"   => 200,
        "resetkey" => $resetkey
      ];

    } else {

      return [
        "status"   => 500,
        "resetkey" => $resetkey
      ];

    }    

  } else {
    
    return [
      "status"   => 400,
      "resetkey" => $resetkey,
      "error"    => $error
    ];

  }

}

?>