<!DOCTYPE html>
<html lang="fi">
    <head>
        <title>Show me the money! - <?=$this->e($title)?></title>
        <meta charset="UTF-8">
    </head>
    <body>
        <header>
            <h1><a href="<?=BASEURL?>">Sijoituskone</a></h1>
    </header>
    <div>
    <ul>
      <li><a href="etusivu" title="Etusivu">Etusivu</a></li>
      <li><a href="lisaa" title="Lisaa tiedot">Lisää tiedot</a></li>
</ul>
<a href="hae" title="Hae tiedot">Hae tiedot</a>
<a href="tulosta" title="Tulosta tiedot">Tulosta tiedot</a>
</div>
    <section>
        <?=$this->section('content')?>
    </section>
    <footer>
      <hr>
      <div>Make it rain inc.</div>
    </footer>
  </body>
</html>