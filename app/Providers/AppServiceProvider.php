<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;
use App\Setting;
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
        $settings = Cache::rememberForever('settings', function(){
            $items = Setting::get()->toArray();
            $settings = [];
            if( $items !== null ){
                foreach( $items as $k => $v ){
                    $settings[$v['name']] = is_array(json_decode($v['value'],true)) ? json_decode($v['value'],true) : $v['value'];
                }
            }
            return $settings;
        });
        config()->set('settings',$settings);
        if(@$settings['email_host']) config()->set('mail.host',$settings['email_host']);
        if(@$settings['email_port']) config()->set('mail.port',$settings['email_port']);
        if(@$settings['email_smtpsecure']) config()->set('mail.encryption',$settings['email_smtpsecure']);
        if(@$settings['email_username']) config()->set('mail.username',$settings['email_username']);
        if(@$settings['email_password']) config()->set('mail.password',$settings['email_password']);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
