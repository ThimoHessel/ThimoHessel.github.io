INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_titles_ARRAY_PBU01', 'arrays', 'error_titles_ARRAY_PBU01', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Backup', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Backup', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Backup', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_titles_ARRAY_PBU02', 'arrays', 'error_titles_ARRAY_PBU02', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Backup complete!', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Backup complete!', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Backup complete!', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_titles_ARRAY_PBU03', 'arrays', 'error_titles_ARRAY_PBU03', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Backup failed!', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Backup failed!', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Backup failed!', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_titles_ARRAY_PBU04', 'arrays', 'error_titles_ARRAY_PBU04', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Backup failed!', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Backup failed!', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Backup failed!', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_bodies_ARRAY_PBU01', 'arrays', 'error_bodies_ARRAY_PBU01', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'We recommend you to regularly back up your database and files to prevent any loss of information.', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'We recommend you to regularly back up your database and files to prevent any loss of information.', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'We recommend you to regularly back up your database and files to prevent any loss of information.', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_bodies_ARRAY_PBU02', 'arrays', 'error_bodies_ARRAY_PBU02', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'All backup files have been saved.', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'All backup files have been saved.', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'All backup files have been saved.', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_bodies_ARRAY_PBU03', 'arrays', 'error_bodies_ARRAY_PBU03', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'No option was selected.', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'No option was selected.', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'No option was selected.', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_bodies_ARRAY_PBU04', 'arrays', 'error_bodies_ARRAY_PBU04', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Backup not performed.', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Backup not performed.', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Backup not performed.', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_backup_menu_backup', 'backend', 'Backup plugin / Menu Backup', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Backup', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Backup', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Backup', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_backup_database', 'backend', 'Backup plugin / Backup database', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Backup database', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Backup database', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Backup database', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_backup_files', 'backend', 'Backup plugin / Backup files', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Backup files', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Backup files', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Backup files', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_backup_btn_backup', 'backend', 'Backup plugin / Backup button', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Backup', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Backup', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Backup', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_titles_ARRAY_PBU05', 'arrays', 'error_titles_ARRAY_PBU05', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Backup failed!', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Backup failed!', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Backup failed!', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_bodies_ARRAY_PBU05', 'arrays', 'error_bodies_ARRAY_PBU05', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Backup folder not found. Please ensure that "app/web/backup" folder exists.', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Backup folder not found. Please ensure that "app/web/backup" folder exists.', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Backup folder not found. Please ensure that "app/web/backup" folder exists.', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_titles_ARRAY_PBU06', 'arrays', 'error_titles_ARRAY_PBU06', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Backup failed!', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Backup failed!', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Backup failed!', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_bodies_ARRAY_PBU06', 'arrays', 'error_bodies_ARRAY_PBU06', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'You need to set write permissions (chmod 777) to "app/web/backup" folder.', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'You need to set write permissions (chmod 777) to "app/web/backup" folder.', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'You need to set write permissions (chmod 777) to "app/web/backup" folder.', 'plugin');