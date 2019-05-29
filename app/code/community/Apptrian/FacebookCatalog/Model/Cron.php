<?php
/**
 * @category  Apptrian
 * @package   Apptrian_FacebookCatalog
 * @author    Apptrian
 * @copyright Copyright (c) 2018 Apptrian (http://www.apptrian.com)
 * @license   http://www.apptrian.com/license Proprietary Software License EULA
 */
class Apptrian_FacebookCatalog_Model_Cron
{
    /**
     * Cron method for executing product feed generation process.
     */
    public function generate()
    {
        $helper           = Mage::helper('apptrian_facebookcatalog');
        
        $extensionEnabled = (int) $helper->getConfig(
            'apptrian_facebookcatalog/general/enabled'
        );
        
        $cronJobEnabled   = (int) $helper->getConfig(
            'apptrian_facebookcatalog/cron/enabled'
        );
            
        if ($extensionEnabled && $cronJobEnabled) {
            try {
                $helper->generate();
                Mage::log('Product Feed generated successfully.');
            } catch (Exception $e) {
                Mage::log($e);
            }
        }
    }
}
