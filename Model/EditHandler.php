<?php

App::import('Model', 'MethodeHandler');
App::uses('AppModel', 'Model');


/**
 * Handles edit item requests
 *
 * @author thomas
 */
class EditHandler extends AppModel implements MethodeHandler {
    private $url = '/items/';    
  
    public function handle(ApiController $controller) {
        $data = $controller->request->data;
        $id = $data['id'];
        $url = $this->url . $id;
        return $this->requestAction($url, array('data' => $data));
    }

}
