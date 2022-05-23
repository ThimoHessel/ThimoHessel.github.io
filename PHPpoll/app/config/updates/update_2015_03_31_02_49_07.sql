
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'lblShowResultTip', 'backend', 'Tip / Show result', 'script', '2015-03-31 02:42:28');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'In the Show Results column you can set number of votes that front end poll will show e.g. you can manipulate the number of votes displayed on the poll.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'In the Show Results column you can set number of votes that front end poll will show e.g. you can manipulate the number of votes displayed on the poll.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'In the Show Results column you can set number of votes that front end poll will show e.g. you can manipulate the number of votes displayed on the poll.', 'script');

COMMIT;