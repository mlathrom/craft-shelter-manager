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
use yii\web\Response;
use GuzzleHttp\Client;
use craft\base\Component;
use GuzzleHttp\Exception\GuzzleException;

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
class Api extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     ShelterManager::$plugin->Api->getAnimals()
     *
     * @return mixed
     * @throws GuzzleException
     * @throws Exception
     */
    
    public $apiUrl = 'https://us09.sheltermanager.com/service';

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function getAnimals()
    {
        $cacheKey = 'sheltermanager';
        $Cache = new Cache();

        // // Try to get response from cache
         $animals = $Cache->get($cacheKey);

         if ($animals) {
             return $animals;
         }

        // Otherwise request the API
        $animalClient = $this->getClient([
            'method' => 'json_shelter_animals',
            'account' => 'kz1405',
            'username' => 'nickl',
            'password' => 'Shelter1',
        ]);

        // Get Shelter Animals
        $animalsResponseJson = $animalClient->request('GET');
        $animalsResponseArray = json_decode($animalsResponseJson->getBody(), true);
        $animalsArray = [];

        foreach ($animalsResponseArray as $animal) {
            $animalEntry = [];
            $animalEntry['name'] = $animal['ANIMALNAME'];
            $animalEntry['sex'] = $animal['SEXNAME'];
            $animalEntry['comments'] = $animal['ANIMALCOMMENTS'];
            $animalEntry['age'] = $animal['ANIMALAGE'];
            $animalEntry['adoptable'] = boolval(!$animal['ISNOTAVAILABLEFORADOPTION']);
            $animalEntry['breed'] = !$animal['BREEDNAME'];
            $animalEntry['id'] = $animal['ID'];
            $animalEntry['species'] = $animal['SPECIESNAME'];
            $animalEntry['dateBroughtIn'] = $animal['DATEBROUGHTIN'];
            $animalEntry['dateOfBirth'] = $animal['DATEOFBIRTH'];
            if ($animal['WEBSITEIMAGECOUNT']) {
                $animalEntry['image'] = $this->apiUrl . '?method=animal_image&account=kz1405&animalid=' . $animal['ID'] . '&seq=1';
            } else {
                $animalEntry['image'] = '';
            }

            array_push($animalsArray, $animalEntry);
        }

        $Cache->set($cacheKey, $animalsArray);

        return $animalsArray;
    }

    public function getAnimalsJson()
    {
        return json_encode($this->getAnimals());
    }

    // Private Methods
    // =========================================================================

    /**
     * Returns the authenticated client.
     *
     * @return Client
     */
    private function getClient($query): Client
    {
        $options = [
            'base_uri' => $this->apiUrl,
            'query' => $query
        ];

        return Craft::createGuzzleClient($options);
    }

}
