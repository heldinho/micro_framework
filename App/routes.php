<?php

$route[] = ['/', 'HomeController@index'];
$route[] = ['/listar', 'ListarController@index'];
$route[] = ['/posts', 'PostsController@index'];
$route[] = ['/post/create', 'PostsController@create'];
$route[] = ['/post/store', 'PostsController@store'];

$route[] = ['/post/{id}/show', 'PostsController@show2'];
$route[] = ['/post/{id}/edit', 'PostsController@edit'];
$route[] = ['/post/{id}/update', 'PostsController@update'];
$route[] = ['/post/{id}/delete', 'PostsController@delete'];

return $route;
