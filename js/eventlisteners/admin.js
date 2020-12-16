const networkManager = new NetworkManager();
const employeeStore = new Store('employees', networkManager, 'empID', 'FirstName');
const driverStore = new Store('drivers', networkManager, 'DriverID', 'FirstName');
const UserStore = new User();

//Add a employee
const EmployeeAddFormClose = new DisplayNextButton('EmployeeAddForm_Close');
const EmployeeAddFormConfirm = new BackendAcessButton(
	'EmployeeAddForm_Confirm',
	'AddEmployee',
	[ObjectCreate, FormValidate],
	ActionCreator([employeeStore], 'ADD'),
	'PHOTO'
);
const EmployeeAddFormPopup = new Popup('EmployeeAddForm', [EmployeeAddFormClose, EmployeeAddFormConfirm]);

//Employee Profile Form
const EmployeeProfileEditFormClose = new DisplayNextButton('EmployeeProfileEditForm_Close');
const EmployeeProfileEditFormCancel = new DisplayNextButton('EmployeeProfileEditForm_Cancel');
const EmployeeProfileEditFormConfirm = new BackendAcessButton(
	'EmployeeProfileEditForm_Confirm',
	'UpdateEmployee',
	[ObjectCreate, FormValidate],
	ActionCreator([employeeStore], 'UPDATE'),
	'DEFAULT',
	{ disabled: 'true' }
);
const EmployeeProfileEditFormPopup = new Popup(
	'EmployeeProfileEditForm',
	[EmployeeProfileEditFormCancel, EmployeeProfileEditFormClose, EmployeeProfileEditFormConfirm],
	['click', 'keyup']
);
EmployeeProfileEditFormPopup.setDataType('value');

//Employee Delete Confirm
const DeleteEmployeeAlertClose = new DisplayNextButton('DeleteEmployeeAlert_Close');
const DeleteEmployeeAlertCancel = new DisplayNextButton('DeleteEmployeeAlert_Cancel');
const DeleteEmployeeAlertDelete = new BackendAcessButton(
	'DeleteEmployeeAlert_Delete',
	'DeleteEmployee',
	[],
	ActionCreator([employeeStore], 'DELETE')
);
const DeleteEmployeeAlertPopup = new Popup('DeleteEmployeeAlertPopup', [
	DeleteEmployeeAlertCancel,
	DeleteEmployeeAlertClose,
	DeleteEmployeeAlertDelete,
]);

//Employee Profile Form
const EmployeeProfileFormClose = new DisplayNextButton('EmployeeProfileForm_Close');
const EmployeeProfileFormEdit = new DisplayNextButton('EmployeeProfileForm_Edit', EmployeeProfileEditFormPopup, [
	ObjectCreate,
]);
const EmployeeProfileFormDelete = new DisplayAlertButton('EmployeeProfileForm_Delete', DeleteEmployeeAlertPopup);
const EmployeeProfileFormPopup = new Popup('EmployeeProfileForm', [
	EmployeeProfileFormEdit,
	EmployeeProfileFormClose,
	EmployeeProfileFormDelete,
]);
EmployeeProfileFormPopup.setDataType('value');
EmployeeProfileEditFormCancel.setNext(EmployeeProfileFormPopup);

//Add a employee
const DriverAddFormClose = new DisplayNextButton('DriverAddForm_Close');
const DriverAddFormConfirm = new BackendAcessButton(
	'DriverAddForm_Confirm',
	'AddDriver',
	[ObjectCreate, FormValidate],
	ActionCreator([driverStore], 'ADD'),
	'PHOTO'
);
const DriverAddFormPopup = new Popup('DriverAddForm', [DriverAddFormClose, DriverAddFormConfirm]);

//Driver Delete Confirm
const DeleteDriverAlertClose = new DisplayNextButton('DeleteDriverAlert_Close');
const DeleteDriverAlertCancel = new DisplayNextButton('DeleteDriverAlert_Cancel');
const DeleteDriverAlertDelete = new BackendAcessButton(
	'DeleteDriverAlert_Delete',
	'DeleteDriver',
	[],
	ActionCreator([driverStore], 'DELETE')
);
const DeleteDriverAlertPopup = new Popup('DeleteDriverAlertPopup', [
	DeleteDriverAlertCancel,
	DeleteDriverAlertClose,
	DeleteDriverAlertDelete,
]);

//Driver Assign Profile Form
const DriverProfileEditFormClose = new DisplayNextButton('DriverProfileEditForm_Close');
const DriverProfileEditFormCancel = new DisplayNextButton('DriverProfileEditForm_Cancel');
const DriverProfileEditFormConfirm = new BackendAcessButton(
	'DriverProfileEditForm_Confirm',
	'UpdateDriver',
	[ObjectCreate, FormValidate],
	ActionCreator([driverStore], 'UPDATE'),
	'PHOTO',
	{ disabled: 'true' }
);
const DriverProfileEditFormPopup = new Popup(
	'DriverProfileEditForm',
	[DriverProfileEditFormCancel, DriverProfileEditFormClose, DriverProfileEditFormConfirm],
	['click', 'keyup', 'change']
);
DriverProfileEditFormPopup.setDataType('value');

//Driver Profile Form
const DriverProfileFormClose = new DisplayNextButton('DriverProfileForm_Close');
const DriverProfileFormEdit = new DisplayNextButton('DriverProfileForm_Edit', DriverProfileEditFormPopup, [
	ObjectCreate,
]);
const DriverProfileFormDelete = new DisplayAlertButton('DriverProfileForm_Delete', DeleteDriverAlertPopup);
const DriverProfileFormPopup = new Popup('DriverProfileForm', [
	DriverProfileFormEdit,
	DriverProfileFormClose,
	DriverProfileFormDelete,
]);
DriverProfileFormPopup.setDataType('value');
DriverProfileEditFormCancel.setNext(DriverProfileFormPopup);

const ChangeProfilePicturePopupClose = new DisplayNextButton('ChangeProfilePictureForm_Close');
const ChangeProfilePicturePopupCancel = new DisplayNextButton('ChangeProfilePictureForm_Cancel');
const ChangeProfilePicturePopupSubmit = new BackendAcessButton(
	'ChangeProfilePictureForm_Submit',
	'ChangeProfilePicture',
	[ObjectCreate],
	ActionCreator([UserStore], 'UPDATE'),
	'PHOTO'
);
const ChangeProfilePicturePopup = new Popup('ChangeProfilePictureForm', [
	ChangeProfilePicturePopupClose,
	ChangeProfilePicturePopupCancel,
	ChangeProfilePicturePopupSubmit,
]);

const ChangePasswordPopupClose = new DisplayNextButton('ChangePasswordForm_Close');
const ChangePasswordPopupCancel = new DisplayNextButton('ChangePasswordForm_Cancel');
const ChangePasswordPopupSubmit = new BackendAcessButton('ChangePasswordForm_Submit', 'ChangePassword', [
	ObjectCreate,
	FormValidate,
]);
const ChangePasswordPopup = new Popup('ChangePasswordForm', [
	ChangePasswordPopupClose,
	ChangePasswordPopupCancel,
	ChangePasswordPopupSubmit,
]);

const UserProfilePopupClose = new DisplayNextButton('UserProfilePopup_Close');
const UserProfilePictureChange = new DisplayNextButton('ChangeProfilePictureButton', ChangeProfilePicturePopup);
const UserPasswordChange = new DisplayNextButton('UserPasswordChange', ChangePasswordPopup);
const UserProfilePopup = new Popup('UserProfilePopup', [
	UserProfilePopupClose,
	UserProfilePictureChange,
	UserPasswordChange,
]);
ChangeProfilePicturePopupClose.setNext(UserProfilePopup);
ChangeProfilePicturePopupCancel.setNext(UserProfilePopup);
ChangeProfilePicturePopupSubmit.setNext(UserProfilePopup);

const UserProfileEditButton = new DOMButton('UserProfileEditButton', UserProfilePopup);
const AddEmployeeButton = new DOMButton('AddEmployeeButton', EmployeeAddFormPopup);
const AddDriverButton = new DOMButton('AddDriverButton', DriverAddFormPopup);
const employeeContainer = new DOMContainer(
	'employeeContainer',
	EmployeeProfileFormPopup,
	employeeStore,
	'employeeCardTemplate'
);

const driverContainer = new DOMContainer('driverContainer', DriverProfileFormPopup, driverStore, 'driverCardTemplate');

const driverTab = new DOMTabContainer('DriversSecTab', driverContainer);
const employeeTab = new DOMTabContainer('EmployeesSecTab', employeeContainer);

const driverTabButton = new SecondaryTabButton('DriversSecLink', driverTab);
const employeeTabButton = new SecondaryTabButton('EmployeesSecLink', employeeTab);

const adminTab = new SecondaryTab('AdminSecTab', [driverTabButton, employeeTabButton], employeeTabButton);
adminTab.render();

employeeStore.addObservers(employeeContainer);
driverStore.addObservers(driverContainer);

var readURL = function (input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$(`#${input.dataset.imageid}`).attr('src', e.target.result);
		};
		console.log(`#${input.dataset.imageid}`);
		reader.readAsDataURL(input.files[0]);
	}
};

$('.file-upload').on('change', function () {
	readURL(this);
});

$('.upload-button').on('click', function () {
	$('.file-upload').click();
});
