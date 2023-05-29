<?php
# poistaa tyhjät merkit alusta ja lopusta mm. sarkain, välilyönti ja rivinvaihto
# poistaa merkkien edestä / -ohjausmerkin
# muuntaa erikoismerkit HTML-kokonaisuuksiksi
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
 }

?>