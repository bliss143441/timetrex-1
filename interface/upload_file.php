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

require_once('../includes/global.inc.php');
$skip_message_check = TRUE;
require_once(Environment::getBasePath() .'includes/Interface.inc.php');
require_once(Environment::getBasePath() .'classes/upload/fileupload.class.php');

//PHP must have the upload and POST max sizes set to handle the largest file upload. If these are too low
//it errors out with a non-helpful error, so set these large and restrict the size in the Upload class.
//ini_set( 'upload_max_filesize', '128M' ); //This is PER DIRECTORY and therefore can't be set this way. Must be set in the PHP.INI or .htaccess files instead.
//ini_set( 'post_max_size', '128M' ); //This has no affect as its set too late. Must be set in the PHP.INI or .htaccess files instead.

extract	(FormVariables::GetVariables(
										array	(
												'action',
												'object_type',
												'parent_object_type_id',
												'object_id',
												'parent_id',
												'SessionID'
												) ) );

if ( Misc::checkValidReferer() == FALSE ) { //Help prevent CSRF attacks with this.
	echo TTi18n::getText( 'Invalid referrer, possible CSRF.' );
	Debug::writeToLog();
	exit;
}

$object_type = trim( strtolower($object_type) );
Debug::Text('Object Type: '. $object_type .' ID: '. $object_id .' Parent ID: '. $parent_id .' POST SessionID: '. $SessionID, __FILE__, __LINE__, __METHOD__, 10);

$upload = new fileupload();
switch ($object_type) {
	case 'invoice_config':
		$max_upload_file_size = 5000000;

		if ( $permission->Check('invoice_config', 'add') OR $permission->Check('invoice_config', 'edit') OR $permission->Check('invoice_config', 'edit_child') OR $permission->Check('invoice_config', 'edit_own') ) {
			if ( isset($_POST['file_data']) ) {
				Debug::Text('HTML5 Base64 encoded upload...', __FILE__, __LINE__, __METHOD__, 10);
				$allowed_upload_content_types = array(FALSE, 'image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png');

				$icf = TTnew( 'InvoiceConfigFactory' );
				$icf->cleanStoragePath( $current_company->getId() );
				$dir = $icf->getStoragePath( $current_company->getId() );
				Debug::Text('Storage Path: '. $dir, __FILE__, __LINE__, __METHOD__, 10);
				if ( isset($dir) ) {
					@mkdir($dir, 0700, TRUE);
					if ( @disk_free_space( $dir ) > ( $max_upload_file_size * 2 )
							AND isset($_POST['mime_type'])
							AND in_array( strtolower( trim($_POST['mime_type']) ), $allowed_upload_content_types ) ) {

						$file_name = $dir . DIRECTORY_SEPARATOR . 'logo.img';
						$file_data = base64_decode( $_POST['file_data'] );
						$file_size = strlen( $file_data );

						if ( in_array( Misc::getMimeType( $file_data, TRUE ), $allowed_upload_content_types ) ) {
							if ( $file_size <= $max_upload_file_size ) {
								$success = file_put_contents( $file_name, $file_data );
								if ( $success == FALSE ) {
									Debug::Text('bUpload Failed! Unable to write data to: '. $file_name, __FILE__, __LINE__, __METHOD__, 10);
									$error = TTi18n::gettext('Unable to upload photo');
								}
							} else {
								Debug::Text('cUpload Failed! File too large: '. $file_size, __FILE__, __LINE__, __METHOD__, 10);
								$error = TTi18n::gettext('File size is too large, must be less than %1 bytes', $max_upload_file_size );
							}
						} else {
							Debug::Text('dUpload Failed! Incorrect mime_type: '. $_POST['mime_type'], __FILE__, __LINE__, __METHOD__, 10);
							$error = TTi18n::gettext('Incorrect file type, must be a JPG or PNG image') .' (b)';
						}
					} else {
						Debug::Text('dUpload Failed! Incorrect mime_type: '. $_POST['mime_type'], __FILE__, __LINE__, __METHOD__, 10);
						$error = TTi18n::gettext('Incorrect file type, must be a JPG or PNG image') .' (a)';
					}
				}
				unset($uf, $ulf);
			}
		}
		break;
	case 'document_revision':
		Debug::Text('Document...', __FILE__, __LINE__, __METHOD__, 10);
		$max_upload_file_size = 128000000;
		if ( isset( $parent_object_type_id ) AND $parent_object_type_id == 400 ) {
			$section = 'user_expense';
		} else {
			$section = 'document';
		}
		if ( DEMO_MODE == FALSE AND ( $permission->Check($section, 'add') OR $permission->Check($section, 'edit') OR $permission->Check($section, 'edit_child') OR $permission->Check($section, 'edit_own') ) ) {
			$permission_children_ids = $permission->getPermissionHierarchyChildren( $current_company->getId(), $current_user->getId() );

			$drlf = TTnew( 'DocumentRevisionListFactory' );
			$drlf->getByIdAndCompanyId( $object_id, $current_user->getCompany() );
			if ( $drlf->getRecordCount() == 1 ) {
				if ( $permission->Check($section, 'edit')
					OR ( $permission->Check($section, 'edit_own') AND $permission->isOwner( $drlf->getCurrent()->getCreatedBy(), $drlf->getCurrent()->getID() ) === TRUE )
					OR ( $permission->Check($section, 'edit_child') AND $permission->isChild( $drlf->getCurrent()->getId(), $permission_children_ids ) === TRUE )  ) {

					$df = TTnew( 'DocumentFactory' );
					/** @var DocumentRevisionFactory $drf */
					$drf = TTnew( 'DocumentRevisionFactory' );

					//Debug::setVerbosity(11);
					$upload->set_max_filesize( $max_upload_file_size ); //128mb or less, though I'm not 100% sure this is even working.
					$upload->set_overwrite_mode( 3 ); //Do nothing

					$dr_obj = $drlf->getCurrent();
					$dr_obj->setLocalFileName();
					$dir = $dr_obj->getStoragePath( $current_company->getId() );
					Debug::Text( 'Storage Path: ' . $dir, __FILE__, __LINE__, __METHOD__, 10 );
					if ( isset( $dir ) ) {
						@mkdir( $dir, 0700, TRUE );

						if ( @disk_free_space( $dir ) > ( $max_upload_file_size * 2 ) ) {
							$upload_result = $upload->upload( 'filedata', $dir ); //'filedata' is case sensitive
							//Debug::Arr($_FILES, 'FILES Vars: ', __FILE__, __LINE__, __METHOD__, 10);
							if ( $upload_result ) {
								Debug::Text( 'Upload Success: ' . $upload_result, __FILE__, __LINE__, __METHOD__, 10 );
								$success = $upload_result . ' ' . TTi18n::gettext( 'Successfully Uploaded' );
								$upload_file_arr = $upload->get_file();
							} else {
								Debug::Text( 'Upload Failed!: ' . $upload->get_error(), __FILE__, __LINE__, __METHOD__, 10 );
								$error = $upload->get_error();
							}
						} else {
							Debug::Text( 'Upload Failed!: Not enough disk space available...', __FILE__, __LINE__, __METHOD__, 10 );
							$error = TTi18n::gettext( 'File is too large to be uploaded at this time' );
						}
					}

					if ( isset( $success ) ) {
						//Document Revision
						Debug::Text( 'Upload File Name: ' . $upload_file_arr['name'] . ' Mime Type: ' . $upload_file_arr['type'], __FILE__, __LINE__, __METHOD__, 10 );

						if ( $drlf->getRecordCount() == 1 ) {

							$dr_obj->setRemoteFileName( $upload_file_arr['name'] );
							$dr_obj->setMimeType( $dr_obj->detectMimeType( $upload_file_arr['name'], $upload_file_arr['type'] ) );
							$dr_obj->setEnableFileUpload( TRUE );
							if ( $dr_obj->isValid() ) {
								$dr_obj->Save( FALSE );
								$dr_obj->renameLocalFile(); //Rename after save as finished successfully, otherwise a validation error will occur because the src file is gone.
								unset( $dr_obj );
								break;
							} else {
								$error = TTi18n::gettext( 'File is invalid, unable to save' );
							}
						} else {
							Debug::Text( 'Object does not exist!', __FILE__, __LINE__, __METHOD__, 10 );
							$error = TTi18n::gettext( 'Invalid Object ID' );
						}
					} else {
						Debug::Text( 'bUpload Failed!: ' . $upload->get_error(), __FILE__, __LINE__, __METHOD__, 10 );
					}
				} else {
					$error = TTi18n::gettext('Permission Denied');
				}
			} else {
				$error = TTi18n::gettext('Invalid Object ID');
			}
		}
		break;
	case 'company_logo':
		Debug::Text('Company Logo...', __FILE__, __LINE__, __METHOD__, 10);
		$max_upload_file_size = 5000000;

		if ( DEMO_MODE == FALSE AND ( $permission->Check('company', 'add') OR $permission->Check('company', 'edit') OR $permission->Check('company', 'edit_child') OR $permission->Check('company', 'edit_own') ) ) {
			if ( isset($_POST['file_data']) ) { //Only required for images due the image wizard.
				Debug::Text('HTML5 Base64 encoded upload...', __FILE__, __LINE__, __METHOD__, 10);
				$allowed_upload_content_types = array(FALSE, 'image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png');

				$cf = TTnew( 'CompanyFactory' );
				$cf->cleanStoragePath( $current_company->getId() );
				$dir = $cf->getStoragePath( $current_company->getId() );
				Debug::Text('Storage Path: '. $dir, __FILE__, __LINE__, __METHOD__, 10);
				if ( isset($dir)  ) {
					@mkdir($dir, 0700, TRUE);
					if (	@disk_free_space( $dir ) > ( $max_upload_file_size * 2 )
							AND isset($_POST['mime_type'])
							AND in_array( strtolower( trim($_POST['mime_type']) ), $allowed_upload_content_types ) ) {
						$file_name = $dir . DIRECTORY_SEPARATOR . 'logo.img';
						$file_data = base64_decode( $_POST['file_data'] );
						$file_size = strlen( $file_data );

						if ( in_array( Misc::getMimeType( $file_data, TRUE ), $allowed_upload_content_types ) ) {
							if ( $file_size <= $max_upload_file_size ) {
								$success = file_put_contents( $file_name, $file_data );
								if ( $success == FALSE ) {
									Debug::Text('bUpload Failed! Unable to write data to: '. $file_name, __FILE__, __LINE__, __METHOD__, 10);
									$error = TTi18n::gettext('Unable to upload photo');
								}
							} else {
								Debug::Text('cUpload Failed! File too large: '. $file_size, __FILE__, __LINE__, __METHOD__, 10);
								$error = TTi18n::gettext('File size is too large, must be less than %1 bytes', $max_upload_file_size );
							}
						} else {
							Debug::Text('dUpload Failed! Incorrect mime_type: '. $_POST['mime_type'], __FILE__, __LINE__, __METHOD__, 10);
							$error = TTi18n::gettext('Incorrect file type, must be a JPG or PNG image') .' (b)';
						}
					} else {
						if ( isset($_POST['mime_type']) ) {
							Debug::Text('dUpload Failed! Incorrect mime_type: '. $_POST['mime_type'], __FILE__, __LINE__, __METHOD__, 10);
						} else {
							Debug::Text('eUpload Failed! Mime_type not specified...', __FILE__, __LINE__, __METHOD__, 10);
						}

						$error = TTi18n::gettext('Incorrect file type, must be a JPG or PNG image') .' (a)';
					}
				}
				unset($cf);
			}
		}
		break;
	case 'legal_entity_logo':
		Debug::Text('Legal Entity Logo...', __FILE__, __LINE__, __METHOD__, 10);
		$max_upload_file_size = 5000000;

		if ( DEMO_MODE == FALSE AND ( $permission->Check('legal_entity', 'add') OR $permission->Check('legal_entity', 'edit') OR $permission->Check('legal_entity', 'edit_child') OR $permission->Check('legal_entity', 'edit_own') ) ) {
			if ( isset($_POST['file_data']) AND TTUUID::isUUID( $object_id ) ) { //Only required for images due the image wizard.
				Debug::Text('HTML5 Base64 encoded upload...', __FILE__, __LINE__, __METHOD__, 10);
				$allowed_upload_content_types = array(FALSE, 'image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png');

				$lef = TTnew( 'LegalEntityFactory' );
				$lef->cleanStoragePath( $object_id );
				$dir = $lef->getStoragePath( $object_id );

				Debug::Text('Storage Path: '. $dir, __FILE__, __LINE__, __METHOD__, 10);
				if ( isset($dir)  ) {
					@mkdir($dir, 0700, TRUE);
					if (	@disk_free_space( $dir ) > ( $max_upload_file_size * 2 )
							AND isset($_POST['mime_type'])
							AND in_array( strtolower( trim($_POST['mime_type']) ), $allowed_upload_content_types ) ) {
						$file_name = $dir . DIRECTORY_SEPARATOR . 'logo.img';
						$file_data = base64_decode( $_POST['file_data'] );
						$file_size = strlen( $file_data );

						if ( in_array( Misc::getMimeType( $file_data, TRUE ), $allowed_upload_content_types ) ) {
							if ( $file_size <= $max_upload_file_size ) {
								$success = file_put_contents( $file_name, $file_data );
								if ( $success == FALSE ) {
									Debug::Text('bUpload Failed! Unable to write data to: '. $file_name, __FILE__, __LINE__, __METHOD__, 10);
									$error = TTi18n::gettext('Unable to upload photo');
								}
							} else {
								Debug::Text('cUpload Failed! File too large: '. $file_size, __FILE__, __LINE__, __METHOD__, 10);
								$error = TTi18n::gettext('File size is too large, must be less than %1 bytes', $max_upload_file_size );
							}
						} else {
							Debug::Text('dUpload Failed! Incorrect mime_type: '. $_POST['mime_type'], __FILE__, __LINE__, __METHOD__, 10);
							$error = TTi18n::gettext('Incorrect file type, must be a JPG or PNG image') .' (b)';
						}
					} else {
						if ( isset($_POST['mime_type']) ) {
							Debug::Text('dUpload Failed! Incorrect mime_type: '. $_POST['mime_type'], __FILE__, __LINE__, __METHOD__, 10);
						} else {
							Debug::Text('eUpload Failed! Mime_type not specified...', __FILE__, __LINE__, __METHOD__, 10);
						}

						$error = TTi18n::gettext('Incorrect file type, must be a JPG or PNG image') .' (a)';
					}
				}
				unset($lef);
			}
		}
		break;
	case 'user_photo':
		Debug::Text('User Photo...', __FILE__, __LINE__, __METHOD__, 10);
		$max_upload_file_size = 25000000;

		if ( DEMO_MODE == FALSE AND ( $permission->Check('user', 'add') OR $permission->Check('user', 'edit') OR $permission->Check('user', 'edit_child') OR $permission->Check('user', 'edit_own') ) ) {
			$permission_children_ids = $permission->getPermissionHierarchyChildren( $current_company->getId(), $current_user->getId() );

			$ulf = TTnew( 'UserListFactory' );
			$ulf->getByIdAndCompanyId( $object_id, $current_company->getId() );
			if ( $ulf->getRecordCount() == 1
				AND
				( $permission->Check('user', 'edit')
					OR ( $permission->Check('user', 'edit_own') AND $permission->isOwner( $ulf->getCurrent()->getCreatedBy(), $ulf->getCurrent()->getID() ) === TRUE )
					OR ( $permission->Check('user', 'edit_child') AND $permission->isChild( $ulf->getCurrent()->getId(), $permission_children_ids ) === TRUE ) ) ) {

				if ( isset($_POST['file_data']) ) { //Only required for images due the image wizard.
					Debug::Text('HTML5 Base64 encoded upload...', __FILE__, __LINE__, __METHOD__, 10);
					$allowed_upload_content_types = array(FALSE, 'image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png');

					if ( $ulf->getRecordCount() == 1 ) {
						$uf = TTnew( 'UserFactory' );
						$uf->cleanStoragePath( $current_company->getId(), $object_id );
						$dir = $uf->getStoragePath( $current_company->getId() );
						Debug::Text('Storage Path: '. $dir, __FILE__, __LINE__, __METHOD__, 10);
						if ( isset($dir) ) {
							@mkdir($dir, 0700, TRUE);
							if ( @disk_free_space( $dir ) > ( $max_upload_file_size * 2 )
									AND isset($_POST['mime_type'])
									AND in_array( strtolower( trim($_POST['mime_type']) ), $allowed_upload_content_types ) ) {
								$file_name = $dir . DIRECTORY_SEPARATOR . TTUUID::castUUID( $object_id ) .'.img';
								$file_data = base64_decode( $_POST['file_data'] );
								$file_size = strlen( $file_data );

								if ( in_array( Misc::getMimeType( $file_data, TRUE ), $allowed_upload_content_types ) ) {
									if ( $file_size <= $max_upload_file_size ) {
										$success = file_put_contents( $file_name, $file_data );
										if ( $success == FALSE ) {
											Debug::Text('bUpload Failed! Unable to write data to: '. $file_name, __FILE__, __LINE__, __METHOD__, 10);
											$error = TTi18n::gettext('Unable to upload photo');
										}
									} else {
										Debug::Text('cUpload Failed! File too large: '. $file_size, __FILE__, __LINE__, __METHOD__, 10);
										$error = TTi18n::gettext('File size is too large, must be less than %1 bytes', $max_upload_file_size );
									}
								} else {
									Debug::Text('dUpload Failed! Incorrect mime_type: '. $_POST['mime_type'], __FILE__, __LINE__, __METHOD__, 10);
									$error = TTi18n::gettext('Incorrect file type, must be a JPG or PNG image') .' (b)';
								}
							} else {
								Debug::Text('dUpload Failed! Incorrect mime_type: '. $_POST['mime_type'], __FILE__, __LINE__, __METHOD__, 10);
								$error = TTi18n::gettext('Incorrect file type, must be a JPG or PNG image') .' (a)';
							}
						}
					} else {
						$error = TTi18n::gettext('Invalid Object ID');
					}
					unset($uf, $ulf);
				}
			} else {
				$error = TTi18n::gettext('Invalid Object ID');
			}
		}
		break;
	case 'remittance_source_account':
		Debug::Text('Remittance Source Account Signature...', __FILE__, __LINE__, __METHOD__, 10);
		$max_upload_file_size = 25000000;

		if ( DEMO_MODE == FALSE AND ( $permission->Check('remittance_source_account', 'add') OR $permission->Check('remittance_source_account', 'edit') OR $permission->Check('remittance_source_account', 'edit_child') OR $permission->Check('remittance_source_account', 'edit_own') ) ) {
			$permission_children_ids = $permission->getPermissionHierarchyChildren( $current_company->getId(), $current_user->getId() );

			$rsalf = TTnew( 'RemittanceSourceAccountListFactory' );
			$rsalf->getByIdAndCompanyId( $object_id, $current_company->getId() );
			if ( $rsalf->getRecordCount() == 1
					AND
					( $permission->Check('remittance_source_account', 'edit')
							OR ( $permission->Check('remittance_source_account', 'edit_own') AND $permission->isOwner( $rsalf->getCurrent()->getCreatedBy(), $rsalf->getCurrent()->getID() ) === TRUE )
							OR ( $permission->Check('remittance_source_account', 'edit_child') AND $permission->isChild( $rsalf->getCurrent()->getId(), $permission_children_ids ) === TRUE ) ) ) {

				if ( isset($_POST['file_data']) ) { //Only required for images due the image wizard.
					Debug::Text('HTML5 Base64 encoded upload...', __FILE__, __LINE__, __METHOD__, 10);
					$allowed_upload_content_types = array(FALSE, 'image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png');

					if ( $rsalf->getRecordCount() == 1 ) {
						$rsaf = TTnew( 'RemittanceSourceAccountFactory' );
						$rsaf->cleanStoragePath( $current_company->getId(), $object_id );
						$dir = $rsaf->getStoragePath( $current_company->getId() );
						Debug::Text('Storage Path: '. $dir, __FILE__, __LINE__, __METHOD__, 10);
						if ( isset($dir) ) {
							@mkdir($dir, 0700, TRUE);
							if ( @disk_free_space( $dir ) > ( $max_upload_file_size * 2 )
									AND isset($_POST['mime_type'])
									AND in_array( strtolower( trim($_POST['mime_type']) ), $allowed_upload_content_types ) ) {
								$file_name = $dir . DIRECTORY_SEPARATOR . TTUUID::castUUID( $object_id ) .'.img';
								$file_data = base64_decode( $_POST['file_data'] );
								$file_size = strlen( $file_data );

								if ( in_array( Misc::getMimeType( $file_data, TRUE ), $allowed_upload_content_types ) ) {
									if ( $file_size <= $max_upload_file_size ) {
										$success = file_put_contents( $file_name, $file_data );
										if ( $success == FALSE ) {
											Debug::Text('bUpload Failed! Unable to write data to: '. $file_name, __FILE__, __LINE__, __METHOD__, 10);
											$error = TTi18n::gettext('Unable to upload signature');
										}
									} else {
										Debug::Text('cUpload Failed! File too large: '. $file_size, __FILE__, __LINE__, __METHOD__, 10);
										$error = TTi18n::gettext('File size is too large, must be less than %1 bytes', $max_upload_file_size );
									}
								} else {
									Debug::Text('dUpload Failed! Incorrect mime_type: '. $_POST['mime_type'], __FILE__, __LINE__, __METHOD__, 10);
									$error = TTi18n::gettext('Incorrect file type, must be a JPG or PNG image') .' (b)';
								}
							} else {
								Debug::Text('dUpload Failed! Incorrect mime_type: '. $_POST['mime_type'], __FILE__, __LINE__, __METHOD__, 10);
								$error = TTi18n::gettext('Incorrect file type, must be a JPG or PNG image') .' (a)';
							}
						}
					} else {
						$error = TTi18n::gettext('Invalid Object ID');
					}
					unset($rsaf, $rsalf);
				}
			} else {
				$error = TTi18n::gettext('Invalid Object ID');
			}
		}
		break;
	case 'license':
		//Always enable debug logging during license upload.
		Debug::setEnable(TRUE);
		Debug::setBufferOutput(TRUE);
		Debug::setEnableLog(TRUE);
		Debug::setVerbosity(10);

		$max_upload_file_size = 50000;

		if ( getTTProductEdition() > 10 ) {
			if ( ( ( DEPLOYMENT_ON_DEMAND == FALSE AND $current_company->getId() == 1 ) OR ( isset($config_vars['other']['primary_company_id']) AND $current_company->getId() == $config_vars['other']['primary_company_id'] ) ) ) {
				if ( ( $permission->Check('company', 'add') OR $permission->Check('company', 'edit') OR $permission->Check('company', 'edit_own') OR $permission->Check('company', 'edit_child') ) ) {
					$upload->set_max_filesize( $max_upload_file_size ); //20K or less
					$upload->set_acceptable_types( array('text/plain', 'plain/text', 'application/octet-stream') ); // comma separated string, or array
					$upload->set_overwrite_mode( 1 );

					$dir = Environment::getStorageBasePath() . DIRECTORY_SEPARATOR . 'license' . DIRECTORY_SEPARATOR . $current_company->getId();
					if ( isset( $dir ) ) {
						@mkdir( $dir, 0700, TRUE );

						if ( @disk_free_space( $dir ) > ( $max_upload_file_size * 2 ) ) {
							$upload_result = $upload->upload( 'filedata', $dir );
							//var_dump($upload ); //file data
							if ( $upload_result ) {
								$success = $upload_result . ' ' . TTi18n::gettext( 'Successfully Uploaded!' );
							} else {
								$error = $upload->get_error();
							}
						} else {
							Debug::Text('Upload Failed: Not enough disk space available...', __FILE__, __LINE__, __METHOD__, 10);
							$error = TTi18n::gettext('File is too large to be uploaded at this time.');
						}
					}

					Debug::Text( 'Post Upload Operation...', __FILE__, __LINE__, __METHOD__, 10 );
					if ( isset( $success ) AND $success != '' ) {
						$clf = new CompanyListFactory();
						$clf->getById( $config_vars['other']['primary_company_id'] );
						if ( $clf->getRecordCount() == 1 ) {
							$ttsc = new TimeTrexSoapClient();
							if ( $ttsc->Ping() == TRUE ) {
								Debug::Text( 'Initial Communication to license server successful!', __FILE__, __LINE__, __METHOD__, 10 );
								$file_data_arr = $upload->get_file();
								$license_data = trim( file_get_contents( $dir . '/' . $upload_result ) );

								$license = new TTLicense();
								$retval = $license->getLicenseFile( TRUE, $license_data ); //Download updated license file if one exists.
								if ( $retval === FALSE ) {
									$error = TTi18n::gettext( 'Invalid license file or unable to activate license.' );
									unset( $success );
								}
							} else {
								$error = TTi18n::gettext( 'ERROR: Unable to communicate with license server, please check your internet connection.' );
								unset( $success );
							}
						} else {
							$error = TTi18n::gettext( 'ERROR: Invalid PRIMARY_COMPANY_ID defined in timetrex.ini.php file.' );
							unset( $success );
						}
					}
				} else {
					$error = TTi18n::gettext('ERROR: Permission Denied!');
				}
			} else {
				Debug::Text( 'Current Company ID: '. $current_company->getId(), __FILE__, __LINE__, __METHOD__, 10);
				$error = TTi18n::gettext('ERROR: Not logged into primary company.');
			}
		} else {
			$error = TTi18n::gettext('ERROR: Product Edition is invalid, must not be Community Edition.');
		}
		break;
	case 'import':
		$max_upload_file_size = 128000000;


		if ( ( DEMO_MODE == FALSE OR ( isset($config_vars['other']['sandbox']) AND $config_vars['other']['sandbox'] == TRUE ) ) //Allow importing in sandbox mode, as its helpful to be able to test this.
			AND (
					$permission->Check('user', 'add')
					OR $permission->Check('user', 'edit_bank')
					OR $permission->Check('branch', 'add')
					OR $permission->Check('department', 'add')
					OR $permission->Check('wage', 'add')
					OR $permission->Check('pay_period_schedule', 'add')
					OR $permission->Check('schedule', 'add')
					OR $permission->Check('pay_stub_amendment', 'add')
					OR $permission->Check('accrual', 'add')
					OR $permission->Check('client', 'add')
					OR $permission->Check('job', 'add')
					OR $permission->Check('job_item', 'add')
				)
			) {
			$import = TTnew( 'Import' );
			$import->company_id = $current_company->getId();
			$import->user_id = $current_user->getId();
			$import->deleteLocalFile(); //Make sure we delete the original file upon uploading, so if there is an error and the file upload is denied we don't show old files.

			//Sometimes Excel uploads .CSV files as application/vnd.ms-excel
			$valid_mime_types = array('text/plain','plain/text','text/comma-separated-values', 'text/csv', 'application/csv', 'text/anytext', 'application/octet-stream' );  // comma separated string, or array

			//Debug::setVerbosity(11);
			$upload->set_max_filesize($max_upload_file_size); //128mb or less, though I'm not 100% sure this is even working.
			//$upload->set_acceptable_types( $valid_mime_types ); //Ignore mime type sent by browser and use mime extension instead.
			$upload->set_overwrite_mode(1); //Overwrite

			$dir = $import->getStoragePath();
			Debug::Text('Storage Path: '. $dir, __FILE__, __LINE__, __METHOD__, 10);
			if ( isset($dir) ) {
				@mkdir($dir, 0700, TRUE);

				if ( @disk_free_space( $dir ) > ( $max_upload_file_size * 2 ) ) {
					$upload_result = $upload->upload('filedata', $dir); //'filedata' is case sensitive
					//Debug::Arr($_FILES, 'FILES Vars: ', __FILE__, __LINE__, __METHOD__, 10);
					//Debug::Arr($upload->get_file(), 'File Upload Data: ', __FILE__, __LINE__, __METHOD__, 10);
					if ($upload_result) {
						$upload_file_arr = $upload->get_file();

						//mime_content_type is being deprecated in PHP, and it doesn't work properly on Windows. So if its not available just accept any file type.
						$mime_type = ( function_exists('mime_content_type') ) ? mime_content_type( $dir.'/'.$upload_file_arr['name'] ) : FALSE;
						if ( $mime_type === FALSE OR in_array( $mime_type, $valid_mime_types ) ) {

							$max_file_line_count = 0;
							if ( DEPLOYMENT_ON_DEMAND == TRUE ) {
								switch ( strtolower($object_id) ) {
									case 'apiimportpunch':
										$max_file_line_count = ( $current_company->getProductEdition() == 10 ) ? 500 : 2500; //Importing punches can be quite slow, so reduce this significantly.
										break;
									default:
										$max_file_line_count = ( $current_company->getProductEdition() == 10 ) ? 100 : 10000;
										break;
								}
							}

							$file_name = $import->getStoragePath(). DIRECTORY_SEPARATOR . $upload_file_arr['name'];
							$file_line_count = Misc::countLinesInFile( $file_name );
							Debug::Text('Upload Success: '. $upload_result .' Full Path: '. $file_name .' Line Count: '. $file_line_count .' Max Lines: '. $max_file_line_count, __FILE__, __LINE__, __METHOD__, 10);

							if ( $max_file_line_count > 0 AND $file_line_count > $max_file_line_count ) {
								$error = TTi18n::gettext('Import file exceeds the maximum number of allowed lines (%1), please reduce the number of lines and try again.', $max_file_line_count );
							} else {
								$success = $upload_result .' '. TTi18n::gettext('Successfully Uploaded');
							}
						} else {
							$error = TTi18n::gettext('ERROR: Uploaded file is not a properly formatted CSV file compatible with importing. You uploaded a file of type'). ': '. $mime_type;
						}
						unset($mime_type);
					} else {
						Debug::Text('Upload Failed!: '. $upload->get_error(), __FILE__, __LINE__, __METHOD__, 10);
						$error = $upload->get_error();
					}
				}
			}

			if ( isset($success) ) {
				$import->setRemoteFileName( $upload_file_arr['name'] );
				$import->renameLocalFile();
			} else {
				Debug::Text('bUpload Failed!: '. $upload->get_error(), __FILE__, __LINE__, __METHOD__, 10);
			}
		} else {
			$error = TTi18n::gettext('Permission Denied');
		}
		break;
	default:
		$error = TTi18n::gettext('Invalid object_type');
		break;
}

if ( isset($success) ) {
	echo 'TRUE';
} else {
	if ( isset($error) ) {
		//In some cases the real path of the file could be included in the error message, revealing too much information.
		//Try to remove the directory from the error message if it exists.
		if ( isset($dir) AND $dir != '' ) {
			$error = str_replace( $dir, '', $error );
		}
		echo $error;
		Debug::Text('Upload ERROR: '. $error, __FILE__, __LINE__, __METHOD__, 10);
	} else {
		if ( DEMO_MODE == TRUE ) {
			echo TTi18n::gettext('ERROR: Uploading files is disabled in DEMO mode.');
		} else {
			echo TTi18n::gettext('ERROR: Unable to upload file!');
		}
	}
}
Debug::writeToLog();
?>