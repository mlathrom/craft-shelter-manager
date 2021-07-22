<?php
/**
 * Shelter Manager plugin for Craft CMS 3.x
 *
 * Adds animals from shelter manager to Craft CMS.
 *
 * @link      mlathrom.com
 * @copyright Copyright (c) 2021 Matt Lathrom
 */

namespace mlathrom\sheltermanager\controllers;

use mlathrom\sheltermanager\ShelterManager;

use Craft;
use craft\web\Controller;

/**
 * SyncAnimals Controller
 *
 * Generally speaking, controllers are the middlemen between the front end of
 * the CP/website and your plugin’s services. They contain action methods which
 * handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering
 * post data, saving it on a model, passing the model off to a service, and then
 * responding to the request appropriately depending on the service method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what
 * the method does (for example, actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 *
 * @author    Matt Lathrom
 * @package   ShelterManager
 * @since     1.0.0
 */
class SettingsController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['index', 'do-something'];

    // Public Methods
    // =========================================================================

    /**
     * Handle a request going to our plugin's index action URL,
     * e.g.: actions/shelter-manager/sync-animals
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $result = 'Welcome to the SyncAnimalsController actionIndex() method';

        return $result;
    }

    /**
     * Handle a request going to our plugin's actionDoSomething URL,
     * e.g.: actions/shelter-manager/sync-animals/do-something
     *
     * @return mixed
     */
    public function actionDoSomething()
    {
        $result = 'Welcome to the SyncAnimalsController actionDoSomething() method';

        return $result;
    }
}
