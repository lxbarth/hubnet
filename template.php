<?php

function hubnet_preprocess_page (&$vars) {
  $vars['site_slogan'] = variable_get('site_slogan', '');
  if ($logged_in == FALSE && $vars['template_files']['0'] == 'page-user') {
    unset($vars['tabs']);
  }
  if (module_exists('osso_provider')) {
    $vars['hub_bar'] = osso_provider_hub_bar();
  }

  $settings = variable_get('theme_hubnet_settings', array());
  $vars['header_color'] = $settings['header_color'];
  $vars['header_color_dark'] = $settings['header_color_dark'];
}

function hubnet_preprocess_node (&$vars) {
  /* Remove duplicate node titles */
  $item = menu_get_object();
  if ($item == $vars["node"]) {
    unset($vars["title"]);
  }
}

/**
 * Add activity type classes.
 */
function hubnet_preprocess_views_view_fields(&$vars) {
  if ($type = $vars['row']->node_feeds_data_activity_feed_node_data_field_type_field_type_value) {
    if (isset($vars['fields']['field_type_value'])) {
      $vars['fields']['field_type_value']->class .= ' activity-type-'. strtolower($type);
    }
  }
}
