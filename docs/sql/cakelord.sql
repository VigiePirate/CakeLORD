-- MySQL Script generated by MySQL Workbench
-- lun. 10 avril 2023 20:34:31
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema cakelord
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roles` ;

CREATE TABLE IF NOT EXISTS `roles` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `is_root` BOOLEAN NOT NULL DEFAULT 0,
  `is_admin` BOOLEAN NOT NULL DEFAULT 0,
  `is_staff` BOOLEAN NOT NULL DEFAULT 0,
  `can_access_personal` BOOLEAN NOT NULL DEFAULT 0,
  `can_change_state` BOOLEAN NOT NULL DEFAULT 0,
  `can_configure` BOOLEAN NOT NULL DEFAULT 0,
  `can_edit_others` BOOLEAN NOT NULL DEFAULT 0,
  `can_edit_frozen` BOOLEAN NOT NULL DEFAULT 0,
  `can_delete` BOOLEAN NOT NULL DEFAULT 0,
  `can_describe` BOOLEAN NOT NULL DEFAULT 0,
  `can_document` BOOLEAN NOT NULL DEFAULT 0,
  `can_restore` BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(70) NOT NULL,
  `password` VARCHAR(70) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `firstname` VARCHAR(45) NULL,
  `lastname` VARCHAR(45) NULL,
  `birth_date` DATE NULL,
  `sex` ENUM('M', 'F', '') NULL DEFAULT '',
  `localization` VARCHAR(255) NULL,
  `avatar` VARCHAR(255) NOT NULL DEFAULT 'Unknown.png',
  `about_me` TEXT NULL,
  `wants_newsletter` BOOLEAN NOT NULL DEFAULT 0,
  `role_id` INT UNSIGNED NOT NULL DEFAULT 4,
  `failed_login_attempts` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `failed_login_last_date` DATETIME NULL,
  `successful_login_last_date` DATETIME NULL,
  `is_locked` BOOLEAN NOT NULL DEFAULT 0,
  `passkey` CHAR(23) NULL,
  `staff_comments` TEXT NULL,
  `created` DATETIME NOT NULL DEFAULT '1981-08-01',
  `modified` DATETIME NOT NULL DEFAULT '1981-08-01',
  PRIMARY KEY (`id`),
  INDEX `fk_users_roles_idx` (`role_id` ASC) ,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) ,
  CONSTRAINT `fk_users_roles`
    FOREIGN KEY (`role_id`)
    REFERENCES `roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `colors`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `colors` ;

CREATE TABLE IF NOT EXISTS `colors` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `genotype` VARCHAR(70) NOT NULL,
  `picture` VARCHAR(255) NOT NULL DEFAULT 'Unknown.png',
  `description` TEXT NOT NULL,
  `is_picture_mandatory` BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `earsets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `earsets` ;

CREATE TABLE IF NOT EXISTS `earsets` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `picture` VARCHAR(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` VARCHAR(70) NOT NULL,
  `description` TEXT NOT NULL,
  `is_picture_mandatory` BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eyecolors`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `eyecolors` ;

CREATE TABLE IF NOT EXISTS `eyecolors` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `picture` VARCHAR(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` VARCHAR(70) NOT NULL,
  `description` TEXT NOT NULL,
  `is_picture_mandatory` BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
COMMENT = 'Table contenant la liste des yeux';


-- -----------------------------------------------------
-- Table `dilutions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dilutions` ;

CREATE TABLE IF NOT EXISTS `dilutions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `picture` VARCHAR(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` VARCHAR(70) NOT NULL,
  `description` TEXT NOT NULL,
  `is_picture_mandatory` BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
COMMENT = 'Table référençant la liste des dilutions';


-- -----------------------------------------------------
-- Table `coats`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coats` ;

CREATE TABLE IF NOT EXISTS `coats` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `picture` VARCHAR(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` VARCHAR(70) NOT NULL,
  `description` TEXT NOT NULL,
  `is_picture_mandatory` BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
COMMENT = 'Table référençant la liste des poils';


-- -----------------------------------------------------
-- Table `markings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `markings` ;

CREATE TABLE IF NOT EXISTS `markings` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `picture` VARCHAR(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` VARCHAR(70) NOT NULL,
  `description` TEXT NOT NULL,
  `is_picture_mandatory` BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
COMMENT = 'Table référençant la liste des marquages';


-- -----------------------------------------------------
-- Table `death_primary_causes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `death_primary_causes` ;

CREATE TABLE IF NOT EXISTS `death_primary_causes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT NOT NULL DEFAULT '',
  `is_infant` BOOLEAN NOT NULL DEFAULT 0,
  `is_accident` BOOLEAN NOT NULL DEFAULT 0,
  `is_oldster` BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
COMMENT = 'Table référençant la liste des causes de décès';


-- -----------------------------------------------------
-- Table `death_secondary_causes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `death_secondary_causes` ;

CREATE TABLE IF NOT EXISTS `death_secondary_causes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `death_primary_cause_id` INT UNSIGNED NOT NULL,
  `description` TEXT NOT NULL DEFAULT '',
  `is_tumor` BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_deces_secondaire_deces_principal_idx` (`death_primary_cause_id` ASC) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  CONSTRAINT `fk_deces_secondaire_deces_principal1`
    FOREIGN KEY (`death_primary_cause_id`)
    REFERENCES `death_primary_causes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `states`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `states` ;

CREATE TABLE IF NOT EXISTS `states` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `color` CHAR(6) NULL COMMENT 'Codage hexadécimal de la composition RVB (par exemple f8d345)',
  `symbol` CHAR(1) NOT NULL,
  `css_property` VARCHAR(45) NULL,
  `is_default` BOOLEAN NOT NULL DEFAULT 0,
  `needs_user_action` BOOLEAN NOT NULL DEFAULT 0,
  `needs_staff_action` BOOLEAN NOT NULL DEFAULT 0,
  `is_reliable` BOOLEAN NOT NULL DEFAULT 0,
  `is_visible` BOOLEAN NOT NULL DEFAULT 1,
  `is_searchable` BOOLEAN NOT NULL DEFAULT 1,
  `is_frozen` BOOLEAN NOT NULL DEFAULT 0,
  `next_ok_state_id` INT UNSIGNED NULL,
  `next_ko_state_id` INT UNSIGNED NULL,
  `next_frozen_state_id` INT UNSIGNED NULL,
  `next_thawed_state_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  INDEX `fk_states_states1_idx` (`next_ok_state_id` ASC) ,
  INDEX `fk_states_states2_idx` (`next_ko_state_id` ASC) ,
  INDEX `fk_states_states3_idx` (`next_frozen_state_id` ASC) ,
  INDEX `fk_states_states4_idx` (`next_thawed_state_id` ASC) ,
  CONSTRAINT `fk_states_states1`
    FOREIGN KEY (`next_ok_state_id`)
    REFERENCES `states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_states_states2`
    FOREIGN KEY (`next_ko_state_id`)
    REFERENCES `states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_states_states3`
    FOREIGN KEY (`next_frozen_state_id`)
    REFERENCES `states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_states_states4`
    FOREIGN KEY (`next_thawed_state_id`)
    REFERENCES `states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `countries`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `countries` ;

CREATE TABLE IF NOT EXISTS `countries` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `iso3166` CHAR(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  UNIQUE INDEX `iso3166_UNIQUE` (`iso3166` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ratteries`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ratteries` ;

CREATE TABLE IF NOT EXISTS `ratteries` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `prefix` VARCHAR(6) NOT NULL,
  `name` VARCHAR(70) NOT NULL,
  `owner_user_id` INT UNSIGNED NOT NULL,
  `birth_year` YEAR NULL,
  `is_alive` BOOLEAN NOT NULL DEFAULT 1,
  `is_generic` BOOLEAN NOT NULL DEFAULT 0,
  `district` VARCHAR(70) NULL,
  `zip_code` VARCHAR(12) NULL,
  `country_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `latitude` DECIMAL(10,7) NULL,
  `longitude` DECIMAL(10,7) NULL,
  `website` VARCHAR(255) NULL,
  `comments` TEXT NULL,
  `wants_statistic` BOOLEAN NOT NULL DEFAULT 1,
  `picture` VARCHAR(255) NOT NULL DEFAULT 'Unknown.png',
  `state_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `created` DATETIME NOT NULL DEFAULT '1981-08-01',
  `modified` DATETIME NOT NULL DEFAULT '1981-08-01',
  PRIMARY KEY (`id`),
  INDEX `fk_ratteries_users_idx` (`owner_user_id` ASC) ,
  INDEX `fk_ratteries_states_idx` (`state_id` ASC) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  UNIQUE INDEX `prefix_UNIQUE` (`prefix` ASC) ,
  INDEX `fk_ratteries_countries1_idx` (`country_id` ASC) ,
  CONSTRAINT `fk_lord_ratteries_lord_users1`
    FOREIGN KEY (`owner_user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ratteries_states1`
    FOREIGN KEY (`state_id`)
    REFERENCES `states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ratteries_countries1`
    FOREIGN KEY (`country_id`)
    REFERENCES `countries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `litters`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `litters` ;

CREATE TABLE IF NOT EXISTS `litters` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `mating_date` DATE NULL,
  `birth_date` DATE NOT NULL,
  `pups_number` TINYINT UNSIGNED NOT NULL,
  `pups_number_stillborn` TINYINT UNSIGNED NULL DEFAULT 0,
  `comments` TEXT NULL,
  `creator_user_id` INT UNSIGNED NOT NULL,
  `state_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `created` DATETIME NOT NULL DEFAULT "1981-08-01",
  `modified` DATETIME NOT NULL DEFAULT "1981-08-01",
  PRIMARY KEY (`id`),
  INDEX `fk_itter_breeder_user_idx` (`creator_user_id` ASC) ,
  INDEX `fk_litters_states1_idx` (`state_id` ASC) ,
  CONSTRAINT `fk_itter_breeder_user`
    FOREIGN KEY (`creator_user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_litters_states1`
    FOREIGN KEY (`state_id`)
    REFERENCES `states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rats`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rats` ;

CREATE TABLE IF NOT EXISTS `rats` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `pedigree_identifier` VARCHAR(16) NULL,
  `is_pedigree_custom` BOOLEAN NOT NULL DEFAULT 0,
  `owner_user_id` INT UNSIGNED NOT NULL,
  `name` VARCHAR(70) NOT NULL,
  `pup_name` VARCHAR(70) NULL,
  `sex` ENUM('M', 'F') NOT NULL,
  `birth_date` DATE NOT NULL,
  `rattery_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `litter_id` INT UNSIGNED NULL DEFAULT NULL,
  `color_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `eyecolor_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `dilution_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `marking_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `earset_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `coat_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `is_alive` BOOLEAN NOT NULL DEFAULT 1,
  `death_date` DATE NULL,
  `death_primary_cause_id` INT UNSIGNED NULL,
  `death_secondary_cause_id` INT UNSIGNED NULL,
  `death_euthanized` BOOLEAN NULL,
  `death_diagnosed` BOOLEAN NULL,
  `death_necropsied` BOOLEAN NULL,
  `comments` TEXT NULL,
  `picture` VARCHAR(255) NULL DEFAULT 'Unknown.png',
  `picture_thumbnail` VARCHAR(255) NULL,
  `creator_user_id` INT UNSIGNED NOT NULL,
  `state_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `created` DATETIME NOT NULL DEFAULT '1981-08-01',
  `modified` DATETIME NOT NULL DEFAULT '1981-08-01',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `Pedigree_identifier_UNIQUE` (`pedigree_identifier` ASC) ,
  INDEX `Fk_owner_idx` (`owner_user_id` ASC) ,
  INDEX `FK_color_idx` (`color_id` ASC) ,
  INDEX `FK_earset_idx` (`earset_id` ASC) ,
  INDEX `FK_eyecolor_idx` (`eyecolor_id` ASC) ,
  INDEX `fk_dilution_idx` (`dilution_id` ASC) ,
  INDEX `fk_coat_idx` (`coat_id` ASC) ,
  INDEX `fk_marking_idx` (`marking_id` ASC) ,
  INDEX `FK_death_primary_cause_idx` (`death_primary_cause_id` ASC) ,
  INDEX `FK_creator_idx` (`creator_user_id` ASC) ,
  INDEX `fk_death_secondary_cause_idx` (`death_secondary_cause_id` ASC) ,
  INDEX `fk_states_idx` (`state_id` ASC) ,
  INDEX `fk_rats_ratteries1_idx` (`rattery_id` ASC) ,
  INDEX `fk_rats_litters1_idx` (`litter_id` ASC) ,
  CONSTRAINT `Fk_owner`
    FOREIGN KEY (`owner_user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_color`
    FOREIGN KEY (`color_id`)
    REFERENCES `colors` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_earset`
    FOREIGN KEY (`earset_id`)
    REFERENCES `earsets` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_eyecolor`
    FOREIGN KEY (`eyecolor_id`)
    REFERENCES `eyecolors` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dilution`
    FOREIGN KEY (`dilution_id`)
    REFERENCES `dilutions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_coat`
    FOREIGN KEY (`coat_id`)
    REFERENCES `coats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_marking`
    FOREIGN KEY (`marking_id`)
    REFERENCES `markings` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_death_primary_cause`
    FOREIGN KEY (`death_primary_cause_id`)
    REFERENCES `death_primary_causes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_creator`
    FOREIGN KEY (`creator_user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_death_secondary_cause`
    FOREIGN KEY (`death_secondary_cause_id`)
    REFERENCES `death_secondary_causes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_state`
    FOREIGN KEY (`state_id`)
    REFERENCES `states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rats_ratteries1`
    FOREIGN KEY (`rattery_id`)
    REFERENCES `ratteries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rats_litters1`
    FOREIGN KEY (`litter_id`)
    REFERENCES `litters` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Table centrale, qui contient l\'ensemble des rats enregistrés\n';


-- -----------------------------------------------------
-- Table `singularities`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singularities` ;

CREATE TABLE IF NOT EXISTS `singularities` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `picture` VARCHAR(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` VARCHAR(70) NOT NULL,
  `description` TEXT NOT NULL,
  `is_picture_mandatory` BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
COMMENT = 'Table référençant la liste des particularités';


-- -----------------------------------------------------
-- Table `rats_singularities`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rats_singularities` ;

CREATE TABLE IF NOT EXISTS `rats_singularities` (
  `rat_id` INT UNSIGNED NOT NULL,
  `singularity_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`rat_id`, `singularity_id`),
  INDEX `singularities_key_idx` (`singularity_id` ASC) ,
  CONSTRAINT `rats_key`
    FOREIGN KEY (`rat_id`)
    REFERENCES `rats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `singularities_key`
    FOREIGN KEY (`singularity_id`)
    REFERENCES `singularities` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rat_messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rat_messages` ;

CREATE TABLE IF NOT EXISTS `rat_messages` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `rat_id` INT UNSIGNED NOT NULL,
  `from_user_id` INT UNSIGNED NOT NULL COMMENT 'Émetteur du message.',
  `content` TEXT NOT NULL,
  `created` DATETIME NOT NULL,
  `is_staff_request` BOOLEAN NOT NULL DEFAULT 0,
  `is_automatically_generated` BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_messages_users1_idx` (`from_user_id` ASC) ,
  INDEX `fk_rat_messages_rats1_idx` (`rat_id` ASC) ,
  CONSTRAINT `fk_messages_users1`
    FOREIGN KEY (`from_user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rat_messages_rats1`
    FOREIGN KEY (`rat_id`)
    REFERENCES `rats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rat_snapshots`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rat_snapshots` ;

CREATE TABLE IF NOT EXISTS `rat_snapshots` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `data` JSON NOT NULL,
  `rat_id` INT UNSIGNED NOT NULL,
  `state_id` INT UNSIGNED NOT NULL,
  `created` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_rat_snapshots_rats1_idx` (`rat_id` ASC) ,
  INDEX `fk_rat_snapshots_states1_idx` (`state_id` ASC) ,
  CONSTRAINT `fk_rat_snapshots_rats1`
    FOREIGN KEY (`rat_id`)
    REFERENCES `rats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rat_snapshots_states1`
    FOREIGN KEY (`state_id`)
    REFERENCES `states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `litter_snapshots`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `litter_snapshots` ;

CREATE TABLE IF NOT EXISTS `litter_snapshots` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `data` JSON NOT NULL,
  `litter_id` INT UNSIGNED NOT NULL,
  `state_id` INT UNSIGNED NOT NULL,
  `created` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_litter_snapshots_litters1_idx` (`litter_id` ASC) ,
  INDEX `fk_litter_snapshots_states1_idx` (`state_id` ASC) ,
  CONSTRAINT `fk_litter_snapshots_litters1`
    FOREIGN KEY (`litter_id`)
    REFERENCES `litters` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_litter_snapshots_states1`
    FOREIGN KEY (`state_id`)
    REFERENCES `states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rattery_snapshots`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rattery_snapshots` ;

CREATE TABLE IF NOT EXISTS `rattery_snapshots` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `data` JSON NOT NULL,
  `rattery_id` INT UNSIGNED NOT NULL,
  `state_id` INT UNSIGNED NOT NULL,
  `created` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_rattery_snapshots_ratteries1_idx` (`rattery_id` ASC) ,
  INDEX `fk_rattery_snapshots_states1_idx` (`state_id` ASC) ,
  CONSTRAINT `fk_rattery_snapshots_ratteries1`
    FOREIGN KEY (`rattery_id`)
    REFERENCES `ratteries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rattery_snapshots_states1`
    FOREIGN KEY (`state_id`)
    REFERENCES `states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logs` ;

CREATE TABLE IF NOT EXISTS `logs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `event` TEXT NOT NULL,
  `created` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `i18n`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `i18n` ;

CREATE TABLE IF NOT EXISTS `i18n` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `locale` VARCHAR(6) NOT NULL,
  `model` VARCHAR(255) NOT NULL,
  `foreign_key` INT(10) NOT NULL,
  `field` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `I18N_LOCALE_FIELD` (`locale` ASC, `model` ASC, `foreign_key` ASC, `field` ASC) ,
  INDEX `I18N_FIELD` (`model` ASC, `foreign_key` ASC, `field` ASC) )
ENGINE = InnoDB
COMMENT = 'Table conforme à l\'utilisation de la classe Cake\\ORM\\Behavior\\TranslateBehavior de type EAV.';


-- -----------------------------------------------------
-- Table `operators`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `operators` ;

CREATE TABLE IF NOT EXISTS `operators` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `symbol` CHAR(2) NOT NULL,
  `meaning` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `compatibilities`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `compatibilities` ;

CREATE TABLE IF NOT EXISTS `compatibilities` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `left_genotype` VARCHAR(255) NOT NULL,
  `operator_id` INT UNSIGNED NOT NULL,
  `right_genotype` VARCHAR(255) NOT NULL,
  `comments` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `genotype1.idx` (`left_genotype` ASC, `right_genotype` ASC) ,
  INDEX `genotype2.idx` (`right_genotype` ASC, `left_genotype` ASC) ,
  INDEX `fk_operator1_idx` (`operator_id` ASC) ,
  CONSTRAINT `fk_compatibilities_compatibility_relations1`
    FOREIGN KEY (`operator_id`)
    REFERENCES `operators` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Recensement des relations entre gènes.\nÀ améliorer ultérieurement. Pour référence : rgd.mcw.edu';


-- -----------------------------------------------------
-- Table `categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `categories` ;

CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `position` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `articles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `articles` ;

CREATE TABLE IF NOT EXISTS `articles` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL DEFAULT '',
  `subtitle` VARCHAR(255) NOT NULL DEFAULT '',
  `content` TEXT NOT NULL DEFAULT '',
  `created` DATETIME NOT NULL,
  `modified` DATETIME NOT NULL,
  `category_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `title_UNIQUE` (`title` ASC) ,
  INDEX `fk_articles_categories1_idx` (`category_id` ASC) ,
  CONSTRAINT `fk_articles_categories1`
    FOREIGN KEY (`category_id`)
    REFERENCES `categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rats_litters`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rats_litters` ;

CREATE TABLE IF NOT EXISTS `rats_litters` (
  `rat_id` INT UNSIGNED NOT NULL,
  `litter_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`rat_id`, `litter_id`),
  INDEX `fk_rats_litters_litters1_idx` (`litter_id` ASC) ,
  CONSTRAINT `fk_rats_has_litters_rats1`
    FOREIGN KEY (`rat_id`)
    REFERENCES `rats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rats_has_litters_litters1`
    FOREIGN KEY (`litter_id`)
    REFERENCES `litters` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'These rats are siring a litter.';


-- -----------------------------------------------------
-- Table `contribution_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contribution_types` ;

CREATE TABLE IF NOT EXISTS `contribution_types` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `priority` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  UNIQUE INDEX `priority_UNIQUE` (`priority` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contributions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contributions` ;

CREATE TABLE IF NOT EXISTS `contributions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `rattery_id` INT UNSIGNED NOT NULL,
  `litter_id` INT UNSIGNED NOT NULL,
  `contribution_type_id` INT UNSIGNED NOT NULL,
  INDEX `fk_ratteries_has_litters_litters1_idx` (`litter_id` ASC) ,
  INDEX `fk_ratteries_has_litters_ratteries1_idx` (`rattery_id` ASC) ,
  PRIMARY KEY (`id`),
  INDEX `fk_contributions_contribution_types1_idx` (`contribution_type_id` ASC) ,
  CONSTRAINT `fk_ratteries_has_litters_ratteries1`
    FOREIGN KEY (`rattery_id`)
    REFERENCES `ratteries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ratteries_has_litters_litters1`
    FOREIGN KEY (`litter_id`)
    REFERENCES `litters` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contributions_contribution_types1`
    FOREIGN KEY (`contribution_type_id`)
    REFERENCES `contribution_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `faqs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `faqs` ;

CREATE TABLE IF NOT EXISTS `faqs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` INT UNSIGNED NOT NULL,
  `question` VARCHAR(255) NOT NULL,
  `answer` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_faqs_categories1_idx` (`category_id` ASC) ,
  CONSTRAINT `fk_faqs_categories1`
    FOREIGN KEY (`category_id`)
    REFERENCES `categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `issues`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `issues` ;

CREATE TABLE IF NOT EXISTS `issues` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `is_open` BOOLEAN NOT NULL DEFAULT 1,
  `url` VARCHAR(255) NOT NULL,
  `complaint` TEXT NOT NULL,
  `handling` TEXT NULL,
  `created` DATETIME NOT NULL,
  `closed` DATETIME NULL,
  `from_user_id` INT UNSIGNED NOT NULL,
  `closing_user_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_issues_users1_idx` (`from_user_id` ASC) ,
  INDEX `fk_issues_users2_idx` (`closing_user_id` ASC) ,
  CONSTRAINT `fk_issues_users1`
    FOREIGN KEY (`from_user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_issues_users2`
    FOREIGN KEY (`closing_user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rattery_messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rattery_messages` ;

CREATE TABLE IF NOT EXISTS `rattery_messages` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ratteries_id` INT UNSIGNED NOT NULL,
  `from_user_id` INT UNSIGNED NOT NULL COMMENT 'Émetteur du message.',
  `content` TEXT NOT NULL,
  `created` DATETIME NOT NULL,
  `is_staff_request` BOOLEAN NOT NULL DEFAULT 0,
  `is_automatically_generated` BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_messages_users1_idx` (`from_user_id` ASC) ,
  INDEX `fk_rattery_messages_ratteries1_idx` (`ratteries_id` ASC) ,
  CONSTRAINT `fk_messages_users10`
    FOREIGN KEY (`from_user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rattery_messages_ratteries1`
    FOREIGN KEY (`ratteries_id`)
    REFERENCES `ratteries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `litter_messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `litter_messages` ;

CREATE TABLE IF NOT EXISTS `litter_messages` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `litter_id` INT UNSIGNED NOT NULL,
  `from_user_id` INT UNSIGNED NOT NULL COMMENT 'Émetteur du message.',
  `content` TEXT NOT NULL,
  `created` DATETIME NOT NULL,
  `is_staff_request` BOOLEAN NOT NULL DEFAULT 0,
  `is_automatically_generated` BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_messages_users1_idx` (`from_user_id` ASC) ,
  INDEX `fk_litter_messages_litters1_idx` (`litter_id` ASC) ,
  CONSTRAINT `fk_messages_users100`
    FOREIGN KEY (`from_user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_litter_messages_litters1`
    FOREIGN KEY (`litter_id`)
    REFERENCES `litters` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
