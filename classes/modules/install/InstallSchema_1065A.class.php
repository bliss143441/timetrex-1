<?php
/*********************************************************************************
 * TimeTrex is a Workforce Management program developed by
 * TimeTrex Software Inc. Copyright (C) 2003 - 2018 TimeTrex Software Inc.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by
 * the Free Software Foundation with the addition of the following permission
 * added to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED
 * WORK IN WHICH THE COPYRIGHT IS OWNED BY TIMETREX, TIMETREX DISCLAIMS THE
 * WARRANTY OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along
 * with this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact TimeTrex headquarters at Unit 22 - 2475 Dobbin Rd. Suite
 * #292 West Kelowna, BC V4T 2E9, Canada or at email address info@timetrex.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License
 * version 3, these Appropriate Legal Notices must retain the display of the
 * "Powered by TimeTrex" logo. If the display of the logo is not reasonably
 * feasible for technical reasons, the Appropriate Legal Notices must display
 * the words "Powered by TimeTrex".
 ********************************************************************************/


/**
 * @package Module_Install
 */
class InstallSchema_1065A extends InstallSchema_Base {

	/**
	 * @return bool
	 */
	function preInstall() {
		Debug::text('preInstall: '. $this->getVersion(), __FILE__, __LINE__, __METHOD__, 9);

		// If a Community/Professional Edition upgrades to latest version (10.1.1) then upgrade to Corporate edition,
		// user_date_total_job_id index will try to be created twice, in 2023C and in 1065A.
		// We will remove it from 1023C so its just created here instead, but we have to drop it first if it exists just in case it was already created.
		$user_date_total_indexes = array_keys( $this->db->MetaIndexes('user_date_total') );
		if ( is_array($user_date_total_indexes) ) {
			if ( array_search( 'user_date_total_job_id', $user_date_total_indexes ) !== FALSE ) {
				Debug::text('Dropping already existing index: user_date_total_job_id', __FILE__, __LINE__, __METHOD__, 9);
				$this->db->Execute('DROP INDEX user_date_total_job_id ON user_date_total');
			} else {
				Debug::text('NOT Dropping already existing index: user_date_total_job_id', __FILE__, __LINE__, __METHOD__, 9);
			}
		}
		unset($user_date_total_indexes);

		return TRUE;
	}

	/**
	 * @return bool
	 */
	function postInstall() {
		Debug::text('postInstall: '. $this->getVersion(), __FILE__, __LINE__, __METHOD__, 9);

		//Delete dummy pay codes created in 1064A schema.
		$pclf = TTnew('PayCodeListFactory');
		$pclf->getAll();
		if ( $pclf->getRecordCount() > 0 ) {
			foreach( $pclf as $pc_obj ) {
				if ( trim( strtolower( $pc_obj->getCode() ) ) == 'dummy' ) {
					$pc_obj->setDeleted( TRUE );
					$pc_obj->Save(); //Don't call isValid() as that causes the slow SQL query check to see if this is in use to run twice.
				}
			}
		}

		return TRUE;
	}
}
?>
