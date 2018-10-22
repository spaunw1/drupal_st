<?php

/**
 * @file
 * My Module Plugin Base class
 */

/**
 * Extend this class to integrate a new plugin.
 */
abstract class MyPluginBase {

  /**
   * Button label.
   */
  abstract public function label();

  /**
   * Configuration form.
   * Drupal form API elements.
   *
   * @return array.
   */
  abstract public function configForm(&$form_state);

  /**
   * Drupal form validation handler.
   */
  abstract public function validationHandler($form, &$form_state);

  /**
   * Drupal form submit handler.
   */
  abstract public function submitHandler($form, &$form_state);

}
