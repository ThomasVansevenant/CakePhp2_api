<?php

App::uses('DispatcherFilter', 'Routing');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CorsFilter
 *
 * @author thomas
 */
class CorsFilter extends DispatcherFilter {

    /**
     * Handles the Cross-origin resource sharing (CORS)
     * @param CakeEvent $event
     * @return type
     */
    public function beforeDispatch(CakeEvent $event) {

        //Handles the preflight request
        if ($event->data['request']->is('OPTIONS')) {
            $event->stopPropagation();
            $event->data['response']->header(array(
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'PUT, DELETE',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Authorization'
            ));
            return $event->data['response'];
        } else {
            $event->data['response']->header(array(
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'POST, GET, HEAD',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Authorization'
            ));
        }
    }

}
