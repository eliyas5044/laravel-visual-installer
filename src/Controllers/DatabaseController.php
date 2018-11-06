<?php

namespace Eliyas5044\LaravelVisualInstaller\Controllers;

use Illuminate\Routing\Controller;
use Eliyas5044\LaravelVisualInstaller\Helpers\DatabaseManager;

class DatabaseController extends Controller
{
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * Migrate and seed the database.
     *
     * @return \Illuminate\View\View
     */
    public function database()
    {
        $response = $this->databaseManager->migrateAndSeed();

        return redirect()->route('LaravelVisualInstaller::final')
            ->with(['message' => $response]);
    }
}
