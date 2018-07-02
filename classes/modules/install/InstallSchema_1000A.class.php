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
 * @package Modules\Install
 */
class InstallSchema_1000A extends InstallSchema_Base {

	/**
	 * @return bool
	 */
	function preInstall() {
		Debug::text('preInstall: '. $this->getVersion(), __FILE__, __LINE__, __METHOD__, 9);

		return TRUE;
	}


	/**
	 * @return bool
	 */
	function postInstall() {
		// @codingStandardsIgnoreStart
		global $config_vars;
		// @codingStandardsIgnoreEnd
		Debug::text('postInstall: '. $this->getVersion(), __FILE__, __LINE__, __METHOD__, 9);

		//Immediately after '1000A' schema version is completed, try to get a registration key so help with UUID generation.
		// Also seed InstallSchema_Base->replaceSQLVariables(), as it needs to run a similar check.
		Debug::text('Initializing database, after first schema file executed, setting registration key/UUID seed...', __FILE__, __LINE__, __METHOD__, 9);
		$ttsc = new TimeTrexSoapClient();
		$ttsc->saveRegistrationKey();

		if ( TTUUID::generateSeed() === FALSE ) { //Generate UUID seed and save it to config file.
			Debug::text('ERROR: Failed writing seed to config file... Failing!', __FILE__, __LINE__, __METHOD__, 9);
			return FALSE;
		}

		$maint_base_path = Environment::getBasePath() . DIRECTORY_SEPARATOR .'maint'. DIRECTORY_SEPARATOR;
		if ( PHP_OS == 'WINNT' ) {
			$cron_job_base_command = 'php-win.exe '. $maint_base_path;
		} else {
			$cron_job_base_command = 'php '. $maint_base_path;
		}
		Debug::text('Cron Job Base Command: '. $cron_job_base_command, __FILE__, __LINE__, __METHOD__, 9);

		// >> /dev/null 2>&1
		$cjf = TTnew( 'CronJobFactory' );
		$cjf->setName('AddPayPeriod');
		$cjf->setMinute(0);
		$cjf->setHour(0);
		$cjf->setDayOfMonth('*');
		$cjf->setMonth('*');
		$cjf->setDayOfWeek('*');
		$cjf->setCommand($cron_job_base_command.'AddPayPeriod.php');
		$cjf->Save();

		$cjf = TTnew( 'CronJobFactory' );
		$cjf->setName('AddUserDate');
		$cjf->setMinute(15);
		$cjf->setHour(0);
		$cjf->setDayOfMonth('*');
		$cjf->setMonth('*');
		$cjf->setDayOfWeek('*');
		$cjf->setCommand($cron_job_base_command.'AddUserDate.php');
		$cjf->Save();

		$cjf = TTnew( 'CronJobFactory' );
		$cjf->setName('calcExceptions');
		$cjf->setMinute(30);
		$cjf->setHour(0);
		$cjf->setDayOfMonth('*');
		$cjf->setMonth('*');
		$cjf->setDayOfWeek('*');
		$cjf->setCommand($cron_job_base_command.'calcExceptions.php');
		$cjf->Save();

		$cjf = TTnew( 'CronJobFactory' );
		$cjf->setName('AddRecurringPayStubAmendment');
		$cjf->setMinute(45);
		$cjf->setHour(0);
		$cjf->setDayOfMonth('*');
		$cjf->setMonth('*');
		$cjf->setDayOfWeek('*');
		$cjf->setCommand($cron_job_base_command.'AddRecurringPayStubAmendment.php');
		$cjf->Save();

		$cjf = TTnew( 'CronJobFactory' );
		$cjf->setName('AddRecurringHoliday');
		$cjf->setMinute(55);
		$cjf->setHour(0);
		$cjf->setDayOfMonth('*');
		$cjf->setMonth('*');
		$cjf->setDayOfWeek('*');
		$cjf->setCommand($cron_job_base_command.'AddRecurringHoliday.php');
		$cjf->Save();

		$cjf = TTnew( 'CronJobFactory' );
		$cjf->setName('UserCount');
		$cjf->setMinute(15);
		$cjf->setHour(1);
		$cjf->setDayOfMonth('*');
		$cjf->setMonth('*');
		$cjf->setDayOfWeek('*');
		$cjf->setCommand($cron_job_base_command.'UserCount.php');
		$cjf->Save();

		$cjf = TTnew( 'CronJobFactory' );
		$cjf->setName('AddRecurringScheduleShift');
		$cjf->setMinute('20, 50');
		$cjf->setHour('*');
		$cjf->setDayOfMonth('*');
		$cjf->setMonth('*');
		$cjf->setDayOfWeek('*');
		$cjf->setCommand($cron_job_base_command.'AddRecurringScheduleShift.php');
		$cjf->Save();

		$cjf = TTnew( 'CronJobFactory' );
		$cjf->setName('CheckForUpdate');
		$cjf->setMinute( rand(0, 59) ); //Random time once a day for load balancing
		$cjf->setHour( rand(0, 23) ); //Random time once a day for load balancing
		$cjf->setDayOfMonth('*');
		$cjf->setMonth('*');
		$cjf->setDayOfWeek('*');
		$cjf->setCommand($cron_job_base_command.'CheckForUpdate.php');
		$cjf->Save();

		return TRUE;

	}
}
?>
