<?php
// /includes/sidebar.php - Menu de navigation latéral

$modules  = require __DIR__ . '/../config/modules.php';
$userRole = $_SESSION['role'] ?? '';
$appName  = $app['name'] ?? 'Admin';
?>

<!-- Sidebar -->
<div id="sidebar-wrapper">

    <div class="sidebar-heading">

        <a href="index.php" class="text-white text-decoration-none d-flex align-items-center">

            <i class="fas fa-shield-alt fa-2x me-3"></i>

            <span><?= htmlspecialchars($appName, ENT_QUOTES, 'UTF-8') ?></span>

        </a>

    </div>


    <div class="list-group list-group-flush mt-3">

        <?php foreach ($modules as $moduleName => $module): ?>

            <?php
            $roles = $module['roles'] ?? [];

            // Ne pas afficher le module si le rôle n'est pas autorisé.
            if (!empty($roles) && !in_array($userRole, $roles, true)) {
                continue;
            }

            $label = $module['label'] ?? $moduleName;
            $icon  = $module['icon'] ?? 'fas fa-question-circle';
            ?>

            <a
                href="#"
                class="list-group-item"
                data-module="<?= htmlspecialchars($moduleName, ENT_QUOTES, 'UTF-8') ?>"
            >
                <i class="<?= htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') ?> fa-fw me-3"></i>
                <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
            </a>

        <?php endforeach; ?>

        <!-- Retour au site visiteur (Laravel) : racine du site -->
        <a href="../../" target="_blank" rel="noopener" class="list-group-item mt-3 border-top">
            <i class="fa-solid fa-arrow-up-right-from-square fa-fw me-3"></i>
            Voir le site
        </a>

    </div>

</div>
<!-- /#sidebar-wrapper -->
