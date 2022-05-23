
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'infoPreviewTitle', 'backend', 'Infobox / Preview', 'script', '2015-03-30 08:55:28');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Preview', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Preview', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Preview', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoPreviewDesc', 'backend', 'Infobox / Preview', 'script', '2015-03-30 08:57:31');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'You can select the theme you want to preview from the drop down below. The selected theme will be saved to database. ', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'You can select the theme you want to preview from the drop down below. The selected theme will be saved to database. ', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'You can select the theme you want to preview from the drop down below. The selected theme will be saved to database. ', 'script');

COMMIT;