/*
 * /assets/js/main.js
 * Navigation modulaire AJAX du back-office (basée sur ChariPHP).
 *
 * Ajouts par rapport à ChariPHP :
 *  - le jeton CSRF est envoyé automatiquement avec chaque requête AJAX ;
 *  - les modules décrits dans config/tables.php sont initialisés par crud.js ;
 *  - les cartes du tableau de bord (data-goto) ouvrent le module correspondant.
 */

$(function () {

    // =========================================================================
    // 1. CONFIGURATIONS GLOBALES
    // =========================================================================

    // Jeton CSRF (placé dans <meta name="csrf-token"> par includes/header.php)
    const csrfToken = $('meta[name="csrf-token"]').attr('content') || '';

    $.ajaxSetup({
        headers: { 'X-CSRF-Token': csrfToken }
    });

    // Notifications Toastr
    toastr.options = {
        closeButton: true,
        newestOnTop: true,
        progressBar: true,
        positionClass: 'toast-top-right',
        timeOut: '5000'
    };

    // DataTables en français ; les erreurs sont gérées par nos propres messages.
    $.extend(true, $.fn.dataTable.defaults, {
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/fr-FR.json'
        }
    });

    $.fn.dataTable.ext.errMode = 'none';

    $(document).on('error.dt', function (e, settings, techNote, message) {
        console.warn('DataTables :', message);
        toastr.error('Impossible de charger les données du tableau.');
    });


    // =========================================================================
    // 2. CHARGEMENT D'UN MODULE
    // =========================================================================

    const $mainContent = $('#main-content');
    const $loader = $('#content-loader');
    const $moduleTitle = $('#module-title');
    const $body = $('body');
    const $moduleScriptContainer = $('#module-script-container');

    const defaultModule =
        $('[data-default-module]').first().data('default-module') || 'dashboard';

    function loadModule(moduleName, linkElement) {

        $body.addClass('is-loading');
        $loader.show();

        $.ajax({
            // Depuis /admin/ : /admin/modules/<module>/index.php
            url: 'modules/' + moduleName + '/index.php',
            type: 'GET',
            dataType: 'html',

            success: function (response) {

                // 1. Injecter le HTML du module
                $mainContent.html(response);

                // 2. Titre de la page
                $moduleTitle.text($(linkElement).text().trim());

                // 3. Script du module
                $moduleScriptContainer.empty();
                window.initModule = undefined;

                if ($('#crud-root').length) {

                    // Module décrit dans config/tables.php : script générique.
                    window.ChariCrud.init();

                } else {

                    // Module ChariPHP personnalisé : /assets/js/modules/<module>.js
                    const scriptPath =
                        '../assets/js/modules/' + moduleName + '.js?v=' + new Date().getTime();

                    $.get(scriptPath)
                        .done(function (scriptContent) {

                            $moduleScriptContainer.html('<script>' + scriptContent + '<\/script>');

                            if (typeof window.initModule === 'function') {
                                window.initModule();
                            }
                        });
                }

                // 4. État actif dans la sidebar
                $('#sidebar-wrapper .list-group-item').removeClass('active');
                $(linkElement).addClass('active');
            },

            error: function (xhr) {

                // Session expirée
                if (xhr.status === 401) {
                    window.location.href = '../login.php';
                    return;
                }

                let errorMsg = '<strong>Erreur lors du chargement du module : '
                    + $('<div>').text(moduleName).html() + '.</strong>';

                if (xhr.status === 404) {
                    errorMsg += '<br>Fichier introuvable : <code>/admin/modules/'
                        + $('<div>').text(moduleName).html() + '/index.php</code>.';
                } else if (xhr.status === 403) {
                    errorMsg += "<br>Vous n'avez pas la permission d'accéder à ce module.";
                } else if (xhr.status === 500) {
                    errorMsg += "<br>Une erreur interne du serveur s'est produite dans le code PHP du module.";
                }

                $mainContent.html('<div class="alert alert-danger">' + errorMsg + '</div>');

                toastr.error('Impossible de charger le module.', 'Erreur critique');
            },

            complete: function () {
                $loader.hide();
                $body.removeClass('is-loading');
            }
        });
    }


    // =========================================================================
    // 3. ÉVÉNEMENTS
    // =========================================================================

    // Clic sur un onglet de la sidebar
    $('#sidebar-wrapper').on('click', '.list-group-item[data-module]', function (e) {

        e.preventDefault();

        const moduleName = $(this).data('module');

        if (moduleName && !$(this).hasClass('active')) {
            loadModule(moduleName, this);
        }
    });

    // Cartes / liens du tableau de bord : ouvrent le module correspondant
    $(document).on('click', '[data-goto]', function (e) {

        e.preventDefault();

        $('#sidebar-wrapper .list-group-item[data-module="' + $(this).data('goto') + '"]')
            .trigger('click');
    });


    // =========================================================================
    // 4. INITIALISATION
    // =========================================================================

    const $initialLink = $(
        '#sidebar-wrapper .list-group-item[data-module="' + defaultModule + '"]'
    );

    if ($initialLink.length) {

        loadModule(defaultModule, $initialLink);

    } else {

        $loader.hide();
        $body.removeClass('is-loading');

        console.warn("Le module par défaut '" + defaultModule + "' est introuvable.");
    }
});
