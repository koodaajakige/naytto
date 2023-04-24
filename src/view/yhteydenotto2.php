<?php $this->layout('template', ['title' => 'Yhteydenotto'])?>

<div class="esittely_teksti p">
<div>
<p></p>
<h1>Heräsikö kysymyksiä?</h1>
<br>
<p>Ota yhteyttä asiakaspalveluumme: </p>
<p>asiakaspalvelu@be23koodaajat.fi </p>
<p>tai p. 0600 123 456 </p>
<p>(ark klo 9-16, 1,20€/min + ppm)</p>
<br>
<p>Voit jättää palautteen myös</p>
<p>alla yhteydenottolomakkeella:</p>
<br>
</div>

<h2>PHP-lomake esimerkki</h2>
 <p><span class="error">* pakolliset kentät.</span></p>
 <form method="post" 
   action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   email: 
    <input type="text" name="email" value="<?php echo $email;?>">
    <span class="error">* <?php echo $emailVirhe;?></span>
    <br><br>
    Kommentti: 
    <textarea name="kommentti" rows="5" cols="40">
    <?php echo $kommentti;?></textarea>
    <br><br>

<div>
  <input type="submit" name="laheta" value="Lähetä">
</div>

</form>
</section>

</div>