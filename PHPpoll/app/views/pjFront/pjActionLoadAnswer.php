<div class="panel-body pjPollBody">
	<?php
	if(!empty($tpl['answer_arr']))
	{
		$limit_message = __('front_limitation', true, true);
		$limit_message = str_replace("{answers}", $tpl['arr']['limit_answers'], $limit_message);
		?>
		<div id="phppoll_error_container_<?php echo $_GET['question_id'];?>" class="alert alert-warning" role="alert" style="display:none;"><?php __('front_choose_answer', false, true)?></div>
		<div id="phppoll_limitation_container_<?php echo $_GET['question_id'];?>" class="alert alert-warning" role="alert" style="display:none;"><?php echo $limit_message;?></div>
		
		<div class="form-group">
			<?php 
			foreach($tpl['answer_arr'] as $v)
			{
				?>
				<div class="<?php echo $tpl['arr']['multiple_vote'] == 'T' ? 'checkbox' : 'radio'; ?>">
					<label id="phppoll_element_label_<?php echo $v['id']?>" class="pjPollAnswer">
						<input type="<?php echo $tpl['arr']['multiple_vote'] == 'T' ? 'checkbox' : 'radio'; ?>" id="answer_<?php echo $v['id']?>" value="<?php echo $v['id']?>" name="answer" class="phppoll-vote-element">
						<?php echo pjSanitize::html($v['answer']);?>
					</label>
				</div>
				<?php
			} 
			?>
		</div>
		<button type="button" class="btn btn-default pjPollBtn pjPollBtnPrimary phpboll-button-vote"><?php __('front_button_vote', false, true)?></button>
		<?php
		if($tpl['arr']['show_result'] != 'none')
		{ 
			?>
			<a href="#" class="btn btn-default pjPollBtn phpboll-button-view"><?php __('front_button_view_results', false, true)?></a>
			<?php
		}
		?>	
		<?php
	}else{
		?>
		<p id="phppoll_error_container_<?php echo $_GET['question_id'];?>" class="phppoll-error"><?php __('front_answer_not_set', false, true)?></p>
		<?php 
	}
	?>
</div><!-- /.panel-body pjPollBody -->