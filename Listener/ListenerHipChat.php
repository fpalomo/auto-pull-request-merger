<?php

namespace Listener;
use Library\HipChat;
use Library\System;

class ListenerHipChat implements ListenerInterface
{

    public function eventList()
    {
        // array ("eventName" => "methodToExecute"
        return array(
            System\Event::TOO_MANY_OPEN_PULL_REQUESTS => 'tooManyOpenPullRequests'
        );
    }

    public function tooManyOpenPullRequests()
    {
        return $this->_sendMessage("Too many open pull requests. @all, Please have a look!");
    }

    /**
     * Send a message to HipChat
     * @param string $msg
     *
     * @return null
     */
    protected
    function _sendMessage(
        $msg
    ) {
        try {
            $hc = new \Library\HipChat\HipChat(\App::config()->get("hipchat_token"));
            $hc->message_room(\App::config()->get("hipchat_token"), \App::config()->get("hipchat_reporter_name"), $msg, false, \Library\Hipchat\HipChat::COLOR_RED);
        } catch (\Exception $e) {
            App::log("\n HIPCHAT API NOT RESPONDING");
            App::log($e);
        }
    }
}