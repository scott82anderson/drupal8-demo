<?php

/**
 * @file
 * Definition of Drupal\node\Plugin\views\argument\Vid.
 */

namespace Drupal\node\Plugin\views\argument;

use Drupal\Component\Utility\String;
use Drupal\Core\Database\Connection;
use Drupal\views\Plugin\views\argument\Numeric;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\node\NodeStorageInterface;

/**
 * Argument handler to accept a node revision id.
 *
 * @ViewsArgument("node_vid")
 */
class Vid extends Numeric {

  /**
   * Database Service Object.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * The node storage.
   *
   * @var \Drupal\node\NodeStorageInterface
   */
  protected $nodeStorage;

  /**
   * Constructs a Drupal\Component\Plugin\PluginBase object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Database\Connection $database
   *   Database Service Object.
   * @param \Drupal\node\NodeStorageInterface
   *   The node storage.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, Connection $database, NodeStorageInterface $node_storage) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->database = $database;
    $this->nodeStorage = $node_storage;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('database'),
      $container->get('entity.manager')->getStorage('node')
    );
  }

  /**
   * Override the behavior of title(). Get the title of the revision.
   */
  public function titleQuery() {
    $titles = array();

    $results = $this->database->query('SELECT nr.vid, nr.nid, npr.title FROM {node_revision} nr WHERE nr.vid IN ( :vids[] )', array(':vids[]' => $this->value))->fetchAllAssoc('vid', PDO::FETCH_ASSOC);
    $nids = array();
    foreach ($results as $result) {
      $nids[] = $result['nid'];
    }

    $nodes = $this->nodeStorage->loadMultiple(array_unique($nids));

    foreach ($results as $result) {
      $nodes[$result['nid']]->set('title', $result['title']);
      $titles[] = String::checkPlain($nodes[$result['nid']]->label());
    }

    return $titles;
  }

}
