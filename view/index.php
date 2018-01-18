<?php 

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

// The path to the views
$viewsDirs = [__DIR__ . '/resources/views'];
// the path to the cache folder
$compiledViewsDir = __DIR__ . '/resources/cache';

// Create a new Filesystem and Dispatcher instance
$fs = new Filesystem;
$dispatcher = new Dispatcher(new Container);

// Create a new EngineResolver and BladeCompiler instance using the Filesystem and views directory
$resolver  = new EngineResolver;
$compiler = new BladeCompiler($fs, $compiledViewsDir);

// Register the blade handler using the Compiler and the Filesystem
$resolver->register('blade', function () use ($compiler, $fs) {
  return new CompilerEngine($compiler, $fs);
});

// Register the PhpEngine
$resolver->register('php', function () {
  return new PhpEngine;
});

// Create a new FileViewFinder and Factory
$viewFinder = new FileViewFinder($fs, $viewsDirs);
$view = new Factory($resolver, $viewFinder, $dispatcher);

// Render a view with the provided data
echo $view->make('index', [
  'title' => 'Using the blade engine outside of laravel',
  'body' => 'This is an example of how to use the blade engine outside of laravel'
])->render();
