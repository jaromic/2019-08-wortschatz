<?php

/**
 * @param $wort
 * @return array
 */
function getSynonymeFromWebService($wort) {
    $wortEncoded = urlencode($wort);
    $response = file_get_contents("https://www.openthesaurus.de/synonyme/search?q={$wortEncoded}%20&format=application/json");
    $synonymeFromService = json_decode($response, true);
    $synonyme = [];
    array_walk($synonymeFromService['synsets'][0]['terms'], function ($value, $key) use (&$synonyme) {
        array_push($synonyme, $value['term']);
    });
    return $synonyme;
}

/**
 * @param string $hauptwort
 * @param string $selectName
 * @return string
 */
function creaeteSelectForHauptwort(string $hauptwort, string $selectName): string {
    $ausgabe = "<select name='{$selectName}'>";
    foreach (getSynonymeFromWebService($hauptwort) as $synonym) {
        if ($synonym == $hauptwort) {
            $selected = " selected";
        } else {
            $selected = "";
        }
        $ausgabe .= "<option value='{$synonym}'{$selected}>$synonym</option > ";
    }

    $ausgabe .= "</select > ";
    return $ausgabe;
}

/**
 * @param $text
 * @return array[]|false|string[]
 */
function getTokensFromText($text) {
    $tokens = preg_split("/([.!?, ])/", $text, null, PREG_SPLIT_DELIM_CAPTURE);
    return $tokens;
}

/**
 * @param $text
 * @return array|array[]|false|string[]
 */
function getHauptwortTokensFromText(string $text) {
    $tokens = getTokensFromText($text);
    return array_filter($tokens, function ($value) {
        istHauptwort($value);
    });
}

/**
 * @param string[] $text
 * @return string
 */
function ersetzeHauptwortTokensWithSelects(array $tokens): string {

    $i=0;
    foreach ($tokens as $key => $hauptwortKandidat) {
        $i++;
        if (istHauptwort($hauptwortKandidat)) {
            $tokens[$key] = creaeteSelectForHauptwort($hauptwortKandidat, $i);
        }
    }

    return implode($tokens);
}

/**
 * @param $hauptwortKandidat
 * @return bool
 */
function istHauptwort($hauptwortKandidat): bool {
    return (strlen($hauptwortKandidat) >= 4) && (ucfirst($hauptwortKandidat) == $hauptwortKandidat);
}


/**
 * @param array $tokens
 * @param $auswahl
 * @return array
 */
function ersetzeHauptwortTokensDurchJeweiligeAuswahl(array $tokens, array $auswahl): array {
    $i=0;
    foreach ($tokens as $key => $token) {
        $i++;
        if (istHauptwort($token)) {
            $tokens[$key] = $auswahl[$i];
        }
    }
    return $tokens;
}

/**
 * @param array $tokens
 * @return string
 */
function tokensToText(array $tokens): string {
    return implode("", $tokens);
}