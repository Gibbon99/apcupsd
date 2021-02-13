#!/usr/local/bin/python3

#
# Support script for the apcupsd plugin
#
# Get the current status from the NIS Server for the UPS
#

import subprocess as sp
import json

result = {}

output = sp.getoutput("/usr/local/sbin/apcaccess")
result['message'] = output
print (json.dumps(result))
