<?php
$eingabe = $_POST['eingabe'];

const EINGABE_MAX_CHARACTERS = 1000;

/* TODO prüfe die maximale Länge */

if (!$eingabe && isset($_SESSION['eingabe'])) {
    $eingabe = $_SESSION['eingabe'];
}

/* TODO zerlege Eingabe in Tokens */
/* TODO ersetze Hauptwort-Tokens durch <select>s */

$_SESSION['eingabe'] = $eingabe;
$_SESSION['tokens'] = $tokens;

?>
<form name="auswahl" method="post">
    <?php echo $auswahlHTML; ?>
    <br /><br />
    <button name="auswahl" type="submit">Auswahl ausgeben</button>
    <button name="reset" type="submit">Zurück zur Eingabe</button>
</form>