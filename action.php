<?php

use dokuwiki\plugin\oauth\Adapter;
use dokuwiki\plugin\oauthdoorkeeper\DoorKeeper;

/**
 * Service Implementation for oAuth Doorkeeper authentication
 */
class action_plugin_oauthdoorkeeper extends Adapter
{

    /** @inheritdoc */
    public function registerServiceClass()
    {
        return DoorKeeper::class;
    }

    /** * @inheritDoc */
    public function getUser()
    {
        $oauth = $this->getOAuthService();
        $data = array();

        $url = $this->getConf('baseurl') . '/api/v1/me.json';


        $raw = $oauth->request($url);
        $result = json_decode($raw, true);

        $data['user'] = 'doorkeeper-' . $result['id'];
        $data['name'] = 'doorkeeper-' . $result['id'];
        $data['mail'] = $result['email'];

        return $data;
    }

    /** @inheritDoc */
    public function getLabel()
    {
        return 'Doorkeeper';
    }

    /** @inheritDoc */
    public function getColor()
    {
        return '#b64145';
    }

}
