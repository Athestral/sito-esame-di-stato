<?php require_once "encrypt_e_decrypt.php"; require "database (1).php"; ?>
<h1>Area di accesso</h1>
<ul>
<?php
    if (isset($_SESSION['session_id'])) {
        $sql_area = "SELECT username FROM admins";
        $result = $conn->query($sql_area);
        
        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                if ($row['username']==$_SESSION['session_user']) {
                    echo "<li>Username: ".$row['username']."</li>";
                } else {
                    echo "<li>Username: ".encrypt_decrypt('decrypt',$_SESSION['session_user'])."</li>";
                }
            }
        }
        echo "<li><a href='./php/logout.php'>Logout</a></li>";
        $conn->close();

        
    } else {
    echo "<li><a href='./html/register.html'>Registrati</a></li>";
    echo "<li><a href='./html/login.html'>Login</a></li>";
    }
?>
</ul>