<div class="panel-body pjPollBody pjPollBodyResults">
	<?php
	if(!empty($tpl['answer_arr']))
	{
		$total_count = intval($tpl['total_count']);
		foreach($tpl['answer_arr'] as $v)
		{
			$amount = intval($v['count']);
			$percentage = 0;
			$percent = '0%';
			if($total_count > 0)
			{
				$percentage = ($amount / $total_count) * 100;
				$percent = number_format($percentage, 2, '.', '') . '%';
			}
			
			if($amount == 1)
			{
				$amount .= ' ' . __('front_vote_singular', true, true);
			}else{
				$amount .= ' ' . __('front_vote_plural', true, true);
			}
			if($tpl['arr']['show_result'] == 'percent')
			{
				?>
				<p><?php echo pjSanitize::html($v['answer'])?> <strong><?php echo $percent?></strong></p>
				<?php
			}else if($tpl['arr']['show_result'] == 'amount'){
				?>
				<p><?php echo pjSanitize::html($v['answer'])?> <small><?php echo $amount;?></small></p>
				<?php
			}else if($tpl['arr']['show_result'] == 'both'){
				?>
				<p><?php echo pjSanitize::html($v['answer'])?> <strong><?php echo $percent;?></strong> <small>(<?php echo $amount;?>)</small></p>
				<?php
			} 
			?>
			<div class="progress pjPollResult">
				<div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent;?>">
                	<span class="sr-only"><?php echo $percent;?> Complete</span>
				</div>
			</div>
			<?php
		} 
		?>
		<p><?php __('front_total_votes', false, true)?> <strong><?php echo $total_count;?></strong></p>
		
		<?php
		if($tpl['arr']['stop_poll'] == 'F')
		{ 
			?>
			<a href="#" class="btn btn-default pjPollBtn phpboll-button-return"><?php __('front_button_return', false, true)?></a>
			<?php
		} 
	} 
	?>
</div><!-- /.panel-body pjPollBody -->