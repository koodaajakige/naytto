<?php $this->layout('template', ['title' => 'Luo uusi tili'])?>

<form action="" method="POST">
<h1>Luo uusi tili</h1>

  <div>
    <label for="nimi">Nimi:</label>
    <input id="nimi" type="text" name="nimi" value="<?= getValue($formdata,'nimi') ?>">
    <div class="error"><span><?= getValue($error,'nimi'); ?></span></div>
  </div>
  <div>
    <label>Sähköposti:</label>
    <input type="text" name="email" value="<?= getValue($formdata,'email') ?>">
    <div class="error"><?= getValue($error,'email'); ?></div>
  </div>
  <div>
    <label>Salasana:</label>
    <input type="password" name="salasana1">
    <div class="error"><?= getValue($error,'salasana'); ?></div>
  </div>
  <div>
    <label>Salasana uudelleen:</label>
    <input type="password" name="salasana2">
  </div>
  <div>
    <input type="submit" name="laheta" value="Luo tili">
  </div>

</form>