<?php
/**
 * @file
 * layout.context.inc
 */

/**
 * Implements hook_context_default_contexts().
 */
function layout_context_default_contexts() {
  $export = array();

  $context = new stdClass();
  $context->disabled = FALSE; /* Edit this to true to make a default context disabled initially */
  $context->api_version = 3;
  $context->name = 'article_view';
  $context->description = '';
  $context->tag = '';
  $context->conditions = array(
    'node' => array(
      'values' => array(
        'article' => 'article',
      ),
      'options' => array(
        'node_form' => '1',
      ),
    ),
  );
  $context->reactions = array(
    'block' => array(
      'blocks' => array(
        'views-clone_of_archive-block' => array(
          'module' => 'views',
          'delta' => 'clone_of_archive-block',
          'region' => 'sidebar_second',
          'weight' => '-10',
        ),
        'user-online' => array(
          'module' => 'user',
          'delta' => 'online',
          'region' => 'sidebar_second',
          'weight' => '-10',
        ),
      ),
    ),
  );
  $context->condition_mode = 0;
  $export['article_view'] = $context;

  return $export;
}
