<?php

namespace Tests;

use Listener;
use Library\System;
use Phake;

class FileSystemLogTest extends \Tests\BaseTestDefinition
{

    protected function cleanOutputFile($fileName)
    {
        file_put_contents($fileName, "");
    }

    public function testPrintLn()
    {

        $message = "Hello World";
        $now = "2013-12-01 12:23:34";
        $outputFileName = "testOuput.log";
        $this->cleanOutputFile($outputFileName);

        $systemDateTimeMock = \Phake::mock("Library\System\SystemDateTime");
        Phake::when($systemDateTimeMock)->now()
            ->thenReturn($now);


        $fileSystemLog = new Listener\FileSystemLog($systemDateTimeMock, $outputFileName);

        $fileSystemLog->printLn($message);

        Phake::verify($systemDateTimeMock)->now();


        $fileExists = file_exists($outputFileName);
        $this->assertTrue($fileExists);

        $fileContent = file_get_contents($outputFileName);
        $outputMsg = "[" . $now . "] $message\n";
        $this->assertEquals($outputMsg, $fileContent);

        unlink($outputFileName);
    }
}