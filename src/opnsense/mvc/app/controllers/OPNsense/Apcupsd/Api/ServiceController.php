<?php

/**
 *    Copyright (C) 2021 David Berry
 *    Copyright (C) 2021 Dan Lundqvist
 *
 *    All rights reserved.
 *
 *    Redistribution and use in source and binary forms, with or without
 *    modification, are permitted provided that the following conditions are met:
 *
 *    1. Redistributions of source code must retain the above copyright notice,
 *       this list of conditions and the following disclaimer.
 *
 *    2. Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *
 *    THIS SOFTWARE IS PROVIDED ``AS IS'' AND ANY EXPRESS OR IMPLIED WARRANTIES,
 *    INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 *    AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *    AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY,
 *    OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 *    SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 *    INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 *    CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 *    ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 *    POSSIBILITY OF SUCH DAMAGE.
 *
 */

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
        if ($this->request->isPost()) {
            $backend = new Backend();
            $result = json_decode(trim($backend->configdRun("apcupsd getNisStatus")), true);
            if ($result !== null) {
              return $result;
            }
        }
        return array("message" => "Error: Null result from running apcupsd getNisStatus.");
    }
}
