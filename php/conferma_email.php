<?php

require_once "../php/invio_email.php";
require_once "../php/encrypt_e_decrypt.php";

$cognome=encrypt_decrypt('encrypt',$cognome);
$nome=encrypt_decrypt('encrypt',$nome);
$luogoNascita=encrypt_decrypt('encrypt',$luogoNascita);
$indirizzo=encrypt_decrypt('encrypt',$indirizzo);
$citta=encrypt_decrypt('encrypt',$citta);
$provincia=encrypt_decrypt('encrypt',$provincia);
$email=encrypt_decrypt('encrypt',$email);
$telefono=encrypt_decrypt('encrypt',$telefono);

?>

<html>
    <head>
        <title>Conferma Email</title>
        <link rel="shortcut icon" href="/gdf.jpg" type="image/x-icon"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="stylesheet" href="../css/style_lr.css">
    </head>
    <body>
        <div>
            <form method="post" action="/php/register.php">
                <h1>Conferma Email</h1>
                
                <input type="text" id="confermaEmail" placeholder="Inserire il codice arrivato per email qui" name="confermaEmail" minlength="10" required>
                <input type="hidden" name="cognome" value="<?php echo $cognome; ?>">
                <input type="hidden" name="nome" value="<?php echo $nome; ?>">
                <input type="hidden" name="sesso" value="<?php echo $sesso; ?>">
                <input type="hidden" name="dataNascita" value="<?php echo $dataNascita; ?>">
                <input type="hidden" name="luogoNascita" value="<?php echo $luogoNascita; ?>">
                <input type="hidden" name="indirizzo" value="<?php echo $indirizzo; ?>">
                <input type="hidden" name="citta" value="<?php echo $citta; ?>">
                <input type="hidden" name="provincia" value="<?php echo $provincia; ?>">
                <input type="hidden" name="password" value="<?php echo encrypt_decrypt('encrypt',$password); ?>">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="telefono" value="<?php echo $telefono; ?>">
                <input type="hidden" name="codice" value="<?php echo encrypt_decrypt('encrypt',$codice); ?>">
                <button type="submit" name="conferma">Conferma</button>
            </form>
        </div>
    </body>
</html>
