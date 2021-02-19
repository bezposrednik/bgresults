<?php

declare(strict_types=1);

use Phalcon\Mvc\Micro\Collection as MicroCollection;

use Api\Controllers\TeamsController as Teams;
use Api\Controllers\ResultsController as Results;

// Teams handler
$teams = new MicroCollection();
$teams->setHandler(new Teams());
$teams->setPrefix('/api');

$teams->get('/teams', 'index');
$teams->get('/teams/page/{page}', 'index');
$teams->get('/teams/details/{url}', 'detailsAction');
$teams->get('/teams/results/{url}/{type}', 'resultsAction');

// $teams->get('/teams/{id}/results/{date_start}/{date_end}/{tournament_type_id}', 'tournamentType');
// $teams->get('/teams/{id}/results/{date_start}/{date_end}/{tournament_type_id}/{tournament_id}', 'tournament');

$app->mount($teams);

// Results handler
$results = new MicroCollection();
$results->setHandler(new Results());
$results->setPrefix('/api');
$results->get('/results', 'all');
$results->get('/results/view/{id}', 'view');
$app->mount($results);