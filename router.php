<?php
session_start();

require_once __DIR__ . '/app/controller/config.php';
require_once __DIR__ . '/app/model/Model.php';
require_once __DIR__ . '/app/model/ModelUtilisateur.php';
require_once __DIR__ . '/app/model/ModelVehicule.php';
require_once __DIR__ . '/app/model/ModelVille.php';
require_once __DIR__ . '/app/model/ModelTrajet.php';
require_once __DIR__ . '/app/model/ModelReservation.php';
require_once __DIR__ . '/app/model/ModelStatistique.php';
require_once __DIR__ . '/app/controller/Controller.php';
require_once __DIR__ . '/app/controller/ControllerAccueil.php';
require_once __DIR__ . '/app/controller/ControllerAuth.php';
require_once __DIR__ . '/app/controller/ControllerAdmin.php';
require_once __DIR__ . '/app/controller/ControllerConducteur.php';
require_once __DIR__ . '/app/controller/ControllerPassager.php';
require_once __DIR__ . '/app/controller/ControllerExaminateur.php';
require_once __DIR__ . '/app/controller/ControllerInnovation.php';

$routes = [
    'accueil' => ['ControllerAccueil', 'accueil'],

    'login' => ['ControllerAuth', 'login'],
    'logged' => ['ControllerAuth', 'logged'],
    'logout' => ['ControllerAuth', 'logout'],

    'adminUtilisateurs' => ['ControllerAdmin', 'utilisateurs'],
    'adminConducteurCreate' => ['ControllerAdmin', 'conducteurCreate'],
    'adminConducteurCreated' => ['ControllerAdmin', 'conducteurCreated'],
    'adminPassagerCreate' => ['ControllerAdmin', 'passagerCreate'],
    'adminPassagerCreated' => ['ControllerAdmin', 'passagerCreated'],
    'adminVehicules' => ['ControllerAdmin', 'vehicules'],
    'adminVehiculeCreate' => ['ControllerAdmin', 'vehiculeCreate'],
    'adminVehiculeCreated' => ['ControllerAdmin', 'vehiculeCreated'],
    'adminVilles' => ['ControllerAdmin', 'villes'],
    'adminVilleCreate' => ['ControllerAdmin', 'villeCreate'],
    'adminVilleCreated' => ['ControllerAdmin', 'villeCreated'],

    'conducteurVehicules' => ['ControllerConducteur', 'vehicules'],
    'conducteurTrajets' => ['ControllerConducteur', 'trajets'],
    'conducteurTrajetCreate' => ['ControllerConducteur', 'trajetCreate'],
    'conducteurTrajetCreated' => ['ControllerConducteur', 'trajetCreated'],
    'conducteurTrajetPassengersForm' => ['ControllerConducteur', 'trajetPassengersForm'],
    'conducteurTrajetPassengers' => ['ControllerConducteur', 'trajetPassengers'],
    'conducteurTrajetClose' => ['ControllerConducteur', 'trajetClose'],
    'conducteurTrajetClosed' => ['ControllerConducteur', 'trajetClosed'],

    'passagerReservations' => ['ControllerPassager', 'reservations'],
    'passagerReservationCreate' => ['ControllerPassager', 'reservationCreate'],
    'passagerReservationCreated' => ['ControllerPassager', 'reservationCreated'],

    'examinateurSuperglobales' => ['ControllerExaminateur', 'superglobales'],
    'examinateurRandomReservations' => ['ControllerExaminateur', 'randomReservations'],

    'innovationData' => ['ControllerInnovation', 'data'],
    'innovationMvc' => ['ControllerInnovation', 'mvc'],
];

$action = $_REQUEST['action'] ?? 'accueil';

if (!array_key_exists($action, $routes)) {
    $action = 'accueil';
}

try {
    [$controller, $method] = $routes[$action];
    $controller::$method();
} catch (Throwable $exception) {
    ControllerAccueil::erreur($exception);
}
