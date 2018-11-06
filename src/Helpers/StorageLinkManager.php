<?php

namespace Eliyas5044\LaravelVisualInstaller\Helpers;

use Exception;
use Illuminate\Support\Facades\Artisan;

class StorageLinkManager
{
    /**
     * Generate storage links to public folder.
     *
     * @return mixed
     */
    public function makeLinks()
    {
        return $this->storageLink();
    }

    /**
     * Run storage:link artisan command.
     *
     * @return mixed
     */
    private function storageLink()
    {
        $message = trans('installer_messages.storage_link.success');

        try {
            Artisan::call('storage:link');
        } catch (Exception $e) {
            $message = trans('installer_messages.storage_link.error');
        }

        return $message;
    }
}