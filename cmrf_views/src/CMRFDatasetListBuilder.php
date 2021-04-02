<?php namespace Drupal\cmrf_views;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Routing\RouteProvider;
use \Drupal\Core\Url;
use Drupal\cmrf_views\Entity\CMRFDataset;

/**
 * Provides a listing of CMRF connector entities.
 */
class CMRFDatasetListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('CMRF Dataset');
    $header['id'] = $this->t('Machine name');
    $header['connector'] = $this->t('Connector');
    $header['entity'] = $this->t('Entity');
    $header['action'] = $this->t('Action');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /** @var CMRFDataset $entity */
    $row['label'] = $entity->label();
    $row['id'] = $entity->id();
    $row['connector'] = $entity->connector;
    $row['entity'] = $entity->entity;
    $row['action'] = $entity->action;
    return $row + parent::buildRow($entity);
  }

  public function getOperations(EntityInterface $entity) {
    $operations = parent::getOperations($entity);
    $operations['relationships'] = [
      'title' => t('Relationships'),
      'url' => $url = Url::fromRoute(
        'entity.cmrf_dataset_relationship.collection',
        ['cmrf_dataset' => $entity->id()]
      ),
    ];

    return $operations;
  }

}