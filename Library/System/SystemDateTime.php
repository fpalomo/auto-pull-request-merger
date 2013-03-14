<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 13/03/13
 * Time: 17:09
 * To change this template use File | Settings | File Templates.
 */

namespace Library\System;


class SystemDateTime {

    public function __construct()
    {

    }

    public function now()
    {
        return date("Y-m-d H:i:s");
    }


}