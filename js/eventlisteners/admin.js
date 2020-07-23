//Add a employee
const EmployeeAddFormClose = new DisplayNextButton('EmployeeAddForm_Close');
const EmployeeAddFormConfirm = new DisplayNextButton('EmployeeAddForm_Confirm',{},[ObjectCreate,BackendAccess('AddEmployee')]);
const EmployeeAddFormPopup = new Popup('EmployeeAddForm',[EmployeeAddFormClose,EmployeeAddFormConfirm]);

//Employee Profile Form
const EmployeeProfileEditFormClose = new DisplayNextButton('EmployeeProfileEditForm_Close')
const EmployeeProfileEditFormCancel = new DisplayNextButton('EmployeeProfileEditForm_Cancel')
const EmployeeProfileEditFormConfirm = new DisplayNextButton('EmployeeProfileEditForm_Confirm',{},[ObjectCreate,BackendAccess('UpdateEmployee')],{disabled:"true"});
const EmployeeProfileEditFormPopup = new Popup('EmployeeProfileEditForm',[EmployeeProfileEditFormCancel,EmployeeProfileEditFormClose,EmployeeProfileEditFormConfirm],['click','keyup']);
EmployeeProfileEditFormPopup.setDataType('value')

//Employee Delete Confirm
const DeleteEmployeeAlertClose = new DisplayNextButton('DeleteEmployeeAlert_Close')
const DeleteEmployeeAlertCancel = new DisplayNextButton('DeleteEmployeeAlert_Cancel')
const DeleteEmployeeAlertDelete = new DisplayNextButton('DeleteEmployeeAlert_Delete',{},[BackendAccess('DeleteEmployee')]);
const DeleteEmployeeAlertPopup = new Popup('DeleteEmployeeAlertPopup',[DeleteEmployeeAlertCancel,DeleteEmployeeAlertClose,DeleteEmployeeAlertDelete]);

//Employee Profile Form
const EmployeeProfileFormClose = new DisplayNextButton('EmployeeProfileForm_Close')
const EmployeeProfileFormEdit = new DisplayNextButton('EmployeeProfileForm_Edit',EmployeeProfileEditFormPopup)
const EmployeeProfileFormDelete = new DisplayAlertButton('EmployeeProfileForm_Delete',DeleteEmployeeAlertPopup)
const EmployeeProfileFormPopup = new Popup('EmployeeProfileForm',[EmployeeProfileFormEdit,EmployeeProfileFormClose,EmployeeProfileFormDelete]);
EmployeeProfileFormPopup.setDataType('value');
EmployeeProfileEditFormCancel.setNext(EmployeeProfileFormPopup);

//Add a employee
const DriverAddFormClose = new DisplayNextButton('DriverAddForm_Close')
const DriverAddFormConfirm = new DisplayNextButton('DriverAddForm_Confirm',[ObjectCreate,BackendAccess('AddDriver')]);
const DriverAddFormPopup = new Popup('DriverAddForm',[DriverAddFormClose,DriverAddFormConfirm]);

//Driver Delete Confirm
const DeleteDriverAlertClose = new DisplayNextButton('DeleteDriverAlert_Close')
const DeleteDriverAlertCancel = new DisplayNextButton('DeleteDriverAlert_Cancel')
const DeleteDriverAlertDelete = new DisplayNextButton('DeleteDriverAlert_Delete',[BackendAccess('DeleteDriver'),RemoveAllPopup]);
const DeleteDriverAlertPopup = new Popup('DeleteDriverAlert',[DeleteDriverAlertCancel,DeleteDriverAlertClose,DeleteDriverAlertDelete]);

//Driver Assign Profile Form
const DriverProfileEditFormClose = new DisplayNextButton('DriverProfileEditForm_Close')
const DriverProfileEditFormCancel = new DisplayNextButton('DriverProfileEditForm_Cancel')
const DriverProfileEditFormConfirm = new DisplayNextButton('DriverProfileEditForm_Confirm',{},[ObjectCreate,BackendAccess('UpdateDriver')],{disabled:"true"});
const DriverProfileEditFormPopup = new Popup('DriverProfileEditForm',[DriverProfileEditFormCancel,DriverProfileEditFormClose,DriverProfileEditFormConfirm],['click','keyup']);

//Driver Profile Form
const DriverProfileFormClose = new DisplayNextButton('DriverProfileForm_Close')
const DriverProfileFormEdit = new DisplayNextButton('DriverProfileForm_Edit')
const DriverProfileFormDelete = new DisplayAlertButton('DriverProfileForm_Delete',DeleteDriverAlertPopup)
const DriverProfileFormPopup = new Popup('DriverProfileForm',[DriverProfileFormEdit,DriverProfileFormClose,DriverProfileFormDelete]);
DriverProfileFormPopup.setDataType('value')
DriverProfileEditFormCancel.setNext(DriverProfileFormPopup);

const employeeTable = new Table('employeeTable',["FirstName","Designation","Email"],EmployeeProfileFormPopup,'employees','empID')
const driverTable = new Table('driverTable',["driverId",,"firstName","assignedVehicleId"],DriverProfileFormPopup,'drivers','driverId')

const AddEmployeeButton = new DOMButton('AddEmployeeButton',EmployeeAddFormPopup)
const AddDriverButton = new DOMButton('AddDriverButton',DriverAddFormPopup)
