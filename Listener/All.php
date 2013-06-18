<?php

namespace Listener;

/**
 * ANY NEW LISTENER HAS TO BE DEFINED IN THIS CLASS
 */
class All extends \Library\System\SingleData
{

    protected static $data = array(
        'Listener\ListenerHipChat'       => null,
        'Listener\ListenerFileSystemLog' => array("\Library\System\SystemDateTime"),
        'Listener\ListenerScreenLog'     => array("\Library\System\SystemDateTime"),

//        'Listener\Environment\UAT'        => null,
    );


}