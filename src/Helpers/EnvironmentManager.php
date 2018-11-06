<?php

namespace Eliyas5044\LaravelVisualInstaller\Helpers;

use Exception;
use Illuminate\Http\Request;

class EnvironmentManager
{
    /**
     * @var string
     */
    private $envPath;

    /**
     * @var string
     */
    private $envExamplePath;

    /**
     * Set the .env and .env.example paths.
     */
    public function __construct()
    {
        $this->envPath = base_path('.env');
        $this->envExamplePath = base_path('.env.example');
    }

    /**
     * Get the content of the .env file.
     *
     * @return string
     */
    public function getEnvContent()
    {
        if (!file_exists($this->envPath)) {
            if (file_exists($this->envExamplePath)) {
                copy($this->envExamplePath, $this->envPath);
            } else {
                touch($this->envPath);
            }
        }

        return file_get_contents($this->envPath);
    }

    /**
     * Get the the .env file path.
     *
     * @return string
     */
    public function getEnvPath()
    {
        return $this->envPath;
    }

    /**
     * Get the the .env.example file path.
     *
     * @return string
     */
    public function getEnvExamplePath()
    {
        return $this->envExamplePath;
    }

    /**
     * Save the edited content to the .env file.
     *
     * @param Request $request
     * @return string
     */
    public function saveFileClassic(Request $request)
    {
        $message = trans('installer_messages.environment.success');

        try {
            file_put_contents($this->envPath, $request->get('envConfig'));
        } catch (Exception $e) {
            $message = trans('installer_messages.environment.errors');
        }

        return $message;
    }

    /**
     * Save the form content to the .env file.
     *
     * @param Request $request
     * @return string
     */
    public function saveFileWizard(Request $request)
    {
        $results = trans('installer_messages.environment.success');
        $app_key = env('APP_KEY') ?? 'base64:q//p01eCRsy52gY8emqjfl8jJYsyeJGJ8OO4vmbtlYI=';
        $envFileData =
            'APP_NAME=\'' . $request->app_name . "'\n" .
            'APP_ENV=' . $request->environment . "\n" .
            'APP_KEY=' . $app_key . "\n" .
            'APP_DEBUG=' . $request->app_debug . "\n" .
            'APP_URL=' . $request->app_url . "\n\n" .
            'LOG_CHANNEL=' . $request->app_log_channel . "\n" .
            'LOG_SLACK_WEBHOOK_URL=' . $request->log_slack_webhook_url . "\n" .
            'PAPERTRAIL_URL=' . $request->papertrail_url . "\n" .
            'PAPERTRAIL_PORT=' . $request->papertrail_port . "\n\n" .
            'DB_CONNECTION=' . $request->database_connection . "\n" .
            'DB_HOST=' . $request->database_hostname . "\n" .
            'DB_PORT=' . $request->database_port . "\n" .
            'DB_DATABASE=' . $request->database_name . "\n" .
            'DB_USERNAME=' . $request->database_username . "\n" .
            'DB_PASSWORD=' . $request->database_password . "\n\n" .
            'BROADCAST_DRIVER=' . $request->broadcast_driver . "\n" .
            'CACHE_DRIVER=' . $request->cache_driver . "\n" .
            'QUEUE_CONNECTION=' . $request->queue_connection . "\n" .
            'SESSION_DRIVER=' . $request->session_driver . "\n" .
            'SESSION_LIFETIME=' . $request->session_lifetime . "\n\n" .
            'REDIS_HOST=' . $request->redis_hostname . "\n" .
            'REDIS_PASSWORD=' . $request->redis_password . "\n" .
            'REDIS_PORT=' . $request->redis_port . "\n\n" .
            'MAIL_DRIVER=' . $request->mail_driver . "\n" .
            'MAIL_HOST=' . $request->mail_host . "\n" .
            'MAIL_PORT=' . $request->mail_port . "\n" .
            'MAIL_USERNAME=' . $request->mail_username . "\n" .
            'MAIL_PASSWORD=' . $request->mail_password . "\n" .
            'MAIL_ENCRYPTION=' . $request->mail_encryption . "\n" .
            'MAIL_TO_ADDRESS=' . $request->mail_to_address . "\n" .
            'MAIL_FROM_ADDRESS=' . $request->mail_from_address . "\n" .
            'MAIL_FROM_NAME=\'' . $request->mail_from_name . "'\n\n" .
            'PUSHER_APP_ID=' . $request->pusher_app_id . "\n" .
            'PUSHER_APP_KEY=' . $request->pusher_app_key . "\n" .
            'PUSHER_APP_SECRET=' . $request->pusher_app_secret . "\n" .
            'PUSHER_APP_CLUSTER=' . $request->pusher_app_cluster . "\n\n" .
            'MIX_PUSHER_APP_KEY=' . $request->pusher_app_key . "\n" .
            'MIX_PUSHER_APP_CLUSTER=' . $request->pusher_app_cluster . "\n\n" .
            'SCOUT_DRIVER=' . $request->scout_driver . "\n" .
            'ALGOLIA_APP_ID=' . $request->algolia_app_id . "\n" .
            'ALGOLIA_SECRET=' . $request->algolia_secret . "\n\n" .
            'JWT_SECRET=' . env('JWT_SECRET') . "\n" .
            'JWT_TTL=' . $request->jwt_ttl;

        try {
            file_put_contents($this->envPath, $envFileData);
        } catch (Exception $e) {
            $results = trans('installer_messages.environment.errors');
        }

        return $results;
    }
}
