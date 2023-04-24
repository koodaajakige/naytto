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
      </div>
    </header>
    <div>
    <section>
        <?=$this->section('content')?>
    </section>
    <footer>
      <hr>
      <div>&copy; Make it rain inc.</div>
    </footer>
  </body>
</html>