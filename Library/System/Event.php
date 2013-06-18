<?php

namespace Library\System;

/**
 *  System events class
 */
class Event extends \Library\System\SingleData
{

    const CANNOT_MERGE_PULL_REQUEST = 1001;
    const CODE_REVIEW_PASSED = 1002;
    const PULL_REQUEST_MERGED = 1003;
    const TOO_MANY_OPEN_PULL_REQUESTS = 1004;
    const NO_PULL_REQUESTS_TO_PARSE = 1005;
    const CODE_REVIEW_FAILED = 1006;
    const LOG = "log";


    // generic events thrown by the application
    protected static $data = array(
        self::CANNOT_MERGE_PULL_REQUEST,
        self::PULL_REQUEST_MERGED,
        self::TOO_MANY_OPEN_PULL_REQUESTS,
        self::NO_PULL_REQUESTS_TO_PARSE,
        self::CODE_REVIEW_PASSED,
        self::CODE_REVIEW_FAILED,
        'log'
    );


    /**
     * @param string $event event title to add
     * @return bool the event has been added
     */
    public function add($event)
    {

        $eventAdded = false;
        if ($this->isValid($event)) {
            array_push(self::$data, $event);
            $eventAdded = true;
        }

        return $eventAdded;
    }

    /**
     * @param string $event ensure the object matches the required conditions: format , etc...
     * @return bool the parameter matches
     */
    public function isValid($event)
    {
        return is_string($event);
    }
}