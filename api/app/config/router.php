<?php

declare(strict_types=1);

use Phalcon\Mvc\Micro\Collection as MicroCollection;

use Api\Controllers\TeamsController as Teams;
use Api\Controllers\ResultsController as Results;

// Teams handler
$teams = new MicroCollection();
$teams->setHandler(new Teams());
$teams->setPrefix('/api');

// /api/teams?founded_start=1920&founded_end=1980&location=1&stadium=2&page=2
$teams->get('/teams', 'loadAction');



// $teams->get('/teams/page/{page}', 'list');
// $teams->get('/teams/details/{url}', 'detailsAction');
// $teams->get('/teams/results/{url}', 'resultsAction');
// $teams->get('/teams/results/{url}/{type}', 'resultsAction');
// $teams->get('/teams/results/{url}/{type}/page/{page}', 'resultsAction');


// $teams->get('/teams/{id}/results/{date_start}/{date_end}/{tournament_type_id}', 'tournamentType');
// $teams->get('/teams/{id}/results/{date_start}/{date_end}/{tournament_type_id}/{tournament_id}', 'tournament');

$app->mount($teams);

// Results handler
$results = new MicroCollection();
$results->setHandler(new Results());
$results->setPrefix('/api');
$results->get('/results', 'list');

// /api/results?team=1&tournament=1&date_start=01032021&date_end=03032021&stadium=2



$results->get('/results/page/{page}', 'list');



// $results->get('/results/view/{id}', 'view');
$app->mount($results);