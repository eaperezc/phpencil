<?php

// Init the configuration for the ActiveRecord library
// I would prefer later to move this to a different place or structure.
// To make this work we need to have a 'root' user with 'root' password
// on a localhost server with a 'phpencil' schema created
ActiveRecord\Config::initialize(function($cfg)
{
    $cfg->set_model_directory(APP_DIR . '/models');
    $cfg->set_connections(array(
        'development' => 'pgsql://yuwqlpjqzssznq:scSZkmmX-yVZNRIpbJ6kN0s3KF@ec2-54-83-12-22.compute-1.amazonaws.com/dcvcglp892dht8'));
});
