<?php

$route[] = ['/', 'HomeController@index'];
$route[] = ['/listar', 'ListarController@index'];
$route[] = ['/posts', 'PostsController@index'];
$route[] = ['/post/{id}/show', 'PostsController@show2'];
$route[] = ['/post/create', 'PostsController@create'];
$route[] = ['/post/store', 'PostsController@store'];
return $route;
