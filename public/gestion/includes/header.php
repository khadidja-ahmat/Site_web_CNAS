<?php
// /includes/header.php - En-tête HTML commun aux pages du Back-Office
// Variables attendues : $app (config/app.php) et la session (config/auth.php)
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">

    <!-- Jeton CSRF envoyé automatiquement par main.js à chaque requête AJAX -->
    <meta name="csrf-token" content="<?= htmlspecialchars((string) ($_SESSION['_csrf'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">

    <title><?= htmlspecialchars($app['admin_title'] ?? 'Administration', ENT_QUOTES, 'UTF-8') ?></title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (icônes) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- DataTables (intégration Bootstrap 5) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">

    <!-- Toastr (notifications) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Styles de l'administration -->
    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body class="is-loading">

<!-- Conteneur principal : sidebar + contenu -->
<div class="d-flex" id="wrapper">
