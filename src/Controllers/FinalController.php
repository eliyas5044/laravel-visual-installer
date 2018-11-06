<?php

namespace Eliyas5044\LaravelVisualInstaller\Controllers;

use Illuminate\Routing\Controller;
use Eliyas5044\LaravelVisualInstaller\Helpers\EnvironmentManager;
use Eliyas5044\LaravelVisualInstaller\Helpers\FinalInstallManager;
use Eliyas5044\LaravelVisualInstaller\Helpers\InstalledFileManager;
use Eliyas5044\LaravelVisualInstaller\Events\LaravelVisualInstallerFinished;

class FinalController extends Controller
{

    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     * @param FinalInstallManager $finalInstall
     * @param EnvironmentManager $environment
     * @return mixed
     */
    public function finish(InstalledFileManager $fileManager, FinalInstallManager $finalInstall, EnvironmentManager $environment)
    {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();

        event(new LaravelVisualInstallerFinished);

        return view('vendor.installer.finished', compact('finalMessages', 'finalStatusMessage', 'finalEnvFile'));
    }
}
