<?php
Router::connect('/users', array('plugin' => 'users', 'controller' => 'users'));
Router::connect('/users/index/*', array('plugin' => 'users', 'controller' => 'users'));
Router::connect('/users/:action/*', array('plugin' => 'users', 'controller' => 'users'));
Router::connect('/users/users/:action/*', array('plugin' => 'users', 'controller' => 'users'));
#Router::connect('/login', array('admin'=>false,'plugin'=>'users','controller'=>'users','action' => 'login'));
#Router::connect('/logout', array('admin'=>false,'plugin'=>'users','controller'=>'users','action' => 'logout'));
#Router::connect('/register', array('admin'=>false,'plugin'=>'users','controller'=>'users','action' => 'add'));
