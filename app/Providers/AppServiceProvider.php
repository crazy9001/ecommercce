<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Collective\Html\FormFacade as Form;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->registerCompnnentViews();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerViews();
    }


    public function registerViews()
    {
        $viewPath = public_path('theme');

        $sourcePath = __DIR__.'/../../public/theme';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/public/theme';
        }, \Config::get('view.paths')), [$sourcePath]), 'theme');
    }

    public function registerCompnnentViews()
    {
        Form::component('cFileUpload', 'components.file_upload', ['title', 'name', 'value', 'width', 'height', 'attributes' => []]);
        Form::component('cFileSelect', 'components.file_select', ['title', 'name', 'value', 'width', 'height', 'attributes' =>[]]);
        Form::component('cFileSingle', 'components.file_single', ['title', 'name', 'value', 'width', 'height', 'attributes' =>[]]);
        Form::component('cFileMulti', 'components.file_multi', ['title', 'name', 'value', 'width', 'height', 'attributes' =>[]]);
        Form::component('cTextArea', 'components.textarea', ['title', 'name', 'value', 'attributes' => []]);
        Form::component('cText', 'components.text', ['title', 'name', 'value', 'attributes' => []]);
        Form::component('cPassword', 'components.password', ['title', 'name', 'attributes' => []]);
        Form::component('cNumber', 'components.number', ['title', 'name', 'value', 'attributes' => []]);
        Form::component('cDateTime', 'components.datetime', ['title', 'name', 'value', 'attributes' => []]);
        Form::component('cDateRange', 'components.daterange', ['title', 'name', 'value', 'attributes' => []]);
        Form::component('cTextEditor', 'components.texteditor', ['title', 'name', 'value', 'height', 'attributes' => []]);
        Form::component('cCodeEditor', 'components.codeeditor', ['title', 'name', 'value', 'lang', 'attributes' =>[]]);
        Form::component('cEmail', 'components.email', ['title', 'name', 'value', 'attributes' => []]);
        Form::component('cSwitch', 'components.switch', ['title', 'name', 'value', 'checked','attributes' => []]);
        Form::component('cSelect', 'components.select', ['title', 'name', 'value' => [], 'selected','attributes' => []]);
        Form::component('cSubmit', 'components.submit', ['title','attributes' => []]);
        Form::component('cButton', 'components.button', ['title','attributes' => []]);
        Form::component('cRadio', 'components.radio', ['title', 'name', 'value', 'checked','attributes' => []]);
        Form::component('cCheckbox', 'components.checkbox', ['title', 'name', 'value', 'checked','attributes' => []]);
        Form::component('cConfig', 'components.config', ['config', 'name', 'value', 'attributes' => []]);

        Form::component('cSEO', 'components.seo', ['seo']);

        Form::component('cMenuItem', 'backend.menu.item', ['menu']);
    }

}
