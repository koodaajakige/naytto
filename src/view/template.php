<!DOCTYPE html>
<html lang="fi">
    <head>
        <link href="styles/styles.css" rel="stylesheet">
        <title>Sijoituskone - <?=$this->e($title)?></title>
        <meta charset="UTF-8">
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
            echo "<div><a href='kirjaudu'>Kirjaudu</a></div>";
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