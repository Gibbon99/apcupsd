<?php

/*
 * Copyright (C) 2017 EURO-LOG AG
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED ``AS IS'' AND ANY EXPRESS OR IMPLIED WARRANTIES,
 * INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY,
 * OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

/*
* This file belongs at /usr/local/etc/inc/plugins.inc.d/
/*

/**
 * register service
 * @return array
 */
function apcupsd_services()
{
    global $config;

    $services = array();

    if (
        isset($config['OPNsense']['apcupsd']['general']['Enabled']) &&
        $config['OPNsense']['apcupsd']['general']['Enabled'] == 1
    ) {
        $services[] = array(
                'description' => gettext('APC UPS Daemon'),
                'configd' => array(
                        'restart' => array('apcupsd restartService'),
                        'start' => array('apcupsd startService'),
                        'stop' => array('apcupsd stopService'),
                ),
                'name' => 'apcupsd',
        );
    }
    return $services;
}

/**
 *  sync configuration via xmlrpc
 * @return array
 */
function apcupsd_xmlrpc_sync()
{
    $result = array();

    $result[] = array(
        'description' => gettext('APC UPS Daemon'),
        'section' => 'OPNsense.apcupsd',
        'id' => 'apcupsd',
        'services' => ["apcupsd"],
    );

    return $result;
}

