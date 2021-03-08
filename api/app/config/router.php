<?php

declare(strict_types=1);

use Phalcon\Mvc\Micro\Collection as MicroCollection;

use Api\Controllers\TeamsController as Teams;
use Api\Controllers\ResultsController as Results;
use Api\Controllers\LocationsController as Locations;
use Api\Controllers\StadiumsController as Stadiums;

// Teams handler
$teams = new MicroCollection();
$teams->setHandler(new Teams());
$teams->setPrefix('/api');

// /api/teams?founded_start=1920&founded_end=1980&location=1&stadium=2&page=2
$teams->get('/teams', 'getItemsAction');
$teams->get('/teams/all', 'getAllItemsAction');
$app->mount($teams);

// $teams->get('/teams/page/{page}', 'list');
// $teams->get('/teams/details/{url}', 'detailsAction');
// $teams->get('/teams/results/{url}', 'resultsAction');
// $teams->get('/teams/results/{url}/{type}', 'resultsAction');
// $teams->get('/teams/results/{url}/{type}/page/{page}', 'resultsAction');
// $teams->get('/teams/{id}/results/{date_start}/{date_end}/{tournament_type_id}', 'tournamentType');
// $teams->get('/teams/{id}/results/{date_start}/{date_end}/{tournament_type_id}/{tournament_id}', 'tournament');

// Locations handler
$locations = new MicroCollection();
$locations->setHandler(new Locations());
$locations->setPrefix('/api');
$locations->get('/locations/all', 'getAllItemsAction');
$app->mount($locations);

// Stadiums handler
$stadiums = new MicroCollection();
$stadiums->setHandler(new Stadiums());
$stadiums->setPrefix('/api');
$stadiums->get('/stadiums/all', 'getAllItemsAction');
$app->mount($stadiums);

// Results handler
$results = new MicroCollection();
$results->setHandler(new Results());
$results->setPrefix('/api');
$results->get('/results', 'list');
$results->get('/results/page/{page}', 'list');
$app->mount($results);