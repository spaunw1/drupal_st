<?php

/**
 * @file
 * My Module API.
 *
 * It is good practice to have .api.php files with custom hook examples.
 * Other developers will use this file as a documentation when they
 * will be extending your module.
 */

/**
 * Implements hook_my_own_hook().
 */
function hook_my_own_hook() {
  return array(
    // Machine name of the plugin.
    'example' => array(
      // Human readable string visible on the config page.
      'name' => t('Example plugin'),
      // PHP Class name that extends MyPluginBase class.
      'phpClassName' => 'Example',
    ),
  );
}
