<?php echo $header; ?>
<div
	class="container">

	<!-- Main component for a primary marketing message or call to action -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">2014年1月 交易记录</h3>
		</div>
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th style="width: 12%">日 期</th>
						<th class="r" style="width: 12%">[1%] 赢利目标</th>
						<th class="r" style="width: 12%">实际赢利</th>
						<th class="r" style="width: 12%">资产目标</th>
						<th class="r" style="width: 12%">实际资产</th>
						<th class="c" style="">总结分析</th>
					</tr>
				</thead>
				<tbody>
					<?php $year = '2014'; $month = '01'; $day = '03'; $total=15000;?>
					<?php for($day_index = 1;$day_index<=date("t",mktime(0,0,0,$month,$day,$year));$day_index++){?>
					
					<tr>
						<td><?php echo $year.'-'.$month.'-'.sprintf("%02d",$day_index).''; ?></td>
						<?php 
							if(strcmp(date("w",mktime(0,0,0,$month,$day_index,$year)),0)==0 || strcmp(date("w",mktime(0,0,0,$month,$day_index,$year)),6)==0)
							{
						?>	
							<td class="r"></td>
							<td class="r"></td>
							<td class="r"></td>
							<td class="r"></td>
							<td class="c g"></td>	
						<?php
							}
							else 
							{
								$profit = 0.01*$total;
								$total = $total + $profit;
						?>	
							<td class="r"><?php echo number_format($profit,2);?></td>
							<td class="r"></td>
							<td class="r"><?php echo number_format($total,2);?></td>
							<td class="r"></td>
							<td class="c g"></td>
						<?php
							}
						?>
					</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>

</div>
<!-- /container -->
<?php echo $footer; ?>