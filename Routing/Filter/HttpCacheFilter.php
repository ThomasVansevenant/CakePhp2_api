<?php

App::uses('DispatcherFilter', 'Routing');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HttpCacheFilter
 *
 * @author thomas
 */
class HttpCacheFilter extends DispatcherFilter {

    public function afterDispatch(CakeEvent $event) {
        $request = $event->data['request'];
        $response = $event->data['response'];
        
      if($request->is('get')){
          return;          
      }

        if ($response->statusCode() === 200) {
            $response->sharable(true);
            $response->expires(strtotime('+1 day'));
        }
    }
}
