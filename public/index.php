<?php
require_once '../src/init.php';

// Siistitään polku urlin alusta ja mahdolliset parametrit urlin lopusta.
$request = str_replace($config['urls']['baseUrl'],'',$_SERVER['REQUEST_URI']);
$request = strtok($request, '?');

// Luodaan uusi Plates-olio ja kytketään se sovelluksen sivupohjiin.
$templates = new League\Plates\Engine(TEMPLATE_DIR);

// Selvitetään mitä sivua on kutsuttu ja suoritetaan sivua vastaava 
// käsittelijä.

/*switch ($request) {
    case '/':
    case '/etusivu':
        echo $templates->render('etusivu');

    case '/lisaa':
        #echo $templates->render('lisaa');
        if (isset($_POST['laheta'])) {
            require_once MODEL_DIR . 'lisaa.php';
            $lisaa = lisaaTiedot($_POST['nimi'], $_POST['liikevaihto'], $_POST['materiaalit'],
            $_POST['henkilosto'], $_POST['poistot'], $_POST['muutkulut'], $_POST['rahoitus'],
            $_POST['verot'], $_POST['osakemaara'], $_POST['osakehinta'], $_POST['sijoitus']);
            #echo $templates->render('lisaa', ['lisaa' => $lisaa]);
            echo "Tiedot lisätty yrityksen $_POST[nimi] nimellä.";
            break;
        } else {
            $templates->render('lisaa');
            break;
        }
    
    case '/hae':
        require_once MODEL_DIR . 'hae.php';
        $hae=haeTiedot();
        echo $templates->render('hae', ['hae' => $hae]);
        #echo $templates->render('hae');
        break;

    case '/tulosta':
        echo $templates->render('tulosta');
        break;

    case '/notfound':
        echo $templates->render('notfound');
        break;

}
*/

if ($request === '/' || $request === '/etusivu') {
    echo $templates->render('etusivu');
}   else if ($request === '/lisaa') {
    if (isset($_POST['laheta'])) {
        require_once MODEL_DIR . 'lisaa.php';
        $lisaa = lisaaTiedot($_POST['nimi'], $_POST['liikevaihto'], $_POST['materiaalit'],
        $_POST['henkilosto'], $_POST['poistot'], $_POST['muutkulut'], $_POST['rahoitus'],
        $_POST['verot'], $_POST['kokonaismaara'], $_POST['osakehinta'], $_POST['sijoitus']);
        #!!!!kokeile post eteen $nimi $liikeaihto yms. 
        echo "Tiedot lisätty yrityksen $_POST[nimi] nimellä.";
        
        /*echo $templates->render('lisaa', ['lisaa' => $lisaa]);
        $lisaa = lisaaTiedot($nimi, $liikevaihto, $materiaalit, $henkilosto, $poistot, 
        $muutkulut, $rahoitus, $verot, $osakkeidenMaara, $osakehinta, $sijoitus);
        */
    } else {
        echo $templates->render('lisaa');
    }
    
}   else if ($request === '/tulosta') {
    echo $templates->render('tulosta');

}   else if ($request === '/hae') {
    require_once MODEL_DIR . 'hae.php';
    $hae = haeTiedot();
    #if ($hae) {
    echo $templates->render('hae', ['hae' => $hae]);
    #} else {
       # echo $templates->render('notfound');
    #}
    
}else {
    echo $templates->render('notfound');
}
?>



