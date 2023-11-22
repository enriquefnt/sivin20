<?php

include __DIR__ . '/../includes/autoload.php';
 
$uri = strtok(ltrim($_SERVER['REQUEST_URI'], '/'), '?');

$SivinWebsite = new \ClassPart\SivinWebsite();
$entryPoint = new \ClassGrl\EntryPoint($SivinWebsite);
$entryPoint->run($uri, $_SERVER['REQUEST_METHOD']);
