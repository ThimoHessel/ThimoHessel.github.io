
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'lblPollWidth', 'backend', 'Tip / Poll width', 'script', '2015-04-01 02:32:40');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Poll width', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Poll width', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Poll width', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblAuto', 'backend', 'Tip / Auto (for responsive websites)', 'script', '2015-04-01 02:36:59');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Auto (for responsive websites)', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Auto (for responsive websites)', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Auto (for responsive websites)', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblFixedSize', 'backend', 'Label / Fixed size', 'script', '2015-04-01 02:37:26');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Fixed size', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Fixed size', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Fixed size', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblPixels', 'backend', 'Label / pixels', 'script', '2015-04-01 02:47:53');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'pixels', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'pixels', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'pixels', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoInstallPollTitle', 'backend', 'Infobox / Install Poll', 'script', '2015-04-06 03:18:47');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Install Poll', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Install Poll', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Install Poll', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoInstallPollDesc', 'backend', 'Infobox / Install Poll', 'script', '2015-04-06 03:19:23');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Copy the code below and paste it where you want your poll to be displayed. You can set a fixed width for your poll or leave the size to Auto and poll will fit the page element container where it is placed.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Copy the code below and paste it where you want your poll to be displayed. You can set a fixed width for your poll or leave the size to Auto and poll will fit the page element container where it is placed.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Copy the code below and paste it where you want your poll to be displayed. You can set a fixed width for your poll or leave the size to Auto and poll will fit the page element container where it is placed.', 'script');

COMMIT;