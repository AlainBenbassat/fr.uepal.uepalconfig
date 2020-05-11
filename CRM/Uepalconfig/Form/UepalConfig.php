<?php

use CRM_Uepalconfig_ExtensionUtil as E;

class CRM_Uepalconfig_Form_UepalConfig extends CRM_Core_Form {
  public function buildQuickForm() {

    $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => 'Mettre à jour la configuration',
        'isDefault' => TRUE,
      ),
    ));

    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());
    parent::buildQuickForm();
  }

  public function postProcess() {
    //$values = $this->exportValues();

    $config = new CRM_Uepalconfig_Config();
    $config->checkConfig();

    CRM_Core_Session::setStatus('La configuration a été mise à jour', '', 'success');

    parent::postProcess();
  }

  public function getRenderableElementNames() {
    // The _elements list includes some items which should not be
    // auto-rendered in the loop -- such as "qfKey" and "buttons".  These
    // items don't have labels.  We'll identify renderable by filtering on
    // the 'label'.
    $elementNames = array();
    foreach ($this->_elements as $element) {
      /** @var HTML_QuickForm_Element $element */
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }
    return $elementNames;
  }

}
