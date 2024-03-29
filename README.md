# apcupsd
APC UPS plugin for OPNsense

This plugin allows you to configure a APC UPS for use with OPNsense. The setup page allows you to set the most common options for connecting your UPS to your OPNsense server.

MANUAL INSTALLATION
You will need the apcupsd package installed - currently version 3.14.14_4. ( Run "pkg install apcupsd" from a shell on your server. )
(done automatically when deployed as real opnsense plugin when migration is complete.)


This is the main settings page:

![apcupsd settings](https://github.com/Gibbon99/apcupsd/blob/master/Docs/apcupsd_settings.png?raw=true)

These are the advanced options available:

![apcupsd advanced settings](https://github.com/Gibbon99/apcupsd/blob/master/Docs/apcupsd_adv.png?raw=true)

The status page shows you information about the connected UPS:

![UPS Status](https://github.com/Gibbon99/apcupsd/blob/master/Docs/apcupsd_status.png?raw=true)



I use the OPNsense Monit service to control the running of the apcupsd service.  The Monit service monitors the PID file of the apcupsd daemon, and restarts it should it fail.

The monit service can be configured like this:

![Monit service config](https://github.com/Gibbon99/apcupsd/blob/master/Docs/monit_apc.png)

INSTALLATION

MANUAL INSTALLATION
This should make the apcupsd daemon appear in the Services widget on the dashboard.
Also do a "chmod +x /usr/local/opnsense/scripts/OPNsense/Apcupsd/*.py" to allow script execution.
(done automatically when deployed as real opnsense plugin when migration is complete.)

Until I can work out how to create an installable package, copy the files here to their locations on your server.