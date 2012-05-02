<?php

    /**
        Configuration file for kit
    */

    $cfg = array (
        // The name of the folder where the application is located
        'base_url'      => '/kit',
        'host'          => 'http://localhost',
        'debug'         => true,
        'error_page'    => 'view/error.php',
        
        // Directories where controllers, views and models are located
        'dir'           => array(
            'controller'    => 'controller/',
            'view'          => 'view/',
            'model'         => 'model/',
            'content'       => 'uc/'
        ),
        
        // Database connection data
        'db'            => array(
            'user'          => 'kit',
            'pass'          => 'kit',
            'host'          => 'localhost',
            'name'          => 'kit'
        ),
        
        // Facebook API stuff
        'fb'            => array(
            'app_id'        => '277561872338820',
            'channel_file'  => 'http://localhost/kit/fb_channel.html',
            'secret'        => 'b8aba3a9a216204a4df4a03c089f7876',
            'scope'         => 'user_about_me, user_birthday, user_education_history, user_hometown, user_location, user_work_history, email'
        ),    
        
        // Google API stuff
        'google'        => array(
            'client_id'     => '42055577201.apps.googleusercontent.com',
            'scopes'        => 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email'
        ),          
        
        'cache_expire'      => 60 * 60 * 24
    );
?>
