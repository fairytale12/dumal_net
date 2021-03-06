<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О нас");
?>

<article class="post-wrapper clearfix">

	<header class="post-header">

		<h1 class="post-title">
			Кто мы?
		</h1><!-- .post-title -->

	</header><!-- .post-header -->

	<div class="post-content clearfix">

		<p>Думал, нет? - это сообщество людей, заинтересованных в улучшении качества жизни, готовых видеть в каждой сложной ситуации не проблему, а новую возможность.</p>
		<p>Хочешь ли ты улучшить свою жизнь?</p>
		<p>Испытываешь ли ты недовольство текущим положением дел?</p>
		<p>Хочешь ли ты видеть в жизни больше возможностей, а не проблем?</p>
		
		<p>Сообщество &laquo;Думал нет&raquo; предлагает его участникам знания, используя которые, можно реально изменить жизнь к лучшему. Наша работа направлена на изменение стиля мышления, потому как именно мышление определеяет восприятие этого мира.</p>
		<p>В жизни каждого человека наступают периоды, когда сложившаяся ситуация кажется непреодолимой и предлагаемый нами материал является ключем к ее решению:
			<ul>
				<li>в отношениях:
					<ul>
						<li>с родителями и близкими людьми</li>
						<li>коллегами и партнерами по бизнесу</li>
						<li>"случайными" людьми</li>
					</ul>
				</li>
				<li>в вопросе самоопределения и мотивации</li>
				<li>в вопросе эмоциональной неустойчивости</li>
				<li>в воспитании детей</li>
			</ul>
		</p>
		
		<p>Мышление человека основывается на <strong>убеждениях</strong>. А что такое эти <strong>убеждения</strong>?</p> 
		<p><strong>Убеждения</strong> - это сложившийся взгляд человека на какие-либо ситуации, которые происходили как с ним самим, так и с другими людьми. В сущности это преобретенный опыт человека, полученный лично или со стороны.</p>  
		<p>С ранних лет мы <strong>убеждаем</strong> себя в том, что мир устроен определенным образом. Но эти <strong>убеждения</strong> могут как способствовать развитию человека, так и ограничивать его. <strong>Убеждения</strong> человек может как осознавать, так и не осознавать.</p>
		
		<p>Предлагаемый нами инструментарий позволяет развить гибкость мышления путем выявления и анализа своих <strong>убеждений</strong>.</p>
		
		<h2 class="page-subtitle">Наша команда</h2>
		
		<?$APPLICATION->IncludeComponent(
			"ft:leading.list",
			"",
			Array(
				"CACHE_TIME" => "3600",
				"CACHE_TYPE" => "A"
			)
		);?>
			
			
		<p>Вы можете пройти мимо этого сообщения и оставить все как есть, или можете подписаться на нашу рассылку и получать новые знания, используя которые вы можете реально изменить вашу жизнь к лучшему.</p>
		<div class="row">
			<div class="col-sm-offset-4 col-md-4">
				<?$APPLICATION->IncludeComponent(
					"ft:user.subscribe.form",
					"",
					Array(
						"RUBRIC_ID" => ARTICLES_AND_VIDEO_RUBRIC_ID . ',' . PROGRAMS_RUBRIC_ID,
						"TEXT" => '',
					)
				);?>
			</div>
		</div>
			
		
			
			--- ТУТ ЦИТАТА ---
			
		

	</div><!-- .post-content -->

</article><!-- .post-wrapper -->

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>