<html>
  <head>
    <title>Progetto d'Esame</title>
    
    <?php session_start(); require_once "html/link_in_head.html"; ?>
    <?php require_once "php/encrypt_e_decrypt.php"; ?>
    <script src="/js/functions.js"></script>

    <script>
      
    </script>

  </head>
  <body onload="dataCorrenteInput();">


    <?php require_once "php/dashboard.php" ?>


    <div id="container">
      <div id="banner">
        <div id="title">
          <h1><a href="http://ferdyerrichielloesame.altervista.org/">Segnalazione violazioni</a></h1>
        </div>
        <ul class="nav">
          <li><a href="./index.php">Home</a></li>
          <li><a href="./segnalazioni.php" id="currentPage">Segnalazioni</a></li>
        </ul>
      </div>
      <div id="mainContentTop"> </div>
      <div id="mainContent">
        <div class="left">
          <div class="article">
          <?php
            require_once "./php/database.php";

            if (isset($_SESSION['session_id'])) { 
             
              $query = "
                  SELECT email
                  FROM users
                  WHERE email = :email
              ";
              
              $check = $pdo->prepare($query);
              $check->bindParam(':email', $_SESSION['session_user'], PDO::PARAM_STR);
              $check->execute();
              
              $user = $check->fetch(PDO::FETCH_ASSOC);
              
              if ($user && $user['email'] === $_SESSION['session_user']) {
                
              ?>
            <div>
              <form method="post" action="/php/registra_segnalazione.php">
                  <h1>Segnalazione</h1>
                  
                  <textarea id="descrizione" name="descrizione" placeholder="Descrivere in maniera dettagliata la segnalazione" rows="10" cols="70" required></textarea>
                  <br><br>Disposto a dichiarare in atti:
                  <label for="attiSi">Si</label>
                  <input type="radio" id="attiSi" name="atti" value="1" required>
                  <label for="attiNo">No</label>
                  <input type="radio" id="attiNo" name="atti" value="0">

                  <br><br><button type="submit" name="registra_segnalazione">Pubblica segnalazione</button>
              </form>
             </div><!--FINE FORM-->

             <?php } else echo 'Sei un amministratore, non puoi fare segnalazioni<br><br>'; } else echo 'Solo gli utenti registrati possono effettuare una segnalazione<br><br>'; ?>

          </div>

          <?php include("./php/filtro.php"); ?>
          
          <!--SEZIONE 1 SEGNALAZIONE-->
          <?php include "./php/Stampa_delle_segnalazioni.php" ?>
          <!--SEZIONE 1 SEGNALAZIONE-->
          
        </div>
        <div class="right">
          <div class="rarticle">

            <?php require_once "./php/Area di accesso.php"; ?>
           
          </div>
          <div class="righthr"></div>
            <h1><a href="informazioni_utili.php">Informazioni utili</a></h1>
            <ul>
              <li>
              <a href="https://www.gdf.gov.it/stampa/ultime-notizie/ultime-notizie-ufficio-stampa-interno" target="_blank">Ultime notizie</a>  
              </li>
              <li>
              <a href="https://www.gdf.gov.it/servizi-per-il-cittadino/modulistica" target="_blank">Modulistica</a>  
              </li>
              <li>
              <a href="https://www.gdf.gov.it/servizi-per-il-cittadino/contatti/117-il-numero-di-pubblica-utilita" target="_blank">117 il numero di pubblica utilità</a>  
              </li>
            </ul>
            <div class="righthr"></div>
        </div>
      </div>
      <div id="clear"></div>
    </div>
  </body>
</html>
