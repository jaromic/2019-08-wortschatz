<?php
$eingabe = $_POST['eingabe'];
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