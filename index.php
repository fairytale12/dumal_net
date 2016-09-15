<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Главная");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Главная страница");
?>

<!--	<iframe width="420" height="315" src="http://www.youtube.com/embed/MzfXQoZb8Ow" frameborder="0" allowfullscreen></iframe> -->
	
<?/*
<iframe width="420" height="315" src="http://www.youtube.com/embed/QRdRYkTZNCI" frameborder="0" allowfullscreen></iframe>

<form action="https://plus.google.com/hangouts/_" method="GET">
	<input type="hidden" name="gid" value="828386634356"/>
	<select name="gd">
		<option>Hangouts</option>
		<option>Google+ API</option>
		<option>+1 Button</option>
	</select>
	<input type="submit">
</form>
	
	
*/?>	
	
	
	
	
	
	<div id="placeholder-div"></div>
	<div id="video-div"></div>
	<script>
		//	api-project-828386634356
		
		/*
		gapi.hangout.render('placeholder-div', { 
			'render': 'createhangout', 
			'hangout_type': 'onair',
			'id': 'test_video',
			'topic': 'TOPIC_TEXT',
			//'app_id': '<?=GOOGLE_HANGOUT_KEY?>',
			//'app_type': 'ROOM_APP'
			
			'initial_apps': [{'app_id' : '828386634356', 'start_data' : 'USER_<ID>', 'app_type' : 'ROOM_APP' }],
			'widget_size': 175
		});
		*/
		//console.log(typeof(gapi.hangout));
		
	</script>
	<!--<iframe width="420" height="315" src="http://www.youtube.com/embed/fCj2UU3dZj8" frameborder="0" allowfullscreen></iframe>-->
	
	
	
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>