<?php

namespace dokuwiki\plugin\oauthdoorkeeper;

use dokuwiki\plugin\oauth\Service\AbstractOAuth2Base;
use OAuth\Common\Http\Uri\Uri;

/**
 * Custom Service for Doorkeeper
 */
class DoorKeeper extends AbstractOAuth2Base
{

    /** @inheritdoc */
    public function getAuthorizationEndpoint()
    {
        $plugin = plugin_load('action', 'oauthdoorkeeper');
        return new Uri($plugin->getConf('baseurl') . '/oauth/authorize');
    }

    /** @inheritdoc */
    public function getAccessTokenEndpoint()
    {
        $plugin = plugin_load('action', 'oauthdoorkeeper');
        return new Uri($plugin->getConf('baseurl') . '/oauth/token');
    }

    /**
     * @inheritdoc
     */
    protected function getAuthorizationMethod()
    {
        return static::AUTHORIZATION_METHOD_QUERY_STRING;
    }
}
