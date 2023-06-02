<?php

require_once HELPERS_DIR . 'DB.php';

function haeTiedot() {
    return DB::run('SELECT * FROM sijoitus WHERE lisaaja=?;' , [$_SESSION['user']])->fetchAll();
}

function haeYritys($yritys) {
    return DB::run('SELECT * FROM sijoitus WHERE nimi = ?;' , [$yritys])->fetchAll();
}

/* Valmius yrityksen poistoon:  
function poistaYritys($yritys) {
    return DB::run('DELETE FROM sijoitus WHERE nimi = ?;' , [$yritys])->fetchAll();
} */

?>


