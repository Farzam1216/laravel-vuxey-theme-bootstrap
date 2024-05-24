<?php

namespace App\Providers;

use App\Services\Permissions\PermissionInterface;
use App\Services\Permissions\PermissionService;
use App\Services\Roles\RoleInterface;
use App\Services\Roles\RoleService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    //
    $this->app->bind(PermissionInterface::class, PermissionService::class);
    $this->app->bind(RoleInterface::class, RoleService::class);
  }
}
