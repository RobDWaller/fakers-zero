<?php

$app->add(new \Slim\Middleware\Session([
  'name' => 'fakers_session',
  'autorefresh' => true,
  'lifetime' => '2 hour'
]));
