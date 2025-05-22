<?php

require_once __DIR__ . '/../models/Mascota.php';
require_once __DIR__ . '/../models/Raza.php';

class MascotaController {
    private $mascotaModel;
    private $razaModel;

    public function __construct() {
        $this->mascotaModel = new Mascota();
        $this->razaModel = new Raza();
    } 

    public function index() {
        $mascotas = $this->mascotaModel->getAll();
        $view = __DIR__ . '/../views/mascotas/index.php';
        include __DIR__ . '/../views/layout.php';
    }

    public function create(): void
    {
        $razas = $this->razaModel->getAll();
        $view = __DIR__ . '/../views/mascotas/create.php';
        include __DIR__ . '/../views/layout.php';
    }

    public function store($data) {
        $this->mascotaModel->create($data['nombre'], $data['edad'], $data['raza_id']);
        header('Location: index.php');
        exit;
    }


    public function edit($id) {
        $mascota = $this->mascotaModel->getById($id);
        $razas = $this->razaModel->getAll();
        $view = __DIR__ . '/../views/mascotas/edit.php';
        include __DIR__ . '/../views/layout.php';
    }

    public function update($id, $data) {
        $this->mascotaModel->update($id, $data['nombre'], $data['edad'], $data['raza_id']);
        header('Location: index.php');
        exit;
    }

    public function delete($id) {
        $this->mascotaModel->delete($id);
        header('Location: index.php');
        exit;
    }
}
