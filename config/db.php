<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=cisss',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',

    'on afterOpen' => function($event) {
        $event->sender->createCommand("SET time_zone = '+00:00'")->execute();
    }   

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
