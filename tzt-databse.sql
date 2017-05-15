-- MySQL Script generated by MySQL Workbench
-- Mon May 15 12:05:20 2017
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema TZT
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema TZT
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `TZT` DEFAULT CHARACTER SET utf8 ;
USE `TZT` ;

-- -----------------------------------------------------
-- Table `TZT`.`Koerier`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TZT`.`Koerier` (
  `koerier_id` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`koerier_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TZT`.`Traject`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TZT`.`Traject` (
  `traject_id` INT NOT NULL AUTO_INCREMENT,
  `koerier_id` INT NOT NULL,
  `startpunt` VARCHAR(45) NOT NULL,
  `eindpunt` VARCHAR(45) NOT NULL,
  `vergoeding` DOUBLE NULL,
  PRIMARY KEY (`traject_id`),
  INDEX `koerier_id_idx` (`koerier_id` ASC),
  CONSTRAINT `koerier_traject_koerier_id`
    FOREIGN KEY (`koerier_id`)
    REFERENCES `TZT`.`Koerier` (`koerier_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TZT`.`Pakket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TZT`.`Pakket` (
  `pakket_id` INT NOT NULL AUTO_INCREMENT,
  `lengte` DOUBLE NOT NULL,
  `breedte` DOUBLE NOT NULL,
  `hoogte` DOUBLE NOT NULL,
  `gewicht` DOUBLE NOT NULL,
  PRIMARY KEY (`pakket_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TZT`.`Klant`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TZT`.`Klant` (
  `klant_id` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`klant_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TZT`.`Offerte`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TZT`.`Offerte` (
  `offerte_id` INT NOT NULL AUTO_INCREMENT,
  `klant_id` INT NOT NULL,
  `bedrag` DOUBLE NOT NULL,
  PRIMARY KEY (`offerte_id`),
  INDEX `klant_id_idx` (`klant_id` ASC),
  CONSTRAINT `klant_offerte_klant_id`
    FOREIGN KEY (`klant_id`)
    REFERENCES `TZT`.`Klant` (`klant_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TZT`.`Factuur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TZT`.`Factuur` (
  `factuur_id` INT NOT NULL,
  `offerte_id` INT NOT NULL,
  `betaald` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`factuur_id`),
  INDEX `offerte_id_idx` (`offerte_id` ASC),
  CONSTRAINT `offerte_id`
    FOREIGN KEY (`offerte_id`)
    REFERENCES `TZT`.`Offerte` (`offerte_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TZT`.`Treinreiziger`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TZT`.`Treinreiziger` (
  `treinreiziger_id` INT NOT NULL,
  INDEX `koerier_id_idx` (`treinreiziger_id` ASC),
  PRIMARY KEY (`treinreiziger_id`),
  CONSTRAINT `koerier_treinreiziger_koerier_id`
    FOREIGN KEY (`treinreiziger_id`)
    REFERENCES `TZT`.`Koerier` (`koerier_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TZT`.`Reis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TZT`.`Reis` (
  `Reis_id` INT NOT NULL AUTO_INCREMENT,
  `treinreiziger_id` INT NOT NULL,
  `startstation` VARCHAR(45) NOT NULL,
  `eindstation` VARCHAR(45) NOT NULL,
  `dag` INT NOT NULL,
  `tijd` DOUBLE NOT NULL,
  INDEX `koerier_id_idx` (`treinreiziger_id` ASC),
  PRIMARY KEY (`Reis_id`),
  CONSTRAINT `reis_treinreiziger_koerier_id`
    FOREIGN KEY (`treinreiziger_id`)
    REFERENCES `TZT`.`Treinreiziger` (`treinreiziger_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TZT`.`KoerierBezorgdPakket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TZT`.`KoerierBezorgdPakket` (
  `pakket_id` INT NOT NULL,
  `koerier_id` INT NOT NULL,
  INDEX `koerier_id_idx` (`koerier_id` ASC),
  CONSTRAINT `koerier_pakket_koerier_id`
    FOREIGN KEY (`koerier_id`)
    REFERENCES `TZT`.`Koerier` (`koerier_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `pakket_koerierbezorgdpakket_pakket_id`
    FOREIGN KEY (`pakket_id`)
    REFERENCES `TZT`.`Pakket` (`pakket_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TZT`.`Bezorgopdracht`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TZT`.`Bezorgopdracht` (
  `opdracht_id` INT NOT NULL AUTO_INCREMENT,
  `klant_id` INT NOT NULL,
  `pakket_id` INT NOT NULL,
  `startpunt` VARCHAR(45) NOT NULL,
  `eindpunt` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`opdracht_id`),
  INDEX `pakket_bezorgdopdracht_pakket_id_idx` (`pakket_id` ASC),
  INDEX `klant_bezorgdopdracht_klant_id_idx` (`klant_id` ASC),
  CONSTRAINT `pakket_bezorgdopdracht_pakket_id`
    FOREIGN KEY (`pakket_id`)
    REFERENCES `TZT`.`Pakket` (`pakket_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `klant_bezorgdopdracht_klant_id`
    FOREIGN KEY (`klant_id`)
    REFERENCES `TZT`.`Klant` (`klant_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TZT`.`TrajectDelen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TZT`.`TrajectDelen` (
  `opdracht_id` INT NOT NULL,
  `traject_id` INT NOT NULL,
  INDEX `traject_id_idx` (`traject_id` ASC),
  CONSTRAINT `opdracht_id`
    FOREIGN KEY (`opdracht_id`)
    REFERENCES `TZT`.`Bezorgopdracht` (`opdracht_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `traject_id`
    FOREIGN KEY (`traject_id`)
    REFERENCES `TZT`.`Traject` (`traject_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Tabel moet altijd aangemaakt worden ivm prijsberekening voor offerte.';


-- -----------------------------------------------------
-- Table `TZT`.`Tarief`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TZT`.`Tarief` (
  `tarief_id` INT NOT NULL AUTO_INCREMENT,
  `koerier_id` INT NOT NULL,
  `vastePrijs` DOUBLE NOT NULL,
  `kilometerTarief` DOUBLE NULL,
  `maximumAantalKilometers` DOUBLE NULL,
  INDEX `koerier_id_idx` (`koerier_id` ASC),
  PRIMARY KEY (`tarief_id`),
  CONSTRAINT `koerier_tarief_koerier_id`
    FOREIGN KEY (`koerier_id`)
    REFERENCES `TZT`.`Koerier` (`koerier_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
