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
$teams->get('/teams', 'indexAction');
$teams->get('/teams/list', 'listAction');
$teams->get('/teams/details/{url}', 'detailsAction');
$app->mount($teams);

// Locations handler
$locations = new MicroCollection();
$locations->setHandler(new Locations());
$locations->setPrefix('/api');
$locations->get('/locations/list', 'listAction');
$app->mount($locations);

// Stadiums handler
$stadiums = new MicroCollection();
$stadiums->setHandler(new Stadiums());
$stadiums->setPrefix('/api');
$stadiums->get('/stadiums/list', 'listAction');
$app->mount($stadiums);

// Results handler
$results = new MicroCollection();
$results->setHandler(new Results());
$results->setPrefix('/api');
$results->get('/results', 'list');
$results->get('/results/page/{page}', 'list');
$app->mount($results);