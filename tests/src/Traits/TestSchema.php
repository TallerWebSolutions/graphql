<?php

namespace Drupal\Tests\graphql\Traits;

use Drupal\graphql\Plugin\GraphQL\SchemaBuilderInterface;
use Drupal\graphql\Plugin\GraphQL\SchemaPluginInterface;
use Drupal\graphql\Plugin\GraphQL\Schemas\SchemaPluginBase;
use Youshido\GraphQL\Field\AbstractField;

/**
 * Empty test schema used by SchemaProphecyTrait.
 */
class TestSchema extends SchemaPluginBase implements SchemaPluginInterface {

  /**
   * Mocked plugin configuration.
   *
   * @return array
   */
  public static function pluginDefinition() {
    return [
      'name' => 'default',
      'path' => 'graphql',
      'builder' => '\Drupal\graphql\Plugin\GraphQL\PluggableSchemaBuilder',
      'weight' => 0,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function create(AbstractField $field = NULL) {
    return new static(['field' => $field], 'graphql:test', static::pluginDefinition());
  }

  /**
   * {@inheritdoc}
   */
  protected function constructSchema(SchemaBuilderInterface $schemaBuilder) {
    parent::constructSchema($schemaBuilder);

    // Allow injection of an additional field.
    if (!empty($field)) {
      $this->getQueryType()->addField($field);
    }
  }

}
