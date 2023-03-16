<?php
require_once '../src/init.php';

// Siistitään polku urlin alusta ja mahdolliset parametrit urlin lopusta.
$request = str_replace($config['urls']['baseUrl'],'',$_SERVER['REQUEST_URI']);
$request = strtok($request, '?');

// Luodaan uusi Plates-olio ja kytketään se sovelluksen sivupohjiin.
$templates = new League\Plates\Engine(TEMPLATE_DIR);

// Selvitetään mitä sivua on kutsuttu ja suoritetaan sivua vastaava 
// käsittelijä.

if ($request === '/' || $request === '/etusivu') {
    echo $templates->render('etusivu');
}   else if ($request === '/lisaa') {
    if (isset($_POST['laheta'])) {
        require_once MODEL_DIR . 'lisaa.php';
        $lisaa = lisaaTiedot($_POST['nimi'], $_POST['liikevaihto'], $_POST['materiaalit'],
        $_POST['henkilosto'], $_POST['poistot'], $_POST['muutkulut'], $_POST['rahoitus'],
        $_POST['verot'], $_POST['kokonaismaara'], $_POST['osakehinta'], $_POST['sijoitus']);
        echo "Tiedot lisätty yrityksen $_POST[nimi] nimellä.";
        
    } else {
        echo $templates->render('lisaa');
    }
    
}   else if ($request === '/tulosta') {
    echo $templates->render('tulosta');

}   else if ($request === '/hae') {
    require_once MODEL_DIR . 'hae.php';
    $hae = haeTiedot();
    echo $templates->render('hae', ['hae' => $hae]);
   
}   else if ($request === '/lisaa_tili') {
    if (isset($_POST['laheta'])) {
        $formdata = siistiTiedot($_POST);
        require_once CONTROLLER_DIR . 'tili.php'; 
        $tulos = lisaaTili($formdata);
        if ($tulos['status'] == '200') {
            echo $templates->render('tili_luotu', ['formdata' => $formdata]);
        }
        echo $templates ->render('lisaa_tili', ['formdata' => $formdata, 'error' => $tulos['error']]);
    
    } else {
        echo $templates ->render('lisaa_tili', ['formdata' => [], 'error' => []]);
    }
} else {
    echo $templates->render('notfound');
}
?>



