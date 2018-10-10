<?php

$data = require 'bootstrap.php';

$users = $data->select('select * from users');

if ($_POST) {
    $_POST['updated_at'] = date('Y-m-d H:i:s');
    switch ($_POST['type']) {
        case 'add':
            $verify = $data->select('select email from users where email = "' . $_POST['email'] . '"');
            if (empty($verify)) {
                $status = $data->insert($_POST);
            } else {
                $status = 'Kasutaja juba olemas';
            }
            break;
        case 'edit':
             $status = $data->update($_POST);
            break;
        case 'delete':
            $status = $data->delete($_POST);
            break;
    }
}

require 'Views/index.view.php';
