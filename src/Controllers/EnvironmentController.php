<?php

namespace Eliyas5044\LaravelVisualInstaller\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Eliyas5044\LaravelVisualInstaller\Helpers\EnvironmentManager;
use Eliyas5044\LaravelVisualInstaller\Events\EnvironmentSaved;
use Illuminate\Validation\Rule;
use Validator;
use DB;
use Exception;

class EnvironmentController extends Controller
{
    /**
     * @var EnvironmentManager
     */
    protected $EnvironmentManager;

    /**
     * @param EnvironmentManager $environmentManager
     */
    public function __construct(EnvironmentManager $environmentManager)
    {
        $this->EnvironmentManager = $environmentManager;
    }

    /**
     * Display the Environment menu page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentMenu()
    {
        return view('vendor.installer.environment');
    }

    /**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentWizard()
    {
        $envConfig = $this->EnvironmentManager->getEnvContent();

        return view('vendor.installer.environment-wizard', compact('envConfig'));
    }

    /**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environmentClassic()
    {
        $envConfig = $this->EnvironmentManager->getEnvContent();

        return view('vendor.installer.environment-classic', compact('envConfig'));
    }

    /**
     * Processes the newly saved environment configuration (Classic).
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveClassic(Request $request)
    {
        $message = $this->EnvironmentManager->saveFileClassic($request);

        event(new EnvironmentSaved($request));

        return redirect()->route('LaravelVisualInstaller::environmentClassic')
            ->with(['message' => $message]);
    }

    /**
     * Processes the newly saved environment configuration (Form Wizard).
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveWizard(Request $request)
    {
        $rules = config('installer.environment.form.rules');
        $messages = [
            'environment_custom.required_if' => trans('installer_messages.environment.wizard.form.name_required'),
            'log_slack_webhook_url.required_if' => trans('installer_messages.environment.wizard.form.name_required'),
            'papertrail_url.required_if' => trans('installer_messages.environment.wizard.form.name_required'),
            'papertrail_port.required_if' => trans('installer_messages.environment.wizard.form.name_required'),
            'algolia_app_id.required_if' => trans('installer_messages.environment.wizard.form.name_required'),
            'algolia_secret.required_if' => trans('installer_messages.environment.wizard.form.name_required'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('LaravelVisualInstaller::environmentWizard')->withErrors($validator)->withInput();
        }

        if (!$this->checkDatabaseConnection($request)) {
            return redirect()->route('LaravelVisualInstaller::environmentWizard')->withErrors([
                'database_connection' => 'Could not connect to the database.',
            ])->withInput();
        }

        $results = $this->EnvironmentManager->saveFileWizard($request);

        event(new EnvironmentSaved($request));

        return redirect()->route('LaravelVisualInstaller::database')
            ->with(['results' => $results]);
    }

    /**
     * Validate database connection with user credentials (Form Wizard).
     *
     * @param Request $request
     * @return bool
     */
    private function checkDatabaseConnection(Request $request)
    {
        $connection = $request->get('database_connection');
        $settings = config("database.connections.$connection");
        config([
            'database' => [
                'default' => $connection,
                'connections' => [
                    $connection => array_merge($settings, [
                        'driver' => $connection,
                        'host' => $request->input('database_hostname'),
                        'port' => $request->input('database_port'),
                        'database' => $request->input('database_name'),
                        'username' => $request->input('database_username'),
                        'password' => $request->input('database_password'),
                    ]),
                ],
            ],
        ]);
        try {
            DB::connection()->getPdo();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
