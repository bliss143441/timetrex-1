require.config( {

	waitSeconds: 500,
	urlArgs: 'v=' + APPLICATION_BUILD,

	paths: {
		'CookieSetting': 'global/CookieSetting',
		'APIGlobal': 'global/APIGlobal.js.php?disable_db='+ DISABLE_DB,
		'async': 'framework/require_async_plugin',
		'jquery_cookie': 'framework/jquery.cookie',
		'jquery_json': 'framework/jquery.json',
		'jquery_tablednd': 'framework/jquery.tablednd',
		'jquery_ba_resize': 'framework/jquery.ba-resize',
		'fastclick': 'framework/fastclick',
		'stacktrace': 'framework/stacktrace',
		'html2canvas': 'framework/html2canvas',
		'datejs': 'framework/date',
		'moment': 'framework/moment.min',
		'timepicker_addon': 'framework/widgets/datepicker/jquery-ui-timepicker-addon',
		'grid_locale': 'framework/widgets/jqgrid/grid.locale-en',
		'jqGrid': 'framework/widgets/jqgrid/jquery.jqGrid.src',
		'ImageAreaSelect': 'framework/jquery.imgareaselect',

		'live-chat': 'global/widgets/live-chat/live-chat',

		'jqGrid_extend': 'framework/widgets/jqgrid/jquery.jqGrid.extend',
		'SearchPanel': 'global/widgets/search_panel/SearchPanel',
		'FormItemType': 'global/widgets/search_panel/FormItemType',
		'TGridHeader': 'global/widgets/jqgrid/TGridHeader',
		'ADropDown': 'global/widgets/awesomebox/ADropDown',
		'AComboBox': 'global/widgets/awesomebox/AComboBox',
		'ASearchInput': 'global/widgets/awesomebox/ASearchInput',
		'ALayoutCache': 'global/widgets/awesomebox/ALayoutCache',
		'ALayoutIDs': 'global/widgets/awesomebox/ALayoutIDs',
		'ColumnEditor': 'global/widgets/column_editor/ColumnEditor',
		'SaveAndContinueBox': 'global/widgets/message_box/SaveAndContinueBox',
		'NoHierarchyBox': 'global/widgets/message_box/NoHierarchyBox',
		'NoResultBox': 'global/widgets/message_box/NoResultBox',
		'SeparatedBox': 'global/widgets/separated_box/SeparatedBox',
		'TTextInput': 'global/widgets/text_input/TTextInput',
		'TPasswordInput': 'global/widgets/text_input/TPasswordInput',
		'TText': 'global/widgets/text/TText',
		'TList': 'global/widgets/list/TList',
		'TToggleButton': 'global/widgets/toggle_button/TToggleButton',
		'SwitchButton': 'global/widgets/switch_button/SwitchButton',
		'TCheckbox': 'global/widgets/checkbox/TCheckbox',
		'TComboBox': 'global/widgets/combobox/TComboBox',
		'TTagInput': 'global/widgets/tag_input/TTagInput',
		'TRangePicker': 'global/widgets/datepicker/TRangePicker',
		'TDatePicker': 'global/widgets/datepicker/TDatePicker',
		'TTimePicker': 'global/widgets/timepicker/TTimePicker',
		'TTextArea': 'global/widgets/textarea/TTextArea',
		'TImageBrowser': 'global/widgets/filebrowser/TImageBrowser',
		'TImageAdvBrowser': 'global/widgets/filebrowser/TImageAdvBrowser',
		'TImage': 'global/widgets/filebrowser/TImage',
		'TImageCutArea': 'global/widgets/filebrowser/TImageCutArea',
		'colors': 'framework/widgets/color-picker/colors',
		'colorpicker': 'framework/widgets/color-picker/color-picker',
		'TColorPicker': 'global/widgets/color-picker/TColorPicker',
		'CameraBrowser': 'global/widgets/filebrowser/CameraBrowser',
		'InsideEditor': 'global/widgets/inside_editor/InsideEditor',
		'ErrorTipBox': 'global/widgets/error_tip/ErrorTipBox',
		'TFeedback': 'global/widgets/feedback/TFeedback',
		'Paging2': 'global/widgets/paging/Paging2',
		'ViewMinTabBar': 'global/widgets/view_min_tab/ViewMinTabBar',
		'RibbonSubMenuNavWidget': 'global/widgets/ribbon/RibbonSubMenuNavWidget',
		'TopNotification': 'global/widgets/top_alert/TopNotification',

		'ContextMenuConstant': 'global/ContextMenuConstant',
		'ProgressBarManager': 'global/ProgressBarManager',
		'TAlertManager': 'global/TAlertManager',
		'PermissionManager': 'global/PermissionManager',
		'TopMenuManager': 'global/TopMenuManager',
		'IndexController': 'IndexController',

		'Base': 'model/Base',
		'SearchField': 'model/SearchField',
		'ResponseObject': 'model/ResponseObject',
		'RibbonMenu': 'model/RibbonMenu',
		'RibbonSubMenu': 'model/RibbonSubMenu',
		'RibbonSubMenuGroup': 'model/RibbonSubMenuGroup',
		'RibbonSubMenuNavItem': 'model/RibbonSubMenuNavItem',
		'ServiceCaller': 'services/ServiceCaller',
		'APIProgressBar': 'services/core/APIProgressBar',
		'APIFactory': 'services/APIFactory',
		'APIReturnHandler': 'model/APIReturnHandler',
		'BaseViewController': 'views/BaseViewController',
		'BaseWindowController': 'views/BaseWindowController',
		'BaseWizardController': 'views/wizard/BaseWizardController',
		'UserGenericStatusWindowController': 'views/wizard/user_generic_data_status/UserGenericStatusWindowController',
		'ReportBaseViewController': 'views/reports/ReportBaseViewController',
		'sonic': 'framework/sonic',
		'qtip': 'framework/jquery.qtip.min',
		'rightclickmenu': 'framework/rightclickmenu/rightclickmenu',
		'jquery.ui.position': 'framework/rightclickmenu/jquery.ui.position',

		'jquery': 'framework/jquery.min',
		'jquery.form': 'framework/jquery.form.min',
		'jquery-ui': 'framework/jqueryui/js/jquery-ui.custom.min',
		'jquery.i18n': 'framework/jquery.i18n',
		'underscore': 'framework/backbone/underscore-min',
		'backbone': 'framework/backbone/backbone-min',
		'jquery.masonry': 'framework/jquery.masonry.min',
		'interact': 'framework/interact.min',
		'tinymce': 'framework/tinymce/tinymce.min',
		'jquery.sortable': 'framework/jquery.sortable',
		'Global': 'global/Global',
		'RateLimiter': 'global/RateLimiter',
		'LocalCacheData': 'global/LocalCacheData',
		'nanobar': 'framework/nanobar.min',

		'leaflet': 'framework/leaflet/leaflet',
		'leaflet-timetrex': 'framework/leaflet/leaflet-timetrex',
		'leaflet-providers': 'framework/leaflet/leaflet-providers/leaflet-providers',
		'leaflet-routing': 'framework/leaflet/leaflet-routing-machine/leaflet-routing-machine.min',
		'leaflet-draw': 'framework/leaflet/leaflet-draw/leaflet.draw',
		'pdfjs': 'framework/pdfjs',
		'autolinker': 'framework/autolinker',
		'measurement': 'framework/measurement',
		'TTPromise': 'global/TTPromise',
		'TTUUID': 'global/TTUUID',

		'Wizard': 'global/widgets/wizard/Wizard',
		'WizardStep': 'global/widgets/wizard/WizardStep',

		'RateLimit': 'global/RateLimit',
		'jquery-bridget': 'framework/jquery.bridget',


		/**
		 * API paths
		 */

		'APICurrency': 'services/core/APICurrency',
		'APICurrencyRate': 'services/core/APICurrencyRate',
		'APIUserPreference': 'services/users/APIUserPreference',
		'APIDate': 'services/APIDate',
		'APIPermission': 'services/core/APIPermission',
		'APIUserGenericData': 'services/users/APIUserGenericData',
		'APIUser': 'services/users/APIUser',
		'APIUserGroup': 'services/users/APIUserGroup',
		'APIBranch': 'services/company/APIBranch',
		'APILegalEntity': 'services/company/APILegalEntity',
		'APIRemittanceSourceAccount': 'services/company/APIRemittanceSourceAccount',
		'APIRemittanceDestinationAccount': 'services/users/APIRemittanceDestinationAccount',
		'APIPayrollRemittanceAgency': 'services/company/APIPayrollRemittanceAgency',
		'APIGEOFence': 'services/company/APIGEOFence',
		'APIDepartment': 'services/department/APIDepartment',
		'APICompany': 'services/company/APICompany',
		'APIPayrollRemittanceAgencyEvent': 'services/company/APIPayrollRemittanceAgencyEvent',
		'APIHierarchyLevel': 'services/company/APIHierarchyLevel',
		'APIUserTitle': 'services/users/APIUserTitle',
		'APIAbout': 'services/help/APIAbout',
		'APIRoundingIntervalPolicy': 'services/policy/APIRoundingIntervalPolicy',
		'APIPermissionControl': 'services/core/APIPermissionControl',
		'APIPayPeriodSchedule': 'services/payperiod/APIPayPeriodSchedule',
		'APIPolicyGroup': 'services/policy/APIPolicyGroup',
		'APIExceptionPolicy': 'services/policy/APIExceptionPolicy',
		'APIExceptionPolicyControl': 'services/policy/APIExceptionPolicyControl',
		'APILog': 'services/core/APILog',
		'APIHierarchyControl': 'services/hierarchy/APIHierarchyControl',
		'APIUserWage': 'services/users/APIUserWage',
		'APIUserDeduction': 'services/users/APIUserDeduction',
		'APIWageGroup': 'services/company/APIWageGroup',
		'APIPunch': 'services/core/APIPunch',
		'APITimeSheet': 'services/core/APITimeSheet',
		'APIJob': 'services/job/APIJob',
		'APIJobGroup': 'services/job/APIJobGroup',
		'APIJobItem': 'services/job_item/APIJobItem',
		'APIJobItemAmendment': 'services/job_item_amendment/APIJobItemAmendment',
		'APIJobItemGroup': 'services/job_item/APIJobItemGroup',
		'APIUserContact': 'services/users/APIUserContact',
		'APIEthnicGroup': 'services/users/APIEthnicGroup',
		'APIGovernmentDocument': 'services/payroll/APIGovernmentDocument',
		'APIBankAccount': 'services/users/APIBankAccount',
		'APIUserDefault': 'services/users/APIUserDefault',
		'APICompanyDeduction': 'services/company/APICompanyDeduction',
		'APIAbsencePolicy': 'services/policy/APIAbsencePolicy',
		'APIExpensePolicy': 'services/policy/APIExpensePolicy',
		'APIUserDateTotal': 'services/core/APIUserDateTotal',
		'APIPunchControl': 'services/core/APIPunchControl',
		'APIROE': 'services/users/APIROE',
		'APIClient': 'services/invoice/APIClient',
		'APIClientGroup': 'services/invoice/APIClientGroup',
		'APIClientContact': 'services/invoice/APIClientContact',
		'APIClientPayment': 'services/invoice/APIClientPayment',
		'APITaxPolicy': 'services/invoice/APITaxPolicy',
		'APIShippingPolicy': 'services/invoice/APIShippingPolicy',
		'APIPaymentGateway': 'services/invoice/APIPaymentGateway',
		'APIInvoiceConfig': 'services/invoice/APIInvoiceConfig',
		'APIInvoiceDistrict': 'services/invoice/APIInvoiceDistrict',
		'APIAreaPolicy': 'services/invoice/APIAreaPolicy',
		'APIPayPeriod': 'services/payroll/APIPayPeriod',
		'APISchedule': 'services/attendance/APISchedule',
		'APIScheduleAdvanced': 'services/attendance/APIScheduleAdvanced',
		'APIRecurringScheduleTemplate': 'services/attendance/APIRecurringScheduleTemplate',
		'APIRecurringScheduleTemplateControl': 'services/attendance/APIRecurringScheduleTemplateControl',
		'APIOtherField': 'services/core/APIOtherField',
		'APIStation': 'services/company/APIStation',
		'APIPayStub': 'services/payroll/APIPayStub',
		'APIPayStubTransaction': 'services/payroll/APIPayStubTransaction',
		'APIPayStubEntry': 'services/payroll/APIPayStubEntry',
		'APIPayStubEntryAccountLink': 'services/payroll/APIPayStubEntryAccountLink',
		'APIPayStubAmendment': 'services/payroll/APIPayStubAmendment',
		'APIRecurringPayStubAmendment': 'services/payroll/APIRecurringPayStubAmendment',
		'APIPayStubEntryAccount': 'services/payroll/APIPayStubEntryAccount',
		'APISchedulePolicy': 'services/policy/APISchedulePolicy',
		'APIUserExpense': 'services/payroll/APIUserExpense',
		'APIMealPolicy': 'services/policy/APIMealPolicy',
		'APIBreakPolicy': 'services/policy/APIBreakPolicy',
		'APIPayCode': 'services/policy/APIPayCode',
		'APIPayFormulaPolicy': 'services/policy/APIPayFormulaPolicy',
		'APIContributingPayCodePolicy': 'services/policy/APIContributingPayCodePolicy',
		'APIContributingShiftPolicy': 'services/policy/APIContributingShiftPolicy',
		'APIRegularTimePolicy': 'services/policy/APIRegularTimePolicy',
		'APIOvertimePolicy': 'services/policy/APIOvertimePolicy',
		'APIAccrualPolicyAccount': 'services/policy/APIAccrualPolicyAccount',
		'APIAccrualPolicy': 'services/policy/APIAccrualPolicy',
		'APIAccrualPolicyUserModifier': 'services/policy/APIAccrualPolicyUserModifier',
		'APIRecurringHoliday': 'services/policy/APIRecurringHoliday',
		'APIHolidayPolicy': 'services/policy/APIHolidayPolicy',
		'APIHoliday': 'services/policy/APIHoliday',
		'APIDocument': 'services/document/APIDocument',
		'APITransaction': 'services/invoice/APITransaction',
		'APIProduct': 'services/invoice/APIProduct',
		'APIProductPrice': 'services/invoice/APIProductPrice',
		'APIDocumentRevision': 'services/document/APIDocumentRevision',
		'APIDocumentGroup': 'services/document/APIDocumentGroup',
		'APIPremiumPolicy': 'services/policy/APIPremiumPolicy',
		'APIAccrualPolicyMilestone': 'services/policy/APIAccrualPolicyMilestone',
		'APIUserGenericStatus': 'services/users/APIUserGenericStatus',
		'APIRecurringScheduleControl': 'services/attendance/APIRecurringScheduleControl',

		'APIActiveShiftReport': 'services/reports/APIActiveShiftReport',
		'APIUserReportData': 'services/reports/APIUserReportData',
		'APIReportSchedule': 'services/reports/APIReportSchedule',
		'APIReportCustomColumn': 'services/reports/APIReportCustomColumn',
		'APIUserSummaryReport': 'services/reports/APIUserSummaryReport',
		'APIAuditTrailReport': 'services/reports/APIAuditTrailReport',
		'APITimesheetDetailReport': 'services/reports/APITimesheetDetailReport',
		'APIPunchSummaryReport': 'services/reports/APIPunchSummaryReport',
		'APIAccrualBalanceSummaryReport': 'services/reports/APIAccrualBalanceSummaryReport',
		'APIAccrual': 'services/attendance/APIAccrual',
		'APIAccrualBalance': 'services/attendance/APIAccrualBalance',
		'APIScheduleSummaryReport': 'services/reports/APIScheduleSummaryReport',
		'APITimesheetSummaryReport': 'services/reports/APITimesheetSummaryReport',
		'APITimeSheetVerify': 'services/reports/APITimeSheetVerify',
		'APIExceptionSummaryReport': 'services/reports/APIExceptionSummaryReport',
		'APIPayStubSummaryReport': 'services/reports/APIPayStubSummaryReport',
		'APIPayStubTransactionSummaryReport': 'services/reports/APIPayStubTransactionSummaryReport',
		'APIGeneralLedgerSummaryReport': 'services/reports/APIGeneralLedgerSummaryReport',
		'APIUserExpenseReport': 'services/reports/APIUserExpenseReport',
		'APIJobSummaryReport': 'services/reports/APIJobSummaryReport',
		'APIJobDetailReport': 'services/reports/APIJobDetailReport',
		'APIJobInformationReport': 'services/reports/APIJobInformationReport',
		'APIJobItemInformationReport': 'services/reports/APIJobItemInformationReport',
		'APIInvoiceTransactionSummaryReport': 'services/reports/APIInvoiceTransactionSummaryReport',
		'APIInvoice': 'services/invoice/APIInvoice',
		'APIProductGroup': 'services/invoice/APIProductGroup',
		'APIRemittanceSummaryReport': 'services/reports/APIRemittanceSummaryReport',
		'APIT4SummaryReport': 'services/reports/APIT4SummaryReport',
		'APIT4ASummaryReport': 'services/reports/APIT4ASummaryReport',
		'APITaxSummaryReport': 'services/reports/APITaxSummaryReport',
		'APIForm940Report': 'services/reports/APIForm940Report',
		'APIForm941Report': 'services/reports/APIForm941Report',
		'APIForm1099MiscReport': 'services/reports/APIForm1099MiscReport',
		'APIFormW2Report': 'services/reports/APIFormW2Report',
		'APIAffordableCareReport': 'services/reports/APIAffordableCareReport',
		'APIUserQualificationReport': 'services/reports/APIUserQualificationReport',
		'APIQualificationGroup': 'services/hr/APIQualificationGroup',
		'APIQualification': 'services/hr/APIQualification',
		'APIQualificationPortal': 'services/hr/APIQualificationPortal',
		'APIUserSkill': 'services/hr/APIUserSkill',
		'APIRequest': 'services/my_account/APIRequest',
		'APIRequestSchedule': 'services/my_account/APIRequestSchedule',
		'APIMessageControl': 'services/my_account/APIMessageControl',
		'APIPayPeriodTimeSheetVerify': 'services/my_account/APIPayPeriodTimeSheetVerify',
		'APIJobApplicantEmployment': 'services/hr/APIJobApplicantEmployment',
		'APIJobApplicantLanguage': 'services/hr/APIJobApplicantLanguage',
		'APIJobApplicantLicense': 'services/hr/APIJobApplicantLicense',
		'APIJobApplicantMembership': 'services/hr/APIJobApplicantMembership',
		'APIJobApplicantEducation': 'services/hr/APIJobApplicantEducation',
		'APIJobApplicantSkill': 'services/hr/APIJobApplicantSkill',
		'APIJobApplicantReference': 'services/hr/APIJobApplicantReference',
		'APIJobApplicantLocation': 'services/hr/APIJobApplicantLocation',
		'APIUserLicense': 'services/hr/APIUserLicense',
		'APIUserEducation': 'services/hr/APIUserEducation',
		'APIUserLanguage': 'services/hr/APIUserLanguage',
		'APIUserMembership': 'services/hr/APIUserMembership',
		'APIKPIReport': 'services/reports/APIKPIReport',
		'APIKPIGroup': 'services/hr/APIKPIGroup',
		'APIKPI': 'services/hr/APIKPI',
		'APIUserReview': 'services/hr/APIUserReview',
		'APIRecruitmentPortalConfig': 'services/hr/APIRecruitmentPortalConfig',
		'APIUserReviewControl': 'services/hr/APIUserReviewControl',
		'APIUserRecruitmentSummaryReport': 'services/reports/APIUserRecruitmentSummaryReport',
		'APIJobApplicant': 'services/hr/APIJobApplicant',
		'APIJobApplication': 'services/hr/APIJobApplication',
		'APIJobVacancy': 'services/hr/APIJobVacancy',
		'APIUserRecruitmentDetailReport': 'services/reports/APIUserRecruitmentDetailReport',
		'APIPayrollExportReport': 'services/reports/APIPayrollExportReport',
		'APIImport': 'services/core/APIImport',
		'APIAuthorization': 'services/core/APIAuthorization',
		'APIAuthentication': 'services/unauthenticated/APIAuthentication',
		'APICurrentUser': 'services/APICurrentUser',
		'APIRoundIntervalPolicy': 'services/policy/APIRoundIntervalPolicy',
		'APIException': 'services/attendance/APIException',
		'APIDocumentAttachment': 'services/document/APIDocumentAttachment',
		'APINotification': 'services/core/APINotification',
		'APIMisc': 'services/core/APIMisc',
		'APICompanyGenericTag': 'services/company/APICompanyGenericTag',
		'APIDashboard': 'services/core/APIDashboard',
		'APIInstall': 'services/install/APIInstall',
		'APIJobVacancyPortal': 'services/hr/APIJobVacancyPortal',
		'APIJobApplicantPortal': 'services/hr/APIJobApplicantPortal',
		'APIRecruitmentAuthentication': 'services/core/APIRecruitmentAuthentication',
		'APICompanyPortal': 'services/company/APICompanyPortal',
		'APIEthnicGroupPortal': 'services/users/APIEthnicGroupPortal',
		'APIUserDefaultPortal': 'services/users/APIUserDefaultPortal',
		'APICurrencyPortal': 'services/core/APICurrencyPortal',
		'APIDocumentPortal': 'services/document/APIDocumentPortal',

		'RequestViewCommonController':'views/common/RequestViewCommonController',
		'EmbeddedMessageCommon':'views/common/EmbeddedMessageCommon',
		'AuthorizationHistoryCommon':'views/common/AuthorizationHistoryCommon',
	},
	shim: {
		'APIGlobal': {
			deps: ['CookieSetting'],
		},
		'LocalCacheData': {
			deps: ['APIGlobal'],
			exports: 'LocalCacheData',
		},
		'Global': {
			exports: 'Global',
			deps: [
				'backbone',
				'LocalCacheData',
				'jquery.masonry',
				'APIGlobal',
				]
		},
		'underscore': {
			exports: '_'
		},
		'interact': {
			exports: 'interact',
		},
		'backbone': {
			deps: [
				'underscore',
				'jquery'
			],
			exports: 'Backbone'
		},
		'Base': {
			deps: ['backbone']
		},

		'BaseViewController': {
			deps: [
				'backbone',
				'ContextMenuConstant',
				'ServiceCaller',
				'APIGlobal'
				]
		},
		'jquery.i18n': {
			deps: ['jquery']
		},
		'jquery-ui': {
			deps: ['jquery']
		},
		'jquery_ba_resize': {
			deps: ['jquery']
		},
		'jquery_tablednd': {
			deps: ['jquery']
		},
		'jquery_json': {
			deps: ['jquery']
		},
		'jquery_cookie': {
			deps: ['jquery']
		},
		'jquery.ui.position': {
			deps: ['jquery']
		},
		'jquery.form': {
			deps: ['jquery']
		},
		'jquery.masonry': {
			deps: ['jquery', 'jquery-ui', 'jquery-bridget'],
			exports: 'jQuery.masonry'
		},
		'jquery.sortable': {
			deps: ['jquery']
		},
		//long dep chain
		'colors': {
			deps: ['jquery'],
		},
		'colorpicker': {
			deps: ['colors'],
		},
		'TColorPicker': {
			deps: ['colorpicker'],
			exports: 'jQuery.fn.TColorPicker',
		},

		'TImageCutArea': {
			deps: ['jquery']
		},
		'TImage': {
			deps: ['jquery']
		},
		'TImageAdvBrowser': {
			deps: ['jquery']
		},
		'TImageBrowser': {
			deps: ['jquery']
		},
		'TRangePicker': {
			deps: ['jquery']
		},
		'TDatePicker': {
			deps: ['jquery']
		},
		'TTimePicker': {
			deps: ['jquery']
		},
		'TTextArea': {
			deps: ['jquery']
		},
		'TText': {
			deps: ['jquery']
		},
		'TList': {
			deps: ['jquery']
		},
		'TCheckbox': {
			deps: ['jquery']
		},
		'TTagInput': {
			deps: ['jquery']
		},
		'TRangePicker': {
			deps: ['jquery']
		},
		'TTextInput': {
			deps: ['jquery']
		},
		'TPasswordInput': {
			deps: ['jquery']
		},
		'TComboBox': {
			deps: ['jquery']
		},
		'jquery.sortable': {
			deps: ['jquery']
		},
		'jquery.sortable': {
			deps: ['jquery']
		},

		//Make sure jqGrid_extend load after jgGrid
		'jqGrid_extend': {
			deps: ['jqGrid']
		},
		'APIReturnHandler': {
			deps: ['Base']
		},
		'ResponseObject': {
			deps: ['Base']
		},
		'ServiceCaller': {
			deps: ['APIReturnHandler', 'Base', 'ResponseObject']
		},
		'BaseViewController': {
			deps: ['backbone', 'ContextMenuConstant', 'ServiceCaller']
		},
		'BaseWindowController': {
			deps: ['backbone']
		},
		'APIProgressBar': {
			deps: ['ServiceCaller']
		},
		'BaseWizardController': {
			deps: ['BaseWindowController']
		},
		'IndexController': {
			deps: ['BaseWizardController']
		},
		'leaflet-providers': {
			deps: ['leaflet']
		},
		'leaflet-routing': {
			deps: ['leaflet']
		},
		'leaflet-draw': {
			deps: ['leaflet']
		},
		'leaflet-timetrex': {
			deps: ['leaflet','leaflet-draw','leaflet-routing','leaflet-providers','measurement'],
			exports: 'L',
			init: function() {
				window.L = L;
			}
		},
		'tinymce': {
            exports: 'tinyMCE',
            init: function () {
                this.tinyMCE.DOM.events.domLoaded = true;
                return this.tinyMCE;
            }
        },

		'APIAuthentication': {
			deps:[ 'ServiceCaller', 'APIFactory' ]
		},


		'WizardStep': {
			deps: ['Wizard', 'backbone']
		},

		'Wizard': {
			deps: ['backbone']
		},
	}
} );

require( [
	'RateLimit',
	'LocalCacheData',
	'backbone',
	'Global',
	'async',
	'jquery-ui',
	'jquery.i18n',
	'jquery_ba_resize',
	'jquery_cookie',
	'fastclick',
	'moment',
	'IndexController',
	'BaseViewController',
	'APIFactory',
	'APIProgressBar',
	'TTextInput',
	'TPasswordInput',
	'FormItemType',
	'TComboBox',
	'ProgressBarManager',
	'TAlertManager',
	'sonic',
	'TTPromise',
	'TTUUID',
	'APIAuthentication',
	'Wizard',
	'WizardStep',
], function() {

	//Hide elements that show hidden link for search friendly
	hideElements();

	//Don't not show loading bar if refresh
	if ( Global.isSet( LocalCacheData.getLoginUser() ) ) {
		$( ".loading-view" ).hide();
	} else {
		setProgress()
	}

	function setProgress() {
		loading_bar_time = setInterval( function() {
			var progress_bar = $( ".progress-bar" );
			var c_value = progress_bar.attr( "value" );

			if ( c_value < 90 ) {
				progress_bar.attr( "value", c_value + 10 );
			}
		}, 1000 );
	}

	function cleanProgress() {
		if ( $( ".loading-view" ).is( ":visible" ) ) {

			var progress_bar = $( ".progress-bar" );
			progress_bar.attr( "value", 100 );
			clearInterval( loading_bar_time );

			loading_bar_time = setInterval( function() {
				$( ".progress-bar-div" ).hide();
				clearInterval( loading_bar_time );
			}, 50 );
		}
	}

	function hideElements() {
		var elements = document.getElementsByClassName( 'need-hidden-element' );

		for ( var i = 0; i < elements.length; i++ ) {
			elements[i].style.display = 'none';
		}
	}

	if ( window.sessionStorage ) {
		LocalCacheData.isSupportHTML5LocalCache = true;
	} else {
		LocalCacheData.isSupportHTML5LocalCache = false;
	}

	is_browser_iOS = ( navigator.userAgent.match( /(iPad|iPhone|iPod)/g ) ? true : false );

	ie = (function() {

		var undef,
			v = 3,
			div = document.createElement( 'div' ),
			all = div.getElementsByTagName( 'i' );

		while (
			div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
				all[0]
			);

		return v > 4 ? v : 11;

	}());

	$( function() {
		Global.styleSandbox();

		$.support.cors = true; // For IE
		cleanProgress();

		currentMousePos = {x: -1, y: -1};
		$( document ).mousemove( function( event ) {
			currentMousePos.x = event.pageX;
			currentMousePos.y = event.pageY;
		} );

		var api_authentication = new (APIFactory.getAPIClass( 'APIAuthentication' ))();

		//BUG-2065 see also: require.onError()
		window.onerror = function() {
			if ( !arguments || arguments.length < 1 ) {
				Global.sendErrorReport( 'No error parameters when window.onerror', ServiceCaller.rootURL, '', '', '' );
			} else {
				Global.sendErrorReport( arguments[0], arguments[1], arguments[2], arguments[3], arguments[4] );
			}

		};

		$( 'body' ).addClass( 'login-bg' );

		FastClick.attach( $( 'body' )[0] );
		//Load need API class

		$( document ).on( "keydown", function( e ) {
			if ( e.which === 8 && !$( e.target ).is( "input, textarea" ) ) {
				e.preventDefault();
			}
		} );

		$( 'body' ).unbind( 'keydown' ).bind( 'keydown', function( e ) {

			//Tab key must go to next search text field if a search text field is selected, otherwise, tab closes awesomebox.
			//This allows consistent ui experience between awesomebox and default form input controls.
			if ( e.keyCode === 27 || e.keyCode === 13 || ( e.keyCode === 9 && e.target.type != 'text' ) ) {
				if ( LocalCacheData.openAwesomeBox ) {
					LocalCacheData.openAwesomeBox.onClose();
				}

				if ( LocalCacheData.openAwesomeBoxColumnEditor ) {
					LocalCacheData.openAwesomeBoxColumnEditor.onClose();
				}
			}

			if ( LocalCacheData.openAwesomeBox ) {
				if ( Global.isValidInputCodes( e.keyCode ) ) {
					LocalCacheData.openAwesomeBox.selectNextItem( e );
				}
			} else if ( LocalCacheData.current_open_primary_controller &&
				LocalCacheData.current_open_primary_controller.column_selector &&
				LocalCacheData.current_open_primary_controller.column_selector.is( ':visible' ) &&
				LocalCacheData.current_open_primary_controller.column_selector.has( $( ':focus' ) ).length > 0 ) {
				if ( Global.isValidInputCodes( e.keyCode ) ) {
					LocalCacheData.current_open_primary_controller.column_selector.selectNextItem( e );
				}
			}

			if ( LocalCacheData.current_open_wizard_controller && e.keyCode === 13 ) {
				if ( LocalCacheData.current_open_wizard_controller.$el.hasClass( 'change-password-wizard' ) ) {
					!LocalCacheData.current_open_wizard_controller.done_btn.attr( "disabled" ) &&
					e.target &&
					e.target.type !== 'textarea' && LocalCacheData.current_open_wizard_controller.onDoneClick();
				}
			}

			if ( (e.keyCode === 65 && e.metaKey === true) || (e.keyCode === 65 && e.ctrlKey === true ) ) {
				e.preventDefault();
				selectAll();
			}

			if ( e.keyCode === 36 ) {
				gridScrollTop();
			}

			if ( e.keyCode === 35 ) {
				gridScrollDown();
			}

			// keyboard event to quick search permission adropdown
			if ( LocalCacheData.current_open_primary_controller &&
				LocalCacheData.current_open_primary_controller.viewId === 'PermissionControl' &&
				LocalCacheData.current_open_primary_controller.edit_view ) {
				LocalCacheData.current_open_primary_controller.onKeyDown( e );

			}

		} );

		$( 'body' ).unbind( 'click' ).click( function( e ) {

			var ui_clicked_date = new Date();
			var ui_stack = {
				target_class: $( e.target ).attr( 'class' ) ? $( e.target ).attr( 'class' ) : '',
				target_id: $( e.target ).attr( 'id' ) ? $( e.target ).attr( 'id' ) : '',
				html: e.target.outerHTML,
				ui_clicked_date: ui_clicked_date.toISOString(),
			};
			if ( LocalCacheData.ui_click_stack.length === 8 ) {
				LocalCacheData.ui_click_stack.pop();
			}

			LocalCacheData.ui_click_stack.unshift( ui_stack );

		} );

		$( 'body' ).unbind( 'mousedown' ).bind( 'mousedown', function( e ) {


			// MUST COLLECT DATA WHEN MOUSE down, otherwise when do save in edit view when awesomebox open, the data can't be saved.
			// Mouse down to collect data so for some actions like search can read select data in its click event
			if ( LocalCacheData.openAwesomeBox && LocalCacheData.openAwesomeBox.getADropDown().has( e.target ).length < 1 ) {
				if ( $( e.target ).hasClass( 'a-combobox' ) ) {
					var target = LocalCacheData.openAwesomeBox;
					$( e.target ).unbind( 'mouseup' ).bind( 'mouseup', function( e ) {
						target.find( '.focus-input' ).focus();
						$( e.target ).unbind( 'mouseup' );
					} );
				}
				LocalCacheData.openAwesomeBox.onClose();
			}

			if ( LocalCacheData.openRangerPicker && !LocalCacheData.openRangerPicker.getIsMouseOver() ) {
				LocalCacheData.openRangerPicker.close();
			}

			if ( LocalCacheData.openAwesomeBoxColumnEditor && !LocalCacheData.openAwesomeBoxColumnEditor.getIsMouseOver() ) {
				LocalCacheData.openAwesomeBoxColumnEditor.onClose();
			}

			if ( LocalCacheData.openRibbonNaviMenu && !LocalCacheData.openRibbonNaviMenu.getIsMouseOver() ) {
				LocalCacheData.openRibbonNaviMenu.close();
			}

		} );

		var cUrl = window.location.href;

		if ( $.cookie( 'js_debug' ) ) {
			var script = Global.loadScript( 'local_testing/LocalURL.js' );
			if ( script === true ) {
				cUrl = LocalURL.url();
			}

			need_load_pre_login_data = true;
		}

		cUrl = getRelatedURL( cUrl );

		ServiceCaller.baseUrl = cUrl + 'api/json/api.php';
		ServiceCaller.staticURL = ServiceCaller.baseUrl;
		ServiceCaller.orginalUrl = cUrl;
		ServiceCaller.rootURL = getRootURL( cUrl );

		var loginData = {};
		//Set in APIGlobal.php
		if ( !need_load_pre_login_data ) {
			loginData = APIGlobal.pre_login_data;
		} else {
			need_load_pre_login_data = false;
		}
		if ( !loginData.hasOwnProperty( 'api_base_url' ) ) {
			api_authentication.getPreLoginData( null, {
				onResult: function( e ) {

					var result = e.getResult();

					LocalCacheData.setLoginData( result );
					APIGlobal.pre_login_data = result;

					loginData = LocalCacheData.getLoginData();
					initApps();

				}
			} );
		} else {
			LocalCacheData.setLoginData( loginData ); //set here because the loginData is set from php
			initApps();
		}
		initAnalytics();

		function initAnalytics() {
			/* jshint ignore:start */
			if ( APIGlobal.pre_login_data.analytics_enabled === true ) {
				(function( i, s, o, g, r, a, m ) {
					i['GoogleAnalyticsObject'] = r;
					i[r] = i[r] || function() {
						(i[r].q = i[r].q || []).push( arguments );
					}, i[r].l = 1 * new Date();
					a = s.createElement( o ),
						m = s.getElementsByTagName( o )[0];
					a.async = 1;
					a.src = g;
					m.parentNode.insertBefore( a, m );
				})( window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga' );
				//ga('set', 'sendHitTask', null); //disables sending hit data to Google. uncoment when debugging GA.

				ga( 'create', APIGlobal.pre_login_data.analytics_tracking_code, 'auto' );

				//Do not check exitstance of LocalCacheData with if(LocalCacheData) or JS will execute the unnamed function it uses as a constructor
				if ( LocalCacheData.loginUser ) {
					var current_company = LocalCacheData.getCurrentCompany();
					Global.setAnalyticDimensions(LocalCacheData.getLoginUser().first_name + ' (' + LocalCacheData.getLoginUser().id + ')', current_company.name);
				} else {
					Global.setAnalyticDimensions();
				}
				ga('send', 'pageview', {'sessionControl': 'start'});
			}
			/* jshint ignore:end */
		}

		function initApps() {
			if ( ie <= 10 ) {
				TAlertManager.showBrowserTopBanner();
			}
			loadViewRequiredJS();
			//Optimization: Only change locale if its *not* en_US or enable_default_language_translation = TRUE
			if ( loginData.locale !== 'en_US' || loginData.enable_default_language_translation == true ) {
				Global.loadLanguage( loginData.locale );
				Debug.Text( 'Using Locale: ' + loginData.locale, 'main.js', '', 'initApps', 1 );
			} else {
				LocalCacheData.setI18nDic( {} );
			}
			$.i18n.load( LocalCacheData.getI18nDic() );
			Global.initStaticStrings();
			ServiceCaller.import_csv_emample = ServiceCaller.rootURL + loginData.base_url + 'html5/views/wizard/import_csv/';
			ServiceCaller.fileDownloadURL = ServiceCaller.rootURL + loginData.base_url + 'send_file.php';
			ServiceCaller.uploadURL = ServiceCaller.rootURL + loginData.base_url + 'upload_file.php';
			ServiceCaller.companyLogo = ServiceCaller.rootURL + loginData.base_url + 'send_file.php?api=1&object_type=company_logo';
			ServiceCaller.invoiceLogo = ServiceCaller.rootURL + loginData.base_url + 'send_file.php?api=1&object_type=invoice_config';
			ServiceCaller.userPhoto = ServiceCaller.rootURL + loginData.base_url + 'send_file.php?api=1&object_type=user_photo';
			ServiceCaller.mainCompanyLogo = ServiceCaller.rootURL + loginData.base_url + 'send_file.php?api=1&object_type=primary_company_logo';
			ServiceCaller.poweredByLogo = ServiceCaller.rootURL + loginData.base_url + 'send_file.php?api=1&object_type=smcopyright';
			ServiceCaller.login_page_powered_by_logo = ServiceCaller.rootURL + loginData.base_url + 'send_file.php?api=1&object_type=copyright';
			LocalCacheData.appType = loginData.deployment_on_demand;
			LocalCacheData.productEditionId = loginData.product_edition;
			var controller = new IndexViewController();

			var alternate_session_data = $.cookie( 'AlternateSessionData' );
			if ( alternate_session_data ) {
				alternate_session_data = JSON.parse( alternate_session_data )
				if ( alternate_session_data.previous_session_id ) {
					TAlertManager.showPreSessionAlert();
				}
			}
		}

		function gridScrollDown() {
			if ( LocalCacheData.openAwesomeBox &&
				_.isFunction( LocalCacheData.openAwesomeBox.gridScrollDown ) ) {
				LocalCacheData.openAwesomeBox.gridScrollDown();
				return;
			}

			if ( LocalCacheData.current_open_sub_controller ) {
				if ( !LocalCacheData.current_open_sub_controller.edit_view &&
					_.isFunction( LocalCacheData.current_open_sub_controller.gridScrollDown ) ) {
					LocalCacheData.current_open_sub_controller.gridScrollDown();
				}
				return;
			}
			if ( LocalCacheData.current_open_primary_controller ) {
				if ( !LocalCacheData.current_open_primary_controller.edit_view &&
					_.isFunction( LocalCacheData.current_open_primary_controller.gridScrollDown ) ) {
					LocalCacheData.current_open_primary_controller.gridScrollDown();
				}
				return;
			}
		}

		function gridScrollTop() {
			if ( LocalCacheData.openAwesomeBox &&
				_.isFunction( LocalCacheData.openAwesomeBox.gridScrollTop ) ) {
				LocalCacheData.openAwesomeBox.gridScrollTop();
				return;
			}
			if ( LocalCacheData.current_open_sub_controller ) {
				if ( !LocalCacheData.current_open_sub_controller.edit_view &&
					_.isFunction( LocalCacheData.current_open_sub_controller.gridScrollTop ) ) {
					LocalCacheData.current_open_sub_controller.gridScrollTop();
				}
				return;
			}
			//Error: Uncaught TypeError: LocalCacheData.current_open_primary_controller.gridScrollTop is not a function in interface/html5/main.js?v=9.0.2-20151106-092147 line 434
			if ( LocalCacheData.current_open_primary_controller ) {
				if ( !LocalCacheData.current_open_primary_controller.edit_view &&
					_.isFunction( LocalCacheData.current_open_primary_controller.gridScrollTop ) ) {
					LocalCacheData.current_open_primary_controller.gridScrollTop();
				}
				return;
			}
		}

		function selectAll() {

			//Error: Uncaught TypeError: LocalCacheData.current_open_primary_controller.selectAll is not a function in interface/html5/main.js?v=9.0.4-20151123-121757 line 457
			if ( LocalCacheData.openAwesomeBox &&
				_.isFunction( LocalCacheData.openAwesomeBox.selectAll ) ) {
				LocalCacheData.openAwesomeBox.selectAll();
				return;
			}

			if ( LocalCacheData.current_open_sub_controller ) {

				if ( !LocalCacheData.current_open_sub_controller.edit_view &&
					_.isFunction( LocalCacheData.current_open_sub_controller.selectAll ) ) {
					LocalCacheData.current_open_sub_controller.selectAll();
				}

				return;
			}

			if ( LocalCacheData.current_open_primary_controller ) {
				if ( !LocalCacheData.current_open_primary_controller.edit_view &&
					_.isFunction( LocalCacheData.current_open_primary_controller.selectAll ) ) {
					LocalCacheData.current_open_primary_controller.selectAll();
				}
				return;
			}
		};

	} );


	function loadViewRequiredJS() {
		LocalCacheData.loadViewRequiredJSReady = false;

		var require_array = [
			'backbone',
			'Global',
			'nanobar', //only in timesheet
			'jquery_json',
			'stacktrace',
			'html2canvas',
			'datejs',
			'jquery.sortable',
			'jquery.ui.position',
			'rightclickmenu',
			'html2canvas',
			'datejs',
			'jquery_tablednd',
			'TTagInput',
			'timepicker_addon',
			'TDatePicker',
			'TTimePicker',
			'TRangePicker',
			'TTextArea',
			'InsideEditor',
			'ErrorTipBox',
			'TFeedback',
			'TText',
			'TList',
			'TToggleButton',
			'SwitchButton',
			'TCheckbox',
			'ViewMinTabBar',
			'TopNotification',
			'RibbonMenu',
			'RibbonSubMenu',
			'RibbonSubMenuGroup',
			'RibbonSubMenuNavItem',
			'RibbonSubMenuNavWidget',
			'SearchPanel',
			'grid_locale',
			'jqGrid_extend',
			'ImageAreaSelect',
			'qtip',
			'SearchField',
			'PermissionManager',
			'TopMenuManager',
			'TGridHeader',
			'ADropDown',
			'AComboBox',
			'ASearchInput',
			'ALayoutCache',
			'ALayoutIDs',
			'ColumnEditor',
			'SaveAndContinueBox',
			'NoHierarchyBox',
			'NoResultBox',
			'SeparatedBox',
			'BaseWizardController',
			'UserGenericStatusWindowController',
			'ReportBaseViewController',
			'Paging2',
			'jquery-ui',

			//API's required to loads views. This is a preemtive move before removing loadScript() from Global
			'APILog',
			'APINotification',
			'APIPermissionControl',
			'APIUserGenericData',
			'APIMisc',
			'APIOtherField',
			'APIDate',
			'APIUser',
			'APICompany',
			'AuthorizationHistoryCommon',
			'RequestViewCommonController',
			'EmbeddedMessageCommon',

		];

		//do not load interact on mobile.
		if ( Global.detectMobileBrowser() == true ) {
			require_array.splice( require_array.indexOf('interact'), 1);
			require(require_array, function (Backbone, Global, Nanobar) {
				window.Nanobar = Nanobar;
				LocalCacheData.loadViewRequiredJSReady = true;
			})
		} else {
			require(require_array, function (Backbone, Global, Nanobar, interact) {
				window.interact = interact;
				window.Nanobar = Nanobar;
				LocalCacheData.loadViewRequiredJSReady = true;
			})
		}
	}

	function stripDuplicateSlashes( url ) {
		return url.replace( /([^:]\/)\/+/g, '$1' )
	}

	function getRelatedURL( url ) {
		url = stripDuplicateSlashes( url );
		var a = url.split( '/' ); //Strip duplicate slashes

		var targetIndex = (a.length - 3);
		var newUrl = '';
		for ( var i = 0; i < targetIndex; i++ ) {
			if ( i !== 1 ) {
				newUrl = newUrl + a[i] + '/';
			} else {
				newUrl = newUrl + '/';
			}

		}

		return newUrl;
	}

	function getRootURL( url ) {
		url = stripDuplicateSlashes( url );
		var a = url.split( '/' );
		var targetIndex = 3;
		var newUrl = '';
		for ( var i = 0; i < targetIndex; i++ ) {
			if ( i !== 1 && i < 2 ) {
				newUrl = newUrl + a[i] + '/';
			} else if ( i === 1 ) {
				newUrl = newUrl + '/';
			} else if ( i === 2 ) {
				newUrl = newUrl + a[i];
			}

		}

		return newUrl;
	}

} );

/**
 * FIXES: BUG-2065 "Uncaught Error: Script error for ..."
 *
 * REASON FOR BUG: The internet going out momentarily
 * 	after the initial scripts have loaded and have begun
 * 	loading the chain of javascript-loaded scripts causes
 * 	requirejs to throw the Script Errors because it's unable
 * 	to reach the files it's being told to load.
 *
 * TO REPRODUCE: in chrome, throttle the internet down then
 * 	turn off the internet once the reload button shows on
 * 	the login screen (and the stop button hides). This ensures
 * 	that requirejs has been loaded and is loading other scripts.
 */
require.onError = function( err ) {
	console.error(err);
	if ( err.message.indexOf( 'Script error for' ) != -1 ) {
		if ( require.script_error_shown == undefined ) {
			require.script_error_shown = 1;
			//There is no pretty errorbox at this time. You may only have basic javascript.
			if ( confirm( "Unable to download required data. Your internet connection may have failed press Ok to reload." ) ) {
				//For testing, so that there's time to turn internet back on after confirm is clicked.
				//window.setTimeout(function() {window.location.reload()},5000);
				window.location.reload();
			}
		}
		console.debug( err.message );
		//Stop error from bubbling up.
		delete err;
	}
};