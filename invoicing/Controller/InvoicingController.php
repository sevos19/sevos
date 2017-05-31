<?php
namespace Efront\Plugin\Invoicing\Controller;

use Efront\Plugin\Invoicing\Model\Invoicing;

use Efront\Controller\BaseController;
use Efront\Controller\UrlhelperController;

use Efront\Model\UserType;

class InvoicingController extends BaseController
{
	public $plugin;

	protected function _requestPermissionFor() {
		return array(UserType::USER_TYPE_PERMISSION_PLUGINS, UserType::USER_TYPE_ADMINISTRATOR);
	}

	public function index() {

		$smarty = self::getSmartyInstance();
		$this->_model = new Invoicing();
		$this->_base_url = UrlhelperController::url(array('ctg' => $this->plugin->name));
		$smarty->assign("T_PLUGIN_TITLE", $this->plugin->title)->assign("T_PLUGIN_NAME", $this->plugin->name)->assign("T_BASE_URL", $this->_base_url);

		parent::index();
	}
}