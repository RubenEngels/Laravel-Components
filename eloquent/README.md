# Illuminate Eloquent (database) component

add your connections like this
```php
<?php 
 
$capsule->addConnection([
  'driver'   => 'sqlite',
  'database' => __DIR__.'/database.sqlite',
  'prefix'   => '',
]);
```
