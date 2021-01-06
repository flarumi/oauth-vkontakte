<?php

namespace Flarumi\OauthVkontakte;

use Flarum\Extend;
use Flarum\Foundation\Application;

return [
    (new Extend\Frontend('forum'))
        ->css(__DIR__ . '/resources/less/forum.less'),
    new Extend\Locales(__DIR__ . '/resources/locale'),
    function (Application $app) {
        $app->register(OauthVkontakteServiceProvider::class);
    }
];
