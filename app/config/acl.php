<?php

/**
 * This is the ACL configuration with resources for each role.
 * There is inheritance for the resources so there is no need to duplicate the resources,
 * for example the Administrators will have the resources for Users and Guests
 */
$resources = [];

/**
 * Resources for the guests
 */
$resources['guests'] = [
    'Module\Controllers\LoginController' => [
        'index', 'clear', 'logout', 'transfer'
    ],
    'Module\Controllers\Crons\MailingsController' => [
        'index', 'queue'
    ],
    'Module\Controllers\Errors\IndexController' => [
        'index', 'exceptions', 'clearing'
    ],
];

/**
 * Resources for the users
 */
$resources['users'] = [
    // ERRORS MANAGEMENT
    'Module\Controllers\Errors\IndexController' => [
        'route401', 'route404', 'route500'
    ],
    // GENERAL
    'Module\Controllers\IndexController' => [
        'index', 'clearCache', 'popover', 'changeLimit'
    ],
    'Module\Controllers\Articles\IndexController' => [
        'index', 'list', 'manage', 'remove', 'migration',
    ],
    'Module\Controllers\Articles\CategoriesController' => [
        'index', 'list', 'manage'
    ],
    'Module\Controllers\Chats\IndexController' => [
        'index', 'list', 'manage'
    ],
    'Module\Controllers\Events\IndexController' => [
        'index', 'list', 'manage'
    ],
    'Module\Controllers\Events\SchedulesController' => [
        'index', 'list', 'manage'
    ],
    'Module\Controllers\Events\LabelsController' => [
        'index', 'list', 'manage'
    ],
    'Module\Controllers\Events\PartnersController' => [
        'ordering', 'orderingUpdate'
    ],
    'Module\Controllers\Live\CandidatesController' => [
        'index', 'list'
    ],
    'Module\Controllers\Live\EventsController' => [
        'index', 'list', 'manage'
    ],
    'Module\Controllers\Live\SpeakersController' => [
        'index', 'list', 'manage'
    ],
    'Module\Controllers\Navigations\IndexController' => [
        'index', 'list'
    ],
    'Module\Controllers\Notes\IndexController' => [
        'index', 'list', 'manage'
    ],
    'Module\Controllers\Pages\IndexController' => [
        'index', 'list', 'manage'
    ],
    'Module\Controllers\Pages\TabsController' => [
        'index', 'list', 'manage'
    ],
    'Module\Controllers\Pages\FragmentsController' => [
        'index', 'list', 'manage', 'remove'
    ],
    'Module\Controllers\Partners\IndexController' => [
        'index', 'list', 'manage'
    ],
    'Module\Controllers\Routes\IndexController' => [
        'index', 'list', 'manage'
    ],
    'Module\Controllers\Schools\ArticlesController' => [
        'index', 'list', 'manage', 'remove'
    ],
    'Module\Controllers\Schools\IndexController' => [
        'index', 'list', 'manage'
    ],
    'Module\Controllers\Schools\ParticipatingController' => [
        'index', 'import', 'manage', 'toggle', 'remove'
    ],
    'Module\Controllers\Spotlight\ArticlesController' => [
        'ordering', 'orderingUpdate'
    ],
    'Module\Controllers\Spotlight\CandidatesController' => [
        'index', 'list'
    ],
    'Module\Controllers\Spotlight\BoxesController' => [
        'index', 'list', 'manage', 'ordering', 'orderingUpdate'
    ],
    'Module\Controllers\Spotlight\EventsController' => [
        'index', 'list', 'manage'
    ],
    'Module\Controllers\Spotlight\ImagesController' => [
        'index', 'list', 'manage'
    ],
    'Module\Controllers\Spotlight\SchoolsController' => [
        'index', 'list', 'manage', 'ordering', 'orderingUpdate'
    ],
    'Module\Controllers\Spotlight\VideosController' => [
        'index', 'list', 'manage', 'ordering', 'orderingUpdate'
    ],
    'Module\Controllers\Testimonials\IndexController' => [
        'index', 'list', 'manage'
    ],
    // WEBINARS
    'Module\Controllers\Webinars\BoxesController' => [
        'index', 'list', 'manage', 'remove', 'ordering', 'orderingUpdate'
    ],
    'Module\Controllers\Webinars\EventsController' => [
        'index', 'list', 'manage', 'remove'
    ],
    'Module\Controllers\Webinars\ImagesController' => [
        'index', 'list', 'manage', 'remove'
    ],
    // FOCUS ARTICLES
    'Module\Controllers\Focus\ArticlesController' => [
        'ordering', 'orderingUpdate'
    ],
    'Module\Controllers\Focus\InterviewsController' => [
        'ordering', 'orderingUpdate'
    ],
    'Module\Controllers\Focus\PagesController' => [
        'index', 'list', 'manage', 'remove'
    ],
    'Module\Controllers\Focus\VideosController' => [
        'index', 'list', 'manage', 'remove', 'ordering', 'orderingUpdate'
    ],
];

/**
 * Resources for the sales
 */
$resources['sales'] = [
    // ERRORS MANAGEMENT
    'Module\Controllers\Errors\IndexController' => [
        'route401', 'route404', 'route500'
    ],
    // GENERAL
    'Module\Controllers\IndexController' => [
        'index', 'clearCache', 'popover', 'changeLimit'
    ],
    'Module\Controllers\Schools\ParticipatingController' => [
        'index', 'import', 'manage', 'toggle', 'remove'
    ],
];

/**
 * Resources for the administrators
 */
$resources['admins'] = [
    'Module\Controllers\Articles\CategoriesController' => [
        'remove'
    ],
    'Module\Controllers\Chats\IndexController' => [
        'remove'
    ],
    'Module\Controllers\Events\SchedulesController' => [
        'remove'
    ],
    'Module\Controllers\Live\CandidatesController' => [
        'remove'
    ],
    'Module\Controllers\Live\EventsController' => [
        'remove'
    ],
    'Module\Controllers\Live\SpeakersController' => [
        'remove'
    ],
    'Module\Controllers\Notes\IndexController' => [
        'remove'
    ],
    'Module\Controllers\Pages\IndexController' => [
        'remove'
    ],
    'Module\Controllers\Pages\TabsController' => [
        'remove'
    ],
    'Module\Controllers\Partners\IndexController' => [
        'remove'
    ],
    'Module\Controllers\Routes\IndexController' => [
        'remove'
    ],
    'Module\Controllers\Schools\IndexController' => [
        'remove'
    ],
    'Module\Controllers\Spotlight\CandidatesController' => [
        'remove'
    ],
    'Module\Controllers\Spotlight\BoxesController' => [
        'remove'
    ],
    'Module\Controllers\Spotlight\EventsController' => [
        'remove'
    ],
    'Module\Controllers\Spotlight\ImagesController' => [
        'remove'
    ],
    'Module\Controllers\Spotlight\SchoolsController' => [
        'remove'
    ],
    'Module\Controllers\Spotlight\VideosController' => [
        'remove'
    ],
    'Module\Controllers\Testimonials\IndexController' => [
        'remove'
    ],
];

/**
 * Resources for the super administrators
 */
$resources['superadmins'] = [
    'Module\Controllers\Navigations\IndexController' => [
        'manage', 'remove'
    ],
];

/**
 * Return the resources list
 */
return $resources;
