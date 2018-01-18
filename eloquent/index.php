<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model as Eloquent;

// Instantiate the Capsule Manager
$capsule = new Capsule;

// Add your connection here, in this case, for ease of use a sqlite database file
$capsule->addConnection([
	'driver' => 'sqlite',
	'database' => __DIR__.'/../database.sqlite',
	'prefix' => ''
]);

// Set the Event Dispatcher
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Set Eloquent as global
$capsule->setAsGlobal();

// Boot Eloquent
$capsule->bootEloquent();

// Create a User model
class User extends Eloquent {

	protected $fillable = ['name', 'email'];

	public $timestamps = false;
}

// Create a new table
Capsule::schema()->create('users', function($table) {
   $table->increments('id');
   $table->string('name');
   $table->string('email');
});


// Fill the table with a record
User::create([
	'admin',
	'admin@admin.nl',
]);

// Return all of the records from the User model
dd(User::all());
