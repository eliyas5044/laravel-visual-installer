<?php

return [

    /**
     *
     * Shared translations.
     *
     */
    'title' => 'Laravel Visual Installer',
    'next' => 'Next Step',
    'back' => 'Previous',
    'finish' => 'Install',
    'forms' => [
        'errorTitle' => 'The Following errors occurred:',
    ],

    /**
     *
     * Home page translations.
     *
     */
    'welcome' => [
        'templateTitle' => 'Welcome',
        'title' => 'Laravel Visual Installer',
        'message' => 'Easy Installation and Setup Wizard.',
        'next' => 'Check Requirements',
    ],

    /**
     *
     * Requirements page translations.
     *
     */
    'requirements' => [
        'templateTitle' => 'Step 1 | Server Requirements',
        'title' => 'Server Requirements',
        'next' => 'Check Permissions',
    ],

    /**
     *
     * Permissions page translations.
     *
     */
    'permissions' => [
        'templateTitle' => 'Step 2 | Permissions',
        'title' => 'Permissions',
        'next' => 'Generate Storage Link',
    ],

    /**
     *
     * Storage link page translations.
     *
     */
    'storage_link' => [
        'templateTitle' => 'Step 3 | Storage Link',
        'title' => 'Storage Link',
        'description' => 'Generate storage link to your public folder.',
        'next' => 'Configure Environment',
        'button_text' => 'Generate Storage Link',
        'success' => 'Storage link generated successfully.',
        'error' => 'Unable to generate storage link, Please generate it manually.',
    ],

    /**
     *
     * Environment page translations.
     *
     */
    'environment' => [
        'menu' => [
            'templateTitle' => 'Step 4 | Environment Settings',
            'title' => 'Environment Settings',
            'desc' => 'Please select how you want to configure the apps <code>.env</code> file.',
            'wizard-button' => 'Form Wizard Setup',
            'classic-button' => 'Classic Text Editor',
        ],
        'wizard' => [
            'templateTitle' => 'Step 4 | Environment Settings | Guided Wizard',
            'title' => 'Guided <code>.env</code> Wizard',
            'tabs' => [
                'environment' => 'Environment',
                'database' => 'Database',
                'application' => 'Application'
            ],
            'form' => [
                'name_required' => 'The :attribute field is required.',
                'app_name_label' => 'App Name',
                'app_name_placeholder' => 'App Name',
                'app_environment_label' => 'App Environment',
                'app_environment_label_local' => 'Local',
                'app_environment_label_development' => 'Development',
                'app_environment_label_qa' => 'Qa',
                'app_environment_label_production' => 'Production',
                'app_environment_label_other' => 'Other',
                'app_environment_placeholder_other' => 'Enter your environment...',
                'app_url_label' => 'App Url',
                'app_url_placeholder' => 'App Url',
                'app_debug_label' => 'App Debug',
                'app_debug_label_true' => 'True',
                'app_debug_label_false' => 'False',
                'app_log_channel_label' => 'App Log Channel',
                'app_log_channel_label_stack' => 'stack',
                'app_log_channel_label_single' => 'single',
                'app_log_channel_label_daily' => 'daily',
                'app_log_channel_label_stderr' => 'stderr',
                'app_log_channel_label_syslog' => 'syslog',
                'app_log_channel_label_errorlog' => 'errorlog',
                'app_log_channel_label_slack' => 'slack',
                'app_log_channel_label_papertrail' => 'papertrail',
                'log_slack_webhook_url_label' => 'Slack Webhook Url',
                'papertrail_url_label' => 'Papertrail Url',
                'papertrail_port_label' => 'Papertrail Port',
                'db_connection_label' => 'Database Connection',
                'db_connection_label_mysql' => 'mysql',
                'db_connection_label_sqlite' => 'sqlite',
                'db_connection_label_pgsql' => 'pgsql',
                'db_connection_label_sqlsrv' => 'sqlsrv',
                'db_host_label' => 'Database Host',
                'db_host_placeholder' => 'Database Host',
                'db_port_label' => 'Database Port',
                'db_port_placeholder' => 'Database Port',
                'db_name_label' => 'Database Name',
                'db_name_placeholder' => 'Database Name',
                'db_username_label' => 'Database User Name',
                'db_username_placeholder' => 'Database User Name',
                'db_password_label' => 'Database Password',
                'db_password_placeholder' => 'Database Password',

                'app_tabs' => [
                    'more_info' => 'More Info',
                    'broadcasting_title' => 'Broadcasting, Caching, Queue & Session',
                    'broadcasting_label' => 'Broadcast Driver',
                    'broadcasting_placeholder' => 'Broadcast Driver',
                    'cache_label' => 'Cache Driver',
                    'cache_placeholder' => 'Cache Driver',
                    'session_label' => 'Session Driver',
                    'session_placeholder' => 'Session Driver',
                    'session_lifetime' => 'Session Lifetime',
                    'session_lifetime_placeholder' => 'Session Lifetime',
                    'session_lifetime_info' => 'Here you may specify the number of minutes that you wish the session to be allowed to remain idle before it expires.',
                    'queue_connection_label' => 'Queue Connection',
                    'queue_connection_placeholder' => 'Queue Connection',
                    'redis_label' => 'Redis Driver',
                    'redis_host' => 'Redis Host',
                    'redis_password' => 'Redis Password',
                    'redis_port' => 'Redis Port',

                    'mail_label' => 'Mail',
                    'mail_driver_label' => 'Mail Driver',
                    'mail_driver_placeholder' => 'Mail Driver',
                    'mail_host_label' => 'Mail Host',
                    'mail_host_placeholder' => 'Mail Host',
                    'mail_port_label' => 'Mail Port',
                    'mail_port_placeholder' => 'Mail Port',
                    'mail_username_label' => 'Mail Username',
                    'mail_username_placeholder' => 'Mail Username',
                    'mail_password_label' => 'Mail Password',
                    'mail_password_placeholder' => 'Mail Password',
                    'mail_encryption_label' => 'Mail Encryption',
                    'mail_encryption_placeholder' => 'Mail Encryption',
                    'mail_to_address_label' => 'Mail To Address',
                    'mail_to_address_placeholder' => 'info@website.com',
                    'mail_from_address_label' => 'Mail From Address',
                    'mail_from_address_placeholder' => 'admin@website.com',
                    'mail_from_name_label' => 'Mail From Name',
                    'mail_from_name_placeholder' => 'Super User',

                    'pusher_label' => 'Pusher',
                    'pusher_app_id_label' => 'Pusher App Id',
                    'pusher_app_id_placeholder' => 'Pusher App Id',
                    'pusher_app_key_label' => 'Pusher App Key',
                    'pusher_app_key_placeholder' => 'Pusher App Key',
                    'pusher_app_secret_label' => 'Pusher App Secret',
                    'pusher_app_secret_placeholder' => 'Pusher App Secret',

                    'jwt_label' => 'JSON Web Token',
                    'jwt_ttl_label' => 'JWT TTL',
                    'jwt_ttl_placeholder' => 'JWT lifetime in minute',

                    'scout_label' => 'Scout Driver',
                    'scout_driver_label' => 'Scout Driver',
                    'scout_driver_mysql' => 'mysql',
                    'scout_driver_algolia' => 'algolia',
                    'algolia_app_id_label' => 'Algolia App Id',
                    'algolia_secret_label' => 'Algolia Secret',
                ],
                'buttons' => [
                    'setup_database' => 'Setup Database',
                    'setup_application' => 'Setup Application',
                    'install' => 'Install',
                ],
            ],
        ],
        'classic' => [
            'templateTitle' => 'Step 4 | Environment Settings | Classic Editor',
            'title' => 'Classic Environment Editor',
            'save' => 'Save .env',
            'back' => 'Use Form Wizard',
            'install' => 'Save and Install',
        ],
        'success' => 'Your .env file settings have been saved.',
        'errors' => 'Unable to save the .env file, Please create it manually.',
    ],

    'install' => 'Install',

    /**
     *
     * Installed Log translations.
     *
     */
    'installed' => [
        'success_log_message' => 'Laravel Installer successfully INSTALLED on ',
    ],

    /**
     *
     * Final page translations.
     *
     */
    'final' => [
        'title' => 'Installation Finished',
        'templateTitle' => 'Installation Finished',
        'finished' => 'Application has been successfully installed.',
        'migration' => 'Migration & Seed Console Output:',
        'console' => 'Application Console Output:',
        'log' => 'Installation Log Entry:',
        'env' => 'Final .env File:',
        'exit' => 'Click here to exit',
    ],

    /**
     *
     * Update specific translations
     *
     */
    'updater' => [
        /**
         *
         * Shared translations.
         *
         */
        'title' => 'Laravel Updater',

        /**
         *
         * Welcome page translations for update feature.
         *
         */
        'welcome' => [
            'title' => 'Welcome To The Updater',
            'message' => 'Welcome to the update wizard.',
        ],

        /**
         *
         * Welcome page translations for update feature.
         *
         */
        'overview' => [
            'title' => 'Overview',
            'message' => 'There is 1 update.|There are :number updates.',
            'install_updates' => "Install Updates"
        ],

        /**
         *
         * Final page translations.
         *
         */
        'final' => [
            'title' => 'Finished',
            'finished' => 'Application\'s database has been successfully updated.',
            'exit' => 'Click here to exit',
        ],

        'log' => [
            'success_message' => 'Laravel Installer successfully UPDATED on ',
        ],
    ],
];
