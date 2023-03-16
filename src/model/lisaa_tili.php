<?php

require_once HELPERS_DIR . 'DB.php';

function lisaaTili($nimi, $email, $salasana) {
    DB::run('INSERT INTO tili (nimi, email, salasana) VALUE (?,?,?);', [$nimi, $email, $salasana]);
    return DB::lastInsertedId(); #palauttaa lisätyn tilin id-tunnisteen
}

function haeTiliSahkopostilla ($email) {
    return DB::run ('SELECT * FROM tili WHERE email =?;', [$email])->fetchAll();
}

?>