<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\ActiviteModel;

class ActivityController extends Controller
{
    private ActiviteModel $activiteModel;

    public function __construct()
    {
        parent::__construct();
        $this->activiteModel = new ActiviteModel();
    }

    public function index()
    {
        $activities = $this->activiteModel->getAllActivities();
        $this->view('activity/index', ['activities' => $activities]);
    }

    public function show(int $id)
    {
        $activity = $this->activiteModel->getActivityById($id);
        $placesLeft = $this->activiteModel->getPlacesLeft($id);
        $this->view('activity/show', ['activity' => $activity, 'placesLeft' => $placesLeft]);
    }

    public function create()
    {
        if (!Auth::checkAdmin()) {
            echo "Accès interdit";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'],
                'type_id' => $_POST['type_id'],
                'places_disponibles' => $_POST['places_disponibles'],
                'description' => $_POST['description'],
                'datetime_debut' => $_POST['datetime_debut'],
                'duree' => $_POST['duree']
            ];

            if ($this->activiteModel->createActivity($data)) {
                header('Location: /');
                exit;
            }
        }

        $this->view('activity/create');
    }

    public function update(int $id)
    {
        if (!Auth::checkAdmin()) {
            echo "Accès interdit";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'],
                'type_id' => $_POST['type_id'],
                'places_disponibles' => $_POST['places_disponibles'],
                'description' => $_POST['description'],
                'datetime_debut' => $_POST['datetime_debut'],
                'duree' => $_POST['duree']
            ];
            $this->activiteModel->updateActivity($id, $data);
            header('Location: /activity/show/' . $id);
            exit;
        }

        $activity = $this->activiteModel->getActivityById($id);
        $this->view('activity/update', ['activity' => $activity]);
    }

    public function delete(int $id)
    {
        if (!Auth::checkAdmin()) {
            echo "Accès interdit";
            return;
        }

        $this->activiteModel->deleteActivity($id);
        header('Location: /');
        exit;
    }
}
