<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjUtil extends pjToolkit
{
	static public function getLimitAnswers($cnt_answers, $limit_answers)
	{
		$element = '';
		$element .= '<select name="limit_answers" id="limit_answers" class="pj-form-field w80">';
		for($i = 1; $i <= $cnt_answers; $i++)
		{
			if($i == $limit_answers)
			{
				$element .= '<option value="'.$i.'" selected="selected">'.$i.'</option>';
			}else{
				$element .= '<option value="'.$i.'">'.$i.'</option>';
			}
		}
		$element .='</select>';
		
		return $element;
	}
}
?>