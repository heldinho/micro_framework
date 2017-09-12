<?php

$route[] = ['/', 'HomeController@index'];
$route[] = ['/listar', 'ListarController@index'];
$route[] = ['/posts', 'PostsController@index'];
$route[] = ['/post/{id}/show', 'PostsController@show'];
return $route;
