<?php

namespace Drupal\module_recipes\Service;

/**
 * provides a service that provides welcome text.
 */

class WelcomeService{
  
    public function getWelcomeMessage(){
        $welcome="Welcome to my website";
        return $welcome;
    }
}