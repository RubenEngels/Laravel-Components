<?php 

use Illuminate\Pagination\Paginator;

// note, if you want to use the links method you must also use the views component
Illuminate\Pagination\Paginator::viewFactoryResolver(function () use ("view factory here") {
  return $factory;
});

// resolve the current path 
Paginator::currentPathResolver(function () {
  return isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : '/';
});

// Set up a current page resolver
Paginator::currentPageResolver(function ($pageName = 'page') {
  $page = isset($_REQUEST[$pageName]) ? $_REQUEST[$pageName] : 1;
  return $page;
});

// paginate some data
$data = User::Paginate(5);
