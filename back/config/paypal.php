<?php

return array(
    /** set your paypal credential **/
    'client_id' =>'Ab0yKcTDEIBRPwts4QG1RHrm38l7-gs9StECKoo8VRWQasVWI4Ci7uWFA4IT7tjVLtsK4Y8BH1myrXhR',
    'secret' => 'EI9fk4SFeNlGM46-lP_9h7Wpx9IuMhCHUkhrHuuRqCwQwMHLKIZGAHBsM5bZbXvEocLW4N6xJL6jTJnu',
    /**
     * SDK configuration
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 1000,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);