<?php
session_start();
require_once('database.php');

if (isset($_POST['registra_segnalazione'])) {
    $dataSegnalazione = date('Y-m-d H:i:s');
    $descrizione = $_POST['descrizione'] ?? '';
    $atti = $_POST['atti'] ?? '';

    $query = "
        SELECT id
        FROM users
        WHERE email = :email
    ";

    $check = $pdo->prepare($query);
    $check->bindParam(':email', $_SESSION['session_user'], PDO::PARAM_STR);
    $check->execute();

    $id_user = $check->fetch(PDO::FETCH_ASSOC);

    $query = "
        INSERT INTO segnalazioni(dataSegnalazione,descrizione,atti,ksUser)
        VALUES (:dataSegnalazione,:descrizione,:atti,:ksUser)
    ";
    
    $check = $pdo->prepare($query);
    $check->bindParam(':dataSegnalazione', $dataSegnalazione, PDO::PARAM_STR);
    $check->bindParam(':descrizione', $descrizione, PDO::PARAM_STR);
    $check->bindParam(':atti', $atti, PDO::PARAM_STR);
    $check->bindParam(':ksUser', $id_user['id'], PDO::PARAM_STR);
    $check->execute();
    
    if ($check->rowCount() > 0) {
        $msg = 'Registrazione eseguita con successo %s';
        require_once "encrypt_e_decrypt.php";
        $session_user = encrypt_decrypt('decrypt',$_SESSION['session_user']);
        mail($session_user,'Registrazione eseguita',"Si ringrazia per la segnalazione. La stessa è stata correttamente presa in carico e potrà essere consultata facendo il login al sito ferdyerrichielloesame.altervista.org.");
    } else {
        $msg = 'Problemi con l\'inserimento dei dati %s';
    }
    
    printf($msg, '<a href="../index.php">torna indietro</a>');
}