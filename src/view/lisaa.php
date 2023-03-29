<?php $this->layout('template', ['title' => 'Lisaa tiedot']) ?>

<form action="" method="POST">
<h1>Lisää yrityksen tiedot</h1>
    <div>
        <label>Nimi:</label>
        <input type="text" name="nimi"><br>
    </div>
    <div>
        <label>Liikevaihto:</label>
        <input type="number" name="liikevaihto"><br>
    </div>
    <div>
        <label>Materiaalit ja palvelut:</label>
        <input type="number" name="materiaalit"><br>
    </div>
    <div>
        <label>Henkilöstökulut: </label>
        <input type="number" name="henkilosto"><br>
    </div>
    <div>
        <label>Poistot ja arvonalennukset: </label>
        <input type="number" name="poistot"><br>
    </div>
    <div>
        <label>Liiketoiminnan muut kulut: </label>
        <input type="number" name="muutkulut"><br>
    </div>
    <div>
        <label>Rahoitustuotot ja -kulut: </label>
        <input type="number" name="rahoitus"><br>
    </div>
    <div>
        <label>Tuloverot: </label>
        <input type="number" name="verot"><br>
    </div>
    <div>
        <label>Osakkeiden kokonaismäärä: </label>
        <input type="number" name="kokonaismaara"><br>
    </div>
    <div>
        <label>Osakkeen hinta: </label>
        <input type="number" name="osakehinta"><br>
    </div>
    <div>
        <label>Sijoitettava summa: </label>
        <input type="number" name="sijoitus"><br>
    </div>
    <div>
        <br>
        <input type="submit" name="laheta" value="TALLENNA">
    </div>
</form>

<!--
    <form action="index.php" method="post">
        <div>
            <label>Liikevaihto: </label>
            <input type="number" name="liikevaihto"><br>
        </div>
        <div>
            <label>Materiaalit ja palvelut:</label>
            <input type="number" name="materiaalit"><br>
        </div>
        <div>
            <label>Henkilöstökulut: </label>
            <input type="number" name="henkilöstö"><br>
        </div>
        <div>
            <label>Poistot ja arvonalennukset: </label>
            <input type="number" name="poistot"><br>
        </div>
        <div>
            <label>Liiketoiminnan muut kulut: </label>
            <input type="number" name="muutkulut"><br>
        </div>
            <label>Rahoitustuotot ja -kulut: </label>
            <input type="number" name="rahoitus"><br>
        </div>
        <div></div>
            <label>Tuloverot: </label>
            <input type="number" name="verot"><br>
        </div>
        <div>
            <label>Osakkeiden kokonaismäärä: </label>
            <input type="number" name="osakemäärä"><br>
        </div>
            <label>Osakkeen hinta: </label>
            <input type="number" name="osakehinta"><br>
        <div>
            <label>Sijoitettava summa: </label>
            <input type="number" name="sijoitus"><br>
        </div>
        <div>
            <button type="submit" name="lähetä"></button>
        </div>
   </form>
-->
