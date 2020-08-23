"use strict";

var employeeStore = new Store('employees', 'empID', 'EmployeeID');
var driverStore = new Store('drivers', 'DriverID', 'DriverID'); //Add a employee

var EmployeeAddFormClose = new DisplayNextButton('EmployeeAddForm_Close');
var EmployeeAddFormConfirm = new ValidatorButton('EmployeeAddForm_Confirm', {}, [ObjectCreate, FormValidate, BackendAccess('AddEmployee', ActionCreator([employeeStore], 'ADD'))]);
var EmployeeAddFormPopup = new Popup('EmployeeAddForm', [EmployeeAddFormClose, EmployeeAddFormConfirm]); //Employee Profile Form

var EmployeeProfileEditFormClose = new DisplayNextButton('EmployeeProfileEditForm_Close');
var EmployeeProfileEditFormCancel = new DisplayNextButton('EmployeeProfileEditForm_Cancel');
var EmployeeProfileEditFormConfirm = new ValidatorButton('EmployeeProfileEditForm_Confirm', {}, [ObjectCreate, FormValidate, BackendAccess('UpdateEmployee', ActionCreator([employeeStore], 'UPDATE'))], {
  disabled: 'true'
});
var EmployeeProfileEditFormPopup = new Popup('EmployeeProfileEditForm', [EmployeeProfileEditFormCancel, EmployeeProfileEditFormClose, EmployeeProfileEditFormConfirm], ['click', 'keyup']);
EmployeeProfileEditFormPopup.setDataType('value'); //Employee Delete Confirm

var DeleteEmployeeAlertClose = new DisplayNextButton('DeleteEmployeeAlert_Close');
var DeleteEmployeeAlertCancel = new DisplayNextButton('DeleteEmployeeAlert_Cancel');
var DeleteEmployeeAlertDelete = new DisplayNextButton('DeleteEmployeeAlert_Delete', {}, [BackendAccess('DeleteEmployee', ActionCreator([employeeStore], 'DELETE')), RemoveAllPopup]);
var DeleteEmployeeAlertPopup = new Popup('DeleteEmployeeAlertPopup', [DeleteEmployeeAlertCancel, DeleteEmployeeAlertClose, DeleteEmployeeAlertDelete]); //Employee Profile Form

var EmployeeProfileFormClose = new DisplayNextButton('EmployeeProfileForm_Close');
var EmployeeProfileFormEdit = new DisplayNextButton('EmployeeProfileForm_Edit', EmployeeProfileEditFormPopup);
var EmployeeProfileFormDelete = new DisplayAlertButton('EmployeeProfileForm_Delete', DeleteEmployeeAlertPopup);
var EmployeeProfileFormPopup = new Popup('EmployeeProfileForm', [EmployeeProfileFormEdit, EmployeeProfileFormClose, EmployeeProfileFormDelete]);
EmployeeProfileFormPopup.setDataType('value');
EmployeeProfileEditFormCancel.setNext(EmployeeProfileFormPopup); //Add a employee

var DriverAddFormClose = new DisplayNextButton('DriverAddForm_Close');
var DriverAddFormConfirm = new ValidatorButton('DriverAddForm_Confirm', {}, [ObjectCreate, FormValidate, BackendAccess('AddDriver', ActionCreator([driverStore], 'ADD'))]);
var DriverAddFormPopup = new Popup('DriverAddForm', [DriverAddFormClose, DriverAddFormConfirm]); //Driver Delete Confirm

var DeleteDriverAlertClose = new DisplayNextButton('DeleteDriverAlert_Close');
var DeleteDriverAlertCancel = new DisplayNextButton('DeleteDriverAlert_Cancel');
var DeleteDriverAlertDelete = new DisplayNextButton('DeleteDriverAlert_Delete', {}, [BackendAccess('DeleteDriver', ActionCreator([driverStore], 'DELETE')), RemoveAllPopup]);
var DeleteDriverAlertPopup = new Popup('DeleteDriverAlertPopup', [DeleteDriverAlertCancel, DeleteDriverAlertClose, DeleteDriverAlertDelete]); //Driver Assign Profile Form

var DriverProfileEditFormClose = new DisplayNextButton('DriverProfileEditForm_Close');
var DriverProfileEditFormCancel = new DisplayNextButton('DriverProfileEditForm_Cancel');
var DriverProfileEditFormConfirm = new ValidatorButton('DriverProfileEditForm_Confirm', {}, [ObjectCreate, FormValidate, BackendAccessWithPicture('UpdateDriver', ActionCreator([driverStore], 'UPDATE'))], {
  disabled: 'true'
});
var DriverProfileEditFormPopup = new Popup('DriverProfileEditForm', [DriverProfileEditFormCancel, DriverProfileEditFormClose, DriverProfileEditFormConfirm], ['click', 'keyup', 'change']);
DriverProfileEditFormPopup.setDataType('value'); //Driver Profile Form

var DriverProfileFormClose = new DisplayNextButton('DriverProfileForm_Close');
var DriverProfileFormEdit = new DisplayNextButton('DriverProfileForm_Edit', DriverProfileEditFormPopup);
var DriverProfileFormDelete = new DisplayAlertButton('DriverProfileForm_Delete', DeleteDriverAlertPopup);
var DriverProfileFormPopup = new Popup('DriverProfileForm', [DriverProfileFormEdit, DriverProfileFormClose, DriverProfileFormDelete]);
DriverProfileFormPopup.setDataType('value');
DriverProfileEditFormCancel.setNext(DriverProfileFormPopup);
var AddEmployeeButton = new DOMButton('AddEmployeeButton', EmployeeAddFormPopup);
var AddDriverButton = new DOMButton('AddDriverButton', DriverAddFormPopup);
var employeeContainer = new DOMContainer('employeeContainer', EmployeeProfileFormPopup, employeeStore, 'employeeCardTemplate');
var driverContainer = new DOMContainer('driverContainer', DriverProfileFormPopup, driverStore, 'driverCardTemplate');
var driverTab = new DOMTabContainer('DriversSecTab', driverContainer);
var employeeTab = new DOMTabContainer('EmployeesSecTab', employeeContainer);
var driverTabButton = new SecondaryTabButton('DriversSecLink', driverTab);
var employeeTabButton = new SecondaryTabButton('EmployeesSecLink', employeeTab);
var adminTab = new SecondaryTab('AdminSecTab', [driverTabButton, employeeTabButton], employeeTabButton);
adminTab.render();
employeeStore.addObservers(employeeContainer);
driverStore.addObservers(driverContainer);

var readURL = function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $("#".concat(input.dataset.imageid)).attr('src', e.target.result);
    };

    console.log("#".concat(input.dataset.imageid));
    reader.readAsDataURL(input.files[0]);
  }
};

$('.file-upload').on('change', function () {
  readURL(this);
});
$('.upload-button').on('click', function () {
  $('.file-upload').click();
});