<html>

<head>
  <title>Progetto d'Esame</title>

  <?php require_once "html/link_in_head.html"; ?>
  <?php require_once "php/encrypt_e_decrypt.php"; ?>

</head>

<body>


  <?php require_once "php/dashboard.php"; ?>

  <div id="container">
    <div id="banner">
      <div id="title">
        <h1><a href="http://ferdyerrichielloesame.altervista.org/">Segnalazione violazioni</a></h1>
      </div>
      <ul class="nav">
        <li><a href="./index.php" id="currentPage">Home</a></li>
        <li><a href="./segnalazioni.php">Segnalazioni</a></li>
      </ul>
    </div>
    <div id="mainContentTop"> </div>
    <div id="mainContent">
      <div class="left">
        <div class="article">
          <h1>La Guardia di Finanza</h1><!--1862-->
          <p>La <b>Guardia di Finanza</b> è una delle forze di polizia italiane ad ordinamento militare, nata nel 1774; vanta una storia di oltre 2 secoli.
            Le Fiamme Gialle, dipendono direttamente dal Ministro dell’Economia e delle Finanze e si occupano di tutto ciò che riguarda la materia economica e finanziaria.<br><br>
            Sono state istituite con lo scopo di prevenire, ricercare e denunciare le evasioni e le violazioni finanziarie, che possono riguardare per esempio le tasse, i diritti di dogana, di confine, i mercati finanziari e qualsiasi altra cosa che abbia a che fare con il settore economico e finanziario sia nazionale che dell’Unione Europea.<br><br>
            I suoi principali obiettivi sono la lotta contro l’evasione fiscale, il contrabbando, la contraffazione e le truffe ai danni dello Stato.<br><br>
            La Guardia di Finanza può venire a conoscenza di un reato o di un comportamento illecito in molte modalità.<br>
            Può farlo durante delle indagini oppure mediante una denuncia inoltrata da una pubblica amministrazione o anche da parte di un privato.<br>
          </p>

        </div>
        <div class="lefthr"></div>
        <div class="article">
          <h1>Sede comando provinciale</h1>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1494.952037652858!2d12.90254545818581!3d41.46299579481429!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13250d5bf7d16193%3A0xfb6c563ba0f629fc!2sPalazzo%20M!5e0!3m2!1sit!2sit!4v1621707587106!5m2!1sit!2sit" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>


        </div>
        <div class="lefthr"></div>
        <div class="article">
          <h1>Video illustrativo</h1>
          <video width="" height="" controls>
            <source src="video/video01.mp4" type="video/mp4">
          </video>


        </div>

        <div class="lefthr"></div>

      </div>
      <div class="right">
        <div class="rarticle">

          <?php require_once "php/Area di accesso.php" ?>

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