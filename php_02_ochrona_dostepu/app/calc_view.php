<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Kalkulator</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>


<div style="width:90%; margin: 2em auto;">
	<a href="<?php print(_APP_ROOT); ?>/app/inna_chroniona.php" class="pure-button">kolejna chroniona strona</a>
	<a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div>

<div style="width:90%; margin: 2em auto;">

    <form action="<?php print(_APP_URL);?>/app/calc.php" method="post" class="pure-form pure-form-stacked>
	<fieldset>
        <label for="id_kwota">Kwota kredytu: </label>
        <input id="id_kwota" type="text" name="kwota" placeholder="np. 100000 (zł)" value="<?php out($kwota) ?>" /> zł<br />
        <label for="id_oprocentowanie">Oprocentowanie: </label>
        <input id="id_oprocentowanie" type="text" name="oprocentowanie" placeholder="np. 5.3 (%)" value="<?php if(isset($oprocentowanie)){print($oprocentowanie);} ?>" /> %<br />
        <label for="id_raty">Ile lat chcesz spłacać kredyt: </label>
        <input id="id_raty" type="text" name="raty" placeholder="np. 2 (lat)" value="<?php if(isset($raty)){print($raty);} ?>" /> lat<br />
        <input type="submit" value="Oblicz" class="pure-button pure-button-primary" />
   </fieldset>
   </form>

    <?php
    //wyświeltenie listy błędów, jeśli istnieją
    if (isset($messages)) {
        if (count ( $messages ) > 0) {
            echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
            foreach ( $messages as $key => $msg ) {
                echo '<li>'.$msg.'</li>';
            }
            echo '</ol>';
        }
    }
    ?>

    <?php if (isset($wynik)){ ?>
        <div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
            <?php echo 'Miesięczna rata wynosi: '.$wynik; ?>
        </div>
    <?php } ?>

</body>
</html>