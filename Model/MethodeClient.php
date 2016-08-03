<?php
App::import('Model', 'MethodeHandler');
App::uses('AppModel', 'Model');

/**
 * Facade for methode handling
 *
 * @author thomas
 */
class MethodeClient {

    private $methode;

    function setMethode(MethodeHandler $methode) {
        $this->methode = $methode;
    }

    function handle(ApiController $controller) {
        return $this->methode->handle($controller);
    }
    

}
