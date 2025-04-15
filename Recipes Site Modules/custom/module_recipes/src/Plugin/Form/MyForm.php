<?php

namespace Drupal\module_recipes\Plugin\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * @Form(
 *   id = "custom_form",
 *   title = @Translation("Custom Form")
 * )
 */
class MyForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#required' => TRUE,
    ];

    $form['age'] = [
      '#type' => 'number',
      '#title' => $this->t('Age'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
    ];
    $form['telephone'] = [
        '#type' => 'Telephone',
        '#title' => $this->t('Telephone'),
        '#required' => TRUE,
      ];
   

    $form['zip_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Zip Code'),
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }


/**
 * {@inheritdoc}
 */

//  public function validateForm(array &$form, FormStateInterface $form_state){

// $name=$form_state->getValue("name");
// if(strlen($name)<4){
//   $form_state->setErrorByName('name', $this->t('Name must be at least 3 characters long.'));
// }
//  }



  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $name=$form_state->getValue('name');
    
  \Drupal::logger('My Form')->notice('SubmitForm method called. Name: @name', ['@name' => $name]);

    \Drupal::messenger()->addMessage($this->t('Form submitted successfully.'));
    // \Drupal::messenger()->addMessage("Your name is @name",['name'=>$form_state->getValue('name')]);
    \Drupal::messenger()->addMessage("Your name is ". $name);

}
}
