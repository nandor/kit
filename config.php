<?php

    /**
        Configuration file for kit
    */

    $cfg = array (
        // The name of the folder where the application is located
        'base_url'      => '/kit',
        'host'          => 'http://localhost',
        
        // Directories where controllers, views and models are located
        'dir'           => array(
            'controller'    => 'controller/',
            'view'          => 'view/',
            'model'         => 'model/',
        ),
        
        // Database connection data
        'db'            => array(
            'user'          => 'kit',
            'pass'          => 'kit',
            'host'          => 'localhost',
            'database'      => 'kit'
        )    
    );
    
?>
