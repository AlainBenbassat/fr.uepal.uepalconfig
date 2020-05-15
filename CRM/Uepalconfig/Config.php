<?php

class CRM_Uepalconfig_Config {
  private static $singleton;

  public function __construct() {
  }

  public function checkConfig() {
    // general settings
    $this->setDateFormat();
    $this->setMoneyFormat();
    $this->setAddressAndDsiplayFormat();

    // contact types
    $this->createContactType('Organization', 'ecole', 'École');
    $this->createContactType('Organization', 'paroisse', 'Paroisse');
    $this->createContactType('Organization', 'consistoire_lutherien', 'Consistoire luthérien');
    $this->createContactType('Organization', 'inspection_consistoire_reforme', 'Inspection / Consistoire réformé');
    $this->createContactType('Organization', 'commission', 'Commission');
    $this->createContactType('Individual', 'pasteur', 'Pasteur');

    // relationships
    $this->getRelationshipType_estMembreEluDe();
    $this->getRelationshipType_estMembreCoopteDe();
    $this->getRelationshipType_estMembreInviteDe();
    $this->getRelationshipType_estMembreDeDroitDe();
    $this->getRelationshipType_estPasteurNommeDe();
    $this->getRelationshipType_estPasteurDesservantDe();
    $this->getRelationshipType_estPasteurChargeDeMissionDetacheDe();
    $this->getRelationshipType_estPasteurAuxiliaireDe();
    $this->getRelationshipType_estPasteurAumonierDe();
    $this->getRelationshipType_estDiacreDe();
    $this->getRelationshipType_estPresidentDe();
    $this->getRelationshipType_estVicePresidentDe();
    $this->getRelationshipType_estTresorierDe();
    $this->getRelationshipType_estSecretaireDe();
    $this->getRelationshipType_estInspecteurDe();
    $this->getRelationshipType_estIntervenantDeReligionPour();
    $this->getRelationshipType_estPredicateurLaiquePour();
    $this->getRelationshipType_estParoissienDe();

    // custom fields
    $this->getCustomField_paroisseDetailEglise();
    $this->getCustomField_paroisseDetailTheologie();
    $this->getCustomField_paroisseDetailNombreParoissiens();
    $this->getCustomField_paroisseDetailNombreElecteurs();

    $this->getCustomField_pasteurDetailAnneeConsecration();
    $this->getCustomField_pasteurDetailAnneeEntreeMinistere();
    $this->getCustomField_pasteurDetailAnneeEntreePosteActuel();
    $this->getCustomField_pasteurDetailDateCAFP();
    $this->getCustomField_pasteurDetailDiplomes();
  }

  public function createContactType($baseContact, $name, $label) {
    try {
      civicrm_api3('ContactType', 'getsingle', [
        'name' => $name,
      ]);
    }
    catch (Exception $e) {
      if ($baseContact == 'Organization') {
        $parentId = 3;
      }
      else {
        $parentId = 1;
      }

      civicrm_api3('ContactType', 'create', [
        'name' => $name,
        'label' => $label,
        'is_active' => 1,
        'parent_id' => $parentId,
      ]);
    }
  }

  public function getRelationshipType_estMembreEluDe() {
    $params = [
      'name_a_b' => 'est_membre_elu_de',
      'label_a_b' => 'est Membre élu·e de',
      'name_b_a' => 'a_pour_membre_elu',
      'label_b_a' => 'a pour Membre élu·e',
      'contact_type_a' => 'Individual',
      'contact_type_b' => 'Organization',
      'contact_sub_type_b' => 'paroisse',
      'is_reserved' => '0',
      'is_active' => '1'
    ];
    return  $this->createOrGetRelationshipType($params);
  }

  public function getRelationshipType_estMembreCoopteDe() {
    $params = [
      'name_a_b' => 'est_membre_coopte_de',
      'label_a_b' => 'est Membre coopté·e de',
      'name_b_a' => 'a_pour_membre_coopte',
      'label_b_a' => 'a pour Membre coopté·e',
      'contact_type_a' => 'Individual',
      'contact_type_b' => 'Organization',
      'is_reserved' => '0',
      'is_active' => '1'
    ];
    return  $this->createOrGetRelationshipType($params);
  }

  public function getRelationshipType_estMembreInviteDe() {
    $params = [
      'name_a_b' => 'est_membre_invite_de',
      'label_a_b' => 'est Membre invité·e de',
      'name_b_a' => 'a_pour_membre_invite',
      'label_b_a' => 'a pour Membre invité·e',
      'contact_type_a' => 'Individual',
      'contact_type_b' => 'Organization',
      'is_reserved' => '0',
      'is_active' => '1'
    ];
    return  $this->createOrGetRelationshipType($params);
  }

  public function getRelationshipType_estMembreDeDroitDe() {
    $params = [
      'name_a_b' => 'est_membre_de_droit_de',
      'label_a_b' => 'est Membre de Droit de',
      'name_b_a' => 'a_pour_membre_de_droit',
      'label_b_a' => 'a pour Membre de Droit',
      'contact_type_a' => 'Individual',
      'contact_type_b' => 'Organization',
      'contact_sub_type_b' => 'paroisse',
      'is_reserved' => '0',
      'is_active' => '1'
    ];
    return  $this->createOrGetRelationshipType($params);
  }

  public function getRelationshipType_estPasteurNommeDe() {
    $params = [
      'name_a_b' => 'est_pasteur_nomme_de',
      'label_a_b' => 'est Pasteur nommé·e de',
      'name_b_a' => 'a_pour_pasteur_nomme',
      'label_b_a' => 'a pour Pasteur nommé·e',
      'contact_type_a' => 'Individual',
      'contact_type_b' => 'Organization',
      'contact_sub_type_a' => 'pasteur',
      'contact_sub_type_b' => 'paroisse',
      'is_reserved' => '0',
      'is_active' => '1'
    ];
    return  $this->createOrGetRelationshipType($params);
  }

  public function getRelationshipType_estPasteurDesservantDe() {
    $params = [
      'name_a_b' => 'est_pasteur_desservant_de',
      'label_a_b' => 'est Pasteur desservant·e de',
      'name_b_a' => 'a_pour_pasteur_desservant',
      'label_b_a' => 'a pour Pasteur desservant·e',
      'contact_type_a' => 'Individual',
      'contact_type_b' => 'Organization',
      'contact_sub_type_a' => 'pasteur',
      'contact_sub_type_b' => 'paroisse',
      'is_reserved' => '0',
      'is_active' => '1'
    ];
    return  $this->createOrGetRelationshipType($params);
  }

  public function getRelationshipType_estPasteurChargeDeMissionDetacheDe() {
    $params = [
      'name_a_b' => 'est_pasteur_charge_de_mission_detache_de',
      'label_a_b' => 'est Pasteur chargé·e de mission de / détaché·e',
      'name_b_a' => 'a_pour_pasteur_charge_de_mission_detache',
      'label_b_a' => 'a pour Pasteur chargé·e de mission / détaché·e',
      'contact_type_a' => 'Individual',
      'contact_type_b' => 'Organization',
      'contact_sub_type_a' => 'pasteur',
      'contact_sub_type_b' => 'paroisse',
      'is_reserved' => '0',
      'is_active' => '1'
    ];
    return  $this->createOrGetRelationshipType($params);
  }

  public function getRelationshipType_estPasteurAuxiliaireDe() {
    $params = [
      'name_a_b' => 'est_pasteur_auxiliaire_de',
      'label_a_b' => 'est Pasteur auxiliaire de',
      'name_b_a' => 'a_pour_pasteur_auxiliaire',
      'label_b_a' => 'a pour Pasteur auxiliaire',
      'contact_type_a' => 'Individual',
      'contact_type_b' => 'Organization',
      'contact_sub_type_a' => 'pasteur',
      'contact_sub_type_b' => 'paroisse',
      'is_reserved' => '0',
      'is_active' => '1'
    ];
    return  $this->createOrGetRelationshipType($params);
  }

  public function getRelationshipType_estPasteurAumonierDe() {
    $params = [
      'name_a_b' => 'est_pasteur_aumonier_de',
      'label_a_b' => 'est Pasteur aumônier de',
      'name_b_a' => 'a_pour_pasteur_aumonier',
      'label_b_a' => 'a pour Pasteur aumônier',
      'contact_type_a' => 'Individual',
      'contact_type_b' => 'Organization',
      'contact_sub_type_a' => 'pasteur',
      'is_reserved' => '0',
      'is_active' => '1'
    ];
    return  $this->createOrGetRelationshipType($params);
  }

  public function getRelationshipType_estDiacreDe() {
    $params = [
      'name_a_b' => 'est_diacre_de',
      'label_a_b' => 'est Diacre de',
      'name_b_a' => 'a_pour_diacre',
      'label_b_a' => 'a pour Diacre',
      'contact_type_a' => 'Individual',
      'contact_type_b' => 'Organization',
      'contact_sub_type_b' => 'paroisse',
      'is_reserved' => '0',
      'is_active' => '1'
    ];
    return  $this->createOrGetRelationshipType($params);
  }

  public function getRelationshipType_estPresidentDe() {
    $params = [
      'name_a_b' => 'est_president_de',
      'label_a_b' => 'est Président·e de',
      'name_b_a' => 'a_pour_president',
      'label_b_a' => 'a pour Président·e',
      'contact_type_a' => 'Individual',
      'contact_type_b' => 'Organization',
      'is_reserved' => '0',
      'is_active' => '1'
    ];
    return  $this->createOrGetRelationshipType($params);
  }

  public function getRelationshipType_estVicePresidentDe() {
    $params = [
      'name_a_b' => 'est_vice_president_de',
      'label_a_b' => 'est Vice-Président·e de',
      'name_b_a' => 'a_pour_vice_president',
      'label_b_a' => 'a pour Vice-Président·e',
      'contact_type_a' => 'Individual',
      'contact_type_b' => 'Organization',
      'is_reserved' => '0',
      'is_active' => '1'
    ];
    return  $this->createOrGetRelationshipType($params);
  }

  public function getRelationshipType_estTresorierDe() {
    $params = [
      'name_a_b' => 'est_tresorier_de',
      'label_a_b' => 'est Trésorier.ère de',
      'name_b_a' => 'a_pour_tresorier',
      'label_b_a' => 'a pour Trésorier.ère',
      'contact_type_a' => 'Individual',
      'contact_type_b' => 'Organization',
      'is_reserved' => '0',
      'is_active' => '1'
    ];
    return  $this->createOrGetRelationshipType($params);
  }

  public function getRelationshipType_estSecretaireDe() {
    $params = [
      'name_a_b' => 'est_secretaire_de',
      'label_a_b' => 'est Secrétaire de',
      'name_b_a' => 'a_pour_secretaire',
      'label_b_a' => 'a pour Secrétaire',
      'contact_type_a' => 'Individual',
      'contact_type_b' => 'Organization',
      'is_reserved' => '0',
      'is_active' => '1'
    ];
    return  $this->createOrGetRelationshipType($params);
  }

  public function getRelationshipType_estInspecteurDe() {
    $params = [
      'name_a_b' => 'est_inspecteur_de',
      'label_a_b' => 'est Inspecteur·trice de',
      'name_b_a' => 'a_pour_inspecteur',
      'label_b_a' => 'a pour Inspecteur·trice',
      'contact_type_a' => 'Individual',
      'contact_type_b' => 'Organization',
      'contact_sub_type_b' => 'inspection_consistoire_reforme',
      'is_reserved' => '0',
      'is_active' => '1'
    ];
    return  $this->createOrGetRelationshipType($params);
  }

  public function getRelationshipType_estIntervenantDeReligionPour() {
    $params = [
      'name_a_b' => 'est_intervenant_de_religion_pour',
      'label_a_b' => 'est Intervenant·e de religion pour',
      'name_b_a' => 'a_pour_intervenant_de_religion',
      'label_b_a' => 'a pour Intervenant·e de religion',
      'contact_type_a' => 'Individual',
      'contact_type_b' => 'Organization',
      'contact_sub_type_b' => 'ecole',
      'is_reserved' => '0',
      'is_active' => '1'
    ];
    return  $this->createOrGetRelationshipType($params);
  }

  public function getRelationshipType_estPredicateurLaiquePour() {
    $params = [
      'name_a_b' => 'est_predicateur_laique_pour',
      'label_a_b' => 'est Prédicateur·trice Laïque pour',
      'name_b_a' => 'a_pour_predicateur_laique',
      'label_b_a' => 'a pour Prédicateur·trice Laïque',
      'contact_type_a' => 'Individual',
      'contact_type_b' => 'Organization',
      'is_reserved' => '0',
      'is_active' => '1'
    ];
    return  $this->createOrGetRelationshipType($params);
  }

  public function getRelationshipType_estParoissienDe() {
    $params = [
      'name_a_b' => 'est_paroissien_de',
      'label_a_b' => 'est Paroissien·ne de',
      'name_b_a' => 'a_pour_paroissien',
      'label_b_a' => 'a pour Paroissien·ne',
      'contact_type_a' => 'Individual',
      'contact_type_b' => 'Organization',
      'contact_sub_type_b' => 'paroisse',
      'is_reserved' => '0',
      'is_active' => '1'
    ];
    return  $this->createOrGetRelationshipType($params);
  }

  public function getCustomGroup_ParoisseDetail() {
    $params = [
      'name' => 'paroisse_detail',
      'title' => 'Paroisse Detail',
      'extends' => 'Organization',
      'extends_entity_column_value' => [
          'paroisse'
      ],
      'style' => 'Inline',
      'collapse_display' => '0',
      'weight' => '1',
      'is_active' => '1',
      'table_name' => 'civicrm_value_paroisse_detail',
      'is_multiple' => '0',
      'collapse_adv_display' => '0',
      'is_reserved' => '0',
      'is_public' => '0'
    ];
    return $this->createOrGetCustomGroup($params);
  }

  public function getCustomGroup_PasteurDetail() {
    $params = [
      'name' => 'pasteur_detail',
      'title' => 'Pasteur Detail',
      'extends' => 'Individual',
      'extends_entity_column_value' => [
        'pasteur'
      ],
      'style' => 'Inline',
      'collapse_display' => '0',
      'weight' => '1',
      'is_active' => '1',
      'table_name' => 'civicrm_value_pasteur_detail',
      'is_multiple' => '0',
      'collapse_adv_display' => '0',
      'is_reserved' => '0',
      'is_public' => '0'
    ];
    return $this->createOrGetCustomGroup($params);
  }

  public function getCustomField_pasteurDetailAnneeConsecration() {
    $params = [
      'custom_group_id' => $this->getCustomGroup_PasteurDetail()['id'],
      'name' => 'annee_consecration',
      'label' => 'Année de consécration',
      'data_type' => 'Int',
      'html_type' => 'Text',
      'is_searchable' => '1',
      'is_search_range' => '1',
      'weight' => '1',
      'is_active' => '1',
      'text_length' => '255',
      'note_columns' => '60',
      'note_rows' => '4',
      'column_name' => 'annee_consecration',
      'in_selector' => '0'
    ];
    return $this->createOrGetCustomField($params);
  }

  public function getCustomField_pasteurDetailAnneeEntreeMinistere() {
    $params = [
      'custom_group_id' => $this->getCustomGroup_PasteurDetail()['id'],
      'name' => 'annee_entree_ministere',
      'label' => 'Année d\'entrée au ministaire',
      'data_type' => 'Int',
      'html_type' => 'Text',
      'is_searchable' => '1',
      'is_search_range' => '1',
      'weight' => '2',
      'is_active' => '1',
      'text_length' => '255',
      'note_columns' => '60',
      'note_rows' => '4',
      'column_name' => 'annee_entree_ministere',
      'in_selector' => '0'
    ];
    return $this->createOrGetCustomField($params);
  }

  public function getCustomField_pasteurDetailAnneeEntreePosteActuel() {
    $params = [
      'custom_group_id' => $this->getCustomGroup_PasteurDetail()['id'],
      'name' => 'annee_poste_actuel',
      'label' => 'Année d\'entrée poste actuel',
      'data_type' => 'Int',
      'html_type' => 'Text',
      'is_searchable' => '1',
      'is_search_range' => '1',
      'weight' => '3',
      'is_active' => '1',
      'text_length' => '255',
      'note_columns' => '60',
      'note_rows' => '4',
      'column_name' => 'annee_poste_actuel',
      'in_selector' => '0'
    ];
    return $this->createOrGetCustomField($params);
  }

  public function getCustomField_pasteurDetailDateCAFP() {
    $params = [
      'custom_group_id' => $this->getCustomGroup_PasteurDetail()['id'],
      'name' => 'date_cafp',
      'label' => 'Date CAFP',
      'data_type' => 'Date',
      'html_type' => 'Select Date',
      'is_searchable' => '1',
      'is_search_range' => '1',
      'weight' => '5',
      'is_active' => '1',
      'text_length' => '255',
      'date_format' => 'dd/mm/yy',
      'note_columns' => '60',
      'note_rows' => '4',
      'column_name' => 'date_cafp',
      'in_selector' => '0'
    ];
    return $this->createOrGetCustomField($params);
  }

  public function getCustomField_pasteurDetailDiplomes() {
    $params = [
      'custom_group_id' => $this->getCustomGroup_PasteurDetail()['id'],
      'name' => 'diplomes',
      'label' => 'Diplômes',
      'data_type' => 'Memo',
      'html_type' => 'TextArea',
      'is_search_range' => '0',
      'weight' => '6',
      'attributes' => 'rows=4, cols=60',
      'is_active' => '1',
      'note_columns' => '60',
      'note_rows' => '6',
      'column_name' => 'diplomes',
      'in_selector' => '0'
    ];
    return $this->createOrGetCustomField($params);
  }

  public function getCustomField_paroisseDetailEglise() {
    $params = [
      'custom_group_id' => $this->getCustomGroup_ParoisseDetail()['id'],
      'name' => 'Eglise',
      'label' => 'Eglise',
      'data_type' => 'String',
      'html_type' => 'Select',
      'is_searchable' => '1',
      'is_search_range' => '0',
      'weight' => '1',
      'is_active' => '1',
      'text_length' => '255',
      'note_columns' => '60',
      'note_rows' => '4',
      'column_name' => 'eglise',
      'option_group_id' => $this->getOptionGroup_Eglises()['id'],
      'in_selector' => '0'
    ];
    return $this->createOrGetCustomField($params);
  }

  public function getCustomField_paroisseDetailTheologie() {
    $params = [
      'custom_group_id' => $this->getCustomGroup_ParoisseDetail()['id'],
      'name' => 'theologie',
      'label' => 'Théologie',
      'data_type' => 'String',
      'html_type' => 'CheckBox',
      'is_searchable' => '1',
      'is_search_range' => '0',
      'weight' => '2',
      'is_active' => '1',
      'options_per_line' => '1',
      'text_length' => '255',
      'note_columns' => '60',
      'note_rows' => '4',
      'column_name' => 'theologie',
      'option_group_id' => $this->getOptionGroup_Theologie()['id'],
      'in_selector' => '0'
    ];
    return $this->createOrGetCustomField($params);
  }

  public function getCustomField_paroisseDetailNombreParoissiens() {
    $params = [
      'custom_group_id' => $this->getCustomGroup_ParoisseDetail()['id'],
      'name' => 'nombre_paroissiens',
      'label' => 'Nombre de paroissiens',
      'data_type' => 'Int',
      'html_type' => 'Text',
      'is_searchable' => '1',
      'is_search_range' => '1',
      'weight' => '3',
      'is_active' => '1',
      'text_length' => '255',
      'note_columns' => '60',
      'note_rows' => '4',
      'column_name' => 'nombre_paroissiens',
      'in_selector' => '0'
    ];
    return $this->createOrGetCustomField($params);
  }

  public function getCustomField_paroisseDetailNombreElecteurs() {
    $params = [
      'custom_group_id' => $this->getCustomGroup_ParoisseDetail()['id'],
      'name' => 'nombre_electeurs',
      'label' => 'Nombre d\'électeurs',
      'data_type' => 'Int',
      'html_type' => 'Text',
      'is_searchable' => '1',
      'is_search_range' => '1',
      'weight' => '3',
      'is_active' => '1',
      'text_length' => '255',
      'note_columns' => '60',
      'note_rows' => '4',
      'column_name' => 'nombre_electeurs',
      'in_selector' => '0'
    ];
    return $this->createOrGetCustomField($params);
  }

  public function getOptionGroup_Eglises() {
    $params = [
      'name' => 'eglises',
      'title' => 'Eglises',
      'data_type' => 'String',
      'is_reserved' => '0',
      'is_active' => '1',
      'is_locked' => '0'
    ];
    $options = ['EPRAL', 'EPCAAL', 'Centre de Rencontre et de Recueillement Spirituel'];
    return $this->createOrGetOptionGroup($params, $options);
  }

  public function getOptionGroup_Theologie() {
    $params = [
      'name' => 'theologies',
      'title' => 'Théologies',
      'data_type' => 'String',
      'is_reserved' => '0',
      'is_active' => '1',
      'is_locked' => '0'
    ];
    $options = ['Réformée', 'Luthérienne'];
    return $this->createOrGetOptionGroup($params, $options);
  }

  private function createOrGetRelationshipType($params) {
    try {
      $relType = civicrm_api3('RelationshipType', 'getsingle', [
        'name_a_b' => $params['name_a_b'],
        'name_b_a' => $params['name_b_a'],
      ]);
    }
    catch (Exception $e) {
      $relType = civicrm_api3('RelationshipType', 'create', $params);
    }

    return $relType;
  }

  private function createOrGetCustomGroup($params) {
    try {
      $customGroup = civicrm_api3('CustomGroup', 'getsingle', [
        'name' => $params['name'],
      ]);
    }
    catch (Exception $e) {
      $customGroup = civicrm_api3('CustomGroup', 'create', $params);
    }

    return $customGroup;
  }

  private function createOrGetCustomField($params) {
    try {
      $customField = civicrm_api3('CustomField', 'getsingle', [
        'custom_group_id' => $params['custom_group_id'],
        'name' => $params['name'],
      ]);
    }
    catch (Exception $e) {
      $customField = civicrm_api3('CustomField', 'create', $params);
    }

    return $customField;
  }

  private function createOrGetOptionGroup($params, $options) {
    // in Development mode we force the recreation of the options
    $recreateOptions = FALSE;
    if (Civi::settings()->get('environment') == 'Development') {
      $recreateOptions = TRUE;
    }

    try {
      $optionGroup = civicrm_api3('OptionGroup', 'getsingle', [
        'name' => $params['name'],
      ]);
    }
    catch (Exception $e) {
      $optionGroup = civicrm_api3('OptionGroup', 'create', $params);
      $recreateOptions = TRUE;
    }

    if ($recreateOptions) {
      // delete existing options
      $sql = "delete from civicrm_option_value where option_group_id = " . $optionGroup['id'];
      CRM_Core_DAO::executeQuery($sql);

      // add the options
      $i = 1;
      foreach ($options as $option) {
        civicrm_api3('OptionValue', 'create', [
          'option_group_id' => $optionGroup['id'],
          'label' => $option,
          'value' => $i,
          'name' => CRM_Utils_String::munge($option, '_', 64),
          'is_default' => '0',
          'weight' => $i,
          'is_optgroup' => '0',
          'is_reserved' => '0',
          'is_active' => '1'
        ]);
        $i++;
      }
    }

    return $optionGroup;
  }

  private function setDateFormat() {
    //Civi\Api4\Setting::set()
    civicrm_api4('Setting', 'set', [
      'values' => [
        'dateformatDatetime' => '%e %B %Y %H:%M',
        'dateformatFull' => '%e %B %Y',
        'dateformatTime' => '%H:%M',
        'dateformatFinancialBatch' => '%d/%m/%Y',
        'dateformatshortdate' => '%d/%m/%Y',
        'dateInputFormat' => 'dd/mm/yy',
        'timeInputFormat' => '2',
        'weekBegins' => '1',
      ],
      'domainId' => 1,
    ]);
  }

  private function setMoneyFormat() {
    civicrm_api4('Setting', 'set', [
      'values' => [
        'monetaryThousandSeparator' => ' ',
        'monetaryDecimalPoint' => ',',
        'moneyformat' => '%a %c',
        'moneyvalueformat' => '%!i',
        'defaultCurrency' => 'EUR',
      ],
    ]);
  }

  private function setAddressAndDsiplayFormat() {
    civicrm_api4('Setting', 'set', [
      'values' => [
        'address_format' => "{contact.address_name}\n{contact.street_address}\n{contact.supplemental_address_1}\n{contact.supplemental_address_2}\n{contact.supplemental_address_3}\n{contact.postal_code}{ }{contact.city}\n{contact.country}",
        'mailing_format' => "{contact.addressee}\n{contact.street_address}\n{contact.supplemental_address_1}\n{contact.supplemental_address_2}\n{contact.supplemental_address_3}\n{contact.postal_code}{ }{contact.city}\n{contact.country}",
        'display_name_format' => '{contact.individual_prefix}{ }{contact.first_name}{ }{contact.last_name}{ }{contact.individual_suffix}',
        'sort_name_format' => '{contact.last_name}{, }{contact.first_name}',
        'defaultContactCountry' => 1076,
      ],
    ]);

    // set email_greeting and postal_greeting (e.g. Chère Mme la pasteure DUPOND, Cher M. PIF)
    $format = '{capture assign=c}{contact.communication_style}{/capture}{capture assign=p}{contact.individual_prefix}{/capture}{if $p=="Mme"}Chère{else}Cher{/if} {if $c=="Familiar"}{contact.first_name}{else}{$p} {contact.formal_title} {contact.last_name}{/if}';
    $sql = "
      update
        civicrm_option_value v
      inner join
        civicrm_option_group g on v.option_group_id = g.id
      set
        label = '$format'
      where
        g.name in ('email_greeting', 'postal_greeting')
      and
        v.value = 1
    ";
    CRM_Core_DAO::executeQuery($sql);

    // see civicrm/admin/setting/preferences/display?reset=1, section "Editing Contacts" (Informations éditables)
    // select everything except OpenID (= 10)
    $prefs = [1,2,3,4,5,6,7,8,9,11,12,13,14,15,16,17];
    $transformedPrefs = serialize(CRM_Core_DAO::VALUE_SEPARATOR . implode(CRM_Core_DAO::VALUE_SEPARATOR, $prefs) . CRM_Core_DAO::VALUE_SEPARATOR);
    $sql = "update civicrm_setting set value = %1 where name = 'contact_edit_options'";
    $sqlParams = [
      1 => [$transformedPrefs, 'String'],
    ];
    CRM_Core_DAO::executeQuery($sql, $sqlParams);

  }

}
