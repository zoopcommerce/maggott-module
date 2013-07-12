<?php
return array(
    'modules' => array(
        'Zoop\MaggottModule'
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'vendor/superdweebie/exception-module/tests/test.module.config.php',
        ),
        'module_paths' => array(
            './vendor',
        ),
    ),
);
