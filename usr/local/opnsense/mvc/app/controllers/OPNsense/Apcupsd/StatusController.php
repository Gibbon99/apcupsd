<?php

namespace OPNsense\Apcupsd;

/**
 * Class StatusController
 * @package OPNsense\Apcupsd
 */
class StatusController extends \OPNsense\Base\IndexController
{
    /**
     * ups status page
     * @throws \Exception
     */
    public function indexAction()
    {
        $this->view->pick('OPNsense/Apcupsd/status');
    }
}

