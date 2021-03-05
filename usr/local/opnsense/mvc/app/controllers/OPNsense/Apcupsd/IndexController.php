<?php

namespace OPNsense\apcupsd;

class IndexController extends \OPNsense\Base\IndexController
{
    public function indexAction()
    {
        // pick the template to serve to our users.
        $this->view->pick('OPNsense/Apcupsd/index');
        $this->view->generalForm = $this->getForm("general");
    }
}

