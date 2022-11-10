<?php
    if (isset($_SESSION['session_id'])) {
?>
<script>

</script>
    
<div class="lefthr"></div>
<div class="article">
    <form method="get" action="../segnalazioni.php">
        <h1>Filtra le segnalazioni</h1>
        
        
        <br>Data antecedente a <input type="datetime-local" id="data_A" name="data">

        <br><br><input type="text" id="cognome" placeholder="Cognome" name="cognome" maxlength="50" >

        <br><br><input type="email" id="email" placeholder="esempio@gmail.com" name="email" >

        <br><br><textarea id="descrizione_f" name="descrizione_f" placeholder="Ricerca per parola" rows="1" cols="40"></textarea>

        <br><br>
        <button type="submit" name="filtro">Filtra</button>
    </form>
</div><!--FINE FORM-->
<?php } ?>