<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv=Content-Type>
<title><?=lang('system_adminname')?> - Powered by <?=lang('system_name')?> <?=lang('system_version')?></title>
<script type="text/javascript" src="<?=base_url('js/jquery.min.js')?>"></script>
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
<script type="text/javascript">
function login(){
	var user_name=$.trim($("#user_name").val());
	var user_pass=$.trim($("#user_pass").val());
	$.ajax({
		type: "POST",
		url: "<?=site_aurl('main/login')?>",
		data: "opt=ajax&user_name="+user_name+"&user_pass="+user_pass,
		success: function(msg){
			if(msg=='ok'){
				<?php if (isset($lose)&&$lose==1): ?>
				location.href=document.referrer
				<?php else: ?>
				location.href="<?=site_aurl('main')?>";
				<?php endif; ?>
			}else{
				$("#msgtip").html("<?=lang('name_or_pass_error')?>");
				flashing();
			}
		},
		beforeSend:function(){
			$("#msgtip").html("<?=lang('user_logining')?>");
		},
		error:function(XMLHttpRequest, textStatus, errorThrown){
			$("#msgtip").html(errorThrown);
			flashing();
		}
	});
}
function flashing(){
	$("#msgtip").hide(200);
	$("#msgtip").show(200);
	$("#msgtip").hide(200);
	$("#msgtip").show(200);
	$("#msgtip").hide(200);
	$("#msgtip").show(200);
}
$(document).keypress(function(e) {
if (e.which == 13)  
	login(); 
});
</script>
</head>
<body>
<div class="jumbotron">
	  <h1>SEO tools</h1>
	  <p>This is a simple SEO tools.</p>
	  <p><a class="btn btn-primary btn-lg" onclick='javascript:$("#logind").show();'>Login in</a></p>
	</div>
	<div class="modal" id="logind">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Login in</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
  <fieldset>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label"><?=lang('user_name')?></label>
      <div class="col-lg-10">
        <input type="text" name="user_name" class="form-control" id="user_name" >
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label"><?=lang('user_pass')?></label>
      <div class="col-lg-10">
        <input type="password" name="user_pass" id="user_pass" class="form-control" ><span id="msgtip"></span>
        <div class="checkbox">
          <label>
            <input type="checkbox"> remeber
          </label>
        </div>
      </div>
    </div>
    
    
  </fieldset>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="login()" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>