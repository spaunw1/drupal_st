<?php

/**
 * @file
 * My Module Plugin Base class
 */

/**
 * Example plugin.
 */
class Example2 extends MyPluginBase {

  /**
   * {@inheritdoc}
   */
  public function label() {
    return t('Example2');
  }

  /**
   * {@inheritdoc}
   */
  public function configForm(&$form_state) {

    $form['example2_setting'] = array(
      '#title' => t('Example variable'),
      '#type' => 'textfield',
      '#default_value' => variable_get('my_module_example_setting', ''),
      '#description' => t('Description of the configraiont option.'),
    );

    $form['advanced'] = array(
      '#title' => t('Advanced Settings'),
      '#type' => 'fieldset',
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );

    $form['advanced']['example2_advanced_setting'] = array(
      '#title' => t('Advanced variable'),
      '#type' => 'textfield',
      '#default_value' => variable_get('my_module_example2_advanced_setting', ''),
      '#description' => t('Description of the configraiont option.'),
    );

    return $form;

  }

  /**
   * {@inheritdoc}
   */
  public function validationHandler($form, &$form_state) {
    if (empty($form_state['values']['example2_setting'])) {
      form_set_error('example_setting', t('Validation error'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitHandler($form, &$form_state) {
    variable_set('my_module_example_setting', $form_state['values']['example2_setting']);
    variable_set('my_module_example2_advanced_setting', $form_state['values']['example2_advanced_setting']);
  }

}
