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
 * @package Modules\Policy
 */
class PremiumPolicyDepartmentFactory extends Factory {
	protected $table = 'premium_policy_department';
	protected $pk_sequence_name = 'premium_policy_department_id_seq'; //PK Sequence name

	protected $department_obj = NULL;

	/**
	 * @return bool|null
	 */
	function getDepartmentObject() {
		if ( is_object($this->department_obj) ) {
			return $this->department_obj;
		} else {
			$lf = TTnew( 'DepartmentListFactory' );
			$lf->getById( $this->getDepartment() );
			if ( $lf->getRecordCount() == 1 ) {
				$this->department_obj = $lf->getCurrent();
				return $this->department_obj;
			}

			return FALSE;
		}
	}

	/**
	 * @return mixed
	 */
	function getPremiumPolicy() {
		return $this->getGenericDataValue( 'premium_policy_id' );
	}

	/**
	 * @param string $value UUID
	 * @return bool
	 */
	function setPremiumPolicy( $value) {
		$value = TTUUID::castUUID( $value );
		return $this->setGenericDataValue( 'premium_policy_id', $value );
	}

	/**
	 * @return bool|mixed
	 */
	function getDepartment() {
		return $this->getGenericDataValue( 'department_id' );
	}

	/**
	 * @param string $value UUID
	 * @return bool
	 */
	function setDepartment( $value) {
		$value = TTUUID::castUUID( $value );
		return $this->setGenericDataValue( 'department_id', $value );
	}
	/**
	 * @return bool
	 */
	function Validate() {
		//
		// BELOW: Validation code moved from set*() functions.
		//
		// Premium Policy
		if ( $this->getPremiumPolicy() != TTUUID::getZeroID() ) {
			$this->Validator->isUUID(	'premium_policy',
												$this->getPremiumPolicy(),
												TTi18n::gettext('Selected Premium Policy is invalid')
											);
		}
		// Department
		$dlf = TTnew( 'DepartmentListFactory' );
		$this->Validator->isResultSetWithRows(	'department',
													$dlf->getByID($this->getDepartment()),
													TTi18n::gettext('Selected Department is invalid')
												);


		//
		// ABOVE: Validation code moved from set*() functions.
		//
		return TRUE;
	}

	/**
	 * @return bool
	 */
	function postSave() {
		$this->removeCache( 'premium_policy-'. $this->getPremiumPolicy() );
		return TRUE;
	}

	//This table doesn't have any of these columns, so overload the functions.

	/**
	 * @return bool
	 */
	function getDeleted() {
		return FALSE;
	}

	/**
	 * @param $bool
	 * @return bool
	 */
	function setDeleted( $bool) {
		return FALSE;
	}

	/**
	 * @return bool
	 */
	function getCreatedDate() {
		return FALSE;
	}

	/**
	 * @param int $epoch EPOCH
	 * @return bool
	 */
	function setCreatedDate( $epoch = NULL) {
		return FALSE;
	}

	/**
	 * @return bool
	 */
	function getCreatedBy() {
		return FALSE;
	}

	/**
	 * @param string $id UUID
	 * @return bool
	 */
	function setCreatedBy( $id = NULL) {
		return FALSE;
	}

	/**
	 * @return bool
	 */
	function getUpdatedDate() {
		return FALSE;
	}

	/**
	 * @param int $epoch EPOCH
	 * @return bool
	 */
	function setUpdatedDate( $epoch = NULL) {
		return FALSE;
	}

	/**
	 * @return bool
	 */
	function getUpdatedBy() {
		return FALSE;
	}

	/**
	 * @param string $id UUID
	 * @return bool
	 */
	function setUpdatedBy( $id = NULL) {
		return FALSE;
	}

	/**
	 * @return bool
	 */
	function getDeletedDate() {
		return FALSE;
	}

	/**
	 * @param int $epoch EPOCH
	 * @return bool
	 */
	function setDeletedDate( $epoch = NULL) {
		return FALSE;
	}

	/**
	 * @return bool
	 */
	function getDeletedBy() {
		return FALSE;
	}

	/**
	 * @param string $id UUID
	 * @return bool
	 */
	function setDeletedBy( $id = NULL) {
		return FALSE;
	}

	/**
	 * @param $log_action
	 * @return bool
	 */
	function addLog( $log_action ) {
		$obj = $this->getDepartmentObject();
		if ( is_object($obj) ) {
			return TTLog::addEntry( $this->getPremiumPolicy(), $log_action, TTi18n::getText('Department').': '. $obj->getName(), NULL, $this->getTable() );
		}
	}
}
?>
