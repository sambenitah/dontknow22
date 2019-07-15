<?php
$fichier = "dontknow.zip";

header('Content-disposition: attachment; filename='.$fichier);
header('Content-Type: application/force-download');
header('Content-Transfer-Encoding: fichier');
header('Content-Length: '.filesize($fichier));
header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');
readfile($fichier);
?>