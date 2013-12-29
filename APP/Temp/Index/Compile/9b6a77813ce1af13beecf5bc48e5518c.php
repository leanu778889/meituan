<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><!-- 商品过滤开始 -->
	<div id="filter">
		<div class='hots'>
			<span>热门团购：</span>
			<div class='box'>
				<?php if(is_array($hotCategory)):?><?php  foreach($hotCategory as $v){ ?>
					<a href="<?php echo U('Index/Index/index');?>/cid/<?php echo $v['cid'];?>"><?php echo $v['cname'];?></a>
				<?php }?><?php endif;?>

			</div>
		</div>

		<div class='filter-box'>
			<div class='category filter-label'>
				<div class='filter-label-level-1'>
					<span><b></b>分类：</span>
					<div class='box'>
						<?php if(is_array($topCategory)):?><?php  foreach($topCategory as $k=>$v){ ?>
							<?php echo $v;?>
						<?php }?><?php endif;?>
					</div>
				</div>
				<?php if($sonCategory){?>
					<div class='filter-label-level-2'>
						<div class='box'>
							<?php if(is_array($sonCategory)):?><?php  foreach($sonCategory as $k=>$v){ ?>
								<?php echo $v;?>
							<?php }?><?php endif;?>
						</div>
					</div>
				<?php }?>
			</div>
			<div class='locality filter-label'>
				<div class='filter-label-level-1'>
					<span><b></b>区域：</span>
					<div class='box'>
						<?php if(is_array($topLocality)):?><?php  foreach($topLocality as $k=>$v){ ?>
							<?php echo $v;?>
						<?php }?><?php endif;?>
					</div>
				</div>
				<?php if($sonLocality){?>
					<div class='filter-label-level-2'>
						<div class='box'>
							<?php if(is_array($sonLocality)):?><?php  foreach($sonLocality as $k=>$v){ ?>
								<?php echo $v;?>
							<?php }?><?php endif;?>
						</div>
					</div>
				<?php }?>
			</div>
			<div class='price filter-label'>
				<div class='filter-label-level-1'>
					<span><b></b>价格：</span>
					<div class='box'>
						<?php if(is_array($price)):?><?php  foreach($price as $v){ ?>
							<?php echo $v;?>
						<?php }?><?php endif;?>
					</div>
				</div>
			</div>
			<div class='screen'>
				<div>
					<a class='active' href="<?php echo $orderUrl['d'];?>">默认排序</a>
					<a href="<?php echo $orderUrl['b'];?>">销量<b></b></a>
					<a href="<?php echo $orderUrl['p_d'];?>">价格<b></b></a>
					<a  href="<?php echo $orderUrl['p_a'];?>">价格<b style="background-position:-45px -16px;"></b></a>
					<a style="border:0;" href="<?php echo $orderUrl['t'];?>">发布时间<b></b></a>
				</div>
			</div>
		</div>
	</div>
	<!-- 商品过滤结束 -->