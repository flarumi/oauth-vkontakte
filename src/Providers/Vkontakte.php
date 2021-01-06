<?php

namespace Flarumi\OauthVkontakte\Providers;

use Flarum\Forum\Auth\Registration;
use Flarum\Settings\SettingsRepositoryInterface;
use FoF\OAuth\Provider;
use League\OAuth2\Client\Provider\AbstractProvider;
use J4k\OAuth2\Client\Provider\VkontakteResourceOwner;
use J4k\OAuth2\Client\Provider\Vkontakte as VkontakteProvider;

class Vkontakte extends Provider
{
	protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    protected $provider;
	
    public function name(): string
    {
        return 'vkontakte';
    }

    public function link(): string
    {
        return 'https://vk-api.readthedocs.io/en/latest/';
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
        return $this->provider = new VkontakteProvider([
            'clientId'        => $this->getSetting('client_id'),
            'clientSecret'    => $this->getSetting('client_secret'),
            'redirectUri'     => $redirectUri,
            'version'         => '5.126',
        ]);
    }

    public function suggestions(Registration $registration, $user, string $token)
    {

        $registration
            ->provideTrustedEmail($user->getEmail())
            ->suggestUsername($user->getName())
            ->provideAvatar(array_get($user->toArray(), 'photo_100'))
            ->setPayload($user->toArray());
    }
}
