#!/usr/local/bin/python3

#
# Support script for the apcupsd plugin
#
# Get the current status of the APCUPSD service
#

import subprocess

print (subprocess.getoutput("/usr/sbin/service apcupsd status"))

