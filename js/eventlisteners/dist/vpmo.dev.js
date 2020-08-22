"use strict";

var requestsToAssignStore = new Store('requestsToAssign');
var ongoingTripStore = new Store('scheduledRequests');
var scheduledRequestsStore = new Store('scheduledHistoryRequests');
var vehicleStore = new Store('vehicles', 'RegistrationNo', 'RegistrationNo');
var driverStore = new Store('drivers', 'DriverID', 'DriverID'); //Add a vehicle

var VehicleAddFormClose = new DisplayNextButton('VehicleAddForm_Close');
var VehicleAddFormSubmit = new ValidatorButton('VehicleAddForm_Submit', {}, [ObjectCreate, FormValidate, BackendAccess('AddVehicle', ActionCreator([vehicleStore], 'ADD'))]);
var VehicleAddFormPopup = new Popup('VehicleAddForm', [VehicleAddFormClose, VehicleAddFormSubmit]); //Vehicle Delete Confirm

var DeleteVehicleAlertClose = new DisplayNextButton('DeleteVehicleAlert_Close');
var DeleteVehicleAlertCancel = new DisplayNextButton('DeleteVehicleAlert_Cancel');
var DeleteVehicleAlertDelete = new DisplayNextButton('DeleteVehicleAlert_Delete', {}, [BackendAccess('DeleteVehicle', ActionCreator([vehicleStore], 'DELETE')), RemoveAllPopup]);
var DeleteVehicleAlertPopup = new Popup('DeleteVehicleAlertPopup', [DeleteVehicleAlertCancel, DeleteVehicleAlertClose, DeleteVehicleAlertDelete]); //Vehicle Edit Profile Form

var VehicleProfileEditFormClose = new DisplayAlertButton('VehicleProfileEditForm_Close', CancelRequestAlertPopup);
var VehicleProfileEditFormCancel = new DisplayNextButton('VehicleProfileEditForm_Cancel');
var VehicleProfileEditFormConfirm = new ValidatorButton('VehicleProfileEditForm_Confirm', {}, [ObjectCreate, FormValidate, BackendAccessWithPicture('UpdateVehicle', ActionCreator([vehicleStore], 'UPDATE'))], {
  disabled: 'true'
});
var VehicleProfileEditFormPopup = new Popup('VehicleProfileEditForm', [VehicleProfileEditFormCancel, VehicleProfileEditFormClose, VehicleProfileEditFormConfirm], ['click', 'keyup', 'change']);
VehicleProfileEditFormPopup.setDataType('value'); //Vehicle Profile Form

var VehicleProfileFormClose = new DisplayNextButton('VehicleProfileForm_Close');
var VehicleProfileFormEdit = new DisplayNextButton('VehicleProfileForm_Edit', VehicleProfileEditFormPopup);
var VehicleProfileFormDelete = new DisplayAlertButton('VehicleProfileForm_Delete', DeleteVehicleAlertPopup);
var VehicleProfileFormPopup = new Popup('VehicleProfileForm', [VehicleProfileFormEdit, VehicleProfileFormClose, VehicleProfileFormDelete]);
VehicleProfileFormPopup.setDataType('value');
VehicleProfileEditFormCancel.setNext(VehicleProfileFormPopup);
DeleteVehicleAlertCancel.setNext(VehicleProfileFormPopup);
DeleteVehicleAlertClose.setNext(VehicleProfileFormPopup); //Assign Final Preview

var RequestFinalDetailsClose = new DisplayAlertButton('RequestFinalDetails_Close', CancelRequestAlertPopup);
var RequestFinalDetailsBack = new DisplayNextButton('RequestFinalDetails_Back');
var RequestFinalDetailsConfirm = new DisplayNextButton('RequestFinalDetails_Confirm', {}, [ObjectCreate, BackendAccess('Schedule', ActionCreator([requestsToAssignStore, ongoingTripStore], 'DELETE&ADD'))]);
var RequestFinalDetailsPopup = new Popup('RequestFinalDetailsPopup', [RequestFinalDetailsBack, RequestFinalDetailsClose, RequestFinalDetailsConfirm]); //Select Vehicle

var SelectVehicleAlertClose = new DisplayNextButton('SelectVehicleAlert_Close');
var SelectVehicleAlertBack = new DisplayNextButton('SelectVehicleAlert_Goback');
var SelectVehicleAlertConfirm = new DisplayNextButton('SelectVehicleAlert_Confirm', RequestFinalDetailsPopup, [], {
  disabled: 'true'
});
var SelectionVehicleTable = new SelectionTable('selectionVehicleTable', {}, vehicleStore, 'selectionVehicleTemplate', SelectVehicleAlertConfirm, 'Vehicle');
var SelectVehicleAlertPopup = new Popup('SelectVehicleAlertPopup', [SelectVehicleAlertBack, SelectVehicleAlertClose, SelectVehicleAlertConfirm], ['click'], {}, SelectionVehicleTable);
RequestFinalDetailsBack.setNext(SelectVehicleAlertPopup); //Select Driver

var SelectDriverAlertClose = new DisplayNextButton('SelectDriverAlert_Close');
var SelectDriverAlertBack = new DisplayNextButton('SelectDriverAlert_Goback');
var SelectDriverAlertConfirm = new DisplayNextButton('SelectDriverAlert_Confirm', SelectVehicleAlertPopup, [], {
  disabled: 'true'
});
var SelectionDriverTable = new SelectionTable('selectionDriverTable', {}, driverStore, 'selectionDriverTemplate', SelectDriverAlertConfirm, 'Driver', 'Vehicle', 'AssignedVehicle');
var SelectDriverAlertPopup = new Popup('SelectDriverAlertPopup', [SelectDriverAlertBack, SelectDriverAlertClose, SelectDriverAlertConfirm], ['click'], {}, SelectionDriverTable);
SelectVehicleAlertBack.setNext(SelectDriverAlertPopup); //Assign Vehicle To Driver

var AssignVehicleToDriverClose = new DisplayNextButton('AssignVehicleToDriver_Close');
var AssignVehicleToDriverBack = new DisplayNextButton('AssignVehicleToDriver_Goback');
var AssignVehicleToDriverConfirm = new DisplayNextButton('AssignVehicleToDriver_Confirm', {}, [BackendAccess('AssignVehicleToDriver', ActionCreator([vehicleStore, driverStore], 'UPDATE&UPDATE'))], {
  disabled: 'true'
});
var assignVehicleToDriverTable = new SelectionTable('assignVehicleToDriverTable', {}, vehicleStore, 'selectionVehicleTemplate', AssignVehicleToDriverConfirm, 'AssignedVehicle');
var AssignVehicleToDriverPopup = new Popup('AssignVehicleToDriverPopup', [AssignVehicleToDriverBack, AssignVehicleToDriverClose, AssignVehicleToDriverConfirm], ['click'], {}, assignVehicleToDriverTable); //Driver Profile Form

var DriverProfileFormClose = new DisplayNextButton('DriverProfileForm_Close');
var DriverProfileFormAssignVehicle = new DisplayNextButton('DriverProfileForm_AssignVehicle', AssignVehicleToDriverPopup);
var DriverProfileFormPopup = new Popup('DriverProfileForm', [DriverProfileFormAssignVehicle, DriverProfileFormClose]);
DriverProfileFormPopup.setDataType('value');
AssignVehicleToDriverBack.setNext(DriverProfileFormPopup); //Request Assign Preview

var RequestAssignPreviewClose = new DisplayNextButton('RequestAssignPreview_Close');
var RequestAssignPreviewCancel = new DisplayNextButton('RequestAssignPreview_Cancel');
var RequestAssignPreviewAssign = new DisplayNextButton('RequestAssignPreview_Assign', SelectDriverAlertPopup);
var RequestAssignPreviewPopup = new Popup('RequestAssignPreviewPopup', [RequestAssignPreviewCancel, RequestAssignPreviewClose, RequestAssignPreviewAssign]);
SelectDriverAlertBack.setNext(RequestAssignPreviewPopup); //Active Trips Preview Popup

var EndTripConfirmClose = new DisplayNextButton('EndTripConfirm_Close');
var EndTripConfirmCancel = new DisplayNextButton('EndTripConfirm_Cancel');
var EndTripConfirmEnd = new DisplayNextButton('EndTripConfirm_Confirm', {}, [ObjectCreate, BackendAccess('EndTrip', ActionCreator([ongoingTripStore, scheduledRequestsStore], 'DELETE&ADD')), RemoveAllPopup]);
var EndTripConfirmPopup = new Popup('EndTripConfirmPopup', [EndTripConfirmCancel, EndTripConfirmClose, EndTripConfirmEnd]); //Active Trips Preview Popup

var ActiveTripDetailsClose = new DisplayNextButton('ActiveTripDetails_Close');
var ActiveTripDetailsCancel = new DisplayNextButton('ActiveTripDetails_Cancel', {}, [BackendAccess('CancelRequest', ActionCreator([ongoingTripStore, scheduledRequestsStore], 'UPDATE'))]);
var ActiveTripDetailsEnd = new DisplayAlertButton('ActiveTripDetails_End', EndTripConfirmPopup);
var ActiveTripDetailsPrintSlip = new OpenNewWindowButton('ActiveTripDetails_PrintSlip', [], [BackendAccess('PrintSlip')]);
var ActiveTripDetailsPopup = new Popup('ActiveTripDetailsPopup', [ActiveTripDetailsCancel, ActiveTripDetailsClose, ActiveTripDetailsEnd, ActiveTripDetailsPrintSlip], ['click'], {
  Vehicle: ['registration'],
  Driver: ['firstName', 'lastName']
});
var assignRequestContainer = new DOMContainer('assignAwaitingRequestContainer', RequestAssignPreviewPopup, requestsToAssignStore, 'awaitingRequestCardTemplate');
var ongoingTripContainer = new DOMContainer('ongoingAwaitingRequestContainer', ActiveTripDetailsPopup, ongoingTripStore, 'awaitingRequestCardTemplate');
var scheduledHistoryContainer = new DOMContainer('scheduledAwaitingRequestContainer', RequestHistoryPreviewPopup, scheduledRequestsStore, 'awaitingRequestCardTemplate');
var vehicleContainer = new DOMContainer('vehiclesContainer', VehicleProfileFormPopup, vehicleStore, 'vehicleCardTemplate');
var driverContainer = new DOMContainer('driverContainer', DriverProfileFormPopup, driverStore, 'driverCardTemplate');
var AddVehicleButton = new DOMButton('AddVehicleButton', VehicleAddFormPopup);
var assignRequestContainerTab = new DOMTabContainer('AssignRequestsSecTab', assignRequestContainer);
var ongoingTripContainerTab = new DOMTabContainer('OngoingTripsSecTab', ongoingTripContainer);
var scheduledHistoryContainerTab = new DOMTabContainer('ScheduledHistorySecTab', scheduledHistoryContainer);
var vehicleContainerTab = new DOMTabContainer('VehiclesSecTab', vehicleContainer);
var driverContainerTab = new DOMTabContainer('DriversSecTab', driverContainer);
var assignRequestContainerTabButton = new SecondaryTabButton('AssignRequestsSecLink', assignRequestContainerTab);
var ongoingTripContainerTabButton = new SecondaryTabButton('OngoingTripsSecLink', ongoingTripContainerTab);
var scheduledHistoryContainerTabButton = new SecondaryTabButton('ScheduledHistorySecLink', scheduledHistoryContainerTab);
var vehicleContainerTabButton = new SecondaryTabButton('VehiclesSecLink', vehicleContainerTab);
var driverContainerTabButton = new SecondaryTabButton('DriversSecLink', driverContainerTab);
var assignTab = new SecondaryTab('AwaitingRequestsSecTab', [assignRequestContainerTabButton, ongoingTripContainerTabButton, scheduledHistoryContainerTabButton], assignRequestContainerTabButton);
var databaseTab = new SecondaryTab('DatabaseSecTab', [vehicleContainerTabButton, driverContainerTabButton], vehicleContainerTabButton);
requesterTab.removeFromDOM();
var assignTabButton = new MainTabButton('AwaitingRequestsMainLink', 'AwaitingRequestsMainTab', assignTab);
var requesterTabButton = new MainTabButton('MyRequestsMainLink', 'MyRequestsMainTab', requesterTab);
var databaseTabButton = new MainTabButton('DatabaseMainLink', 'DatabaseMainTab', databaseTab);
var vpmoMainTab = new MainTab('mainNavBarContainer', [assignTabButton, requesterTabButton, databaseTabButton], requesterTabButton);
requestsToAssignStore.addObservers(assignRequestContainer);
ongoingTripStore.addObservers(ongoingTripContainer);
scheduledRequestsStore.addObservers(scheduledHistoryContainer);
vehicleStore.addObservers(vehicleContainer);
vehicleStore.addObservers(SelectionVehicleTable);
vehicleStore.addObservers(assignVehicleToDriverTable);
driverStore.addObservers(driverContainer);
driverStore.addObservers(SelectionDriverTable);