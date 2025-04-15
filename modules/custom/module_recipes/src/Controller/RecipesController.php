<?php
namespace Drupal\module_recipes\Controller;
use Drupal\Core\Controller\ControllerBase;

class RecipesController extends ControllerBase{

    function RecipesList(){
       
        $recipes=[
            ['name'=>'Veg Puloa'],
            ['name'=>'Dosa'],
            ['name'=>'Biryani'],
            ['name'=>'Margherita Pizza'],
            ['name'=>'Chicken Pizza'],
           
        ];

        // $recipesList='<ul>';
        // foreach($recipes as $recipe){
        //     $recipesList .='<li>' . $recipe['name'] . '</li>';

        // }
        // $recipesList .='</ul>';
        
        return [
            ['#type' =>'markup'],
            ['#markup'=>$this->t('Welcome to my new module')],
           
        ];
}
}