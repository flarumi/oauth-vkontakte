<?php

namespace Flarumi\OauthVkontakte;

use Illuminate\Support\ServiceProvider;


class OauthVkontakteServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->tag([
            Providers\Vkontakte::class,
        ], 'fof-oauth.providers');
    }
}
