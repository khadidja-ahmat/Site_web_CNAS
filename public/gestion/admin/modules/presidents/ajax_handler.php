<?php
// /admin/modules/presidents/ajax_handler.php
// Logique serveur du module : voir config/crud.php et config/tables.php.

require_once __DIR__ . '/../../../config/crud.php';

crud_handle('presidents');
