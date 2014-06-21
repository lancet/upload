<?php if($tpl=='list'):?>
	<?php $this->load->view('admin_head.php');?>
	
	<script type="text/javascript" src="js/highcharts.js"></script>
	<script type="text/javascript" src="js/exporting.js"></script>
	<script> var newarry=[],i=0,timearry=[];</script>
	<?php $i=0;foreach($data as $value):$i++;if($i>7) break;?>
		<script>
			newarry[i] = <?=$value['title']?>;
			timearry[i] = "<?=date('m-d',$value['createtime'])?>";
			i++;
			
		</script>
	<?php endforeach;?>
	<script>
	console.log(timearry);
		$(function () {
		
	    $('#container').highcharts({
	        title: {
	            text: '最近一周排名',
	            x: -20 //center
	        },
	        xAxis: {
	            categories: timearry
	        },
	        yAxis: {
	            title: {
	                text: '排名'
	            },
	            plotLines: [{
	                value: 0,
	                width: 1,
	                color: '#808080'
	            }]
	        },
	        tooltip: {
	            valueSuffix: '(位)'
	        },
	        legend: {
	            layout: 'vertical',
	            align: 'right',
	            verticalAlign: 'middle',
	            borderWidth: 0
	        },
	        series: [{
	            name: '排名',
	            data: newarry
	        }]
	    });
		});	
		
	</script>
	<div id="container" style="min-width:800px;height:400px"></div>
	
	<form name="formlist" id="formlist" action="<?=site_aurl($tablefunc)?>" method="post">
	<input type="hidden" name="action" id="action" value="<?=site_aurl($tablefunc)?>">
	<div id="main" class="main">
	<table cellSpacing=0 width="100%" class="content_list">
	<thead>
	<tr>
	<th width=240  align="left">日期</th>
	<th align=left>排名</th>
	</tr>
	</thead>
	<tbody id="content_list"><?php if (isset($liststr)): ?><?=$liststr?><?php endif; ?></tbody>
	</table>
	</div>
	</form>
	<div class="main_foot">
	<table><tr><td>
	<!--<div class="func"><?php if (isset($funcstr)): ?><?=$funcstr?><?php endif; ?></div>-->
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
		<td rowspan="4" class="upic">
		<img src="<?=isset($view['thumb'])&&$view['thumb']!=''?get_image_url($view['thumb']):get_image_url('data/nopic8080.gif')?>" onclick="uploadpic(this,'thumb')" width="150" id="imgthumb"><input type="hidden" name="thumb" id="thumb" value="<?=isset($view['thumb'])?$view['thumb']:'';?>"><br><input type="button" class="btn" onclick="unsetThumb('thumb','imgthumb')" value="<?=lang('unsetpic')?>">	
		</td>
	</tr>
	<tr>
		<td><?=lang('title')?></td>
		<td colspan="4"><input type="text" name="title" id="title" size="60" style="color:<?=isset($view['color'])?$view['color']:'';?>" class="validate input-text" validtip="required"  value="<?=isset($view['title'])?$view['title']:'';?>">
			<a  class="selectcolor colorpicker" onclick="colorpicker(this,'color','title')">&nbsp;</a>
			<input type="hidden" name="color" id="color"  value="<?=isset($view['color'])?$view['color']:'';?>">
			<input type="checkbox" id="isbold" name="isbold" <?=isset($view['isbold'])&&$view['isbold']==1?'checked':'';?> value="1"><?=lang('isbold')?>
		</td>
	</tr>
	<tr>
		<td><?=lang('keywords')?></td>
		<td colspan="4"><input type="text" name="keywords" id="keywords" class="input-text" size="60"  value="<?=isset($view['keywords'])?$view['keywords']:'';?>"></td></tr>
	<tr>
		<td><?=lang('description')?></td>
		<td colspan="4"><textarea rows="5" cols="80" class="txtarea" name="description" id="description"><?=isset($view['description'])?$view['description']:'';?></textarea></td></tr>
	<tr>
		<td><?=lang('content')?></td>
		<td colspan="5"><textarea style="width:668px;height:300px;" name="content" id="content" class="editor"><?=isset($view['content'])?htmlspecialchars($view['content']):'';?></textarea></td></tr>
	<tr>
		<td><?=lang('down_attrurl')?></td>
		<td colspan="3"><input type="text" name="attrurl" id="attrurl" class="input-text" size="50"  value="<?=isset($view['attrurl'])?$view['attrurl']:'';?>"><input type="button" value="<?=lang('down_select')?>" class="btn"  onclick="uploadfile('attrurl','attrname')"></td>
		<td><?=lang('down_attrname')?></td>
		<td><input type="text" name="attrname" id="attrname" class="input-text" value="<?=isset($view['attrname'])?$view['attrname']:'';?>"></td></tr>
	<tr>
	<tr>
		<td><?=lang('tag')?></td>
		<td colspan="5"><input type="text" name="tags" id="tags" size="80" class="input-text" value="<?=isset($tags)?$tags:'';?>"><?=lang('tagtip')?></td></tr>
	<tr>
		<td><?=lang('recommend')?></td>
		<td colspan="5">
		<?php foreach($recommendarr as $recommend):?>
		<?=$recommend['title']?><input type="checkbox" name="recommends[]" <?php if(in_array($recommend['id'],$recommends)):?>checked<?php endif;?> value="<?=$recommend['id']?>">
		<?php endforeach;?>
		</td>
	</tr>
	<tr>
		<td><?=lang('hits')?></td>
		<td><input type="text" name="hits" id="hits"  class="input-text" value="<?=isset($view['hits'])?$view['hits']:0?>"></td>
		<td><?=lang('puttime')?></td>
		<td><input type="text" name="puttime" id="puttime" readOnly onClick="WdatePicker({doubleCalendar:true,dateFmt:'yyyy-MM-dd HH:mm:ss'})"  class="input-text Wdate" value="<?=isset($view['puttime'])?date('Y-m-d H:i:s',$view['puttime']):date('Y-m-d H:i:s')?>"></td>
		<td><?=lang('tpl')?></td>
		<td><input type="text" name="tpl" id="tpl" class="input-text" value="<?=isset($view['tpl'])?$view['tpl']:'';?>"></td>
	</tr>
	<tr>
		<td><?=lang('order')?></td>
		<td><input type="text" name="listorder" id="listorder" value="<?php if(isset($view['listorder'])){echo $view['listorder'];}else{echo '999';} ?>" class="input-text"></td>
		<td><?=lang('status')?></td>
		<td colspan="3"><?=lang('status1')?><input type="radio" name="status" value="1" <?php if(!isset($view['status'])||$view['status']==1){echo 'checked';} ?> /><?=lang('status0')?><input type="radio" name="status" value="0" <?php if(isset($view['status'])&&$view['status']==0){echo 'checked';} ?>  /></td>
	</tr>
	</table>
	</div>
	</form>
<?php endif;?>