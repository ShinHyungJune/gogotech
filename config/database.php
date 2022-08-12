<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
                PDO::ATTR_EMULATE_PREPARES => true,
            ]) : [],
        ],

        'pinco' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_PINCO_HOST', '127.0.0.1'),
            'port' => env('DB_PINCO_PORT', '3306'),
            'database' => env('DB_PINCO_DATABASE', 'forge'),
            'username' => env('DB_PINCO_USERNAME', 'forge'),
            'password' => env('DB_PINCO_PASSWORD', ''),
            'unix_socket' => env('DB_PINCO_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus1' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS1_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS1_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS1_DATABASE', 'hisms_emfoplus1'),
            'username' => env('DB_HISMS_EMFOPLUS1_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS1_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS1_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus2' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS2_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS2_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS2_DATABASE', 'hisms_emfoplus2'),
            'username' => env('DB_HISMS_EMFOPLUS2_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS2_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS2_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus3' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS3_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS3_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS3_DATABASE', 'hisms_emfoplus3'),
            'username' => env('DB_HISMS_EMFOPLUS3_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS3_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS3_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus4' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS4_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS4_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS4_DATABASE', 'hisms_emfoplus4'),
            'username' => env('DB_HISMS_EMFOPLUS4_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS4_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS4_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus5' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS5_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS5_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS5_DATABASE', 'hisms_emfoplus5'),
            'username' => env('DB_HISMS_EMFOPLUS5_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS5_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS5_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus6' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS6_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS6_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS6_DATABASE', 'hisms_emfoplus6'),
            'username' => env('DB_HISMS_EMFOPLUS6_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS6_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS6_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus7' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS7_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS7_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS7_DATABASE', 'hisms_emfoplus7'),
            'username' => env('DB_HISMS_EMFOPLUS7_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS7_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS7_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus8' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS8_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS8_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS8_DATABASE', 'hisms_emfoplus8'),
            'username' => env('DB_HISMS_EMFOPLUS8_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS8_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS8_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus9' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS9_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS9_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS9_DATABASE', 'hisms_emfoplus9'),
            'username' => env('DB_HISMS_EMFOPLUS9_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS9_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS9_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus10' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS10_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS10_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS10_DATABASE', 'hisms_emfoplus10'),
            'username' => env('DB_HISMS_EMFOPLUS10_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS10_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS10_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus11' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS11_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS11_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS11_DATABASE', 'hisms_emfoplus11'),
            'username' => env('DB_HISMS_EMFOPLUS11_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS11_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS11_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus12' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS12_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS12_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS12_DATABASE', 'hisms_emfoplus12'),
            'username' => env('DB_HISMS_EMFOPLUS12_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS12_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS12_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],


        'hisms_emfoplus13' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS13_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS13_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS13_DATABASE', 'hisms_emfoplus13'),
            'username' => env('DB_HISMS_EMFOPLUS13_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS13_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS13_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus14' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS14_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS14_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS14_DATABASE', 'hisms_emfoplus14'),
            'username' => env('DB_HISMS_EMFOPLUS14_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS14_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS14_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus15' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS15_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS15_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS15_DATABASE', 'hisms_emfoplus15'),
            'username' => env('DB_HISMS_EMFOPLUS15_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS15_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS15_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus16' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS16_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS16_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS16_DATABASE', 'hisms_emfoplus16'),
            'username' => env('DB_HISMS_EMFOPLUS16_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS16_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS16_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus17' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS17_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS17_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS17_DATABASE', 'hisms_emfoplus17'),
            'username' => env('DB_HISMS_EMFOPLUS17_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS17_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS17_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus18' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS18_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS18_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS18_DATABASE', 'hisms_emfoplus18'),
            'username' => env('DB_HISMS_EMFOPLUS18_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS18_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS18_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus19' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS19_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS19_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS19_DATABASE', 'hisms_emfoplus19'),
            'username' => env('DB_HISMS_EMFOPLUS19_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS19_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS19_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus20' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS20_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS20_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS20_DATABASE', 'hisms_emfoplus20'),
            'username' => env('DB_HISMS_EMFOPLUS20_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS20_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS20_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'hisms_emfoplus21' => [
            'driver' => 'mysql',
            'url' => env('DATABASERDS__URL'),
            'host' => env('DB_HISMS_EMFOPLUS21_HOST', 'database-message-outlet.c8ctxswpyt2d.ap-northeast-2.rds.amazonaws.com'),
            'port' => env('DB_HISMS_EMFOPLUS21_PORT', '3306'),
            'database' => env('DB_HISMS_EMFOPLUS21_DATABASE', 'hisms_emfoplus21'),
            'username' => env('DB_HISMS_EMFOPLUS21_USERNAME', 'admin'),
            'password' => env('DB_HISMS_EMFOPLUS21_PASSWORD', 'shin1109'),
            'unix_socket' => env('DB_HISMS_EMFOPLUS21_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_0900_ai_ci',
            'prefix' => '',
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];
