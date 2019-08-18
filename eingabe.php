<?php

if(isset($_SESSION['eingabe'])) {
    $eingabe = $_SESSION['eingabe'];
}
?>
<form name="eingabe" method="post">
    <textarea name="eingabe"><?php echo $eingabe ?></textarea>
    <button type="submit">Text einlesen</button>
</form>
