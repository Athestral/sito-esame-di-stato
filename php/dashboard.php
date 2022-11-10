<?php
session_start();

if (isset($_SESSION['session_id'])) {
    $session_user = htmlspecialchars($_SESSION['session_user'], ENT_QUOTES, 'UTF-8');
    $session_id = htmlspecialchars($_SESSION['session_id']);
    
    //printf("Benvenuto %s, il tuo session ID è %s", $session_user, $session_id);
    //echo "<br>";
    //echo '<a href="logout.php">logout</a>';
} else {
    //echo "Effettua il login per accedere all'area riservata<br>";
    //echo "Effettua il login per accedere all'area riservata<br><a href=\"../index.php\">Torna alla pagina iniziale</a>";
}
?>