<?php

/**
 * @file
 * My Module Plugin Base class
 */

/**
 * Example plugin.
 */
class Example extends MyPluginBase {

  /**
   * {@inheritdoc}
   */
  public function label() {
    return t('Example');
  }

  /**
   * {@inheritdoc}
   */
  public function configForm(&$form_state) {

    $form['example_setting'] = array(
      '#title' => t('Example variable'),
      '#type' => 'textfield',
      '#default_value' => variable_get('my_module_example_setting', ''),
      '#description' => t('Description of the configraiont option.'),
    );

    return $form;

  }

  /**
   * {@inheritdoc}
   */
  public function validationHandler($form, &$form_state) {
    if (empty($form_state['values']['example_setting'])) {
      form_set_error('example_setting', t('Validation error'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitHandler($form, &$form_state) {
    variable_set('my_module_example_setting', $form_state['values']['example_setting']);
  }

}
