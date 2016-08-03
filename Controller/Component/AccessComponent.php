<?php

App::uses('Component', 'Controller');
App::uses('Security', 'Utility');
App::uses('ClassRegistry', 'Utility');


/**
 * Prevents access to ItemsController
 *
 * @author thomas
 */
class AccessComponent extends Component {

    public $components = array('Cookie');
    public $status = 'success';

    public function register($args) {
        if (empty($args['username'])) {
            throw new Exception('Missing argument: username');
        }
        if (empty($args['password'])) {
            throw new Exception('Missing argument: password');
        }
        $User = ClassRegistry::init('User');
        $User->create();
        return $User->save(array(
                    'username' => $args['username'],
                    'password' => Security::hash($args['password'], null, true)
        ));
    }

    public function login($args) {
        if (empty($args['username'])) {
            throw new Exception('Missing argument: username');
        }
        if (empty($args['password'])) {
            throw new Exception('Missing argument: password');
        }
        $User = ClassRegistry::init('User');
        $data = $User->find('first', array(
            'conditions' => array(
                'User.username' => $args['username'],
                'User.password' => Security::hash($args['password'], null, true)
            )
        ));
        if (!empty($data)) {
            if (empty($data['User']['token'])) {
                $request = $this->_Collection->getController()->request;
                $data['User']['token'] = md5(uniqid());
                $data['User']['ip'] = $request->clientIp(false);
                $User->save($data);
            }
            $this->Cookie->write('auth_token', $data['User']['token']);
            return true;
        }
        return false;
    }

    public function logout($args) {
        if ($this->Cookie->check('auth_token')) {
            $request = $this->_Collection->getController()->request;
            $User = ClassRegistry::init('User');
            $data = $User->find('first', array(
                'conditions' => array(
                    'User.token' => $this->Cookie->read('auth_token'),
                    'User.ip' => $request->clientIp(false)
                )
            ));
            if (!empty($data)) {
                $data['User']['token'] = null;
                $data['User']['ip'] = null;
                $User->save($data);
                $this->Cookie->delete('auth_token');
                return true;
            }
        }
        return false;
    }

    public function validate($args) {
        if ($this->Cookie->check('auth_token')) {
            $request = $this->_Collection->getController()->request;
            $User = ClassRegistry::init('User');
            $data = $User->find('first', array(
                'conditions' => array(
                    'User.token' => $this->Cookie->read('auth_token'),
                    'User.ip' => $request->clientIp(false)
                )
            ));
            if (!empty($data)) {
                return true;
            }
        }
        return false;
    }

    private function formatArray($array) {
        $data = Hash::extract($array, 'User');
         $data = Hash::remove($data, 'id');
        $data = Hash::remove($data, 'password');
        $data = Hash::remove($data, 'ip');
        $data = Hash::remove($data, 'ip');
        $data = Hash::remove($data, 'created');
        $data = Hash::remove($data, 'modified');
        
        return $data;
    }

}
