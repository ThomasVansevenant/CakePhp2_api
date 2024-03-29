<?php
App::import('Model', 'MethodeHandler');
App::uses('AppModel', 'Model');

/**
 * Handles get all items request
 *
 * @author thomas
 */
class ItemsHandler extends AppModel implements MethodeHandler {
    private $baseUrl = '/items/'; 
    
    public function handle(ApiController $controller) {
        return $this->requestAction($this->baseUrl);
    }

}
