<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Vue générique d'un module (tableau + formulaire)
|--------------------------------------------------------------------------
|
| Générée à partir de config/tables.php. Le JavaScript correspondant est
| assets/js/crud.js : il lit la configuration placée dans l'attribut
| data-config de #crud-root.
|
*/

function crud_h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function crud_render_view(string $module): void
{
    $tables = require __DIR__ . '/../config/tables.php';

    if (!isset($tables[$module])) {
        http_response_code(404);
        echo '<div class="alert alert-danger">Module inconnu.</div>';
        return;
    }

    $cfg      = $tables[$module];
    $readonly = !empty($cfg['readonly']);

    // Colonnes visibles dans le tableau.
    $listColumns = [];

    foreach ($cfg['fields'] as $name => $field) {

        if (!empty($field['list'])) {
            $listColumns[] = [
                'name'  => $name,
                'label' => $field['label'],
                'type'  => $field['type'],
            ];
        }
    }

    $jsConfig = [
        'module'   => $module,
        'readonly' => $readonly,
        'imageDir' => $cfg['image_dir'],
        'singular' => $cfg['singular'],
        'columns'  => $listColumns,
        'fields'   => array_map(static fn (array $f): string => $f['type'], $cfg['fields']),
    ];

    ?>
<div
    id="crud-root"
    data-config="<?= crud_h(json_encode($jsConfig, JSON_UNESCAPED_UNICODE)) ?>"
>

    <div class="container-fluid">

        <div class="card shadow mb-4">

            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="<?= crud_h($cfg['icon']) ?> me-2"></i>
                    <?= crud_h($cfg['label']) ?>
                </h6>

                <?php if (!$readonly): ?>
                    <button id="add-btn" type="button" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>
                        Ajouter <?= crud_h($cfg['singular']) ?>
                    </button>
                <?php endif; ?>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table
                        class="table table-bordered table-striped table-hover align-middle"
                        id="crudTable"
                        width="100%"
                    >
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>

                                <?php foreach ($listColumns as $column): ?>
                                    <th><?= crud_h($column['label']) ?></th>
                                <?php endforeach; ?>

                                <th>Créé le</th>
                                <th style="width: 110px">Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                </div>

            </div>

        </div>

    </div>


    <!-- Fenêtre d'ajout / modification / consultation -->
    <div class="modal fade" id="crudModal" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="crudModalLabel"></h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>

                <form id="crudForm" autocomplete="off" novalidate>

                    <div class="modal-body">

                        <input type="hidden" name="id" id="f_id" value="">
                        <input type="hidden" name="action" value="save_item">

                        <?php foreach ($cfg['fields'] as $name => $field): ?>

                            <?php
                            $id       = 'f_' . $name;
                            $label    = crud_h($field['label']);
                            $required = !empty($field['required']) && !$readonly;
                            $max      = isset($field['max']) ? (int) $field['max'] : 0;
                            $disabled = $readonly ? 'disabled' : '';
                            ?>

                            <div class="mb-3">

                                <label for="<?= crud_h($id) ?>" class="form-label">
                                    <?= $label ?>
                                    <?php if ($required): ?>
                                        <span class="text-danger">*</span>
                                    <?php endif; ?>
                                </label>

                                <?php if ($field['type'] === 'textarea'): ?>

                                    <textarea
                                        id="<?= crud_h($id) ?>"
                                        name="<?= crud_h($name) ?>"
                                        class="form-control"
                                        rows="4"
                                        <?= $max > 0 ? 'maxlength="' . $max . '"' : '' ?>
                                        <?= $required ? 'required' : '' ?>
                                        <?= $disabled ?>
                                    ></textarea>

                                <?php elseif ($field['type'] === 'image'): ?>

                                    <input
                                        type="file"
                                        id="<?= crud_h($id) ?>"
                                        name="<?= crud_h($name) ?>"
                                        class="form-control"
                                        accept="image/jpeg,image/png,image/gif,image/webp"
                                        data-required="<?= $required ? '1' : '0' ?>"
                                    >

                                    <div class="form-text">JPG, PNG, GIF ou WEBP — 5 Mo maximum.</div>

                                    <img
                                        class="crud-preview d-none mt-2"
                                        data-preview-for="<?= crud_h($name) ?>"
                                        alt="Aperçu"
                                    >

                                <?php elseif ($field['type'] === 'password'): ?>

                                    <input
                                        type="password"
                                        id="<?= crud_h($id) ?>"
                                        name="<?= crud_h($name) ?>"
                                        class="form-control"
                                        autocomplete="new-password"
                                        minlength="8"
                                        maxlength="72"
                                        data-required="<?= $required ? '1' : '0' ?>"
                                    >

                                    <div class="form-text" data-password-hint>8 caractères minimum.</div>

                                <?php else: ?>

                                    <input
                                        type="<?= $field['type'] === 'email' ? 'email' : 'text' ?>"
                                        id="<?= crud_h($id) ?>"
                                        name="<?= crud_h($name) ?>"
                                        class="form-control"
                                        <?= $max > 0 ? 'maxlength="' . $max . '"' : '' ?>
                                        <?= $required ? 'required' : '' ?>
                                        <?= $disabled ?>
                                    >

                                <?php endif; ?>

                            </div>

                        <?php endforeach; ?>

                    </div>

                    <div class="modal-footer">

                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
                            <?= $readonly ? 'Fermer' : 'Annuler' ?>
                        </button>

                        <?php if (!$readonly): ?>
                            <button type="submit" class="btn btn-primary" id="crudSubmit">
                                <i class="fas fa-save me-2"></i>Enregistrer
                            </button>
                        <?php endif; ?>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
<?php
}
