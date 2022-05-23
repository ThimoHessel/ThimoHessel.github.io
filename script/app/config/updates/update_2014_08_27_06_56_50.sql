
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'infoQuestionAnswerBody2', 'backend', 'Infobox / Question and answers', 'script', '2014-08-27 13:39:59');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Enter poll question and answers. There should be at least 2 answers for your poll. In the Votes column you can see real votes number for each answer. In the Show Results column you can set number of votes that front end poll will show e.g. you can manipulate the number of votes displayed on the poll.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Enter poll question and answers. There should be at least 2 answers for your poll. In the Votes column you can see real votes number for each answer. In the Show Results column you can set number of votes that front end poll will show e.g. you can manipulate the number of votes displayed on the poll.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Enter poll question and answers. There should be at least 2 answers for your poll. In the Votes column you can see real votes number for each answer. In the Show Results column you can set number of votes that front end poll will show e.g. you can manipulate the number of votes displayed on the poll.', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblVotes', 'backend', 'Label / Votes', 'script', '2014-08-27 13:40:57');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Votes', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Votes', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Votes', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblShowResults2', 'backend', 'Label / Show Results', 'script', '2014-08-27 13:51:26');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Show Results', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Show Results', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Show Results', 'script');

COMMIT;