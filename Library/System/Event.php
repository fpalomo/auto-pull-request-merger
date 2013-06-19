<?php

namespace Library\System;

/**
 *  System events class
 */
class Event extends \Library\System\SingleData
{

    const CANNOT_MERGE_PULL_REQUEST = "cannot_merge_pr";
    const CODE_REVIEW_PASSED = "code_review_OK";
    const PULL_REQUEST_MERGED = "pr_merged";
    const TOO_MANY_OPEN_PULL_REQUESTS = "too_many_open_pr";
    const NO_PULL_REQUESTS_TO_PARSE = "no_pr_to_parse";
    const CODE_REVIEW_FAILED = "code_review_KO";
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