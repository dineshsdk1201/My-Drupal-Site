<?php
 
namespace Drupal\module_recipes\Service;
 
class MyCustomService {
  public $name;
  public function getRecipeMessage($recipeName) {
    return "The recipe for {$recipeName} is delicious!";
  }


  public function getMessage(){
    return "I am a custom service developed by me";
  }

  public function setName($name){
  
    $this->name=$name;
  }
  public function getName(){
    return $this->name;
  }
}

