<?php

namespace OPNsense\apcupsd\Api;

use OPNsense\Base\ApiControllerBase;
use OPNsense\Apcupsd\apcupsd;
use OPNsense\Core\Config;

class SettingsController extends ApiControllerBase
{
    /**
     * retrieve apcupsd general settings
     * @return array general settings
     */
    public function getAction()
    {
        // define list of configurable settings
        $result = [];
        if ($this->request->isGet()) {
            $mdlapcupsd = new apcupsd();
            $result['apcupsd'] = $mdlapcupsd->getNodes();
        }
        return $result;
    }

    /**
     * update apcupsd settings
     * @return array status
     */
    public function setAction()
    {
        $result = ["message" => "failed to set"];
        if ($this->request->isPost()) {
            // load model and update with provided data
            $mdlapcupsd = new apcupsd();
            $mdlapcupsd->setNodes($this->request->getPost("apcupsd"));

            // perform validation
            $valMsgs = $mdlapcupsd->performValidation();
            foreach ($valMsgs as $field => $msg) {
                if (!array_key_exists("validations", $result)) {
                    $result["validations"] = [];
                }
                $result["validations"]["general." . $msg->getField()] = $msg->getMessage();
            }

            // serialize model to config and save
            if ($valMsgs->count() == 0) {
                $mdlapcupsd->serializeToConfig();
                Config::getInstance()->save();
                $result["message"] = "Settings saved. Service will need to be restarted.";
            }
        }
        return $result;
    }
}

