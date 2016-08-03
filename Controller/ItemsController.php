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
     * Gets all the items
     * @return void
     */
    public function index() {

        $items = $this->Item->find('all');
        if (isset($this->params['requested']) && $this->params['requested'] == 1) {
            $result = Hash::extract($items, '{n}.Item');
            return $result;
        } else {
            $items = $this->Item->find('all');
            $result = Hash::extract($items, '{n}.Item');

            $this->setOutput($message);
        }
    }

    /**
     * view method
     * Gets item by id
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {

        $item = $this->Item->findById($id);
        if (isset($this->params['requested']) && $this->params['requested'] == 1) {
            $result = Hash::extract($item, 'Item');
            return $result;
        } else {
            $item = $this->Item->findById($id);
            $result = Hash::extract($item, 'Item');
            $this->setOutput($result);
        }
    }

    /**
     * add method
     * Adds an item
     * @return void
     */
    public function add() {


        if (isset($this->params['requested']) && $this->params['requested'] == 1) {
            $this->Item->create();
            if ($this->Item->save($this->request->data)) {
                $message = 'Item saved';
            } else {
                $message = 'Error adding item';
            }
            return $message;
        } else {
            $this->log('komt in else', 'debug');
            $this->Item->create();
            if ($this->Item->save($this->request->data)) {
                $message = 'Item saved';
            } else {
                $message = 'Error on adding item';
            }
            $this->setOutput($message);
        }
    }

    /**
     * edit method
     * edits an item
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {

        if (isset($this->params['requested']) && $this->params['requested'] == 1 && $this->params['data']) {
            $this->Item->id = $id;
            if ($this->Item->save($this->request->data)) {
                $message = 'Item edited';
            } else {
                $message = 'Error editing item';
            }
            return $message;
        } else {
            $this->Item->id = $id;
            if ($this->Item->save($this->request->data)) {
                $message = 'Item edited';
            } else {
                $message = 'Error editing item';
            }
            $this->setOutput($message);
        }
    }

    /**
     * delete method
     * deletes an item
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {

        if (isset($this->params['requested']) && $this->params['requested'] == 1) {
            if ($this->Item->delete($id)) {
                $message = 'Item deleted';
            } else {
                $message = 'Error deleting item';
            }
            return $message;
        } else {
            if ($this->Item->delete($id)) {
                $message = 'Item deleted';
            } else {
                $message = 'Error deleting item';
            }

            $this->setOutput($message);
        }
    }

    /**
     * setOutput methode
     * Helper methode. Prints the output to a json string
     * @param type $result
     * 
     * sets output to json
     */
    private function setOutput($result) {
        $this->set(array(
            'items' => $result,
            '_serialize' => 'items'
        ));
    }

}
