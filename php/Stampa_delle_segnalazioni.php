<?php
session_start();
require_once('database (1).php');
require_once "php/encrypt_e_decrypt.php";

//header("Refresh: 2; url=segnalazioni.php");

$sec="2";
$c=0;
if (isset($_SESSION['session_id'])) {
  //FILTRO<----------------------------------------
  if (isset($_GET['filtro'])) {
    if ($_GET['data']!=="") {
      $data_f="AND dataSegnalazione <= '".$_GET['data']."'";
    }
    if ($_GET['cognome']!=="") {
      $cognome_f="AND cognome = '".encrypt_decrypt('encrypt',$_GET['cognome'])."'";
    }
    if ($_GET['email']!=="") {
      $email_f="AND email = '".encrypt_decrypt('encrypt',$_GET['email'])."'";
    }
    if ($_GET['descrizione_f']!=="") {
      $descrizione_f="AND descrizione LIKE '%".$_GET['descrizione_f']."%'";
    }
    

    
    
  }

  $session_user=$_SESSION['session_user'];
  $sql_admin = "
  SELECT username
  FROM admins
  WHERE username = '$session_user'
  ";
  $result_admin = mysqli_query($conn, $sql_admin);
  if (mysqli_num_rows($result_admin) > 0) {
    $sql1 = "
      SELECT segnalazioni.id as 'id segnalazione',segnalazioni.dataSegnalazione as 'data segnalazione',users.cognome as 'cognome',users.nome as 'nome',users.email as 'email',users.telefono as 'telefono',segnalazioni.descrizione as 'descrizione',segnalazioni.ksReparto as 'reparto',segnalazioni.ksTipologia as 'tipologia',segnalazioni.atti as 'atti',segnalazioni.risolto as 'risolto'
      FROM users,segnalazioni
      WHERE segnalazioni.ksUser=users.id $data_f $cognome_f $email_f $descrizione_f
      ORDER BY dataSegnalazione desc
    ";
  } else {
    $sql1 = "
        SELECT segnalazioni.id as 'id segnalazione',segnalazioni.dataSegnalazione as 'data segnalazione',users.cognome as 'cognome',users.nome as 'nome',users.email as 'email',users.telefono as 'telefono',segnalazioni.descrizione as 'descrizione',segnalazioni.ksReparto as 'reparto',segnalazioni.ksTipologia as 'tipologia',segnalazioni.atti as 'atti',segnalazioni.risolto as 'risolto'
        FROM users,segnalazioni
        WHERE segnalazioni.ksUser=users.id AND users.email='$session_user' $data_f $cognome_f $email_f $descrizione_f
        ORDER BY dataSegnalazione desc
    ";
  }
} else {
  $common_user=true;
}


    
$result1 = $conn->query($sql1);

//---------------------------
if ($result1->num_rows > 0) {
  while($row = $result1->fetch_assoc()) {
    ?>
    <style type="text/css">

      .tg {
        border-collapse:collapse;
        border-spacing:0;
        width: 575px;
      }

      .tg td {
        border-color:black;
        border-style:solid;
        border-width:1px;
        font-family:Arial, sans-serif;
        font-size:14px;
        overflow:hidden;
        padding:10px 5px;
        word-break:normal;
        font-weight:normal;
        overflow:hidden;
        padding:10px 5px;
        word-break:normal;
      }

      .tg .tg-0lax {
        text-align:left;
        vertical-align:top
      }

      .tg .tg-0pky
      {
        border-color:inherit;
        text-align:left;
        vertical-align:top
      }

    </style>
    <div class="lefthr"></div>
    <div class="article">
      <table class="tg"><!--TABELLA DELLA SEGNALAZIONE-->
        <tr>
          <td class="tg-0lax">Data della segnalazione: <?php echo $row['data segnalazione']?></td>
          <td class="tg-0pky">Cognome: <?php echo encrypt_decrypt('decrypt',$row['cognome']);?></td>
          <td class="tg-0pky">Nome: <?php echo encrypt_decrypt('decrypt',$row['nome']);?></td>
          <td class="tg-0lax">Email: <?php echo encrypt_decrypt('decrypt',$row['email']);?></td>
          <td class="tg-0lax">Tel.: <?php echo encrypt_decrypt('decrypt',$row['telefono']);?></td>
        </tr>
        <tr>
          <td class="tg-0lax" colspan="5">Descrizione: <?php echo $row['descrizione'];?></td>
        </tr>
        <tr>
          <td class="tg-0lax" colspan="2">Reparto: <?php 
//-------------------
          if ($row['reparto']===NULL) echo "Non ancora impostato"; 
          else {
            $id_reparto_in_tabella=$row['reparto'];
            $sql_reparto_t="
            SELECT reparti.descrizione AS 'descrizione'
            FROM reparti
            WHERE id='$id_reparto_in_tabella' 
            ";
            $result_reparto_in_tabella = mysqli_query($conn, $sql_reparto_t);
            while($row_descrizione_reparto_in_tabella = mysqli_fetch_assoc($result_reparto_in_tabella)) {
              echo $row_descrizione_reparto_in_tabella['descrizione'];
            }
          }
//-------------------
          ?></td>
          <td class="tg-0lax">Tipologia: <?php 
//-------------------
          if ($row['tipologia']===NULL) echo "Non ancora impostato"; 
          else {
            $id_tipologia_in_tabella=$row['tipologia'];
            $sql_tipologia_t="
            SELECT tipologie.descrizione AS 'descrizione'
            FROM tipologie
            WHERE id='$id_tipologia_in_tabella' 
            ";
            $result_tipologia_in_tabella = mysqli_query($conn, $sql_tipologia_t);
            while($row_descrizione_tipologia_in_tabella = mysqli_fetch_assoc($result_tipologia_in_tabella)) {
              echo $row_descrizione_tipologia_in_tabella['descrizione'];
            }
          }
//-------------------
          ?></td>
          <td class="tg-0lax">Disposto a dichiarare in atti: <?php if($row['atti']==1) echo "Si"; else echo "No";?></td>
          <td class="tg-0lax">Risolto: <?php if($row['risolto']==1) echo "Si"; else echo "No";?></td>
        </tr>
      </table><br>

      <?php
      //OPERAZIONE DI CANCELLAZIONE DELL'AMMINISTRATORE SULLE SEGNALAZIONI
      if (isset($_SESSION['session_id'])) {
        $session_user=$_SESSION['session_user'];
        $sql2 = "
        SELECT username
        FROM admins
        WHERE username = '$session_user'
        ";
        $result2 = $conn->query($sql2);
        $roww = $result2->fetch_assoc();
        if ($result2->num_rows > 0) {
          $id_segnalazione=$row['id segnalazione'];
          //echo "<a href=\"?delete_s=".$id_segnalazione."\" onclick=\"return confirm('Sei sicuro di voler cancellare questa segnalazione? Non potrai annullare questa operazione');\">Cancella segnalazione</a>";
          //echo "<br><br>";
        }
      }

      //OPERAZIONI DELL'AMMINISTRATORE SUI REPARTI E TIPOLOGIE
      if (isset($_SESSION['session_id'])) {
        $session_user=$_SESSION['session_user'];
        $sql2 = "
        SELECT username
        FROM admins
        WHERE username = '$session_user'
        ";
        $result2 = $conn->query($sql2);
        $roww2 = $result2->fetch_assoc();
        if ($result2->num_rows > 0) {
          //SE E' ADMIN
          $sql_reparto = "
          SELECT *
          FROM reparti
          ";
          $sql_tipologia = "
          SELECT *
          FROM tipologie
          ";
          $result_reparto = mysqli_query($conn, $sql_reparto);
          $result_tipologie = mysqli_query($conn, $sql_tipologia);

          if (mysqli_num_rows($result_reparto) > 0) {
            ?>
            <form method="get" action="../segnalazioni.php">
            <select name="reparto" id="reparto">
            <?php
            while($row_reparti = mysqli_fetch_assoc($result_reparto)) {
              echo "<option value=\"".$row_reparti['id']."-".$id_segnalazione."\">".$row_reparti['descrizione']."</option>";
            }
            ?>
              </select>
              <br><br>
              <input type="submit" name="reparto_button" value="Modifica" onclick="return confirm('Stai modificando il reparto della segnalazione, sei sicuro di volerlo fare?');">
            </form>

            <?php

          }
          if (mysqli_num_rows($result_tipologie) > 0) {
            ?>
            <form method="get" action="../segnalazioni.php">
            <select name="tipologia" id="tipologia">
            <?php
            while($row_tipologie = mysqli_fetch_assoc($result_tipologie)) {
              echo "<option value=\"".$row_tipologie['id']."-".$id_segnalazione."\">".$row_tipologie['descrizione']."</option>";
            }
            ?>
              </select>
              <br><br>
              <input type="submit" name="tipologia_button" value="Modifica" onclick="return confirm('Stai modificando la tipologia della segnalazione, sei sicuro di volerlo fare?');">
            </form>
            
            <?php

          }
          ?>






          <form method="get" action="../segnalazioni.php">
          <input type="hidden" name="statoRisoluzione" value="<?php echo $row['risolto']."-".$id_segnalazione; ?>">
          <input type="submit" name="risolto_button" value="Cambia stato risoluzione" onclick="return confirm('<?php
          if($row['risolto']==0) {
            ?>Impostare la segnalazione come completata?<?php
          } else {
            ?>Impostare la segnalazione come non completata?<?php
          }
          ?>');"></form>






          <?php

          echo "<br><br>";
        }
      }
      ?>

        
    </div>
  <?php } 
  } else {
    if (!$common_user) {
      ?>
        <div class="lefthr"></div>
        <div class="article">
          <!--p>0 risultati</p-->
          <h1>0 segnalazioni registrate</h1>
        </div>
      <?php
    } else {
      ?>
      <div class="lefthr"></div>
      <div class="article">
        <!--p>0 risultati</p-->
        <h1>Non hai l'accesso alle segnalazioni degli altri utenti</h1>
      </div>
    <?php
    } 
}






if (isset($_SESSION['session_id'])) {
  $session_user=$_SESSION['session_user'];
  $sql2 = "
  SELECT username
  FROM admins
  WHERE username = '$session_user'
  ";
  $result2 = $conn->query($sql2);
  $roww2 = $result2->fetch_assoc();
  if ($result2->num_rows > 0) {
    //SE E' ADMIN
    //--------------------------------------------------------
    /*if (isset($_GET['delete_s'])) {
      //$page = $_SERVER['PHP_SELF'];
      $id_segnalazione=$_GET['delete_s'];

      $sql_cancellazione = "DELETE FROM segnalazioni WHERE id='$id_segnalazione'";

      if (mysqli_query($conn, $sql_cancellazione)) {
        ?><script>alert("Segnalazione cancellata con successo");setTimeout(function(){ window.history.back(); }, 1000);</script><?php
      } else {
        ?><script>alert("Errore nella cancellazione della segnalazione");setTimeout(function(){ window.history.back(); }, 1000);</script><?php
      }
      
    }*/
    //--------------------------------------------------------
    if (isset($_GET['reparto_button'])) {
      $ar=explode("-",$_GET['reparto']);
      $id_reparto=$ar[0];
      $id_segnalazione_1=$ar[1];

      $sql3 = "UPDATE segnalazioni SET ksReparto='$id_reparto' WHERE id='$id_segnalazione_1'";

      if (mysqli_query($conn, $sql3)) {
        ?><script>alert("Segnalazione modificata con successo");setTimeout(function(){ window.history.back(); }, 1000);</script><?php
      } else {
        ?><script>alert("Errore nella modifica della segnalazione");setTimeout(function(){ window.history.back(); }, 1000);</script><?php
      }
      
    }
    //--------------------------------------------------------
    if (isset($_GET['tipologia_button'])) {
      $ar=explode("-",$_GET['tipologia']);
      $id_tipologia=$ar[0];
      $id_segnalazione_1=$ar[1];

      $sql4 = "UPDATE segnalazioni SET ksTipologia='$id_tipologia' WHERE id='$id_segnalazione_1'";

      if (mysqli_query($conn, $sql4)) {
        ?><script>alert("Segnalazione modificata con successo");setTimeout(function(){ window.history.back(); }, 1000);</script><?php
      } else {
        ?><script>alert("Errore nella modifica della segnalazione");setTimeout(function(){ window.history.back(); }, 1000);</script><?php
      }
    }
    //--------------------------------------------------------
    if (isset($_GET['risolto_button'])) {
      $ar=explode("-",$_GET['statoRisoluzione']);
      $risolto=$ar[0];
      $id_segnalazione_1=$ar[1];

      if ($risolto==1) {
      $sql5 = "UPDATE segnalazioni SET risolto=0 WHERE id='$id_segnalazione_1'";
      } else {
      $sql5 = "UPDATE segnalazioni SET risolto=1 WHERE id='$id_segnalazione_1'";
      }
      if (mysqli_query($conn, $sql5)) {
        ?><script>alert("Segnalazione modificata con successo");setTimeout(function(){ window.history.back(); }, 1000);</script><?php
      } else {
        ?><script>alert("Errore nella modifica della segnalazione");setTimeout(function(){ window.history.back(); }, 1000);</script><?php
      }

    }
    //--------------------------------------------------------
    
  
  }
}






$conn->close();

//---------------------------


?>