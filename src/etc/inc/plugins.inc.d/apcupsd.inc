<?php

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
                'restart' => array('apcupsd restart'),
                'start' => array('apcupsd start'),
                'stop' => array('apcupsd stop'),
            ),
            'name' => 'apcupsd',
            'pidfile' => '/var/run/apcupsd.pid'
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
