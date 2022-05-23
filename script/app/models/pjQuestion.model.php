<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjQuestionModel extends pjAppModel
{
	protected $primaryKey = 'id';
	
	protected $table = 'questions';
	
	protected $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'question', 'type' => 'text', 'default' => ':NULL'),
		array('name' => 'skin', 'type' => 'enum', 'default' => ':NULL'),
		array('name' => 'width', 'type' => 'int', 'default' => '320'),
		array('name' => 'days', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'limit_via', 'type' => 'enum', 'default' => 'ip'),
		array('name' => 'show_result', 'type' => 'enum', 'default' => 'both'),
		array('name' => 'stop_poll', 'type' => 'enum', 'default' => 'F'),
		array('name' => 'use_interval', 'type' => 'enum', 'default' => 'F'),
		array('name' => 'start_time', 'type' => 'datetime', 'default' => ':NULL'),
		array('name' => 'stop_time', 'type' => 'datetime', 'default' => ':NULL'),
		array('name' => 'multiple_vote', 'type' => 'enum', 'default' => 'F'),
		array('name' => 'limit_answers', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'modified', 'type' => 'datetime', 'default' => ':NULL'),
		array('name' => 'created', 'type' => 'datetime', 'default' => ':NOW()'),
		array('name' => 'status', 'type' => 'enum', 'default' => 'T')
	);
	
	public static function factory($attr=array())
	{
		return new pjQuestionModel($attr);
	}
}
?>