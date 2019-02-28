<?php
namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer(
            'layouts.default', 'App\Http\View\Composers\DefaultLayoutComposer'
        );
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(){}
}
