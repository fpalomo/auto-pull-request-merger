<?php

namespace Listener;

use App;
use Library\System;

class ListenerScreenLog
{

    protected $systemDateTime = null;

    protected $outputFile = null;

    public function __construct(\Library\System\SystemDateTime $systemDateTime = null)
    {
        if ($systemDateTime !== null) {
            $this->systemDateTime = $systemDateTime;
        } else {
            $this->systemDateTime = new \Library\System\SystemDateTime();
        }
    }


    public function eventList()
    {
        return array(
            "log" => 'printLn'
        );
    }

    public function printLn($message)
    {
        $messageLine = "[" . $this->systemDateTime->now() . "] $message\n";
        echo $messageLine;
    }

}