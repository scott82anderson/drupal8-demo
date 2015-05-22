<?php
/**
 * @file
 * Contains \Drupal\scotts_module\Controller\ScottsController.
 */
namespace Drupal\scotts_module\Controller;

class ScottsController {

  public function content() {

    /*return array(
      '#type' => 'markup',
      '#markup' => t('Hello, World!'),
    );*/

    $name = "Technocrat";  // access Model and get some data
    return array(
      '#theme' => 'hello',
      '#name' => $name
    );

  }

}
