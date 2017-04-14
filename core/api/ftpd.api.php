<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

require_once dirname(__FILE__) . '/../../../../core/php/core.inc.php';
include_file('core', 'ftpd', 'class', 'ftpd');

try {
    if (init('action') == 'force_detect_ftpd') {
		ftpd::force_detect_ftpd();
		exit;
    }

	if (init('action') == 'newcapture') {
		$ftpd = eqlogic::byLogicalId(init('LogicalId'), 'ftpd');
		if (!is_object($ftpd)) {
			throw new Exception(__('Impossible de trouver la ftpd : ' . init('LogicalId'), __FILE__));
		}
		$ftpd->newcapture(init('lastfilename'));
		exit;
	}
    throw new Exception(__('Aucune methode correspondante à : ', __FILE__) . init('action'));
    /*     * *********Catch exeption*************** */
} catch (Exception $e) {
    throw new Exception(displayExeption($e), $e->getCode());
}
?>