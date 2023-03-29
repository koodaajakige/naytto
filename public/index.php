<?php
session_start();

require_once '../src/init.php';

$request = str_replace($config['urls']['baseUrl'],'',$_SERVER['REQUEST_URI']);
$request = strtok($request, '?');

$templates = new League\Plates\Engine(TEMPLATE_DIR);


switch ($request) {
    case '/':
    case '/etusivu':
        echo $templates->render('etusivu');
        break;
    
    case "/kirjaudu":
        if (isset($_POST['laheta'])) {
          require_once CONTROLLER_DIR . 'kirjaudu.php';
          if (tarkistaKirjautuminen($_POST['email'],$_POST['salasana'])) {
            require_once MODEL_DIR . 'henkilo.php';
            $user = haeHenkilo($_POST['email']);
            if ($user['vahvistettu']) {
              session_regenerate_id();
              $_SESSION['user'] = $user['email'];
              header("Location: " . $config['urls']['baseUrl']);
            } else {
              echo $templates->render('kirjaudu', [ 'error' => ['virhe' => 'Tili on vahvistamatta! Ole hyvä, ja vahvista tili sähköpostissa olevalla linkillä.']]);
            }
          } else {
            echo $templates->render('kirjaudu', [ 'error' => ['virhe' => 'Väärä käyttäjätunnus tai salasana!']]);
          }
        } else {
          echo $templates->render('kirjaudu', [ 'error' => []]);
        }
        break;

    case "/logout":
        require_once CONTROLLER_DIR . 'kirjaudu.php';
        logout();
        header("Location: " . $config['urls']['baseUrl']);
        break;

    case '/lisaa':
        if (isset($_SESSION['user'])) {
            echo $templates->render('lisaa');
            if (isset($_POST['laheta'])) {
                require_once MODEL_DIR . 'lisaa.php';
                $lisaa = lisaaTiedot($_POST['nimi'], $_POST['liikevaihto'], $_POST['materiaalit'],
                $_POST['henkilosto'], $_POST['poistot'], $_POST['muutkulut'], $_POST['rahoitus'],
                $_POST['verot'], $_POST['kokonaismaara'], $_POST['osakehinta'], $_POST['sijoitus']);
                echo $templates->render('tallennusok');
                break;
              }
            else {
                break;
            }         
        } 
        else {
            echo $templates->render('kirjautumaton');
            break;
        }
    
    case '/lisaa_tili':
        if (isset($_POST['laheta'])) {
            $formdata = siistiTiedot($_POST);
            require_once CONTROLLER_DIR . 'tili.php'; #uusi_tili tk-funktio
            $tulos = lisaaTili($formdata,$config['urls']['baseUrl']);
            if ($tulos['status'] == '200') {
            echo $templates->render('tili_luotu', ['formdata' => $formdata]);
            break;
            }
            else {
            echo $templates ->render('lisaa_tili', ['formdata' => $formdata, 'error' => $tulos['error']]);
            break;
            }        
        } else {
            echo $templates ->render('lisaa_tili', ['formdata' => [], 'error' => []]);
            break;
        }
   
    case "/vahvista":
        if (isset($_GET['key'])) {
          $key = $_GET['key'];
          require_once MODEL_DIR . 'henkilo.php';
          if (vahvistaTili($key)) {
            echo $templates->render('tilin_aktivointi');
          } else {
            echo $templates->render('tilin_aktivointi_virhe');
          }
        } else {
          header("Location: " . $config['urls']['baseUrl']);
        }
        break;

    case "/tilaa_vaihtoavain":
        $formdata = siistiTiedot($_POST);
        if (isset($formdata['laheta'])) {    
            require_once MODEL_DIR . 'henkilo.php';
            $user = haeHenkilo($formdata['email']);
            if ($user) {
              require_once CONTROLLER_DIR . 'tili.php';
              $tulos = luoVaihtoavain($formdata['email'],$config['urls']['baseUrl']);
              if ($tulos['status'] == "200") {
                echo $templates->render('vaihtoavaimen_lahetys');
                break;
              }
              echo $templates->render('virhe');
              break;
            } else {
              echo $templates->render('vaihtoavaimen_lahetys');
              break;
            }
    
        } else {
          echo $templates->render('salasana_unohtunut');
        }
        break;        

    case '/tulosta':
        if (isset($_SESSION['user'])) {
        require_once MODEL_DIR . 'tulosta.php';
        $hae=haeTiedot();
        echo $templates->render('tulosta', ['hae' => $hae]);
        break;
        }
        else {
        echo $templates->render('kirjautumaton');
        break;
        }

    case '/notfound':
        echo $templates->render('notfound');
        break;
    
        case "/reset":
          $resetkey = $_GET['key'];
          require_once MODEL_DIR . 'henkilo.php';
          $rivi = tarkistaVaihtoavain($resetkey);
          if ($rivi) {
            if ($rivi['aikaikkuna'] < 0) {
              echo $templates->render('reset_virhe');
              break;
            }
          } else {
            echo $templates->render('reset_virhe');
            break;
          }

          $formdata = cleanArrayData($_POST);
          if (isset($formdata['laheta'])) {
          require_once CONTROLLER_DIR . 'tili.php';
          $tulos = resetoiSalasana($formdata,$resetkey);
            if ($tulos['status'] == "200") {
            echo $templates->render('reset_valmis');
            break;
          }
          echo $templates->render('reset_lomake', ['error' => $tulos['error']]);
          break;
    
          } else {
            echo $templates->render('reset_lomake', ['error' => '']);
            break;
          }
    
          break;
    
    default:
        echo $templates->render('notfound');

    }
//require_once '../src/init.php';


// Siistitään polku urlin alusta ja mahdolliset parametrit urlin lopusta.
//$request = str_replace($config['urls']['baseUrl'],'',$_SERVER['REQUEST_URI']);
//$request = strtok($request, '?');

// Luodaan uusi Plates-olio ja kytketään se sovelluksen sivupohjiin.
//$templates = new League\Plates\Engine(TEMPLATE_DIR);

// Selvitetään mitä sivua on kutsuttu ja suoritetaan sivua vastaava 
// käsittelijä.

//if ($request === '/' || $request === '/etusivu') {
//    echo $templates->render('etusivu');
//}   else if ($request === '/lisaa') {
//    if (isset($_POST['laheta'])) {
//        require_once MODEL_DIR . 'lisaa.php';
//        $lisaa = lisaaTiedot($_POST['nimi'], $_POST['liikevaihto'], $_POST['materiaalit'],
//        $_POST['henkilosto'], $_POST['poistot'], $_POST['muutkulut'], $_POST['rahoitus'],
//        $_POST['verot'], $_POST['kokonaismaara'], $_POST['osakehinta'], $_POST['sijoitus']);
//        echo "Tiedot lisätty yrityksen $_POST[nimi] nimellä.";
//        
//    } else {
//        echo $templates->render('lisaa');
//    }
//    
//}   else if ($request === '/tulosta') {
//    echo $templates->render('tulosta');

//}   else if ($request === '/hae') {
//    require_once MODEL_DIR . 'hae.php';
//   $hae = haeTiedot();
//    echo $templates->render('hae', ['hae' => $hae]);
   
//}   else if ($request === '/lisaa_tili') {
//    if (isset($_POST['laheta'])) {
//        $formdata = siistiTiedot($_POST);
//        require_once MODEL_DIR . 'henkilo.php'; 
//        $tulos = lisaaHenkilo($formdata);
//        $salasana = password_hash($_POST['salasana1'], PASSWORD_DEFAULT);
//        $id = lisaaHenkilo($formdata['nimi'], $formdata['email'], $salasana);
//        if($tulos['status']=="200") {
//        echo $templates->render('tili_luotu');
//        }

        
    
//    } else {
//        echo $templates ->render('lisaa_tili');
//    }
//}    else if ($request === '/kirjaudu') {
//        if (isset($_POST['laheta'])) {
//            require_once CONTROLLER_DIR . 'kirjaudu.php';
//            if (tarkistaKirjautuminen($_POST['email'],$_POST['salasana'])) {
//                session_regenerate_id;
//                $_SESSION['user'] = $_POST['email'];
//                header("Location: " . $config['urls']['baseUrl']);
//            } else {
//              echo $templates->render('kirjaudu', [ 'error' => ['virhe' => 'Väärä käyttäjätunnus tai salasana!']]);
//            }
//          } else {
//            echo $templates->render('kirjaudu', [ 'error' => []]);
//          }
//}     else if ($request === '/logout') {
//        require_once CONTROLLER_DIR . 'kirjaudu.php';
//        logout();
//        header("Location: " . $config['urls']['baseUrl']);
//         


//} else {
//    echo $templates->render('notfound');
//}
?>



