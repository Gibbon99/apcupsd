<?php

namespace OPNsense\apcupsd\Api;

use \OPNsense\Base\ApiMutableModelControllerBase;

class SettingsController extends ApiMutableModelControllerBase
{
	protected static $internalModelClass = '\OPNsense\Apcupsd\apcupsd';
	protected static $internalModelName = 'apcupsd';
}
