<?php if($tpl=='list'):?>
	<?php $this->load->view('admin_head.php');?>
	
	<link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/bootswatch.min.css">
	
	<div id="main_head" class="main_head">
	<form name="formsearch" id="formsearch" action="<?=site_aurl($tablefunc)?>" method="post">
	<table class="menu">
	<tr height=70><td>
	<!--<a href="<?=site_aurl($tablefunc)?>" class="current"><?=lang('func_'.$tablefunc)?></a>
	<span><?=lang('filter')?></span><input type="text" name="keyword" value="<?=$search['keyword']?>" class="input-text">
	<select name="searchtype">
	<option value="title" <?php if ($search['searchtype'] == 'title'): ?>selected<?php endif; ?>><?=lang('title')?></option>
	<option value="id" <?php if ($search['searchtype'] == 'id'): ?>selected<?php endif; ?>><?=lang('id')?></option>
	</select>
	<select name="category"><option value="0"><?=lang('category_pselect')?></option>
	<?php foreach($categoryarr as $category):?>
	<option value="<?=$category['id']?>"<?php if ($search['category']==$category['id']): ?>selected<?php endif; ?>><?=$category['name']?></option>
	<?php endforeach;?>
	</select>
	<select name="recommend"><option value="0"><?=lang('recommend')?></option>
	<?php foreach($recommendarr as $recommend):?>
	<option value="<?=$recommend['id']?>"<?php if ($search['recommend']==$recommend['id']): ?>selected<?php endif; ?>><?=$recommend['title']?></option>
	<?php endforeach;?>
	</select>
	<input type="submit" class="btn" value="<?=lang('search')?>">-->
	</td><td><div class="func"><?php if (isset($funcstr)): ?><?=$funcstr?><?php endif; ?></div></td></tr>
	</table>
	</form>
	<table class="table table-striped table-hover ">
		<thead>
		<tr>
			<th width=30 style="text-align:center;"><input type="checkbox" onclick="checkAll(this)"></th>
			<th width=90 style="text-align:center;"><?=lang('order')?></th>
			<th width=80 style="text-align:center;">上级栏目</th>
			<th width=180 style="text-align:center;">单元名称</th>
			<th width=180 style="text-align:center;">网址</th>
			<th style="text-align:center;"><?=lang('operate')?></th>
		</tr>
		</thead>
	</table> 
	
	</div>
	<form name="formlist" id="formlist" action="<?=site_aurl($tablefunc)?>" method="post">
	<input type="hidden" name="action" id="action" value="<?=site_aurl($tablefunc)?>">
	<div id="main" class="main">
	<table class="table table-striped table-hover ">
		<tbody id="content_list">
			<?php if (isset($liststr)): ?><?=$liststr?><?php endif; ?>
		</tbody>
	</table> 
	</div>
	</form>
	<div class="main_foot">
	<table><tr><td>
	
	</td><td align="right">
	<div class="page"><?php if (isset($pagestr)): ?><?=$pagestr?><?php endif; ?></div>
	</td></tr></table>
	</div>
	<?php $this->load->view('admin_foot.php');?>
<?php elseif($tpl=='view'):?>
	<form name="formview" id="formview" action="" method="post">
	<input type="hidden" name="action" id="action" value="<?=site_aurl($tablefunc)?>">
	<input type="hidden" name="id" value="<?=isset($view['id'])?$view['id']:'';?>">
	<div id="main_view" class="main_view">
	<table cellSpacing=0 width="100%" class="content_view">
	<tr>
		<td><?=lang('category_pselect')?></td>
		<td colspan="4"><select name="category" id="category" class="validate" validtip="required">
		<?php foreach($categoryarr as $category):?>
		<option value="<?=$category['id']?>"<?php if (isset($view['category'])&&$view['category']==$category['id']): ?>selected<?php endif; ?>><?=$category['name']?></option>
		<?php endforeach;?>
		</select></td>
		
	</tr>
	<tr>
		<td><?=lang('title')?></td>
		<td colspan="4"><input type="text" name="title" id="title" size="60" style="color:<?=isset($view['color'])?$view['color']:'';?>" class="validate input-text" validtip="required"  value="<?=isset($view['title'])?$view['title']:'';?>">
			
			
		</td>
	</tr>
	<tr>
		<td>网址</td>
		<td colspan="4">
			<input type="text" name="keywords" id="keywords" size="60" style="color:<?=isset($view['color'])?$view['color']:'';?>" class="validate input-text" validtip="required"  value="<?=isset($view['keywords'])?$view['keywords']:'';?>">
		</td>
	</tr>
	<?php if($isadd=='1'){?><tr>
		<td>关键字</td>
		<td colspan="4"><textarea rows="5" style="width:399px;" cols="80" class="txtarea" name="content" id="content"><?=isset($view['content'])?$view['content']:'';?></textarea></td></tr>
	
	
	<tr><?php }?>
		<td><?=lang('order')?></td>
		<td><input type="text" name="listorder" id="listorder" value="<?php if(isset($view['listorder'])){echo $view['listorder'];}else{echo '999';} ?>" class="input-text"></td>
		
	</tr>
	</table>
	</div>
	</form>
<?php endif;?>