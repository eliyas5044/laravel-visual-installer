# Laravel Visual Web Installer

[![Latest Stable Version](https://poser.pugx.org/eliyas5044/laravel-visual-installer/v/stable)](https://packagist.org/packages/eliyas5044/laravel-visual-installer)
[![Total Downloads](https://poser.pugx.org/eliyas5044/laravel-visual-installer/downloads)](https://packagist.org/packages/eliyas5044/laravel-visual-installer)
[![License](https://poser.pugx.org/eliyas5044/laravel-visual-installer/license)](https://packagist.org/packages/eliyas5044/laravel-visual-installer)

- [About](#about)
- [Requirements](#requirements)
- [Laravel Compatibility](#laravel-compatibility)
- [Installation](#installation)
- [Extends](#extends)
- [Routes](#routes)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## About

This package was made possible by using [Laravel Installer](https://github.com/rashidlaasri/LaravelVisualInstaller) awesome package. Most code copied from this repository. I just needed more features for my project. So I've made this package.

The current features are :

- Check for server requirements.
- Check for folders permissions.
- Generate storage link to public folder.
- Ability to set database information.
	- .env text editor
	- .env form wizard
- Migrate the database.
- Seed the tables.

## Requirements

* [Laravel 5.7+](https://laravel.com/docs/installation)

## Laravel Compatibility

  Laravel  | Laravel Visual Installer
  :---------|:----------
  5.7      | 1.0 +

## Installation

### Step 1: Install package

Add the package in your composer.json by executing the command.

```bash
composer require eliyas5044/laravel-visual-installer
```

### Step 2: Publish package

Publish the packages views, config file, assets, and language files by executing the command.

```bash
php artisan vendor:publish --tag=laravelinstaller
```

> Note: For **linux** user
```bash
# update user group of laravel project folder
sudo chown -R $USER:www-data /var/www/html/laravel
# give folder permissions
sudo chmod -R 775 storage
sudo chmod -R 775 bootstrap/cache
```

## Extends

If you need extend this package, such as need more `.env` variables, need to override controller method, you can easily extend it.
Create a file `EnvironmentManager` in your _app_ directory and bind it in your `AppServiceProvider`.
```php
use Eliyas5044\LaravelVisualInstaller\Controllers\FinalController;
use Eliyas5044\LaravelVisualInstaller\Helpers\EnvironmentManager;

public function register()
{
    $this->app->bind(EnvironmentManager::class, \App\Helpers\EnvironmentManager::class);
    $this->app->bind(FinalController::class, \App\Http\Controllers\FinalController::class);
}
```
> Override controller method in \App\Http\Controllers\FinalController::class
```php
<?php

namespace App\Http\Controllers;

use Eliyas5044\LaravelVisualInstaller\Events\LaravelVisualInstallerFinished;
use Eliyas5044\LaravelVisualInstaller\Helpers\EnvironmentManager;
use Eliyas5044\LaravelVisualInstaller\Helpers\FinalInstallManager;
use Eliyas5044\LaravelVisualInstaller\Helpers\InstalledFileManager;

class FinalController extends \Eliyas5044\LaravelVisualInstaller\Controllers\FinalController
{
    public function finish(InstalledFileManager $fileManager, FinalInstallManager $finalInstall, EnvironmentManager $environment)
    {
        $finalMessages = $finalInstall->runFinal();
        $finalEnvFile = $environment->getEnvContent();
    
        event(new LaravelVisualInstallerFinished);
    
        return view('vendor.installer.finished', compact('finalMessages', 'finalEnvFile'));
    }
}
```

## Routes

* `/install`
* `/update`

## Usage

* **Install Routes Notes**
	* In order to install your application, go to the `/install` route and follow the instructions.
	* Once the installation has ran the empty file `installed` will be placed into the `/storage` directory. If this file is present the route `/install` will abort to the 404 page.

* **Update Route Notes**
	* In order to update your application, go to the `/update` route and follow the instructions.
	* The `/update` routes counts how many migration files exist in the `/database/migrations` folder and compares that count against the migrations table. If the files count is greater then the `/update` route will render, otherwise, the page will abort to the 404 page.

* Additional Files and folders published to your project :

|File|File Information|
|:------------|:------------|
|`config/installer.php`|In here you can set the requirements along with the folders permissions for your application to run, by default the array contains the default requirements for a basic Laravel app.|
|`public/installer/assets`|This folder contains a css folder and inside of it you will find a `main.css` file, this file is responsible for the styling of your installer, you can override the default styling and add your own.|
|`resources/views/vendor/installer`|This folder contains the HTML code for your installer, it is 100% customizable, give it a look and see how nice/clean it is.|
|`resources/lang/en/installer_messages.php`|This file holds all the messages/text, currently only English is available, if your application is in another language, you can copy/past it in your language folder and modify it the way you want.|

## Contributing

* If you have any suggestions please let me know : https://github.com/eliyas5044/laravel-visual-installer/pulls.

## License

Laravel Visual Web Installer is licensed under the MIT license. Enjoy!
