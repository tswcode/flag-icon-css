#!/usr/bin/php
.flag-icon-background {
    background-size: contain;
    background-position: 50%;
    background-repeat: no-repeat;
}
.flag-icon {
    background-size: contain;
    background-position: 50%;
    background-repeat: no-repeat;
    position: relative;
    display: inline-block;
    width: 1.33333333em;
    line-height: 1em;
}
.flag-icon:before {
    content: "\00a0";
}
.flag-icon.flag-icon-squared {
    width: 1em;
}
<?php

const PATH_DEFAULT = __DIR__ . '/flags/4x3';
const PATH_SQUARE  = __DIR__ . '/flags/1x1';
const FLAG_LIST    = [
        'wm' => [
            'ar', 'au',
            'be', 'br',
            'ch', 'co', 'cr',
            'de', 'dk',
            'eg', 'es',
            'fr', 'gb', 'hr',
            'ir', 'is', 'jp',
            'kr',
            'ma', 'mx', 'ng',
            'pa', 'pe', 'pl', 'pt',
            'rs', 'ru',
            'sa', 'se', 'sn',
            'tn',
            'uy',
        ]
];

$dirListDefault = scandir(PATH_DEFAULT);

foreach($dirListDefault as $entry) {
    $flagName = pathinfo($entry, PATHINFO_FILENAME);

    if(in_array($entry, ['.', '..']) || !in_array($flagName, FLAG_LIST['wm'])) {
        continue;
    }

    $flagFilePath          = PATH_DEFAULT . "/$entry";
    $flagFileContent       = file_get_contents($flagFilePath);
    $flagFileContent       = str_replace("\n", '', str_replace('"', "'", $flagFileContent));
    $flagFileContent       = preg_replace('/\>\s*\</', '><', $flagFileContent);
    $flagFileContent       = base64_encode($flagFileContent);

    $flagFileSquarePath    = PATH_SQUARE  . "/$entry";
    $flagFileSquareContent = file_get_contents($flagFileSquarePath);
    $flagFileSquareContent = str_replace("\n", '', str_replace('"', "'", $flagFileSquareContent));
    $flagFileSquareContent = preg_replace('/\>\s*\</', '><', $flagFileSquareContent);
    $flagFileSquareContent = base64_encode($flagFileSquareContent);

?>
.flag-icon-<?= $flagName ?> {
    background-image: url("data:image/svg+xml;utf8,<?= $flagFileContent ?>");
}
.flag-icon-<?= $flagName ?>.flag-icon-squared {
    background-image: url("data:image/svg+xml;utf8,<?= $flagFileSquareContent ?>");
}
<?php
}

?>
