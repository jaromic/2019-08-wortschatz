<?php

/**
 * @param $wort
 * @return array
 */
function getSynonymeFromWebService($wort) {
    $wortEncoded = urlencode($wort);
    $response = file_get_contents("https://www.openthesaurus.de/synonyme/search?q={$wortEncoded}%20&format=application/json");
    $synonymeFromService = json_decode($response, true);
    $synonymeSets = $synonymeFromService['synsets'];
    $synonyme = [];
    if (count($synonymeSets) > 0) {
        array_walk($synonymeSets[0]['terms'], function ($value, $key) use (&$synonyme) {
            array_push($synonyme, $value['term']);
        });
    }
    return $synonyme;
}

/**
 * @param string $selectName
 * @param string $synonyme
 * @param string $hauptwort
 * @return string
 */
function createSelect(string $selectName, string $synonyme, string $hauptwort): string {

    if(count($synonyme)>0) {
        $ausgabe = "<select name='{$selectName}'>";
        foreach ($synonyme as $synonym) {
            if ($synonym == $hauptwort) {
                $selected = " selected";
            } else {
                $selected = "";
            }
            $ausgabe .= "<option value='{$synonym}'{$selected}>$synonym</option > ";
        }
        $ausgabe .= "</select > ";
    } else {
        $ausgabe = $hauptwort;
    }

    return $ausgabe;
}
