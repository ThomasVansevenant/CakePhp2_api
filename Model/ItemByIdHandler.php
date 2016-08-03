<?php

App::import('Model', 'MethodeHandler');
App::uses('AppModel', 'Model');

/**
 * Description of ItemByIdHandler
 *
 * @author thomas
 */
class ItemByIdHandler extends AppModel implements MethodeHandler {

    private $baseUrl = '/items/';
    private $itemId;

    public function setId($id) {
        $this->itemId = $id;
    }

    public function handle(ApiController $controller) {
        $url = $this->baseUrl . $this->itemId;
        return $this->requestAction($url);
    }

}
