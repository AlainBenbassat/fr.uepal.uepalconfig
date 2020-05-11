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

    /*
     * point du milieu feminité  ·
     */
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

  private static function createOrGetRelationshipType($params) {
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

  private static function setDateFormat() {
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

  private static function setMoneyFormat() {
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

  private static function setAddressAndDsiplayFormat() {
    civicrm_api4('Setting', 'set', [
      'values' => [
        'address_format' => '{contact.address_name}\r\n{contact.street_address}\r\n{contact.supplemental_address_1}\r\n{contact.supplemental_address_2}\r\n{contact.supplemental_address_3}\r\n{contact.postal_code}{ }{contact.city}\r\n{contact.country}',
        'mailing_format' => '{contact.addressee}\r\n{contact.street_address}\r\n{contact.supplemental_address_1}\r\n{contact.supplemental_address_2}\r\n{contact.supplemental_address_3}\r\n{contact.postal_code}{ }{contact.city}\r\n{contact.country}',
        'display_name_format' => '{contact.individual_prefix}{ }{contact.first_name}{ }{contact.last_name}{ }{contact.individual_suffix}',
        'sort_name_format' => '{contact.last_name}{, }{contact.first_name}',
      ],
    ]);
  }
}
