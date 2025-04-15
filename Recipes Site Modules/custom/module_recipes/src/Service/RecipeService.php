<?php

namespace Drupal\module_recipes\Service;
use Drupal\module_recipes\Service\PrepareIngredients;
/**
 * Provides service for prepare recipes
 */

class RecipeService{
protected PrepareIngredients $prepareIngredients;

public function __construct(PrepareIngredients $prepareIngredients){
$this->prepareIngredients=$prepareIngredients;
}
//      public static function create(ContainerInterface $container){
//      return new static(
//    $container->get("module_recipes.prepare_ingredients")
// );
//      }
     public function prepareRecipe($RecipeName){
   $ingredients=$this->prepareIngredients->prepareIngredient($RecipeName);
        $dish="Your recipe {$RecipeName} is Ready to serve";
        return $ingredients ."<br>". $dish;
     }

}