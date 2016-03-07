<?php

// Init the configuration for the ActiveRecord library
// I would prefer later to move this to a different place or structure.
// To make this work we need to have a 'root' user with 'root' password
// on a localhost server with a 'phpencil' schema created
ActiveRecord\Config::initialize(function($cfg)
{
    // The database connection string for the config
    $db_connection = sprintf('%s://%s:%s@%s/%s',
        'pgsql',                                    // db type
        'yuwqlpjqzssznq',                           // username
        'scSZkmmX-yVZNRIpbJ6kN0s3KF',               // password
        'ec2-54-83-12-22.compute-1.amazonaws.com',  // host
        'dcvcglp892dht8'                            // schema
    );
    
    // Here we set the configurations for the library
    $cfg->set_model_directory(APP_DIR . '/models');
    $cfg->set_connections(array('development' => $db_connection));
});
