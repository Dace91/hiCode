<?php namespace App\Providers;

use App\Category;
use App\Http\ViewComposer\Active;
use App\Student;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

use View, Form;

class ComposerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.master', function ($view) {
            $view->with('students', Student::current()->get());
        });

        View::composer('partials.nav', function ($view) {
            $view->with('menus', Category::all());
        });

        Form::macro('date', function ($name, $value = '', $options = []) {

            $attr = '';
            foreach ($options as $n => $v) $attr = "\"$n\"=\"$v\" ";

            $value = $value ? Carbon::parse($value)->format('Y-m-d') : Carbon::now()->format('Y-m-d');

            return "<input type=\"date\" value=\"$value\" name=\"$name\" $attr>";
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindShared('active', function ($app) {
            return new Active($app['request']);
        });

        // $this->app->alias('Active', 'App\Http\ViewComposer\Facades\Active');

    }

}
