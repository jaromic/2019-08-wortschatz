<?php
$eingabe = $_POST['eingabe'];

const EINGABE_MAX_CHARACTERS = 1000;

if(strlen($eingabe)>EINGABE_MAX_CHARACTERS) {
    throw new Exception("Text darf maximal ".EINGABE_MAX_CHARACTERS. " Zeichen lang sein.");
}

if (!$eingabe && isset($_SESSION['eingabe'])) {
    $eingabe = $_SESSION['eingabe'];
}

$tokens = getTokensFromText($eingabe);
$auswahlHTML = ersetzeHauptwortTokensWithSelects($tokens);
$_SESSION['eingabe'] = $eingabe;
$_SESSION['tokens'] = $tokens;

?>
<form name="auswahl" method="post">
    <?php echo $auswahlHTML; ?>
    <br /><br />
    <button name="auswahl" type="submit">Auswahl ausgeben</button>
    <button type="submit" name="reset">Zurück zur Eingabe</button>
</form>