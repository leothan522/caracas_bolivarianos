<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | the application so that it's available within Artisan commands.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. The timezone
    | is set to "UTC" by default as it is suitable for most use cases.
    |
    */

    'timezone' => 'America/Caracas',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by Laravel's translation / localization methods. This option can be
    | set to any locale for which you plan to have translation strings.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is utilized by Laravel's encryption services and should be set
    | to a random, 32 character string to ensure that all encrypted values
    | are secure. You should do this prior to deploying the application.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Variables de Entorno personalizadas para el proyecto
    |--------------------------------------------------------------------------
    |
    |
    */

    'livewire' => env('APP_ASSET_LIVEWIRE', false),
    'register' => env('REGISTER', false),
    'root_name' => env('ROOT_NAME', false),
    'root_email' => env('ROOT_EMAIL', false),
    'root_password' => env('ROOT_PASSWORD', false),

    'sql_extra' => env('CARGAR_INIT_EXTRA', true),
    'sql_estados' => env('CARGAR_INIT_ESTADOS', false),
    'sql_users' => env('CARGAR_INIT_USER', false),
    'sql_socios' => env('CARGAR_INIT_SOCIOS', false),
    'sql_participantes' => env('CARGAR_INIT_PARTICIPANTES', false),
    'sql_datos_medicos' => env('CARGAR_INIT_DATOS_MEDICOS', false),
    'sql_atletas' => env('CARGAR_INIT_ATLETAS', false),

    'chequear_socios' => env('CHEQUEAR_LISTADO_SOCIOS', false),

    'intencion_ver' => env('INTENCION_VER', true),
    'intencion_hasta' => env('INTENCION_HASTA', false),
    'numerica_ver' => env('NUMERICA_VER', true),
    'numerica_hasta' => env('NUMERICA_HASTA', false),
    'participantes_ver' => env('PARTICIPANTES_VER', true),
    'participantes_hasta' => env('PARTICIPANTES_VER', false),

    'intencion_deporte_ver' => env('INTENCION_DEPORTE_VER', true),
    'intencion_deporte_hasta' => env('INTENCION_DEPORTE_HASTA', false),

    'reportes_ver' => env('reportes_ver', true),

    'widget_filament' => env('WIDGET_FILAMENT', false),

];
