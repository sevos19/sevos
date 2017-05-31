<?php
namespace Efront\Plugin\Invoicing\Model;

use Efront\Plugin\Invoicing\Controller\InvoicingController;

use Efront\Controller\BaseController;
use Efront\Controller\UrlhelperController;

use Efront\Model\AbstractPlugin;
use Efront\Model\User;
use Efront\Model\Database;
use Efront\Model\PaymentTransaction;
use Efront\Exception\EfrontException;

class InvoicingPlugin extends AbstractPlugin {
	const VERSION = '1.0';

	public function installPlugin() {
	}

	public function uninstallPlugin() {
	}

	public function upgradePlugin() {
	}

	public function onLoadIconList($list_name, &$options) {
	    if ($list_name == 'dashboard' && User::getCurrentUser()->isAdministator()) {
	        $options[] = array('text' => $this->plugin->title,
	            'image' => $this->plugin_url.'/assets/images/plug.svg',
	            'class' => 'medium',
	            'href'  => UrlhelperController::url(array('ctg' => $this->plugin->name)),
	            'plugin' => true);
	        return $options;
	    } else {
	        return null;
	    }
	}

	public function onCtg($ctg) {
	    if ($ctg == $this->plugin->name) {
	        BaseController::getSmartyInstance()->assign("T_CTG", 'plugin')->assign("T_PLUGIN_FILE", $this->plugin_dir.'/View/Invoicing.tpl');
	        $controller = new InvoicingController();
	        $controller->plugin = $this->plugin;
	        return $controller;
	    }
	}


	public function onApiCall($method, $data) {
	    switch ($data['type']) {
	        case 'transactions': $result = $this->_getTransactions(); 
	        	break;
	        default: throw new EfrontException("Invalid or no operation type specified");
	         	break;
	    }
	    return $result;
	}

	protected function _getTransactions() {
	   // retrieve the list of transactions here, order by timestamp desc
	   try{
		    $transactions = Database::getInstance()->getTableData(PaymentTransaction::DATABASE_TABLE,
		    	'id,
		    	users_ID,
		    	users_name,
		    	parent_id,
		    	timestamp,
		    	amount,
		    	tax,
		    	gateway,
		    	status,
		    	comments,
		    	cancellation_fee,
		    	total_items,
		    	creator_ID,
		    	creator_name,
		    	refund_ID,
		    	refundable,
		    	public_id,
		    	refunded_amount',
		    	'timestamp'
		    );
		}catch (Exception $e) {pr($e);exit();}
	    return $transactions;
	}

}