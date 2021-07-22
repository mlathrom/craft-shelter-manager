<?php
/**
 * Shelter Manager plugin for Craft CMS 3.x
 *
 * Adds animals from shelter manager to Craft CMS.
 *
 * @link      mlathrom.com
 * @copyright Copyright (c) 2021 Matt Lathrom
 */

namespace mlathrom\sheltermanager\variables;

use GuzzleHttp\Exception\GuzzleException;
use mlathrom\sheltermanager\services\Api;

/**
 * Shelter Manager Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.shelterManager }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    Matt Lathrom
 * @package   ShelterManager
 * @since     1.0.0
 */
class Variables
{
    // Public Methods
    // =========================================================================

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.shelterManager.animals }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.shelterManager.animals() }}
     *
     * @return array
     * @throws GuzzleException
     */
    public function animals(): array
    {
        return Api::instance()->getAnimals();
    }
}
