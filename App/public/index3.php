<?php
use KanbanBoard\Authentication;
use KanbanBoard\GithubActual;
use KanbanBoard\Utilities;

require '../App/KanbanBoard/Github.php';
require '../App/Utilities.php';
require '../App/KanbanBoard/Authentication.php';

$repositories = explode('|', Utilities::env('GH_REPOSITORIES'));
$authentication = new \KanbanBoard\Login();
$token = $authentication->login();
$github = new GithubClient($token, Utilities::env('GH_ACCOUNT'));
$board = new \KanbanBoard\Application($github, $repositories, array('waiting-for-feedback'));
$data = $board->board();
$m = new Mustache_Engine(array(
	'loader' => new Mustache_Loader_FilesystemLoader('../views'),
));
echo $m->render('index', array('milestones' => $data));
