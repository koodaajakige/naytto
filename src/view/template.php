<!DOCTYPE html>
<html lang="fi">
    <head>
        <link href="styles/styles.css" rel="stylesheet">
        <meta charset="UTF-8">
        <title>Sijoituskone - <?=$this->e($title)?></title>
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
        <link rel="manifest" href="images/site.webmanifest">
    </head>
    <body>
        <header>
            <h1><a href="<?=BASEURL?>">Sijoituskone</a></h1>
            <div class="profile">
            <br>
        <?php
          if (isset($_SESSION['user'])) {
            echo "<div>$_SESSION[user]</div>";
            echo "<div><a href='logout'>Kirjaudu ulos</a></div>";
          } else {
            echo "<div class='kirjaudu'><a href='kirjaudu'>Kirjaudu</a></div>";
          }
        ?>
      </div>
    </header>
    <div>
    <nav>
      <ul>
        <li><a href="etusivu" title="Etusivu">Etusivu</a></li>
        <li><a href="lisaa" title="Lisaa tiedot">Lisää uusi yritys</a></li>
        <li><a href="tulosta" title="Tulosta tiedot">Näytä sijoitukset</a></li>
        <li><a href="lisaa_tili" title="Luo uusi tili">Luo uusi tili</a></li>
      </ul>
    </nav>
    <section>
        <?=$this->section('content')?>
    </section>
    <footer>
      <hr>
      <div>&copy; Make it rain inc.</div>
    </footer>
  </body>
</html>