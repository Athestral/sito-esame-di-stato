<?php
require_once('database (1).php');
require("encrypt_e_decrypt.php");

if (isset($_POST['register']) || isset($_POST['conferma'])) {

    $sesso = $_POST['sesso'];
    $dataNascita = $_POST['dataNascita'];

    if (isset($_POST['conferma'])) {
        $cognome=encrypt_decrypt('decrypt',$_POST['cognome']);
        $nome=encrypt_decrypt('decrypt',$_POST['nome']);
        $luogoNascita=encrypt_decrypt('decrypt',$_POST['luogoNascita']);
        $indirizzo=encrypt_decrypt('decrypt',$_POST['indirizzo']);
        $citta=encrypt_decrypt('decrypt',$_POST['citta']);
        $provincia=encrypt_decrypt('decrypt',$_POST['provincia']);
        $email=encrypt_decrypt('decrypt',$_POST['email']);
        $telefono=encrypt_decrypt('decrypt',$_POST['telefono']);
    } else {
        $cognome = $_POST['cognome'];
        $nome = $_POST['nome'];
        $luogoNascita = $_POST['luogoNascita'];
        $indirizzo = $_POST['indirizzo'];
        $citta = $_POST['citta'];
        $provincia = $_POST['provincia'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
    }

    if (isset($_POST['conferma'])) {
        $password = encrypt_decrypt('decrypt',$_POST['password']);
    } else {
        $password = $_POST['password'];
    }
    
    
    $isSurnameValid = filter_var(
        $cognome,
        FILTER_VALIDATE_REGEXP, [
            "options" => [
                "regexp" => "/^[a-z\d_]{3,20}$/i"
            ]
        ]
    );
    $isNameValid = filter_var(
        $nome,
        FILTER_VALIDATE_REGEXP, [
            "options" => [
                "regexp" => "/^[a-z\d_]{3,20}$/i"
            ]
        ]
    );
    $pwdLenght = mb_strlen($password);
    
    if (empty($cognome) || empty($nome) || empty($sesso) || empty($dataNascita) || empty($luogoNascita) || empty($indirizzo) || empty($citta) || empty($provincia) || empty($password) || empty($email) || empty($telefono)) {
        echo $cognome."<br>";
            echo $nome."<br>";
            echo $sesso."<br>";
            echo $dataNascita."<br>";
            echo $luogoNascita."<br>";
            echo $indirizzo."<br>";
            echo $citta."<br>";
            echo $provincia."<br>";
            echo $password."<br>";
            echo $email."<br>";
            echo $telefono."<br>";
        $msg = 'Compila tutti i campi %s';
    } elseif (false === $isSurnameValid || false === $isNameValid) {
        $msg = 'Il Cognome o il Nome non sono validi. Sono ammessi solamente caratteri 
                alfanumerici e l\'underscore. Lunghezza minina 3 caratteri.
                Lunghezza massima 20 caratteri';
    } elseif ($pwdLenght < 8 || $pwdLenght > 20) {
        $msg = 'Lunghezza minima password 8 caratteri.
                Lunghezza massima 20 caratteri';
    } else {
        

        $query = "
            SELECT id
            FROM users
            WHERE email = '$email'
        ";
        
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            $msg = 'Email gia\' in uso %s';
        } else {
            
            if (!isset($_POST['conferma'])) {
                $codice=getRandomString(10);
                require_once "conferma_email.php";
            } else {
                if ($_POST['confermaEmail']==encrypt_decrypt('decrypt',$_POST['codice'])) {
                    
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);
                    
                    $cognome=encrypt_decrypt('encrypt',$cognome);
                    $nome=encrypt_decrypt('encrypt',$nome);
                    $luogoNascita=encrypt_decrypt('encrypt',$luogoNascita);
                    $indirizzo=encrypt_decrypt('encrypt',$indirizzo);
                    $citta=encrypt_decrypt('encrypt',$citta);
                    $provincia=encrypt_decrypt('encrypt',$provincia);
                    $email=encrypt_decrypt('encrypt',$email);
                    $telefono=encrypt_decrypt('encrypt',$telefono);

                    $query2 = "INSERT INTO users(cognome,nome,sesso,dataNascita,luogoNascita,indirizzo,citta,provincia,pass,email,telefono)
                    VALUES ('$cognome','$nome','$sesso','$dataNascita','$luogoNascita','$indirizzo','$citta','$provincia','$password_hash','$email','$telefono')";

                    if (mysqli_query($conn, $query2)) {
                        $msg = 'Registrazione eseguita con successo %s';
                    } else {
                        $msg = '<br>Problemi con l\'inserimento dei dati %s';
                        echo("Error description: " . mysqli_error($conn));
                    }
                } else {$msg="<h1>errore</h1><br>";}
            }

            
        }
    }
    printf($msg, '<a href="../index.php">torna indietro</a>');
    $conn->close();
}