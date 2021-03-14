#!/usr/local/bin/python3

#
# Support script for the apcupsd plugin
#
# Get the current status from the NIS Server for the UPS
#

import subprocess

output = subprocess.getoutput("/usr/local/sbin/apcaccess")
print (output)          # Return the string to the php function ( getUpsStatusAction ) within ServiceController.php
