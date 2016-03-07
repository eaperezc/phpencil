<?php

// Init the configuration for the ActiveRecord library
// I would prefer later to move this to a different place or structure.
// To make this work we need to have a 'root' user with 'root' password
// on a localhost server with a 'phpencil' schema created
ActiveRecord\Config::initialize(function($cfg)
{
    // The database connection string for the config
    $db_connection = sprintf('%s://%s:%s@%s/%s',
        'mysql',        // db type
        'root',         // username
        'root',         // password
        'localhost',    // host
        'phpencil'      // schema
    );

    // Here we set the configurations for the library
    $cfg->set_model_directory(APP_DIR . '/models');
    $cfg->set_connections(array('development' => $db_connection));
});
