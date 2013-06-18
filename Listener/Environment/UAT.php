<?php

namespace Listener\Environment;

use \Listener;
use App;
use Library\System;

class UAT implements \Listener\ListenerInterface
{

    public function eventList()
    {
        return array(
            System\Event::CODE_REVIEW_PASSED => 'createUATEnvironment'
        );
    }


    public function createUATEnvironment($params)
    {

        if (isset($params["pr_number"])){
            $pullRequestNumber = $params["pr_number"];
        }
        if (isset($params["issue_tracker_number"])){
            $issueTrackerNumber = $params["issue_tracker_number"];
        }


        // basic version, only checkout the code
        if (empty($issueTrackerNumber)) {
            $issueTrackerNumber = "pull-request-$pullRequestNumber";
            $cannotFindIssueMessage = "Cannot find issue number for Pull Request $pullRequestNumber. "
                . " creating branch with name $issueTrackerNumber name";
            App::log($cannotFindIssueMessage);
        }
        $shellCommand = "./prepareTestEnv.sh $pullRequestNumber $issueTrackerNumber";
        $message = "Preparing local branch $issueTrackerNumber merging master branch "
            . "with pull request $pullRequestNumber\n";
        App::log($message);
        shell_exec($shellCommand);
    }


}