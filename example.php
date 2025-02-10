<?php

$res = 0;
if (!$res && file_exists("../main.inc.php")) {
    $res = @include "../main.inc.php";
}
if (!$res && file_exists("../../main.inc.php")) {
    $res = @include "../../main.inc.php";
}
if (!$res && file_exists("../../../main.inc.php")) {
    $res = @include "../../../main.inc.php";
}
if (!$res) {
    die("Main include failed");
}

$langs->loadLangs(['debug@debug']);

if (!function_exists("ds")) {
die($langs->trans("DebugConfigError"));
}

ds($langs->trans('DebugHello'))->coffee();
ds($langs->trans('DebugHelloRed'))->red();
ds($langs->trans('DebugHelloGreen'))->green();
ds($langs->trans('DebugHelloBlue'))->blue();

ds($langs->trans('DebugHelloWarning'))->warning();
ds($langs->trans('DebugHelloDanger'))->danger();
ds($langs->trans('DebugHelloSuccess'))->success();

print "Voir <a href='https://laradumps.dev/debug/usage.html'>Usage Laradumps</a> pour plus d'informations sur l'utilisation de Laradumps.\n";