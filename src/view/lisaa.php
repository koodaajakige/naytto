<?php $this->layout('template', ['title' => 'Lisaa tiedot']) ?>

<form action="" method="POST">
<h1>Lisää yrityksen tiedot</h1>
<div class="kirjautuminen>
    <div>
        <label>Nimi:</label>
        <input type="text" name="nimi" id="nimi">
    </div>
    <div>
        <label>Liikevaihto:</label>
        <input type="number" name="liikevaihto">
    </div>
    <div>
        <label>Materiaalit ja palvelut:</label>
        <input type="number" name="materiaalit">
    </div>
    <div>
        <label>Henkilöstökulut: </label>
        <input type="number" name="henkilosto">
    </div>
    <div>
        <label>Poistot ja arvonalennukset: </label>
        <input type="number" name="poistot">
    </div>
    <div>
        <label>Liiketoiminnan muut kulut: </label>
        <input type="number" name="muutkulut">
    </div>
    <div>
        <label>Rahoitustuotot ja -kulut: </label>
        <input type="number" name="rahoitus">
    </div>
    <div>
        <label>Tuloverot: </label>
        <input type="number" name="verot">
    </div>
    <div>
        <label>Osakkeiden kokonaismäärä: </label>
        <input type="number" name="kokonaismaara">
    </div>
    <div>
        <label>Osakkeen hinta: </label>
        <input type="number" name="osakehinta">
    </div>
    <div>
        <label>Sijoitettava summa: </label>
        <input type="number" name="sijoitus">
    </div>
    <div>
        <input type="submit" name="laheta" value="TALLENNA">
    </div>
</div>
</form>

