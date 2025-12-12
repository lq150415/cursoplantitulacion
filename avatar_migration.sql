-- Migration to add avatar column to persona table
ALTER TABLE `persona` ADD `avatar` VARCHAR(255) NULL DEFAULT NULL AFTER `materno`;