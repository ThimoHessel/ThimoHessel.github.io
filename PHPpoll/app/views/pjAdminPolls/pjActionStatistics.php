<?php
if(!empty($tpl['answer_arr']))
{
	?>
	<table cellspacing="0" cellpadding="0" class="pj-table" style="width: 100%;">
		
		<tbody >
			<tr class="pj-table-row-odd">
				<td><?php __('lblTotalVotes', false, true); ?></td>
				<td colspan="2"><?php echo pjSanitize::html($tpl['arr']['total_votes']);?></td>
			</tr>
			<tr class="pj-table-row-odd">
				<td><?php __('lblTodayVotes', false, true); ?></td>
				<td colspan="2"><?php echo pjSanitize::html($tpl['arr']['today_votes']);?></td>
			</tr>
			<tr class="pj-table-row-even">
				<th><?php __('lblAnswerVotes', false, true); ?></th>
				<th><?php __('lblPercentage', false, true); ?></th>
				<th><?php __('lblAmount', false, true); ?></th>
			</tr>
			<?php
				$i = 1;
				foreach($tpl['answer_arr'] as $k => $v)
				{
					?>
					<tr class="pj-table-row-odd">
						<td>
							<?php echo pjSanitize::html($v['answer']);?>
						</td>
						<td>
							<?php
							$percent = 0;
							if($tpl['arr']['total_votes'] > 0)
							{
								$percent =  ($v['total_votes'] / $tpl['arr']['total_votes']) * 100;
							}
							echo number_format($percent, 2, '.', '') . '%';
							?>
						</td>
						<td>
							<?php echo pjSanitize::html($v['total_votes']);?>
						</td>
					</tr>
					<?php
					$i++;
				}
			?>
		</tbody>
	</table>
	<?php
} 
?>