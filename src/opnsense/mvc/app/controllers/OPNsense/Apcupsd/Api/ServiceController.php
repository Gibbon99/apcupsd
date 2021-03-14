<?php

namespace OPNsense\apcupsd\Api;

use OPNsense\Core\Backend;
use OPNsense\Base\ApiControllerBase;

class ServiceController extends ApiControllerBase
{
    public function reloadAction()
    {
        $status = "failed";
        if ($this->request->isPost()) {
            $backend = new Backend();
            $bckresult = trim($backend->configdRun("template reload OPNsense/Apcupsd"));
            if ($bckresult == "OK") {
                $status = "ok";
            }
        }
        return ["status" => $status];
    }

    public function statusServiceAction()
    {
        $result['message'] = 'Unable to run serviceStatus action.';
        if ($this->request->isPost()) {
            $backend = new Backend();
            $result['message'] = trim($backend->configdRun("apcupsd statusService"));
        }
        return $result;
    }

    public function stopServiceAction()
    {
        $result['message'] = 'Unable to run stopService action.';
        if ($this->request->isPost()) {
            $backend = new Backend();
            $result['message'] = trim($backend->configdRun("apcupsd stopService"));
        }
        return $result;
    }

    public function startServiceAction()
    {
        $result['message'] = 'Unable to run startService action.';
        if ($this->request->isPost()) {
            $backend = new Backend();
            $result['message'] = trim($backend->configdRun("apcupsd startService"));
        }
        return $result;
    }

    public function restartServiceAction()
    {
        $result['message'] = 'Unable to run restartService action.';
        if ($this->request->isPost()) {
            $backend = new Backend();
            $result['message'] = trim($backend->configdRun("apcupsd restartService"));
        }
        return $result;
    }

    public function getUpsStatusAction()
    {
        $result['message'] = 'Unable to run upsStatus action.';
        if ($this->request->isPost()) {
            $backend = new Backend();
            $result['message'] = trim($backend->configdRun("apcupsd getNisStatus"));
        }
        return $result;
    }
}
