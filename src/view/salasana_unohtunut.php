<?php $this->layout('template', ['title' => 'Salasana unohtunut?']) ?>

<form action="" method="POST">
<h1>Oletko unohtanut salasanasi?</h1>
<p>Ei hätää, voit vaihtaa unohtuneen salasan </p>
<p>tilaamalla vahvistuslinkin sähköpostiisi.</p>

  <div>
    <label for="email">Sähköposti:</label>
    <input id="email" type="email" name="email">
  </div>
  <div>
    <input type="submit" name="laheta" value="Lähetä">
  </div>
</form>