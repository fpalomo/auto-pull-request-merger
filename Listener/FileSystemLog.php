<?php

namespace Listener;

use App;
use Library\System;

class FileSystemLog
{

    protected $systemDateTime = null;

    protected $outputFile = null;

    public function __construct(\Library\System\SystemDateTime $systemDateTime = null, $outputFile  = null  )
    {
        if ($systemDateTime !== null) {
            $this->systemDateTime = $systemDateTime;
        } else {
            $this->systemDateTime = new SystemDateTime();
        }

        if ($outputFile)
        {
            $this->outputFile = $outputFile;
        }
        else{
            $this->outputFile = App::config("file_system_log_path");
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
        if (true === file_put_contents($this->outputFile, $messageLine, FILE_APPEND)) {
            return true;
        }

    }

}