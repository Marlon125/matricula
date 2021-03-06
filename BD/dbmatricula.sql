-- MySQL Script generated by MySQL Workbench
-- Thu Nov 29 00:08:30 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema dbmatricula
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema dbmatricula
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dbmatricula` DEFAULT CHARACTER SET utf8 ;
USE `dbmatricula` ;

-- -----------------------------------------------------
-- Table `dbmatricula`.`credito`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbmatricula`.`credito` ;

CREATE TABLE IF NOT EXISTS `dbmatricula`.`credito` (
  `idcredito` INT NOT NULL AUTO_INCREMENT,
  `numero` INT NOT NULL,
  PRIMARY KEY (`idcredito`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbmatricula`.`estudiante`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbmatricula`.`estudiante` ;

CREATE TABLE IF NOT EXISTS `dbmatricula`.`estudiante` (
  `idestudiante` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `identificacion` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idestudiante`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbmatricula`.`materia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbmatricula`.`materia` ;

CREATE TABLE IF NOT EXISTS `dbmatricula`.`materia` (
  `idmateria` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idmateria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbmatricula`.`matricula`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbmatricula`.`matricula` ;

CREATE TABLE IF NOT EXISTS `dbmatricula`.`matricula` (
  `idmatricula` INT NOT NULL AUTO_INCREMENT,
  `horario` VARCHAR(45) NOT NULL,
  `idestudiante` INT NOT NULL,
  `materia_idmateria` INT NOT NULL,
  PRIMARY KEY (`idmatricula`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbmatricula`.`programa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbmatricula`.`programa` ;

CREATE TABLE IF NOT EXISTS `dbmatricula`.`programa` (
  `idprograma` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idprograma`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbmatricula`.`programa_semestre`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbmatricula`.`programa_semestre` ;

CREATE TABLE IF NOT EXISTS `dbmatricula`.`programa_semestre` (
  `idprograma` INT NOT NULL,
  `idsemestre` INT NOT NULL,
  PRIMARY KEY (`idprograma`, `idsemestre`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbmatricula`.`semestre`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbmatricula`.`semestre` ;

CREATE TABLE IF NOT EXISTS `dbmatricula`.`semestre` (
  `idsemestre` INT NOT NULL AUTO_INCREMENT,
  `numero` INT NOT NULL,
  PRIMARY KEY (`idsemestre`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbmatricula`.`semestre_materia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbmatricula`.`semestre_materia` ;

CREATE TABLE IF NOT EXISTS `dbmatricula`.`semestre_materia` (
  `idsemestre` INT NOT NULL,
  `idmateria` INT NOT NULL,
  `idcredito` INT NOT NULL,
  PRIMARY KEY (`idsemestre`, `idmateria`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
