<?php
require_once __DIR__ . '/controllers/MascotaController.php';

$controller = new MascotaController();

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store($_POST);
        break;
    case 'edit':
        $controller->edit($_GET['id']);
        break;
    case 'update':
        $controller->update($_GET['id'], $_POST);
        break;
    case 'delete':
        $controller->delete($_GET['id']);
        break;
    default:
        $controller->index();
        break;
}

$routes = [
    'GET' => [
        '' => 'index',
        'create' => 'create',
        'edit' => 'edit'
    ],
    'POST' => [
        'store' => 'store',
        'update' => 'update',
        'delete' => 'delete'
    ]
];