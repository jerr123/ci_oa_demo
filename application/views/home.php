<aside class="Hui-aside">
	<input runat="server" id="divScrollValue" type="hidden" value="" />
	<div class="menu_dropdown bk_2">
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 申请队列<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo site_url('Home/subForReview')?>" data-title="创建未提交" href="javascript:void(0)">创建未提交</a></li>
				</ul>
				<ul>
					<li><a _href="<?php echo site_url('Home/returnList')?>" data-title="退回待修改申请" href="javascript:void(0)">退回待修改申请</a></li>
				</ul>
				<ul>
					<li><a _href="<?php echo site_url('Home/rejectList')?>" data-title="已拒绝" href="javascript:void(0)">已拒绝</a></li>
				</ul>
				<ul>
					<li><a _href="<?php echo site_url('Home/cancelList')?>" data-title="已取消" href="javascript:void(0)">已取消</a></li>
				</ul>
				<ul>
					<li><a _href="<?php echo site_url('Home/reviewingList')?>" data-title="审核中" href="javascript:void(0)">审核中</a></li>
				</ul>
				<ul>
					<li><a _href="<?php echo site_url('Home/passList')?>" data-title="已通过" href="javascript:void(0)">已通过</a></li>
				</ul>
				<ul>
					<li><a _href="<?php echo site_url('Home/firstList')?>" data-title="已经首付" href="javascript:void(0)">已经首付</a></li>
				</ul>
				<ul>
					<li><a _href="<?php echo site_url('Home/reqPayList')?>" data-title="请款中" href="javascript:void(0)">请款中</a></li>
				</ul>
				<ul>
					<li><a _href="<?php echo site_url('Home/payedList')?>" data-title="已请款" href="javascript:void(0)">已请款</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-picture">
			<dt><i class="Hui-iconfont">&#xe70c;</i>金融机构<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<!-- <li><a _href="<?php echo site_url('Option/bankingList') ?>" data-title="金融机构管理" href="javascript:void(0)">金融机构</a></li> -->
					<!-- <li><a _href="<?php echo site_url('Option/carBrandList') ?>" data-title="车辆品牌管理" href="javascript:void(0)">车辆品牌</a></li> -->
					<?php foreach ($opt_map as $k => $v): ?>
						<?php if ($v['om_id']!=2): ?>
							<li><a _href="<?php echo site_url('Option/optList?type='.$v['om_id']) ?>" href="javascript:void(0)" data-title="<?php echo $v['om_name'] ?>管理"><?php echo $v['om_name'] ?></a></li>
						<?php endif ?>
						
					<?php endforeach ?>
				</ul>
			</dd>
		</dl>
		<!-- <dl id="menu-product">
			<dt><i class="Hui-iconfont">&#xe620;</i> 产品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="product-brand.html" data-title="品牌管理" href="javascript:void(0)">品牌管理</a></li>
					<li><a _href="product-category.html" data-title="分类管理" href="javascript:void(0)">分类管理</a></li>
					<li><a _href="product-list.html" data-title="产品管理" href="javascript:void(0)">产品管理</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-comments">
			<dt><i class="Hui-iconfont">&#xe622;</i> 评论管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="http://h-ui.duoshuo.com/admin/" data-title="评论列表" href="javascript:;">评论列表</a></li>
					<li><a _href="feedback-list.html" data-title="意见反馈" href="javascript:void(0)">意见反馈</a></li>
				</ul>
			</dd>
		</dl> -->
		<!-- <dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="member-list.html" data-title="会员列表" href="javascript:;">会员列表</a></li>
					<li><a _href="member-del.html" data-title="删除的会员" href="javascript:;">删除的会员</a></li>
					<li><a _href="member-level.html" data-title="等级管理" href="javascript:;">等级管理</a></li>
					<li><a _href="member-scoreoperation.html" data-title="积分管理" href="javascript:;">积分管理</a></li>
					<li><a _href="member-record-browse.html" data-title="浏览记录" href="javascript:void(0)">浏览记录</a></li>
					<li><a _href="member-record-download.html" data-title="下载记录" href="javascript:void(0)">下载记录</a></li>
					<li><a _href="member-record-share.html" data-title="分享记录" href="javascript:void(0)">分享记录</a></li>
				</ul>
			</dd>
		</dl> -->
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo site_url('User/roleList') ?>" data-title="角色管理" href="javascript:void(0)">角色管理</a></li>
					<!-- <li><a _href="<?php echo site_url('User/nodeList') ?>" data-title="权限管理" href="javascript:void(0)">权限管理</a></li> -->
					<li><a _href="<?php echo site_url('User/userList') ?>" data-title="管理员列表" href="javascript:void(0)">管理员列表</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-tongji">
			<dt><i class="Hui-iconfont">&#xe61a;</i> 数据统计<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="<?php echo site_url('Count/order') ?>" data-title="申请单处理状态数据" href="javascript:void(0)">申请单处理状态数据</a></li>
					<li>
						<a _href="<?php echo site_url('Count/countCompany') ?>" data-title="申请单金融公司" href="javascript:void(0)">申请单金融公司</a>
					</li>
					<li>
						<a _href="<?php echo site_url('Count/countCompany') ?>" data-title="申请单金融公司" href="javascript:void(0)">申请单金融公司</a>
					</li>
					<li>
						<a _href="<?php echo site_url('Count/countCompany') ?>" data-title="申请单金融公司" href="javascript:void(0)">申请单金融公司</a>
					</li>
					<!-- <li><a _href="charts-3.html" data-title="区域图" href="javascript:void(0)">区域图</a></li>
					<li><a _href="charts-4.html" data-title="柱状图" href="javascript:void(0)">柱状图</a></li>
					<li><a _href="charts-5.html" data-title="饼状图" href="javascript:void(0)">饼状图</a></li>
					<li><a _href="charts-6.html" data-title="3D柱状图" href="javascript:void(0)">3D柱状图</a></li>
					<li><a _href="charts-7.html" data-title="3D饼状图" href="javascript:void(0)">3D饼状图</a></li> -->
				</ul>
			</dd>
		</dl>
		<dl id="menu-system">
			<dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="system-base.html" data-title="系统设置" href="javascript:void(0)">系统设置</a></li>
					<!-- <li><a _href="system-category.html" data-title="栏目管理" href="javascript:void(0)">栏目管理</a></li>
					<li><a _href="system-data.html" data-title="数据字典" href="javascript:void(0)">数据字典</a></li>
					<li><a _href="system-shielding.html" data-title="屏蔽词" href="javascript:void(0)">屏蔽词</a></li>
					<li><a _href="system-log.html" data-title="系统日志" href="javascript:void(0)">系统日志</a></li> -->
				</ul>
			</dd>
		</dl>
	</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active"><span title="我的桌面" data-href="<?php echo site_url('Home/welcome') ?>">我的桌面</span><em></em></li>
			</ul>
		</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
	</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="<?php echo site_url('Home/welcome') ?>"></iframe>
		</div>
	</div>
</section>