[![Build Status](https://travis-ci.org/fpalomo/auto-pull-request-merger.png)](https://travis-ci.org/fpalomo/auto-pull-request-merger)

This simple script will parse every open pull request in a given GitHub repository. It will check if the build has been reported as successful
successful by your CI tool , and also if it has passed your code review process. ( Usually by adding any special character as a comment )


This is a tool that came out after some work from the guys at Splendia back in 2012, specially :
=====
Adrià Cidre, https://github.com/adriacidre
Natxo Treig, https://github.com/natxetee
Christof Damian, https://github.com/christofdamian , who already released another tool based in that work.


USAGE:

    ./auto-merge 
    ./auto-merge \<GitHubUser\> \<GitHubPassword\> \<owner\> \<repo\>

  The first option will work if you have set all the required parameters in the config file, find it at Config/config.yaml .
  you can also run the tool in debug mode:

    ./auto-merge --debug


How to create new functionalities
=====

The system is based in events that are dispatched under some circunstances. You can add new listeners defining them at Listener\All.php .

If you need to add a new event, you can define it at Library\System\Event.php .

If your new class constructor have dependencies, please define this dependencies with a new file in "Dependency" directory . 
