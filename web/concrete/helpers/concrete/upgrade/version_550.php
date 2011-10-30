<?
/**
 * @access private
 * @package Helpers
 * @category Concrete
 * @author Andrew Embler <andrew@concrete5.org>
 * @copyright  Copyright (c) 2003-2008 Concrete5. (http://www.concrete5.org)
 * @license    http://www.concrete5.org/license/     MIT License
 */

/**
 * @access private
 * @package Helpers
 * @category Concrete
 * @author Andrew Embler <andrew@concrete5.org>
 * @copyright  Copyright (c) 2003-2008 Concrete5. (http://www.concrete5.org)
 * @license    http://www.concrete5.org/license/     MIT License
 */

defined('C5_EXECUTE') or die("Access Denied.");
class ConcreteUpgradeVersion550Helper {

	public function run() {
		$db = Loader::db();
		$columns = $db->MetaColumns('Pages');
		if (!isset($columns['CISSYSTEMPAGE'])) {
			$db->Execute('alter table Pages add column cIsSystemPage tinyint(1) not null default 0');
			$db->Execute('alter table Pages add index (cIsSystemPage)');
		}
	}
	
	public function prepare() {
		// we install the updated schema just for tables that matter
		Package::installDB(dirname(__FILE__) . '/db/version_550.xml');
	}

	
}