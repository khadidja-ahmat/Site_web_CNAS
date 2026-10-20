/*
 * /assets/js/crud.js
 * Tableau + formulaire génériques pour tous les modules décrits dans
 * config/tables.php. La configuration vient de l'attribut data-config
 * de #crud-root (généré par includes/crud_view.php).
 */

window.ChariCrud = (function ($) {

    // Échappe le HTML : indispensable, car certains contenus viennent des
    // visiteurs du site (ex. messages du formulaire de contact).
    function esc(value) {
        return String(value === null || value === undefined ? '' : value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    // Les images du site Laravel sont dans /images/<dossier>/<fichier>.
    // Depuis /gestion/admin/ : ../../images/...
    function imageUrl(dir, file) {
        return '../../images/' + encodeURIComponent(dir) + '/' + encodeURIComponent(file);
    }

    // created_at est en UTC dans la base : affichage dans l'heure locale.
    function formatDate(value) {
        if (!value) {
            return '<span class="text-muted">—</span>';
        }

        const date = new Date(String(value).replace(' ', 'T') + 'Z');

        if (isNaN(date.getTime())) {
            return esc(value);
        }

        return esc(date.toLocaleString('fr-FR', {
            day: '2-digit', month: '2-digit', year: 'numeric',
            hour: '2-digit', minute: '2-digit'
        }));
    }

    function errorMessage(xhr) {
        if (xhr && xhr.responseJSON && xhr.responseJSON.message) {
            return xhr.responseJSON.message;
        }

        return 'Erreur de communication avec le serveur.';
    }

    function init() {

        const $root = $('#crud-root');

        if (!$root.length) {
            return;
        }

        const cfg      = $root.data('config');
        const ajaxUrl  = 'modules/' + cfg.module + '/ajax_handler.php';
        const $form    = $('#crudForm');
        const $table   = $('#crudTable');
        const $submit  = $('#crudSubmit');
        const modal    = bootstrap.Modal.getOrCreateInstance(document.getElementById('crudModal'));
        const readonly = !!cfg.readonly;

        // ---------------------------------------------------------------
        // COLONNES DU TABLEAU
        // ---------------------------------------------------------------
        const columns = [{ data: 'id' }];

        cfg.columns.forEach(function (column) {

            columns.push({
                data: column.name,
                render: function (data, type) {

                    if (type !== 'display') {
                        return data;
                    }

                    if (column.type === 'image') {

                        if (!data) {
                            return '<span class="text-muted">—</span>';
                        }

                        return '<img class="crud-thumb" loading="lazy" alt="" src="'
                            + esc(imageUrl(cfg.imageDir, data)) + '">';
                    }

                    return '<span class="crud-cell-text" title="' + esc(data) + '">'
                        + esc(data) + '</span>';
                }
            });
        });

        columns.push({
            data: 'created_at',
            render: function (data, type) {
                return type === 'display' ? formatDate(data) : (data || '');
            }
        });

        columns.push({
            data: null,
            orderable: false,
            searchable: false,
            render: function (data, type, row) {

                const editIcon  = readonly ? 'fa-eye' : 'fa-edit';
                const editClass = readonly ? 'btn-info' : 'btn-warning';
                const editTitle = readonly ? 'Consulter' : 'Modifier';

                return '<div class="btn-group">'
                    + '<button type="button" class="btn ' + editClass + ' btn-sm edit-btn" title="' + editTitle
                    + '" data-id="' + esc(row.id) + '"><i class="fas ' + editIcon + '"></i></button>'
                    + '<button type="button" class="btn btn-danger btn-sm delete-btn" title="Supprimer"'
                    + ' data-id="' + esc(row.id) + '"><i class="fas fa-trash"></i></button>'
                    + '</div>';
            }
        });

        // ---------------------------------------------------------------
        // DATATABLE
        // ---------------------------------------------------------------
        const dataTable = $table.DataTable({
            processing: true,
            order: [[0, 'desc']],
            ajax: {
                url: ajaxUrl,
                type: 'POST',
                data: { action: 'fetch_items' },
                dataSrc: 'data'
            },
            columns: columns
        });

        // Session expirée pendant le chargement du tableau.
        $table.on('xhr.dt', function (e, settings, json, xhr) {
            if (xhr && xhr.status === 401) {
                window.location.href = '../login.php';
            }
        });

        // ---------------------------------------------------------------
        // OUTILS FORMULAIRE
        // ---------------------------------------------------------------
        function resetForm() {

            $form[0].reset();
            $('#f_id').val('');

            $form.find('.crud-preview').addClass('d-none').removeAttr('src');
        }

        // En ajout, image et mot de passe obligatoires (selon la config) ;
        // en modification, on peut les laisser vides pour conserver l'existant.
        function setMode(isEdit) {

            if (readonly) {
                return;
            }

            $form.find('input[type="file"], input[type="password"]').each(function () {

                const mustFill = $(this).data('required') === 1 || $(this).data('required') === '1';

                $(this).prop('required', mustFill && !isEdit);
            });

            $form.find('[data-password-hint]').text(
                isEdit
                    ? 'Laissez vide pour conserver le mot de passe actuel.'
                    : '8 caractères minimum.'
            );
        }

        // Aperçu de l'image choisie.
        $form.on('change', 'input[type="file"]', function () {

            const name     = $(this).attr('name');
            const $preview = $form.find('.crud-preview[data-preview-for="' + name + '"]');
            const file     = this.files && this.files[0];

            if (file) {
                $preview.attr('src', URL.createObjectURL(file)).removeClass('d-none');
            }
        });

        // ---------------------------------------------------------------
        // AJOUTER
        // ---------------------------------------------------------------
        $('#add-btn').on('click', function () {

            resetForm();
            setMode(false);

            $('#crudModalLabel').text('Ajouter ' + cfg.singular);

            modal.show();
        });

        // ---------------------------------------------------------------
        // MODIFIER / CONSULTER
        // ---------------------------------------------------------------
        $table.on('click', '.edit-btn', function () {

            const id = $(this).data('id');

            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: { action: 'fetch_single_item', id: id },
                dataType: 'json'
            }).done(function (response) {

                if (response.status !== 'success') {
                    toastr.error(response.message);
                    return;
                }

                const data = response.data;

                resetForm();
                setMode(true);

                $form.find('[name]').each(function () {

                    const field = $(this).attr('name');
                    const type  = cfg.fields[field];

                    if (type === 'image') {

                        const $preview = $form.find('.crud-preview[data-preview-for="' + field + '"]');

                        if (data[field]) {
                            $preview.attr('src', imageUrl(cfg.imageDir, data[field])).removeClass('d-none');
                        }

                        return;
                    }

                    if (type === 'password') {
                        return;
                    }

                    if (data[field] !== undefined) {
                        $(this).val(data[field]);
                    }
                });

                $('#f_id').val(data.id);

                $('#crudModalLabel').text(
                    readonly ? 'Consulter ' + cfg.singular : 'Modifier ' + cfg.singular
                );

                modal.show();

            }).fail(function (xhr) {

                if (xhr.status === 401) {
                    window.location.href = '../login.php';
                    return;
                }

                toastr.error(errorMessage(xhr));
            });
        });

        // ---------------------------------------------------------------
        // ENREGISTRER (ajout ou modification)
        // ---------------------------------------------------------------
        $form.on('submit', function (e) {

            e.preventDefault();

            if (readonly) {
                return;
            }

            if (!$form[0].checkValidity()) {
                $form[0].reportValidity();
                return;
            }

            $submit.prop('disabled', true);

            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: new FormData($form[0]),   // inclut les fichiers
                processData: false,
                contentType: false,
                dataType: 'json'
            }).done(function (response) {

                if (response.status === 'success') {

                    toastr.success(response.message);

                    modal.hide();

                    dataTable.ajax.reload(null, false);

                } else {

                    toastr.error(response.message);
                }

            }).fail(function (xhr) {

                if (xhr.status === 401) {
                    window.location.href = '../login.php';
                    return;
                }

                toastr.error(errorMessage(xhr));

            }).always(function () {

                $submit.prop('disabled', false);
            });
        });

        // ---------------------------------------------------------------
        // SUPPRIMER
        // ---------------------------------------------------------------
        $table.on('click', '.delete-btn', function () {

            const id = $(this).data('id');

            if (!confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
                return;
            }

            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: { action: 'delete_item', id: id },
                dataType: 'json'
            }).done(function (response) {

                if (response.status === 'success') {

                    toastr.success(response.message);

                    dataTable.ajax.reload(null, false);

                } else {

                    toastr.error(response.message);
                }

            }).fail(function (xhr) {

                if (xhr.status === 401) {
                    window.location.href = '../login.php';
                    return;
                }

                toastr.error(errorMessage(xhr));
            });
        });
    }

    return { init: init };

})(jQuery);
