<?php

namespace Drupal\myblock\Plugin\Block;

use Drupal\Core\Block\Blockbase;
use Drupal\Core\Form\FormStateInterface;
/**
 * Provides simple block for adding a text
 * 
 * @Block(
 *   id = "text_block",
 *   admin_label = "Description",
 *   category = "Text",
 * )
 */

 class TextBlock extends Blockbase{
    /**
     * {@inheritdoc}
     */

     public function blockForm($form, FormStateInterface $form_state){
        $config=$this->getConfiguration();
        $form['description'] = [
          "#type" => "textarea",
          "#title" => $this->t("Block Description"),
          "#default_value" => $config['description'] ?? "",
        ];
        return $form;
     }

     /**
      * {@inheritdoc}
      * saves the form
      */

      public function blockSubmit($form,FormStateInterface $form_state){
        $this->setConfigurationValue("description",$form_state->getValue("description"));

      }
      /**
       * {@inheritdoc}
       * display's the form
       */
      public function build(){
        $config=$this->getConfiguration();

        return[
            "#theme" => "text_block",
            "#description" => $config["description"]??"demo Text",
            "#attached" => [
                "library" => [
                    "myblock/text_block_styles",
                ],
            ],
                ];
      }
 }