# apcupsd
APC UPS plugin for OPNsense

This plugin allows you to configure a APC UPS for use with OPNsense. The setup page allows you to set the most common options for connecting your UPS to your OPNsense server.

You will need the apcupsd package installed - currently version 3.14.14_4.

This is the main settings page:

![apcupsd settings](https://github.com/Gibbon99/apcupsd/blob/master/Docs/apcupsd_settings.png?raw=true)

These are the advanced options available:

![apcupsd advanced settings](https://github.com/Gibbon99/apcupsd/blob/master/Docs/apcupsd_adv.png?raw=true)

The status page shows you information about the connected UPS:

![UPS Status](https://github.com/Gibbon99/apcupsd/blob/master/Docs/apcupsd_status.png?raw=true)



I use the OPNsense monit service to control the running of the apcupsd service.  You will need to enable the APC NIS server for this to work - the monit daemon polls the UPS service on port 3551 ( default ) to see if it is running or not.

The monit service can be configured like this:

![Monit service config](https://github.com/Gibbon99/apcupsd/blob/master/Docs/monit_apc.png)

You can add a new Service Test to ensure that the apcupsd daemon starts up, and Monit will restart it should it crash.

![Monit Service Test](https://github.com/Gibbon99/apcupsd/blob/master/Docs/monit_apc_test.png?raw=true)


This is my first attempt at an OPNsense plugin - I wrote this becuase the NUT package would continually disconnect after configuring it for my UPS. I have been running apcupsd for several weeks now, and it has not failed once.


