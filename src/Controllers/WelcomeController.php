<?php

namespace Eliyas5044\LaravelVisualInstaller\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    /**
     * Display the installer welcome page.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('vendor.installer.welcome');
    }

}
