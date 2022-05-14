<?php
$router->get('', 'PagesController@home');

$router->get('carousel', 'CarouselController@index');
$router->get('schema', 'CarouselController@schema');

$router->get('activities', 'ActivitiesController@index');
$router->get('api/activities', 'ActivitiesController@getAll');

$router->get('stories', 'StoriesController@index');
$router->get('api/stories', 'StoriesController@getAll');

$router->get('capoeira-songs', 'CapoeiraController@index');
$router->get('api/capoeira-songs', 'CapoeiraController@getAll');

$router->get('ukulele-songs', 'UkuleleController@index');
$router->get('api/ukulele-songs', 'UkuleleController@getAll');

$router->get('track', 'PagesController@track');