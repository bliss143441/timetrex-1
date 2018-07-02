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
 * @package Core
 */
class Pager {
	protected $rs = NULL;
	protected $count_rows = TRUE; //Specify if we count the total rows or not.

	/**
	 * Pager constructor.
	 * @param $arr
	 */
	function __construct( $arr) {
		if ( isset($arr->rs) ) {
			//If there is no RS to return, something is seriously wrong. Check interface.inc.php?
			//Make sure the ListFactory function is doing a pageselect
			$this->rs = $arr->rs;

			$this->count_rows = $arr->db->pageExecuteCountRows;

			return TRUE;
		}

		return FALSE;
	}

	/**
	 * @return bool|int
	 */
	function getPreviousPage() {
		if ( is_object($this->rs) ) {
			return (int)( $this->rs->absolutepage() - 1 );
		}

		return FALSE;
	}

	/**
	 * @return bool|int
	 */
	function getCurrentPage() {
		if ( is_object($this->rs) ) {
			return (int)$this->rs->absolutepage();
		}

		return FALSE;
	}

	/**
	 * @return bool|int
	 */
	function getNextPage() {
		if ( is_object($this->rs) ) {
			return (int)( $this->rs->absolutepage() + 1 );
		}

		return FALSE;
	}

	/**
	 * @return bool
	 */
	function isFirstPage() {
		if ( is_object($this->rs) ) {
			return (bool)$this->rs->atfirstpage();
		}

		return TRUE;
	}

	/**
	 * @return bool
	 */
	function isLastPage() {
		//If the first page is also the last, return true.
		if ( $this->isFirstPage() AND $this->LastPageNumber() == 1) {
			return TRUE;
		}

		if ( is_object($this->rs) ) {
			return (bool)$this->rs->atlastpage();
		}

		return TRUE;
	}

	/**
	 * @return bool|int
	 */
	function LastPageNumber() {
		if ( is_object($this->rs) ) {
			if ( $this->count_rows === FALSE ) {
				if ( $this->getCurrentPage() < 0 ) {
					//Only one page in result set.
					return (int)$this->rs->lastpageno();
				} else {
					//More than one page in result set.
					if ( $this->rs->atlastpage() == TRUE ) {
						return (int)$this->getCurrentPage();
					} else {
						//Since we don't know what the actual last page is, just add 100 pages to the current one.
						//The user may need to click this several times if there are more than 100 pages.
						return (int)( $this->getCurrentPage() + 99 );
					}
				}
			} else {
				return (int)$this->rs->lastpageno();
			}
		}

		return FALSE;
	}

	//Return maximum rows per page

	/**
	 * @return bool|int
	 */
	function getRowsPerPage() {
		if ( is_object($this->rs) ) {
			if ( isset($this->rs->rowsPerPage) ) {
				return (int)$this->rs->rowsPerPage;
			} else {
				return (int)$this->rs->recordcount();
			}
		}

		return FALSE;
	}

	/**
	 * @return bool|int
	 */
	function getTotalRows() {
		if ( is_object($this->rs) ) {
			if ( $this->count_rows === FALSE ) {
				if ( $this->isLastPage() === TRUE ) {
					return (int)( ( $this->getPreviousPage() * $this->getRowsPerPage() ) + $this->rs->recordcount() );
				} else {
					return FALSE;
				}
			} else {
				return (int)$this->rs->maxrecordcount();
			}
		}

		return FALSE;
	}

	/**
	 * @return array
	 */
	function getPageVariables() {
		//Make sure the ListFactory function is doing a pageselect
		$paging_data = array(
							'previous_page'		=> $this->getPreviousPage(),
							'current_page'		=> $this->getCurrentPage(),
							'next_page'			=> $this->getNextPage(),
							'is_first_page'		=> $this->isFirstPage(),
							'is_last_page'		=> $this->isLastPage(),
							'last_page_number'	=> $this->LastPageNumber(),
							'rows_per_page'		=> $this->getRowsPerPage(),
							'total_rows'		=> $this->getTotalRows(),
							);
		//Debug::Arr($paging_data, ' Paging Data: Count Rows: '. (int)$this->count_rows, __FILE__, __LINE__, __METHOD__, 10);
		return $paging_data;
	}
}
?>
