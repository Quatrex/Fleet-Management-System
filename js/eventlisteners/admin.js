//Fields
const employeeCard_Fields = ['FirstName', 'LastName', 'Designation', 'Email'];
const driverCard_Fields = ['driverId', , 'firstName', 'assignedVehicleId'];

const employeeStore = new Store('employees','empID');
const driverStore = new Store('drivers','driverId',);

//Add a employee
const EmployeeAddFormClose = new DisplayNextButton('EmployeeAddForm_Close');
const EmployeeAddFormConfirm = new DisplayNextButton('EmployeeAddForm_Confirm', {}, [
	ObjectCreate,
	BackendAccess('AddEmployee', ActionCreator([employeeStore], 'ADD')),
]);
const EmployeeAddFormPopup = new Popup('EmployeeAddForm', [EmployeeAddFormClose, EmployeeAddFormConfirm]);

//Employee Profile Form
const EmployeeProfileEditFormClose = new DisplayNextButton('EmployeeProfileEditForm_Close');
const EmployeeProfileEditFormCancel = new DisplayNextButton('EmployeeProfileEditForm_Cancel');
const EmployeeProfileEditFormConfirm = new DisplayNextButton(
	'EmployeeProfileEditForm_Confirm',
	{},
	[ObjectCreate, BackendAccess('UpdateEmployee', ActionCreator([employeeStore], 'UPDATE'))],
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
const DeleteEmployeeAlertDelete = new DisplayNextButton('DeleteEmployeeAlert_Delete', {}, [
	BackendAccess('DeleteEmployee', ActionCreator([employeeStore], 'DELETE')),RemoveAllPopup
]);
const DeleteEmployeeAlertPopup = new Popup('DeleteEmployeeAlertPopup', [
	DeleteEmployeeAlertCancel,
	DeleteEmployeeAlertClose,
	DeleteEmployeeAlertDelete,
]);

//Employee Profile Form
const EmployeeProfileFormClose = new DisplayNextButton('EmployeeProfileForm_Close');
const EmployeeProfileFormEdit = new DisplayNextButton('EmployeeProfileForm_Edit', EmployeeProfileEditFormPopup);
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
const DriverAddFormConfirm = new DisplayNextButton('DriverAddForm_Confirm', [
	ObjectCreate,
	BackendAccess('AddDriver', ActionCreator([driverStore], 'ADD')),
]);
const DriverAddFormPopup = new Popup('DriverAddForm', [DriverAddFormClose, DriverAddFormConfirm]);

//Driver Delete Confirm
const DeleteDriverAlertClose = new DisplayNextButton('DeleteDriverAlert_Close');
const DeleteDriverAlertCancel = new DisplayNextButton('DeleteDriverAlert_Cancel');
const DeleteDriverAlertDelete = new DisplayNextButton('DeleteDriverAlert_Delete',{},[
	BackendAccess('DeleteDriver', ActionCreator([driverStore], 'DELETE')),
	RemoveAllPopup,
]);
const DeleteDriverAlertPopup = new Popup('DeleteDriverAlertPopup', [
	DeleteDriverAlertCancel,
	DeleteDriverAlertClose,
	DeleteDriverAlertDelete,
]);

//Driver Assign Profile Form
const DriverProfileEditFormClose = new DisplayNextButton('DriverProfileEditForm_Close');
const DriverProfileEditFormCancel = new DisplayNextButton('DriverProfileEditForm_Cancel');
const DriverProfileEditFormConfirm = new DisplayNextButton(
	'DriverProfileEditForm_Confirm',
	{},
	[ObjectCreate, BackendAccess('UpdateDriver', ActionCreator([driverStore], 'UPDATE'))],
	{ disabled: 'true' }
);
const DriverProfileEditFormPopup = new Popup(
	'DriverProfileEditForm',
	[DriverProfileEditFormCancel, DriverProfileEditFormClose, DriverProfileEditFormConfirm],
	['click', 'keyup']
);
DriverProfileEditFormPopup.setDataType('value');

//Driver Profile Form
const DriverProfileFormClose = new DisplayNextButton('DriverProfileForm_Close');
const DriverProfileFormEdit = new DisplayNextButton('DriverProfileForm_Edit',DriverProfileEditFormPopup);
const DriverProfileFormDelete = new DisplayAlertButton('DriverProfileForm_Delete', DeleteDriverAlertPopup);
const DriverProfileFormPopup = new Popup('DriverProfileForm', [
	DriverProfileFormEdit,
	DriverProfileFormClose,
	DriverProfileFormDelete,
]);
DriverProfileFormPopup.setDataType('value');
DriverProfileEditFormCancel.setNext(DriverProfileFormPopup);

const AddEmployeeButton = new DOMButton('AddEmployeeButton', EmployeeAddFormPopup);
const AddDriverButton = new DOMButton('AddDriverButton', DriverAddFormPopup);
const employeeContainer = new DOMContainer(
	'employeeContainer',
	employeeCard_Fields,
	EmployeeProfileFormPopup,
	employeeStore,
	'employeeCardTemplate',
);
const driverContainer = new DOMContainer(
	'driverContainer',
	driverCard_Fields,
	DriverProfileFormPopup,
	driverStore,
	'driverCardTemplate',
);


const driverTab = new DOMTabContainer('DriverSecTab',driverContainer);
const employeeTab = new DOMTabContainer('EmployeeSecTab',employeeContainer);

const driverTabButton = new SecondaryTabButton('DriverSecLink',driverTab);
const employeeTabButton = new SecondaryTabButton('EmployeeSecLink',employeeTab);

const adminTab = new SecondaryTab('AdminSecTab',[driverTabButton,employeeTabButton],employeeTabButton)
adminTab.render();

employeeStore.addObservers(employeeContainer);
driverStore.addObservers(driverContainer);
