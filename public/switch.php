<?php

switch ($request) {
    case '/':
    case '/etusivu':
        echo $templates->render('etusivu');

    case '/lisaa':
        if (isset($_POST['laheta'])) {
            require_once MODEL_DIR . 'lisaa.php';
            $lisaa = lisaaTiedot($_POST['nimi'], $_POST['liikevaihto'], $_POST['materiaalit'],
            $_POST['henkilosto'], $_POST['poistot'], $_POST['muutkulut'], $_POST['rahoitus'],
            $_POST['verot'], $_POST['osakemaara'], $_POST['osakehinta'], $_POST['sijoitus']);
            echo "Tiedot lisätty yrityksen $_POST[nimi] nimellä.";
            break;
        } else {
            $templates->render('lisaa');
            break;
        }
    
    case '/lisaa_tili':
        if (isset($_POST['laheta'])) {
            $formdata = siistiTiedot($_POST);
            require_once MODEL_DIR . 'uusi_tili.php'; #uusi_tili tk-funktio
            $salasana = password_hash($formdata['salasana1'], PASSWORD_DEFAULT); #salataan ss pw_hash funktiolla
            $id = lisaaTili ($formdata['email'], $salasana); #lisätään tili tk-funktiolla, palautusarvona tilin id
            echo "Tili on luotu tunnisteella $id"; 
        
        } else {
            echo $templates->render('lisaa_tili');
        }
        
    case '/hae':
        require_once MODEL_DIR . 'hae.php';
        $hae=haeTiedot();
        echo $templates->render('hae', ['hae' => $hae]);
        break;

    case '/tulosta':
        echo $templates->render('tulosta');
        break;

    case '/notfound':
        echo $templates->render('notfound');
        break;
    
    default:
        echo $templates->render('notfound');

}

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
        require_once MODEL_DIR . 'uusi_tili.php'; #uusi_tili tk-funktio
        $salasana = password_hash($formdata['salasana1'], PASSWORD_DEFAULT); #salataan ss pw_hash funktiolla
        $id = lisaaTili ($formdata['email'], $salasana); #lisätään tili tk-funktiolla, palautusarvona tilin id
        echo "Tili on luotu tunnisteella $id"; 
    
    } else {
        echo $templates->render('lisaa_tili');
    }
} else {
    echo $templates->render('notfound');
}
?>