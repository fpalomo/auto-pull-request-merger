<?php

namespace Listener;

/**
 * ANY NEW LISTENER HAS TO BE DEFINED IN THIS CLASS
 */
class All extends \Library\System\SingleData
{

    protected static $data = array(
        'Listener\ListenerHipChat' => null,
        'Listener\FileSystemLog' => array("\Library\System\SystemDateTime"),
        'Listener\ScreenLog' => array("\Library\System\SystemDateTime")
    );


}