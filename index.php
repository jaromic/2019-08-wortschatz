<!DOCTYPE html>
<html>
    <head>
        <title>Wortschatz</title>
    </head>
    <body>
        <h1>Wortschatz</h1>

        <main>
        <?php

        session_start();

        if (isset($_POST['eingabe'])) {
            require_once("verarbeitung.php");
            require_once("auswahl.php");
        } elseif(isset($_POST['auswahl'])) {
            require_once("verarbeitung.php");
            require_once("ausgabe.php");
        } else {
            require_once("eingabe.php");
        }

        ?>
        </main>

    </body>
</html>
