<?php
require_once "encrypt_e_decrypt.php";


$msgg="E' stata usata questa email per effettuare una registrazione al sito ferdyerrichielloesame.altervista.org.
Codice da inserire: ".$codice."
Se non sei il proprietario sposta queste email in spam.";
mail($email,'ferdyerrichielloesame.altervista.org',$msgg);

?>