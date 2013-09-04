# only pass pull requests when the CI tool marks the build as stable
force_build_confirmation: false

# over this number of open pull requests the script will trigger a notification event
max_open_pull_requests: 25

# this is the HipChat token of the room you want to be notified
hipchat_token: 'e1'
hipchat_room: 'work-room'
hipchat_reporter_name: 'auto-merger'

# this is the number of positive reviews you require to merge the pull request
required_positive_reviews: 1
# any of these characters in a comment will be considered a positive code review comment
valid_positive_code_review_messages: [':+1:', '+1']
# any of these characters in a comment will be considered a negative code review comment
valid_blocker_code_review_messages: ["[B]", "[b]" ]
# is uat ok message required to merge?
uat_is_required_to_merge: 0
# any of these characters in a comment will be considered a UAT OK from the product owner
valid_uat_ok_messages: ["UAT OK"]
# will merge with uat ok message
merge_with_uat_message: 1

# GitHub repository info
github_user: 'myUser'
github_password: 'myPass'
github_repository_owner: 'Company'
github_repository_name: 'repo'


# file system log
file_system_log_path: '/tmp/myPRMerger.log'

# example for jira
issue_tracker_number_format: "/\#[A-Za-z]+\-[0-9]+/"

