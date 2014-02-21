<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | WHMCS Database Connection
    |--------------------------------------------------------------------------
    |
    | The connection your WHMCS database lives in. This should
    | be defined in app/config/database.
    |
    */
    'connection' => 'whmcs'

    /*
    |--------------------------------------------------------------------------
    | WHMCS Database API Details
    |--------------------------------------------------------------------------
    |
    | If you plan to use the WHMCS API, you will need to insert
    | the apropriate details in this section.
    |
    */
    'api' => array(
        'username' => 'api-username',
        'password' => 'api-password',
        'url' => 'http://www.site.com/whmcs/includes/api.php',
    )
);