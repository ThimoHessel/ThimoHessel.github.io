
START TRANSACTION;

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "front_question_disabled");
UPDATE `multi_lang` SET `content` = 'Sorry! This poll is not active anymore.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "front_question_not_started");
UPDATE `multi_lang` SET `content` = 'Sorry! This poll is not started by the administrator yet.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "front_question_stopped");
UPDATE `multi_lang` SET `content` = 'Sorry! This poll was stopped by the administrator.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

COMMIT;