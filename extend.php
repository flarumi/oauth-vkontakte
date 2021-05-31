<?php

namespace Flarumi\OauthVkontakte;

use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->css(__DIR__ . '/resources/less/forum.less'),
    new Extend\Locales(__DIR__ . '/resources/locale'),
    (new Extend\ServiceProvider())
        ->register(OauthVkontakteServiceProvider::class),
];
