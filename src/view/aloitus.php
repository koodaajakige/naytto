<!DOCTYPE html>
<html lang="fi">
    <head>
        <link href="styles/styles.css" rel="stylesheet">
        <meta charset="UTF-8">
        <title>Sijoituskone - Kirjaudu</title>
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
           </div>
      </header>

<div class="esittely_teksti">
    <br>
    <p>Sijoituskone on palvelu, jolla voit arvioida </p>
    <p>sijoituksesi kannattavuutta.</p>
    <p>Kirjaudu käyttääksesi tätä huikeaa palvelua!</p>
  <br>
</div>
<section>
<form action="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" method="POST">
<h1>Kirjaudu sisään</h1>
  <div>
    <label>Sähköposti:</label>
    <input type="text" name="email">
  </div>
  <div>
    <label>Salasana:</label>
    <input type="password" name="salasana">
  </div>
  <div class="error"><?= getValue($error,'virhe'); ?></div>
  <div>
    <input type="submit" name="laheta" value="Kirjaudu">
  </div>
  <div class="info">
  <a href="tilaa_vaihtoavain">Salasana unohtunut?</a>.
  </div>
  <div class="info">
  <a href="lisaa_tili">Luo uusi tili</a>.
  </div>
</form>
</section>

<div class="yhteys_teksti">
    <p>Ongelmia kirjautumisessa? </p>
    <p>Ota yhteyttä asiakaspalveluumme: </p>
    <p>asiakaspalvelu@be23koodaajat.fi </p>
    <p>tai p. 0600 123 456 </p>
    <p>(ark klo 9-16, 1.20€/min + ppm)</p>
  <br>
</div>
<footer>
      <hr>
      <div>&copy; Make it rain inc.</div>
    </footer>
  </body>
</html>