<?php

require_once 'uepalconfig.civix.php';
use CRM_Uepalconfig_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function uepalconfig_civicrm_config(&$config) {
  _uepalconfig_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function uepalconfig_civicrm_install() {
  _uepalconfig_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function uepalconfig_civicrm_enable() {
  _uepalconfig_civix_civicrm_enable();
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 *

 // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
function uepalconfig_civicrm_navigationMenu(&$menu) {
  _uepalconfig_civix_insert_navigation_menu($menu, 'Administer/System Settings', [
    'label' => E::ts('Configuration UEPAL'),
    'name' => 'uepal_config',
    'url' => 'civicrm/admin/uepalconfig',
    'permission' => 'administer CiviCRM',
    'operator' => 'OR',
    'separator' => 0,
  ]);
  _uepalconfig_civix_navigationMenu($menu);
}
