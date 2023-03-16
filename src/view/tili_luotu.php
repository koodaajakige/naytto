<?php $this->layout('templates', ['title' => 'Tili luotu']) ?>

<h1>Teille on luotu uusi tili!</h1>

<p>Sinulle on lähetetty sähköpostiisi (<?= getValue($formdata, 'email') ?>) vahvistusviesti. 
Käy vahvistamassa sähköpostiosoitteesi klikkaamalla viestissä olevaa linkkiä</p>

