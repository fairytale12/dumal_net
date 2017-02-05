<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus('404 Not Found');
@define('ERROR_404','Y');

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

$APPLICATION->SetTitle('404 Страница не найдена');

?>
<div class="row blog-content">
	<div class="col-md-12">
		<h3 class='tag-title'>Уупс... <span>Ошибка 404</span></h3>
		Страница не найдена, однако вы всегда можете перейти <a data-pjax="<?=ft\CHelper::getLinkId('/')?>" href="/">на главную</a>.
	</div>
</div>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>