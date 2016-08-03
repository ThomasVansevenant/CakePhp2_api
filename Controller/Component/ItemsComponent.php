<?php

App::uses('Component', 'Controller');
App::import('Controller', 'Items');
App::import('Model', 'MethodeClient');
App::import('Model', 'EditHandler');
App::import('Model', 'ItemsHandler');
App::import('Model', 'ItemByIdHandler');
App::import('Model', 'DeleteHandler');
App::import('Model', 'CreateHandler');


/**
 * Description of ItemsComponent
 *
 * @author thomas
 */
class ItemsComponent extends Component {

    public $status = 'success';
    private $apiController;
    private $methodeClient;

    function initialize(Controller $controller) {
        $this->apiController = $controller;
    }

    public function items() {
        return $this->methodeHandler(new ItemsHandler());
    }

    public function itemById($args) {

        $itemHandler = new ItemByIdHandler();
        $itemHandler->setId($args['id']);
        return $this->methodeHandler($itemHandler);
    }

    public function create() {
        return $this->methodeHandler(new CreateHandler());
    }

    public function edit() {
        return $this->methodeHandler(new EditHandler());
    }

    public function delete($args) {
        $deleteHandler = new ItemByIdHandler();
        $deleteHandler->setId($args['id']);
        return $this->methodeHandler($deleteHandler);
    }

    private function methodeHandler(MethodeHandler $methode) {
        $this->methodeClient = new MethodeClient();
        $this->methodeClient->setMethode($methode);
        return $this->methodeClient->handle($this->apiController);
    }

}
