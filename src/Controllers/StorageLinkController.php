<?php

namespace Eliyas5044\LaravelVisualInstaller\Controllers;

use App\Http\Controllers\Controller;
use Eliyas5044\LaravelVisualInstaller\Helpers\StorageLinkManager;

class StorageLinkController extends Controller
{
    /**
     * @var StorageLinkManager
     */
    protected $StorageLinkManager;

    /**
     * StorageLinkController constructor.
     * @param StorageLinkManager $storageLinkManager
     */
    public function __construct(StorageLinkManager $storageLinkManager)
    {
        $this->StorageLinkManager = $storageLinkManager;
    }

    /**
     * Show storage link page.
     *
     * @return mixed
     */
    public function storageLink()
    {
        return view('vendor.installer.storage-link');
    }

    /**
     * Generate storage link.
     *
     * @return mixed
     */
    public function makeLinks()
    {
        $message = $this->StorageLinkManager->makeLinks();

        return redirect()->route('LaravelVisualInstaller::storage-link')
            ->with(['message' => $message]);
    }
}