<?php

App::uses('AppController', 'Controller');

/**
 * Items Controller
 *
 * @property Item $Item
 * @property RequestHandlerComponent $RequestHandler
 */
class ItemsController extends AppController {

    /**
     * RequestHandler component 
     * is required to process the REST resource request.
     */
    public $components = array('RequestHandler');

    /**
     * $this->RequestHandler->ext = 'json';
     * removes the .json extension when calling the api
     * 
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->RequestHandler->ext = 'json';
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $items = $this->Item->find('all');
        $result = Hash::extract($items, '{n}.Item');        
        $this->setOutput($result);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $item = $this->Item->findById($id);
        $result = Hash::extract($item, 'Item');
        
        $this->setOutput($result);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->Item->create();
        if ($this->Item->save($this->request->data)) {
            $message = 'Item saved';
        } else {
            $message = 'Error on adding item';
        }        
        
        $this->setOutput($message);
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->Item->id = $id;
        if ($this->Item->save($this->request->data)) {
            $message = 'Item edited';
        } else {
            $message = 'Error editing item';
        }
        
        $this->setOutput($message);
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        if ($this->Item->delete($id)) {
            $message = 'Item deleted';
        } else {
            $message = 'Error deleting item';
        }
        
        $this->setOutput($message);
    }
    
    /**
     * setOutput methode
     * 
     * @param type $result
     * 
     * sets output to json
     */
    private function setOutput($result){
        $this->set(array(
            'items' => $result,
            '_serialize' => 'items'
        ));
    }
}
