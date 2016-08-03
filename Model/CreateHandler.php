<?php

App::import('Model', 'MethodeHandler');
App::uses('AppModel', 'Model');

/**
 * Description of CreateHandler
 *
 * @author thomas
 */
class CreateHandler extends AppModel implements MethodeHandler{
    private $url = '/items/'; 
    
    public function handle(ApiController $controller) {
        return $this->requestAction($this->url);
    }

}
