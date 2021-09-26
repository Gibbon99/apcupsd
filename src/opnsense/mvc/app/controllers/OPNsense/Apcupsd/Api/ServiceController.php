<?php

/**
 *    Copyright (C) 2021 Dan Lundqvist
 *    Copyright (C) 2021 David Berry
 *    Copyright (C) 2021 Nicola Pellegrini <xbb@xbblabs.com>
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

namespace OPNsense\Apcupsd\Api;

use OPNsense\Core\Backend;
use OPNsense\Base\ApiMutableServiceControllerBase;

class ServiceController extends ApiMutableServiceControllerBase
{
    protected static $internalServiceClass = '\OPNsense\Apcupsd\Apcupsd';
    protected static $internalServiceTemplate = 'OPNsense/Apcupsd';
    protected static $internalServiceEnabled = 'general.Enabled';
    protected static $internalServiceName = 'apcupsd';

    public function getUpsStatusAction() {
        $result = $this->getUpsStatusOutput();
        $result['status'] = NULL;
        if (!$result['error']) {
            $result['status'] = $this->parseUpsStatus($result['output']);
        }
        return $result;
    }

    private function parseUpsStatus($statusOutput) {
        $status = array();
        foreach (explode("\n", $statusOutput) as $line) {
            $kv = array_map('trim', explode(':', $line, 2));
            $key = $kv[0];
            $value = isset($kv[1]) ? $kv[1] : NULL;
            $norm = $value;
            if (empty($key)) {
                continue;
            }
            if (preg_match('/^((?:[0-9]*[.])?[0-9]+)(?:\s+\w+)?$/i', $value, $matches)) {
                $norm = floatval($matches[1]);
            }
            $status[$key] = array(
                'value' => $value,
                'norm' => $norm
            );
        }
        return $status;
    }

    private function getUpsStatusOutput() {
        $output = $error = NULL;

        if ($this->isEnabled()) {
            $backend = new Backend();
            $output = trim($backend->configdRun('apcupsd upsstatus'));
            if (empty($output)) {
                $error = 'Error: empty output from apcaccess';
            }
        } else {
            $error = 'Error: apcupsd is disabled';
        }

        return array(
            'error' => $error,
            'output' => $output
        );
    }

    private function isEnabled() {
        return $this->getModel()->general->Enabled == '1';
    }
}
