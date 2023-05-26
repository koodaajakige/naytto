<?php

function tarkistaViesti($formdata) {

  // Alustetaan virhetaulukko, joka palautetaan lopuksi joko
  // tyhjänä tai virheillä täytettynä.
  $error = [];

  // Seuraavaksi tehdään lomaketietojen tarkistus. Tarkistusten
  // periaate on jokaisessa kohdassa sama. Jos kentän arvo
  // ei täytä tarkistuksen ehtoja, niin error-taulukkoon
  // lisätään virhekuvaus. Lopussa error-taulukko on tyhjä, jos
  // kaikki kentät menivät tarkistuksesta lävitse.

  // Tarkistetaan, että sähköpostiosoite on määritelty ja se on
  // oikeassa muodossa.
  if (!isset($formdata['email']) || !$formdata['email']) {
    $error['email'] = "Anna sähköpostiosoitteesi.";
  } else {
    if (!filter_var($formdata['email'], FILTER_VALIDATE_EMAIL)) {
      $error['email'] = "Sähköpostiosoite on virheellisessä muodossa.";
    }
  }
  
  // Tarkistetaan onko viesti määritelty.
  if (!isset($formdata['viesti']) || !$formdata['viesti']) {
    $error['viesti'] = "Kirjoita viesti.";
	}

  // Jos edellä syötettyissä tiedoissa ei ollut virheitä
  // eli error-taulukosta ei löydy virhetekstejä,
  // palautetaan syötetiedot.
  if (!$error) {

  // Haetaan lomakkeen tiedot omiin muuttujiinsa.
  $email = $formdata['email'];
  $viesti = $formdata['viesti'];

  // Palautetaan JSON-tyyppinen taulukko, jossa:
  //  status   = Koodi, joka kertoo tarkistuksen läpäisystä.
  //             Hyvin samankaltainen kuin HTTP-protokollan
  //             vastauskoodi.
  //             200 = OK
  //             400 = Bad Request
  //  formdata = Lomakedata. Sama, mitä
  //             annettiin syötteenä.
  //  error    = Taulukko, jossa on lomaketarkistuksessa
  //             esille tulleet virheet.

   return [
      "status" => 200,
      "data"   => $formdata
    ];

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