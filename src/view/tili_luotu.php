<?php $this->layout('template', ['title' => 'Tili luotu']) ?>

<h1>Sinulle on luotu tili!</h1>

<p>Sähköpostiisi (<?= getValue($formdata,'email') ?>) on lähetetty vahvistusviesti. 
Käy vahvistamassa sähköpostiosoitteesi klikkaamalla viestissä olevaa linkkiä</p>

