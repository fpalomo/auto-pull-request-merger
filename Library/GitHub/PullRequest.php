<?php

namespace Library\GitHub;

use App;
use Library\System;

class PullRequest
{

    protected $number;

    protected $gitHubAdapter;
    protected $apiPullRequest;
    protected $pullRequestComments;

    public function __construct($gitHubAdapter, $pullRequest)
    {
        $this->gitHubAdapter = $gitHubAdapter;
        $this->apiPullRequest = $pullRequest;
        $this->number = $this->apiPullRequest->number;
        $this->sha = $this->apiPullRequest->head->sha;

    }

    public function canBeMerged()
    {
        $canBeMerged = false;
        App::log("Checking if pull request $this->number can be merged");
        if ($this->hasPassedCodeReview()) {
            App::dispatchEvent(System\Event::CODE_REVIEW_PASSED, array("pr_number" => $this->number));
            $canBeMerged = true;
            $uatIsRequired = App::config()->get("uat_is_required_to_merge");
            if ($uatIsRequired) {
                if ($this->hasPassedUAT()) {
                    App::dispatchEvent(System\Event::CAN_MERGE_PULL_REQUEST, array("pr_number" => $this->number));
                    $canBeMerged = true;
                }
            }
        } else {
            $canBeMerged = false;
            App::dispatchEvent(System\Event::CANNOT_MERGE_PULL_REQUEST, array("pr_number" => $this->number));
        }

        return $canBeMerged;

    }

    /**
     * @return array of Library\Github\PullRequestComment
     */
    public function comments()
    {
        $this->pullRequestComments = array();
        $comments = $this->gitHubAdapter->pullRequestComments($this->number);
        foreach ($comments as $pullRequestCommentApiObj) {
            $this->pullRequestComments[] = new PullRequestComment($pullRequestCommentApiObj);
        }

        return $this->pullRequestComments;
    }


    public function hasPassedCodeReview()
    {
        $pluses = 0;
        $blocker = false;

        $forceConfirmation = App::config()->get("force_build_confirmation");
        if (!$this->buildIsOk() and $forceConfirmation) {
            App::log("Pull request " . $this->number . " has no build success confirmation message");

            return false;
        }

        foreach ($this->comments() as $comment) {
            if ($comment->isAValidCodeReviewOKComment()) {
                ++$pluses;
                $blocker = false;
            } else {
                if ($comment->isAValidCodeReviewBlockerComment($comment)) {
                    App::log("Blocker found");
                    $blocker = true;
                    break;
                }
            }
        }

        $requiredPositiveReviews = App::config()->get("required_positive_reviews");
        if ($pluses >= $requiredPositiveReviews && !$blocker) {
            return true;
        }

        App::log("Pull request " . $this->number . " has only $pluses positive reviews");

    }


    /**
     * @return bool CI suite confirms the build is OK to be merged
     */
    public function buildIsOk()
    {
        $shaIdentifier = $this->gitHubAdapter->getStatus($this->sha);

        return (!empty($shaIdentifier) && $shaIdentifier->state == 'success');
    }

    public function hasPassedUAT()
    {
        foreach ($this->comments() as $comment) {

            if ($comment->isAValidUATOKComment()) {
                return true;
            }
        }

        return false;
    }


    public function merge()
    {
        $this->gitHubAdapter->merge($this->number);
        App::log("merging pull request $this->number");
        App::dispatchEvent("merged_pull_request", array($this->number));
    }


    public function addComment($message)
    {

        return $this->gitHubAdapter->addComment($this->number, $message);
    }

    public function findIssueTrackerNumber()
    {
        $issueNumber = null;
        $title = $this->apiPullRequest->title;
        if (preg_match(App::config()->get("issue_tracker_number_format"), $title, $matches)) {
            $issueNumber = $matches[0];
        }
        $issueNumber = trim($issueNumber, "#");

        return $issueNumber;

    }


    public function getId()
    {
        return $this->number;
    }

}
