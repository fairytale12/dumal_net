<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Видео");
?>
<div class="col-md-8">
	Видео <?=intval($GLOBALS['USER']->getId())?>

	<div id="placeholder-div"></div>
	<div id="video-div"></div>
	<script>
		gapi.hangout.render('placeholder-div', { 
			'render': 'createhangout', 
			'hangout_type': 'onair',
			'id': 'test_video',
			'topic': 'TOPIC_TEXT',
			/*'app_id': '<?=GOOGLE_HANGOUT_KEY?>',
			'app_type': 'ROOM_APP'*/
			
			'initial_apps': [{'app_id' : '<?=GOOGLE_HANGOUT_KEY?>', 'start_data' : 'USER_<ID>', 'app_type' : 'ROOM_APP' }],
			'widget_size': 175
		});
		

	</script>
	<!--<iframe width="420" height="315" src="http://www.youtube.com/embed/fCj2UU3dZj8" frameborder="0" allowfullscreen></iframe>-->
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_RECURSIVE" => "Y",
		"AREA_FILE_SHOW" => "sect",
		"AREA_FILE_SUFFIX" => "sidebar",
		"EDIT_TEMPLATE" => ""
	)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>