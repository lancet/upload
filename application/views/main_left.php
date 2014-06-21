<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootswatch: Cosmo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/bootswatch.min.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
      <script src="../bower_components/respond/dest/respond.min.js"></script>
    <![endif]-->
    <script>

     var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-23019901-1']);
      _gaq.push(['_setDomainName', "bootswatch.com"]);
        _gaq.push(['_setAllowLinker', true]);
      _gaq.push(['_trackPageview']);

     (function() {
       var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
       ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
     })();

    </script>
  </head>
  <body style="padding-top:14px;">
 
  
  
<ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
	<li class="active"><a href='javascript:seton(this,"<?=site_aurl("article")?>");'>我的单元</a></li>
	<li class="disabled"><a href="#">分类管理</a></li>
	<li class="disabled"><a href="#">个人中心</a></li>
	<!--<li><a href="#">Profile</a></li>
	
	<?php foreach($purview[2] as $key=>$item):?>
	<?php if($key>0):?>
	<li class="dropdown" id="purview_<?=$key?>">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			<?=lang('func_'.$purview[3][$key]['class'])?> <span class="caret"></span>
		</a>
		<ul class="dropdown-menu">
			<?php foreach ($item as $puritem): ?>
			<li><a href="javascript:seton(this,'<?=site_aurl($puritem['class'])?>');"><?=lang('func_'.$puritem['class'])?></a></li>
			<?php endforeach; ?>
		</ul>
	</li>
	<?php endif;?>
	<?php endforeach;?>-->
</ul>
<script type="text/javascript">
function setTab(tid){
	$("#purview_"+tid).find('td').each(function(){
		$(this).removeClass("on");
	});
	$("table").hide();
	$("#purview_"+tid).show();
}
function seton(t,url) {
	$(t).parent().parent().find('td').each(function(){
		$(this).removeClass("on");
	});
	$(t).addClass("on");
	parent.main.location.href=url;
}


</script> 


    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootswatch.js"></script>
  </body>
</html>
