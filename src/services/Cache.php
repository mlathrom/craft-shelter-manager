<?php
/**
 * Shelter Manager plugin for Craft CMS 3.x
 *
 * Adds animals from shelter manager to Craft CMS.
 *
 * @link      mlathrom.com
 * @copyright Copyright (c) 2021 Matt Lathrom
 */


namespace mlathrom\sheltermanager\services;

use Craft;
use Exception;
use yii\base\Component;
use DateInterval;
use DateTime;
use yii\caching\TagDependency;

/**
 * Api Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Matt Lathrom
 * @package   ShelterManager
 * @since     0.0.1
 */
class Cache extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * Get cache
     *
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return Craft::$app->cache->get($key);
    }

    /**
     * Set cache
     *
     * @param      $key
     * @param      $value
     * @param null $expire
     * @return bool
     * @throws Exception
     */
    public function set($key, $value, $expire = null): bool
    {

        if (!$expire) {
            $duration = 'P11D';
            $date = new DateTime;
            $current = $date->getTimestamp();
            $date->add(new DateInterval($duration));
            $durationToSeconds = $date->getTimestamp() - $current;

            $expire = $durationToSeconds;
        }

        return Craft::$app->cache->set($key, $value, $expire, new TagDependency(['tags' => 'sheltermanager']));
}
}