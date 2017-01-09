<?php

/**
 * This file is part of the Laravel Blade Directives library.
 *
 * @author     Wilson Pinto <wilsonpinto360@gmail.com>
 * @copyright  2016
 *
 * For the full copyright and license information,
 * please view the LICENSE.md file that was distributed
 * with this source code.
 */

namespace Wilsonpinto\Blade;

use Illuminate\Support\ServiceProvider;
use Wilsonpinto\Blade\Directives\AssignmentDirectives;
use Wilsonpinto\Blade\Directives\IteratorDirectives;

class BladeDirectivesServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/blade-directives.php' => config_path('blade-directives.php')
        ]);

        $blade = $this->app->make('blade.compiler');

        $filesystem = $this->app->make('files');

        $config = $this->app->make('config');

        AssignmentDirectives::register($blade, IteratorDirectives::get($filesystem, $config));
    }
}
