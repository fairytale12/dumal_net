<?
namespace ft;

use Bitrix\Main\Application;
//use Symfony\Component\DomCrawler\Crawler;

class pjax {
    /**
     * @var Bitrix\Main\Application
     */
    protected $app;

    /**
     * @param Bitrix\Main\Application $app
     */
    public function __construct(Application $app) {
        $this->app = $app;
    }

    /**
     * @inheritdoc
     */
    public function setHeaderPjaxUrl($url = '') {
        header(sprintf('X-PJAX-URL: %s', $url ?: $this->getServer()->get('REQUEST_URI')));
    }

    /**
     * @inheritdoc
     */
    public function getResponseContent($buffer) {
		
		$query = \phpQuery::newDocumentHTML($buffer);
		$responseTitle = $query->find('head > title');
		$responseContainer = $query->find($this->getPjaxContainer());
		
		if ($responseContainer->count()) {
            if ($responseTitle->count()) {
                $content = sprintf('<title>%s</title>', \pq($responseTitle)->html());
            }

            return sprintf('%s%s', $content ?: '', \pq($responseContainer)->html());
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function isPjaxRequest() {
        return (bool) $this->getServer()->get('HTTP_X_PJAX');
    }

    /**
     * @inheritdoc
     */
    public function getPjaxContainer() {
        return $this->getServer()->get('HTTP_X_PJAX_CONTAINER');
    }

    /**
     * @return Bitrix\Main\Server
     */
    public function getServer() {
        return $this->app->getContext()->getServer();
    }
}
