<?php
session_start();
require_once('database.php');
require("encrypt_e_decrypt.php");

if (isset($_SESSION['session_id'])) {
    header('Location: dashboard.php');
    exit;
}

if (isset($_POST['noPassword'])) {
    if (!isset($_POST['recupero'])) {
        ?>  
        <form method="post" action="login.php">
            <label for="recupero">Inserire l'email </label><input type="email" name="recupero" required>
        <button type="submit" name="noPassword">Non ricordo la password</button>
        <?php
    } else {
        mail($_POST['recupero'],'Password dimenticata',"Se hai dimenticato la password inviare un'email a ferdinando.errichiello2002@gmail.com");
        ?><script>alert("Leggere l'email arrivata sulla posta elettronica");setTimeout(function(){ window.history.back(); }, 1000);</script><?php
    }
}

if (isset($_POST['login']) && !isset($_POST['email'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        $msg = 'Inserisci username e password %s';
    } else {
        $query = "
            SELECT username, password
            FROM admins
            WHERE username = :username
        ";
        
        $check = $pdo->prepare($query);
        $check->bindParam(':username', $username, PDO::PARAM_STR);
        $check->execute();
        
        $user = $check->fetch(PDO::FETCH_ASSOC);
        
        if (!$user || password_verify($password, $user['password']) === false) {
            $msg = 'Credenziali utente errate %s';
        } else {
            session_regenerate_id();
            $_SESSION['session_id'] = session_id();
            $_SESSION['session_user'] = $user['username'];
            
            header('Location: /index.php');
            exit;
        }
    }
    
    printf($msg, '<a href="../index.php">torna indietro</a>');

    //FINE LOGIN AMMINISTRATORE

    
    //INIZIO LOGIN UTENTE NORMALE
    
} else if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (empty($email) || empty($password)) {
        $msg = 'Inserisci email e password %s';
    } else {
        $query = "
            SELECT email, pass
            FROM users
            WHERE email = :email
        ";

        $email=encrypt_decrypt('encrypt',$email);

        $check = $pdo->prepare($query);
        $check->bindParam(':email', $email, PDO::PARAM_STR);
        $check->execute();
        
        $user = $check->fetch(PDO::FETCH_ASSOC);
        
        if (!$user || password_verify($password, $user['pass']) === false) {
            $msg = 'Credenziali utente errate %s';
        } else {
            session_regenerate_id();
            $_SESSION['session_id'] = session_id();
            $_SESSION['session_user'] = $user['email'];
            
            header('Location: /index.php');
            exit;
        }
    }
    
    printf($msg, '<a href="../index.php">torna indietro</a>');

}