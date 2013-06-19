[![Build Status](https://travis-ci.org/fpalomo/auto-pull-request-merger.png)](https://travis-ci.org/fpalomo/auto-pull-request-merger)

This simple script will parse every open pull request in a given GitHub repository. It will check if the build has been reported as successful
successful by your CI tool , and also if it has passed your code review process. ( Usually by adding any special character as a comment )



This is a tool that came out after some work from the guys at Splendia back in 2012, specially :
=====
Adrià Cidre, https://github.com/adriacidre
Natxo Treig, https://github.com/natxetee
Christof Damian, https://github.com/christofdamian , who already released another tool based in that work.


USAGE:

  ./auto-merge \<GitHubUser\> \<GitHubPassword\> \<owner\> \<repo\> OR

  ./auto-merge  , when config/config.yaml contains the required parameters.

all parameters can be set at Commands/Merge.php
  
  you can also use ./auto-merge --debug if you want to see debug messages


WARNING: THE CURRENT VERSION IS STILL WORK IN PROGRESS . PLEASE , DOWNLOAD "STABLE" TAG FOR THE LATEST STABLE VERSION



How to extend functionalities
=====

You can define listener to system events at Listener\All.php

If your new classes have dependencies, please define this dependencies with a new file in "Dependency" directory
