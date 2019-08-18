<?php

$ausgabe = tokensToText(ersetzeHauptwortTokensDurchJeweiligeAuswahl($_SESSION['tokens'], $_POST));

echo $ausgabe;
?>

<form method="post">
    <button type="submit" name="eingabe">Auswahl bearbeiten</button>
</form>