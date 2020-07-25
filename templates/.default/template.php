<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?

if($_REQUEST["ajax_dscard_search"]=="Y") {

    $APPLICATION->RestartBuffer();

    if($arResult["SUCCESS"]) {

    	echo json_encode(Array("result"=>"success","message"=>GetMessage("DISCOUNDCARD_REMEMBER_TEMPLATE_SUCCESS"),"name"=>$arResult["DSCARD_NAME"],"number"=>$arResult["DSCARD_NUMBER"]));

    } elseif(!empty($arResult["ERROR_MESSAGE"])) {

    	echo json_encode(Array("result"=>"error","message"=>implode("<br />",$arResult["ERROR_MESSAGE"])));

    }

    die();

} else {

    if($arResult["SUCCESS"]) {
    
    	echo $arParams["OK_TEXT"];
    
    } elseif(!empty($arResult["ERROR_MESSAGE"])) {
    
    	foreach($arResult["ERROR_MESSAGE"] as $v)
    		ShowError($v);
    		
    }

}

$APPLICATION->SetAdditionalCSS($APPLICATION->GetTemplatePath("js/fancybox/jquery.fancybox.css"));

?>

<a href="#dscard_remember" id="dscard_remember_link"><?=GetMessage("DISCOUNDCARD_REMEMBER_TEMPLATE_REMEMBER")?></a>

<div style="display: none" id="dscard_remember">

	<h2><?=GetMessage("DISCOUNDCARD_REMEMBER_TEMPLATE_REMEMBER")?></h2>

	<div class="grain-dscard-remember-caption">
		<?=GetMessage("DISCOUNDCARD_REMEMBER_TEMPLATE_NAME")?>
	</div>

	<div class="grain-dscard-remember-field">
		<input type="text" id="dscard_remember_name" value="<?=$arResult["USER_NAME"]?>" />
	</div>

	<div class="grain-dscard-remember-caption">
		<?=GetMessage("DISCOUNDCARD_REMEMBER_TEMPLATE_LASTNAME")?>
	</div>

	<div class="grain-dscard-remember-field">
		<input type="text" id="dscard_remember_lastname" value="<?=$arResult["USER_LASTNAME"]?>" />
	</div>

	<div class="grain-dscard-remember-caption">
		<?=GetMessage("DISCOUNDCARD_REMEMBER_TEMPLATE_EMAIL")?>
	</div>
	
	<div class="grain-dscard-remember-field">
		<input type="text" id="dscard_remember_email" value="<?=$arResult["USER_EMAIL"]?>" />
	</div>
	
	<div class="grain-dscard-remember-caption">
		<span class="grain-dscard-remember-caption-green"><?=GetMessage("DISCOUNDCARD_REMEMBER_TEMPLATE_OR")?></span> <?=GetMessage("DISCOUNDCARD_REMEMBER_TEMPLATE_PHONE")?>
	</div>

	<div class="grain-dscard-remember-field">
		<input type="text" id="dscard_remember_phone" value="<?=$arResult["USER_PHONE"]?>" />
	</div>

	<div id="dscard_remember_message">&nbsp;</div>

	<input type="button" value="<?=GetMessage("DISCOUNDCARD_REMEMBER_TEMPLATE_BUTTON")?>" id="search_dscard_button" />

</div>

<script type="text/javascript">

$().ready(function(){

	$("#dscard_remember_link").click(function(){
		$("#dscard_remember").show();
	});

	$("#dscard_remember_link").fancybox({
		maxWidth	: 470,
		//maxHeight	: 420,
		autoHeight: true,
		fitToView	: true,
		//autoSize	: false,
		closeClick	: false
		//openEffect	: 'none',
		//closeEffect	: 'none'
	});

	$("#search_dscard_button").click(function(){
	
		var dscard_name = $("#dscard_remember_name").val();
		var dscard_lastname = $("#dscard_remember_lastname").val();
		var dscard_email = $("#dscard_remember_email").val();
		var dscard_phone = $("#dscard_remember_phone").val();
		
		var params = "action=search_dscard&ajax_dscard_search=Y";
		params += "&dscard_remember_name="+dscard_name;
		params += "&dscard_remember_lastname="+dscard_lastname;
		params += "&dscard_remember_email="+dscard_email;
		params += "&dscard_remember_phone="+dscard_phone;

		$("#dscard_remember_message")
			.removeClass("success error").addClass("wait")
			.html("<?=GetMessage("DISCOUNDCARD_REMEMBER_TEMPLATE_WAIT")?>");

		$.post("<?=$APPLICATION->GetCurPage()?>",params,false,"json")

		    .done($.proxy(function(data) {

				if(!data)
					$("#dscard_remember_message")
						.removeClass("wait success").addClass("error")
						.html("<?=GetMessage("DISCOUNDCARD_REMEMBER_TEMPLATE_SERVER_ERROR")?>");

		    	if(data.result=="success") {
		    
					$("#dscard_remember_message")
						.removeClass("wait error").addClass("success")
						.html("<?=$arParams["SUCCESS_MESSAGE"]?$arParams["SUCCESS_MESSAGE"]:GetMessage("DISCOUNDCARD_REMEMBER_TEMPLATE_SUCCESS")?>");
		    		
		    		$("#<?=$arParams["FIELD_ID"]?>").val(data.number);
		    		<?=$arParams["~SUCCESS_JS"]?>;
		    		
		    	} else if(data.result=="error") {
		    	
					$("#dscard_remember_message")
						.removeClass("wait success").addClass("error")
						.html(data.message);
		    	
		    	}

		    },this))

		    .fail($.proxy(function(data) {

		    	//alert("error");

		    },this));

		return false;

	});

});


</script>
