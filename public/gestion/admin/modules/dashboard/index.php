<?php
// /admin/modules/dashboard/index.php
// Tableau de bord : nombre d'éléments par module + derniers messages reçus.

require_once __DIR__ . '/../../../config/auth.php';
require_once __DIR__ . '/../../../config/database.php'; // $pdo

$modules = require __DIR__ . '/../../../config/modules.php';
$tables  = require __DIR__ . '/../../../config/tables.php';

function dash_h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// Nombre de lignes par table.
$counts = [];

foreach ($tables as $name => $cfg) {
    try {
        $counts[$name] = (int) $pdo->query("SELECT COUNT(*) FROM `{$name}`")->fetchColumn();
    } catch (PDOException $e) {
        $counts[$name] = null; // table absente
    }
}

// Derniers messages de contact.
$messages = [];

try {
    $messages = $pdo
        ->query('SELECT `id`, `nom`, `email`, `objet`, `created_at` FROM `contacts` ORDER BY `id` DESC LIMIT 5')
        ->fetchAll();
} catch (PDOException $e) {
    $messages = [];
}
?>

<div class="container-fluid">

    <div class="mb-4">
        <h4 class="mb-1">Tableau de bord</h4>
        <p class="text-muted mb-0">
            Bienvenue dans l'administration de <?= dash_h($app['name'] ?? '') ?>.
            Les modifications apparaissent immédiatement sur le site.
        </p>
    </div>

    <div class="row">

        <?php foreach ($tables as $name => $cfg): ?>

            <?php if (!isset($modules[$name]) || $counts[$name] === null) { continue; } ?>

            <div class="col-xl-3 col-md-4 col-sm-6 mb-4">

                <a href="#" class="text-decoration-none" data-goto="<?= dash_h($name) ?>">

                    <div class="card shadow h-100 dash-card">

                        <div class="card-body">

                            <div class="d-flex align-items-center">

                                <div class="me-3">
                                    <i class="<?= dash_h($cfg['icon']) ?> fa-2x text-primary"></i>
                                </div>

                                <div>
                                    <div class="text-muted small"><?= dash_h($cfg['label']) ?></div>
                                    <div class="fw-bold fs-4 text-dark"><?= $counts[$name] ?></div>
                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

        <?php endforeach; ?>

    </div>


    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fa-solid fa-envelope me-2"></i>Derniers messages
            </h6>
            <a href="#" class="small" data-goto="contacts">Tout voir</a>
        </div>

        <div class="card-body">

            <?php if (empty($messages)): ?>

                <p class="text-muted mb-0">Aucun message pour le moment.</p>

            <?php else: ?>

                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>E-mail</th>
                                <th>Objet</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($messages as $message): ?>
                                <tr>
                                    <td><?= dash_h((string) $message['nom']) ?></td>
                                    <td><?= dash_h((string) $message['email']) ?></td>
                                    <td><?= dash_h((string) $message['objet']) ?></td>
                                    <td><?= dash_h((string) ($message['created_at'] ?? '')) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php endif; ?>

        </div>

    </div>

</div>
