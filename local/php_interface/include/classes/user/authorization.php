<?
namespace ft;

use Bitrix\Main\UserTable;

class CUserAuthorization {
	
	public static function checkAuthorization($showLogin = true, $checkGroups = null, $backUrl = null) {
	    global $USER, $APPLICATION;
	    if (null !== $backUrl && 0 >= strlen($backUrl)) {
	        $backUrl = $APPLICATION->GetCurPage();
        }
		if (!$USER->IsAuthorized()) {
			if ($showLogin) {
			    if (!$backUrl) {
                    //LocalRedirect('/');
					?>
					<script type="text/javascript">
						$(function() {
							ftHelper.showLoginForm();
						});
					</script>
					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-danger">
								<strong>Раздел доступен только авторизованному пользователю</strong>, 
								<a href="javascript:void(0);" onclick="ftHelper.showLoginForm();">войти</a>.
							</div>
						</div>
					</div>
					<?
                } else {
                    LocalRedirect('/?BACKURL=' . $backUrl);
                }
			}
			return false;
		} elseif (is_array($checkGroups) && !empty($checkGroups)) {
		    return \CSite::InGroup($checkGroups);
        }
		
		return true;
	}
	
}
?>