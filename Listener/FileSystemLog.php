<?php

namespace Listener;

use App;
use Library\System;

class FileSystemLog
{

    protected $systemDateTime = null;

    protected $outputFile = null;

    public function __construct(\Library\System\SystemDateTime $systemDateTime = null, $outputFile = null)
    {
        if ($systemDateTime !== null) {
            $this->systemDateTime = $systemDateTime;
        } else {
            $this->systemDateTime = new \Library\System\SystemDateTime();
        }

        if ($outputFile) {
            $this->outputFile = $outputFile;
        }
    }


    public function eventList()
    {
        return array(
            "log" => 'printLn'
        );
    }

    protected function loadOutputFile()
    {
        if (empty($this->outputFile)) {
            $this->outputFile = App::config("file_system_log_path");
        }
    }

    public function printLn($message)
    {
        $this->loadOutputFile();
        $messageLine = "[" . $this->systemDateTime->now() . "] $message\n";
        if (true === file_put_contents($this->outputFile, $messageLine, FILE_APPEND)) {
            return true;
        }

    }

}