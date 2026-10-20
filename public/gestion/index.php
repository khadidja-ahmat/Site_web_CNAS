<?php
// /gestion/index.php : redirige vers la connexion (ou le Back-Office si déjà connecté).
//
// L'adresse est calculée depuis l'URL réelle du script, pour fonctionner aussi
// quand on tape /gestion sans la barre finale (serveur de développement Laravel).
$dir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/gestion/index.php')), '/');

header('Location: ' . $dir . '/login.php');
exit;
