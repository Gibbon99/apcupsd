# apcupsd
APC UPS plugin for OPNsense

This plugin allows you to configure a APC UPS for use with OPNsense. The setup page allows you to set the most common options for connecting your UPS to your OPNsense server.

I use the OPNsense monit service to control the running of the apcupsd service.  You will need to enable the APC NIS server for this to work - the monit daemon polls the UPS service on port 3551 ( default ) to see if it is running or not.
