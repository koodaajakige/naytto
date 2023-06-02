<?php $this->layout('template', ['title' => 'Lisaa tiedot']) ?>

<div class="kirjautuminen">
<form action="" method="POST">
<h1>Lisää uusi yritys</h1>
    <div>
        <label>Nimi:</label>
        <input type="text" name="nimi" value="<?= getValue($formdata, 'nimi') ?>">
        <div class="error"><span><?=getValue($error, 'nimi'); ?></span></div>
    </div>
    <div>
        <label>Liikevaihto:</label>
        <input type="number" step=".01" min="0" name="liikevaihto" value="<?= getValue($formdata, 'liikevaihto') ?>">
        <div class="error"><?=getValue($error, 'liikevaihto'); ?></div>
    </div>
    <div>
        <label>Materiaalit ja palvelut:</label>
        <input type="number" step=".01" name="materiaalit" value="<?= getValue($formdata, 'materiaalit') ?>">
        <div class="error"><?=getValue($error, 'materiaalit'); ?></div>
    </div>
    <div>
        <label>Henkilöstökulut: </label>
        <input type="number" step=".01" name="henkilosto" value="<?= getValue($formdata, 'henkilosto') ?>">
        <div class="error"><?=getValue($error, 'henkilosto'); ?></div>
    </div>
    <div>
        <label>Poistot ja arvonalennukset: </label>
        <input type="number" step=".01" name="poistot" value="<?= getValue($formdata, 'poistot') ?>">
        <div class="error"><?=getValue($error, 'poistot'); ?></div>
    </div>
    <div>
        <label>Liiketoiminnan muut kulut: </label>
        <input type="number" step=".01" name="muutkulut" value="<?= getValue($formdata, 'muutkulut') ?>">
        <div class="error"><?=getValue($error, 'muutkulut'); ?></div>
    </div>
    <div>
        <label>Rahoitustuotot ja -kulut: </label>
        <input type="number" step=".01" name="rahoitus" value="<?= getValue($formdata, 'rahoitus') ?>">
        <div class="error"><?=getValue($error, 'rahoitus'); ?></div>
    </div>
    <div>
        <label>Tuloverot: </label>
        <input type="number" step=".01" name="verot" value="<?= getValue($formdata, 'verot') ?>">
        <div class="error"><?=getValue($error, 'verot'); ?></div>
    </div>
    <div>
        <label>Osakkeiden kokonaismäärä: </label>
        <input type="number" name="kokonaismaara" value="<?= getValue($formdata, 'kokonaismaara') ?>">
        <div class="error"><?=getValue($error, 'kokonaismaara'); ?></div>
    </div>
    <div>
        <label>Osakkeen hinta: </label>
        <input type="number" step=".01" name="osakehinta" value="<?= getValue($formdata, 'osakehinta') ?>">
        <div class="error"><?=getValue($error, 'osakehinta'); ?></div>
    </div>
    <div>
        <label>Sijoitettava summa: </label>
        <input type="number" step=".01" name="sijoitus" value="<?= getValue($formdata, 'sijoitus') ?>">
        <div class="error"><?=getValue($error, 'sijoitus'); ?></div>
    </div>
    <div>
        <input type="submit" name="laheta" value="Lisää tiedot">
    </div>
    </form>

