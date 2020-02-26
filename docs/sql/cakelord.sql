-- MySQL Script generated by MySQL Workbench
-- mer. 26 févr. 2020 15:16:50 CET
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema cakelord
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `cakelord` ;

-- -----------------------------------------------------
-- Schema cakelord
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cakelord` DEFAULT CHARACTER SET utf8mb4 ;
USE `cakelord` ;

-- -----------------------------------------------------
-- Table `cakelord`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`roles` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`roles` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cakelord`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`users` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(70) NOT NULL,
  `password` VARCHAR(70) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `firstname` VARCHAR(45) NULL,
  `lastname` VARCHAR(45) NULL,
  `birth_date` DATE NULL,
  `sex` ENUM('F', 'M') NULL,
  `localization` VARCHAR(255) NULL,
  `avatar` VARCHAR(255) NOT NULL DEFAULT 'Unknown.png',
  `about_me` TEXT NULL,
  `wants_newsletter` TINYINT(1) NOT NULL DEFAULT 0,
  `role_id` INT UNSIGNED NOT NULL DEFAULT 3,
  `failed_login_attempts` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `failed_login_last_date` DATETIME NULL,
  `is_locked` TINYINT(1) NOT NULL DEFAULT 0,
  `staff_comments` TEXT NOT NULL DEFAULT '',
  `created` DATETIME NOT NULL DEFAULT '1981-08-01',
  `modified` DATETIME NOT NULL DEFAULT '1981-08-01',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  CONSTRAINT `fk_users_roles`
    FOREIGN KEY (`role_id`)
    REFERENCES `cakelord`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cakelord`.`states`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`states` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`states` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `color` CHAR(6) NOT NULL COMMENT 'Codage hexadécimal de la composition RVB (par exemple f8d345)',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cakelord`.`countries`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`countries` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`countries` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `iso3166` CHAR(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  UNIQUE INDEX `iso3166_UNIQUE` (`iso3166` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cakelord`.`ratteries`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`ratteries` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`ratteries` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `prefix` VARCHAR(3) NOT NULL,
  `name` VARCHAR(70) NOT NULL,
  `owner_user_id` INT UNSIGNED NOT NULL,
  `birth_year` YEAR NULL,
  `is_alive` TINYINT(1) NOT NULL DEFAULT 1,
  `district` VARCHAR(70) NULL,
  `zip_code` VARCHAR(12) NULL,
  `website` VARCHAR(255) NULL,
  `comments` TEXT NULL,
  `picture` VARCHAR(255) NOT NULL DEFAULT 'Unknown.png',
  `state_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `created` DATETIME NOT NULL DEFAULT "1981-08-01",
  `modified` DATETIME NOT NULL DEFAULT "1981-08-01",
  `countries_id` INT UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  UNIQUE INDEX `prefix_UNIQUE` (`prefix` ASC),
  CONSTRAINT `fk_lord_ratteries_lord_users1`
    FOREIGN KEY (`owner_user_id`)
    REFERENCES `cakelord`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ratteries_states1`
    FOREIGN KEY (`state_id`)
    REFERENCES `cakelord`.`states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ratteries_countries1`
    FOREIGN KEY (`countries_id`)
    REFERENCES `cakelord`.`countries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cakelord`.`eyecolors`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`eyecolors` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`eyecolors` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `picture` VARCHAR(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` VARCHAR(70) NOT NULL,
  `description` TEXT NOT NULL,
  `is_picture_mandatory` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB
COMMENT = 'Table contenant la liste des yeux';


-- -----------------------------------------------------
-- Table `cakelord`.`colors`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`colors` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`colors` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `genotype` VARCHAR(70) NOT NULL,
  `picture` VARCHAR(255) NOT NULL DEFAULT 'Unknown.png',
  `eyecolor_id` INT UNSIGNED NOT NULL,
  `description` TEXT NOT NULL,
  `is_picture_mandatory` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  CONSTRAINT `fk_colors_eyecolors1`
    FOREIGN KEY (`eyecolor_id`)
    REFERENCES `cakelord`.`eyecolors` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cakelord`.`earsets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`earsets` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`earsets` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `picture` VARCHAR(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` VARCHAR(70) NOT NULL,
  `description` TEXT NOT NULL,
  `is_picture_mandatory` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cakelord`.`dilutions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`dilutions` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`dilutions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `picture` VARCHAR(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` VARCHAR(70) NOT NULL,
  `description` TEXT NOT NULL,
  `is_picture_mandatory` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB
COMMENT = 'Table référençant la liste des dilutions';


-- -----------------------------------------------------
-- Table `cakelord`.`coats`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`coats` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`coats` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `picture` VARCHAR(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` VARCHAR(70) NOT NULL,
  `description` TEXT NOT NULL,
  `is_picture_mandatory` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB
COMMENT = 'Table référençant la liste des poils';


-- -----------------------------------------------------
-- Table `cakelord`.`markings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`markings` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`markings` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `picture` VARCHAR(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` VARCHAR(70) NOT NULL,
  `description` TEXT NOT NULL,
  `is_picture_mandatory` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB
COMMENT = 'Table référençant la liste des marquages';


-- -----------------------------------------------------
-- Table `cakelord`.`death_primary_causes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`death_primary_causes` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`death_primary_causes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB
COMMENT = 'Table référençant la liste des causes de décès';


-- -----------------------------------------------------
-- Table `cakelord`.`death_secondary_causes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`death_secondary_causes` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`death_secondary_causes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `death_primary_cause_id` INT UNSIGNED NOT NULL,
  `description` TEXT NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  CONSTRAINT `fk_deces_secondaire_deces_principal1`
    FOREIGN KEY (`death_primary_cause_id`)
    REFERENCES `cakelord`.`death_primary_causes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cakelord`.`litters`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`litters` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`litters` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `rattery_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `mother_rat_id` INT UNSIGNED NOT NULL,
  `father_rat_id` INT UNSIGNED NULL,
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
  CONSTRAINT `fk_litter_mother_rat`
    FOREIGN KEY (`mother_rat_id`)
    REFERENCES `cakelord`.`rats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_litter_father_rat`
    FOREIGN KEY (`father_rat_id`)
    REFERENCES `cakelord`.`rats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_itter_breeder_user`
    FOREIGN KEY (`creator_user_id`)
    REFERENCES `cakelord`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_litters_states1`
    FOREIGN KEY (`state_id`)
    REFERENCES `cakelord`.`states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_litters_ratteries1`
    FOREIGN KEY (`rattery_id`)
    REFERENCES `cakelord`.`ratteries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cakelord`.`rats`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`rats` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`rats` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `pedigree_identifier` VARCHAR(10) NOT NULL,
  `owner_user_id` INT UNSIGNED NULL,
  `name` VARCHAR(70) NOT NULL,
  `pup_name` VARCHAR(70) NULL,
  `sex` CHAR NOT NULL,
  `birth_date` DATE NULL,
  `rattery_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `mother_rat_id` INT UNSIGNED NULL,
  `father_rat_id` INT UNSIGNED NULL,
  `litter_id` INT UNSIGNED NULL,
  `mother_rattery_id` INT UNSIGNED NULL,
  `father_rattery_id` INT UNSIGNED NULL,
  `color_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `eyecolor_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `dilution_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `marking_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `earset_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `coat_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `is_alive` TINYINT(1) NOT NULL DEFAULT 0,
  `death_date` DATE NULL,
  `death_primary_cause_id` INT UNSIGNED NULL,
  `death_secondary_cause_id` INT UNSIGNED NULL,
  `death_euthanized` TINYINT(1) NULL,
  `death_diagnosed` TINYINT(1) NULL,
  `death_necropsied` TINYINT(1) NULL,
  `comments` TEXT NULL,
  `picture` VARCHAR(255) NULL,
  `picture_thumbnail` VARCHAR(255) NULL,
  `creator_user_id` INT UNSIGNED NOT NULL,
  `state_id` INT UNSIGNED NOT NULL DEFAULT 1,
  `created` DATETIME NOT NULL DEFAULT "1981-08-01",
  `modified` DATETIME NOT NULL DEFAULT "1981-08-01",
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `Pedigree_identifier_UNIQUE` (`pedigree_identifier` ASC),
  CONSTRAINT `FK_mother_rattery`
    FOREIGN KEY (`mother_rattery_id`)
    REFERENCES `cakelord`.`ratteries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_father_rat`
    FOREIGN KEY (`father_rat_id`)
    REFERENCES `cakelord`.`rats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_mother_rat`
    FOREIGN KEY (`mother_rat_id`)
    REFERENCES `cakelord`.`rats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Fk_owner`
    FOREIGN KEY (`owner_user_id`)
    REFERENCES `cakelord`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_color`
    FOREIGN KEY (`color_id`)
    REFERENCES `cakelord`.`colors` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_earset`
    FOREIGN KEY (`earset_id`)
    REFERENCES `cakelord`.`earsets` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_eyecolor`
    FOREIGN KEY (`eyecolor_id`)
    REFERENCES `cakelord`.`eyecolors` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dilution`
    FOREIGN KEY (`dilution_id`)
    REFERENCES `cakelord`.`dilutions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_coat`
    FOREIGN KEY (`coat_id`)
    REFERENCES `cakelord`.`coats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_marking`
    FOREIGN KEY (`marking_id`)
    REFERENCES `cakelord`.`markings` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_death_primary_cause`
    FOREIGN KEY (`death_primary_cause_id`)
    REFERENCES `cakelord`.`death_primary_causes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_creator`
    FOREIGN KEY (`creator_user_id`)
    REFERENCES `cakelord`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_father_rattery`
    FOREIGN KEY (`father_rattery_id`)
    REFERENCES `cakelord`.`ratteries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_death_secondary_cause`
    FOREIGN KEY (`death_secondary_cause_id`)
    REFERENCES `cakelord`.`death_secondary_causes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_litter`
    FOREIGN KEY (`litter_id`)
    REFERENCES `cakelord`.`litters` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_state`
    FOREIGN KEY (`state_id`)
    REFERENCES `cakelord`.`states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rats_ratteries1`
    FOREIGN KEY (`rattery_id`)
    REFERENCES `cakelord`.`ratteries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Table centrale, qui contient l\'ensemble des rats enregistrés\n';


-- -----------------------------------------------------
-- Table `cakelord`.`singularities`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`singularities` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`singularities` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `picture` VARCHAR(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` VARCHAR(70) NOT NULL,
  `description` TEXT NOT NULL,
  `is_picture_mandatory` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB
COMMENT = 'Table référençant la liste des particularités';


-- -----------------------------------------------------
-- Table `cakelord`.`rats_singularities`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`rats_singularities` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`rats_singularities` (
  `rat_id` INT UNSIGNED NOT NULL,
  `singularity_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`rat_id`, `singularity_id`),
  CONSTRAINT `rats_key`
    FOREIGN KEY (`rat_id`)
    REFERENCES `cakelord`.`rats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `singularities_key`
    FOREIGN KEY (`singularity_id`)
    REFERENCES `cakelord`.`singularities` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cakelord`.`conversations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`conversations` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`conversations` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `rat_id` INT UNSIGNED NULL,
  `rattery_id` INT UNSIGNED NULL,
  `litter_id` INT UNSIGNED NULL,
  `created` DATETIME NOT NULL,
  `modified` DATETIME NOT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_conversations_ratteries1`
    FOREIGN KEY (`rattery_id`)
    REFERENCES `cakelord`.`ratteries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conversations_litters1`
    FOREIGN KEY (`litter_id`)
    REFERENCES `cakelord`.`litters` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conversations_rats1`
    FOREIGN KEY (`rat_id`)
    REFERENCES `cakelord`.`rats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = ' ';


-- -----------------------------------------------------
-- Table `cakelord`.`messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`messages` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`messages` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `conversation_id` INT UNSIGNED NOT NULL,
  `content` TEXT NOT NULL,
  `from_user_id` INT UNSIGNED NOT NULL COMMENT 'Émetteur du message.',
  `created` DATETIME NOT NULL,
  PRIMARY KEY (`id`, `conversation_id`),
  CONSTRAINT `fk_messages_conversations1`
    FOREIGN KEY (`conversation_id`)
    REFERENCES `cakelord`.`conversations` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_messages_users1`
    FOREIGN KEY (`from_user_id`)
    REFERENCES `cakelord`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cakelord`.`users_conversations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`users_conversations` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`users_conversations` (
  `user_id` INT UNSIGNED NOT NULL,
  `conversation_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`, `conversation_id`),
  CONSTRAINT `fk_users_has_conversations_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `cakelord`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_conversations_conversations1`
    FOREIGN KEY (`conversation_id`)
    REFERENCES `cakelord`.`conversations` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cakelord`.`rat_snapshots`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`rat_snapshots` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`rat_snapshots` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `data` JSON NOT NULL,
  `rat_id` INT UNSIGNED NOT NULL,
  `state_id` INT UNSIGNED NOT NULL,
  `created` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_rat_snapshots_rats1`
    FOREIGN KEY (`rat_id`)
    REFERENCES `cakelord`.`rats` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rat_snapshots_states1`
    FOREIGN KEY (`state_id`)
    REFERENCES `cakelord`.`states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cakelord`.`litter_snapshots`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`litter_snapshots` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`litter_snapshots` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `data` JSON NOT NULL,
  `litter_id` INT UNSIGNED NOT NULL,
  `state_id` INT UNSIGNED NOT NULL,
  `created` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_litter_snapshots_litters1`
    FOREIGN KEY (`litter_id`)
    REFERENCES `cakelord`.`litters` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_litter_snapshots_states1`
    FOREIGN KEY (`state_id`)
    REFERENCES `cakelord`.`states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cakelord`.`rattery_snapshots`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`rattery_snapshots` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`rattery_snapshots` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `data` JSON NOT NULL,
  `rattery_id` INT UNSIGNED NOT NULL,
  `state_id` INT UNSIGNED NOT NULL,
  `created` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_rattery_snapshots_ratteries1`
    FOREIGN KEY (`rattery_id`)
    REFERENCES `cakelord`.`ratteries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rattery_snapshots_states1`
    FOREIGN KEY (`state_id`)
    REFERENCES `cakelord`.`states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cakelord`.`logs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`logs` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`logs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `event` TEXT NOT NULL,
  `created` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cakelord`.`i18n`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`i18n` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`i18n` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `locale` VARCHAR(6) NOT NULL,
  `model` VARCHAR(255) NOT NULL,
  `foreign_key` INT(10) NOT NULL,
  `field` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `I18N_LOCALE_FIELD` (`locale` ASC, `model` ASC, `foreign_key` ASC, `field` ASC),
  INDEX `I18N_FIELD` (`model` ASC, `foreign_key` ASC, `field` ASC))
ENGINE = InnoDB
COMMENT = 'Table conforme à l\'utilisation de la classe Cake\\ORM\\Behavior\\TranslateBehavior de type EAV.';


-- -----------------------------------------------------
-- Table `cakelord`.`operators`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`operators` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`operators` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `symbol` CHAR(2) NOT NULL,
  `meaning` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cakelord`.`compatibilities`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`compatibilities` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`compatibilities` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `left_genotype` VARCHAR(255) NOT NULL,
  `operator_id` INT UNSIGNED NOT NULL,
  `right_genotype` VARCHAR(255) NOT NULL,
  `comments` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `genotype1.idx` (`left_genotype` ASC, `right_genotype` ASC),
  INDEX `genotype2.idx` (`right_genotype` ASC, `left_genotype` ASC),
  CONSTRAINT `fk_compatibilities_compatibility_relations1`
    FOREIGN KEY (`operator_id`)
    REFERENCES `cakelord`.`operators` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Recensement des relations entre gènes.\nÀ améliorer ultérieurement. Pour référence : rgd.mcw.edu';


-- -----------------------------------------------------
-- Table `cakelord`.`articles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cakelord`.`articles` ;

CREATE TABLE IF NOT EXISTS `cakelord`.`articles` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL DEFAULT '',
  `subtitle` VARCHAR(255) NOT NULL DEFAULT '',
  `content` TEXT NOT NULL DEFAULT '',
  `created` DATETIME NOT NULL,
  `modified` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `title_UNIQUE` (`title` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
