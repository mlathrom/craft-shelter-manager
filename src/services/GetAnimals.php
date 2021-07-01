<?php
/**
 * Shelter Manager plugin for Craft CMS 3.x
 *
 * Adds animals from shelter manager to Craft CMS.
 *
 * @link      mlathrom.com
 * @copyright Copyright (c) 2021 Matt Lathrom
 */

namespace mlathromsheltermanager\sheltermanager\services;

use mlathromsheltermanager\sheltermanager\ShelterManager;

use Craft;
use craft\base\Component;

/**
 * GetAnimals Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Matt Lathrom
 * @package   ShelterManager
 * @since     1.0.0
 */
class GetAnimals extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     ShelterManager::$plugin->getAnimals->exampleService()
     *
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';
        // Check our Plugin's settings for `someAttribute`
        if (ShelterManager::$plugin->getSettings()->someAttribute) {
        }

        return $result;
    }
}
