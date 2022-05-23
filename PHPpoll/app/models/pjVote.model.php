<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjVoteModel extends pjAppModel
{
	protected $primaryKey = 'id';
	
	protected $table = 'votes';
	
	protected $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'question_id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'answer_id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'ip', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'vote_time', 'type' => 'datetime', 'default' => ':NOW()')
	);
	
	public static function factory($attr=array())
	{
		return new pjVoteModel($attr);
	}
}
?>