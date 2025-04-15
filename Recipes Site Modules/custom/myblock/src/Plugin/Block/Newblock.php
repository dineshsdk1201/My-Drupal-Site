<?php

namespace Drupal\myblock\Plugin\Block;

use Drupal\Core\Block\Blockbase;

/**
 * Provides simple block for drupal
 * @Block(
 *   id = "myblock",
 *   admin_label = "MY Block",
 *   category = "Custom Blocks"
 * )
 */

class Newblock extends Blockbase{
    /**
     * (@inheritdoc)
     */
    public function build(){
        
        return[
            '#theme' => 'new_block',
            "#data" => $this->t("A recipe is a formula of ingredients and a list of instructions for creating 
            prepared foods. It is used to control quality, quantity, and food costs in a foodservice operation. 
            A recipe may be simple to complex based on the requirements of the operation and the intended user. 
            For example, an experienced chef may need a recipe with only a few details, while a beginner cook may 
            need more information about ingredients, 
            preparation steps, cooking times and temperatures, visual cues, and equipment requirements."),
        ];
    }
}







?>