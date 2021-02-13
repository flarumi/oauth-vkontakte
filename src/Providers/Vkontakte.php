<?php

namespace Flarumi\OauthVkontakte\Providers;

use FoF\OAuth\Provider;
use Illuminate\Support\Arr;
use Flarum\Forum\Auth\Registration;
use League\OAuth2\Client\Provider\AbstractProvider;
use J4k\OAuth2\Client\Provider\Vkontakte as VkontakteProvider;

class Vkontakte extends Provider
{

    public function name(): string
    {
        return 'vkontakte';
    }
	
    public function icon(): string
    {
        return "fab fa-vk";
    }
	
    public function link(): string
    {
        return 'https://vk.com/apps?act=manage';
    }

    public function fields(): array
    {
        return [
            'client_id'     => 'required',
            'client_secret' => 'required',
        ];
    }
	
   public function provider(string $redirectUri): AbstractProvider
    {
        return new VkontakteProvider([
            'clientId'       => $this->getSetting('client_id'),
            'clientSecret'   => $this->getSetting('client_secret'),
            'redirectUri'    => $redirectUri,
            'version'        => '5.130',
        ]);
    }

    public function suggestions(Registration $registration, $user, string $token)
    {
        $reg =  $registration->provideAvatar(Arr::get($user->toArray(), 'photo_100'))->suggestUsername($user->getName());
        empty($user->getEmail()) ?  $reg->suggestEmail('') : $reg->provideTrustedEmail($user->getEmail());
        $reg->setPayload($user->toArray());
    }
}
