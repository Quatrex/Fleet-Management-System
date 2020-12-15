const requestsToAssignStore = new Store('requestsToAssign', networkManager);
const ongoingTripStore = new Store('scheduledRequests', networkManager);
const scheduledRequestsStore = new Store('scheduledHistoryRequests', networkManager);
const vehicleStore = new Store('vehicles', networkManager, 'RegistrationNo', 'RegistrationNo');
const driverStore = new Store('drivers', networkManager, 'DriverID', 'DriverID');

//Add a vehicle
const VehicleAddFormClose = new DisplayNextButton('VehicleAddForm_Close');
const VehicleAddFormSubmit = new BackendAcessButton(
	'VehicleAddForm_Submit',
	'AddVehicle',
	[ObjectCreate, FormValidate],
	ActionCreator([vehicleStore], 'ADD'),'PHOTO'
);
const VehicleAddFormPopup = new Popup('VehicleAddForm', [VehicleAddFormClose, VehicleAddFormSubmit]);

//Vehicle Delete Confirm
const DeleteVehicleAlertClose = new DisplayNextButton('DeleteVehicleAlert_Close');
const DeleteVehicleAlertCancel = new DisplayNextButton('DeleteVehicleAlert_Cancel');
const DeleteVehicleAlertDelete = new BackendAcessButton(
	'DeleteVehicleAlert_Delete',
	'DeleteVehicle',
	[],
	ActionCreator([vehicleStore], 'DELETE')
);
const DeleteVehicleAlertPopup = new Popup('DeleteVehicleAlertPopup', [
	DeleteVehicleAlertCancel,
	DeleteVehicleAlertClose,
	DeleteVehicleAlertDelete,
]);

//Vehicle Edit Profile Form
const VehicleProfileEditFormClose = new DisplayAlertButton('VehicleProfileEditForm_Close', CancelRequestAlertPopup);
const VehicleProfileEditFormCancel = new DisplayNextButton('VehicleProfileEditForm_Cancel');
const VehicleProfileEditFormConfirm = new BackendAcessButton(
	'VehicleProfileEditForm_Confirm',
	'UpdateVehicle',
	[ObjectCreate, FormValidate],
	ActionCreator([vehicleStore], 'UPDATE'),
	'PHOTO',
	{ disabled: 'true' }
);
const VehicleProfileEditFormPopup = new Popup(
	'VehicleProfileEditForm',
	[VehicleProfileEditFormCancel, VehicleProfileEditFormClose, VehicleProfileEditFormConfirm],
	['click', 'keyup', 'change']
);
VehicleProfileEditFormPopup.setDataType('value');

//Vehicle Profile Form
const VehicleProfileFormClose = new DisplayNextButton('VehicleProfileForm_Close');
const VehicleProfileFormEdit = new DisplayNextButton('VehicleProfileForm_Edit', VehicleProfileEditFormPopup,[ObjectCreate]);
const VehicleProfileFormDelete = new DisplayAlertButton('VehicleProfileForm_Delete', DeleteVehicleAlertPopup);
const VehicleProfileFormPopup = new Popup('VehicleProfileForm', [
	VehicleProfileFormEdit,
	VehicleProfileFormClose,
	VehicleProfileFormDelete,
]);
VehicleProfileFormPopup.setDataType('value');
VehicleProfileEditFormCancel.setNext(VehicleProfileFormPopup);
DeleteVehicleAlertCancel.setNext(VehicleProfileFormPopup);
DeleteVehicleAlertClose.setNext(VehicleProfileFormPopup);

//Assign Final Preview
const RequestFinalDetailsClose = new DisplayAlertButton('RequestFinalDetails_Close', CancelRequestAlertPopup);
const RequestFinalDetailsBack = new DisplayNextButton('RequestFinalDetails_Back');
const RequestFinalDetailsConfirm = new BackendAcessButton(
	'RequestFinalDetails_Confirm',
	'Schedule',
	[ObjectCreate],
	ActionCreator([requestsToAssignStore, ongoingTripStore], 'DELETE&ADD')
);
const RequestFinalDetailsPopup = new Popup('RequestFinalDetailsPopup', [
	RequestFinalDetailsBack,
	RequestFinalDetailsClose,
	RequestFinalDetailsConfirm,
]);

//Select Vehicle
const SelectVehicleAlertClose = new DisplayNextButton('SelectVehicleAlert_Close');
const SelectVehicleAlertBack = new DisplayNextButton('SelectVehicleAlert_Goback');
const SelectVehicleAlertConfirm = new DisplayNextButton('SelectVehicleAlert_Confirm', RequestFinalDetailsPopup, [], {
	disabled: 'true',
});
const SelectionVehicleTable = new SelectionTable(
	'selectionVehicleTable',
	{},
	vehicleStore,
	'selectionVehicleTemplate',
	SelectVehicleAlertConfirm,
	'Vehicle'
);
const SelectVehicleAlertPopup = new Popup(
	'SelectVehicleAlertPopup',
	[SelectVehicleAlertBack, SelectVehicleAlertClose, SelectVehicleAlertConfirm],
	['click'],
	{},
	SelectionVehicleTable
);
RequestFinalDetailsBack.setNext(SelectVehicleAlertPopup);
//Select Driver

const SelectDriverAlertClose = new DisplayNextButton('SelectDriverAlert_Close');
const SelectDriverAlertBack = new DisplayNextButton('SelectDriverAlert_Goback');
const SelectDriverAlertConfirm = new DisplayNextButton('SelectDriverAlert_Confirm', SelectVehicleAlertPopup, [], {
	disabled: 'true',
});
const SelectionDriverTable = new SelectionTable(
	'selectionDriverTable',
	{},
	driverStore,
	'selectionDriverTemplate',
	SelectDriverAlertConfirm,
	'Driver',
	'Vehicle',
	'AssignedVehicle'
);
const SelectDriverAlertPopup = new Popup(
	'SelectDriverAlertPopup',
	[SelectDriverAlertBack, SelectDriverAlertClose, SelectDriverAlertConfirm],
	['click'],
	{},
	SelectionDriverTable
);
SelectVehicleAlertBack.setNext(SelectDriverAlertPopup);

//Assign Vehicle To Driver
const AssignVehicleToDriverClose = new DisplayNextButton('AssignVehicleToDriver_Close');
const AssignVehicleToDriverBack = new DisplayNextButton('AssignVehicleToDriver_Goback');
const AssignVehicleToDriverConfirm = new BackendAcessButton(
	'AssignVehicleToDriver_Confirm',
	'AssignVehicleToDriver',
	[],
	ActionCreator([vehicleStore, driverStore], 'UPDATE&UPDATE'),
	'DEFAULT',
	{ disabled: 'true' }
);
const assignVehicleToDriverTable = new SelectionTable(
	'assignVehicleToDriverTable',
	{},
	vehicleStore,
	'selectionDriverVehicleTemplate',
	AssignVehicleToDriverConfirm,
	'AssignedVehicle'
);
const AssignVehicleToDriverPopup = new Popup(
	'AssignVehicleToDriverPopup',
	[AssignVehicleToDriverBack, AssignVehicleToDriverClose, AssignVehicleToDriverConfirm],
	['click'],
	{},
	assignVehicleToDriverTable
);

//Driver Profile Form
const DriverProfileFormClose = new DisplayNextButton('DriverProfileForm_Close');
const DriverProfileFormAssignVehicle = new DisplayNextButton(
	'DriverProfileForm_AssignVehicle',
	AssignVehicleToDriverPopup
);
const DriverProfileFormPopup = new Popup('DriverProfileForm', [DriverProfileFormAssignVehicle, DriverProfileFormClose]);
DriverProfileFormPopup.setDataType('value');
AssignVehicleToDriverBack.setNext(DriverProfileFormPopup);

//Request Assign Preview
const RequestAssignPreviewClose = new DisplayNextButton('RequestAssignPreview_Close');
const RequestAssignPreviewCancel = new DisplayNextButton('RequestAssignPreview_Cancel');
const RequestAssignPreviewAssign = new DisplayNextButton('RequestAssignPreview_Assign', SelectDriverAlertPopup);
const RequestAssignPreviewPopup = new Popup('RequestAssignPreviewPopup', [
	RequestAssignPreviewCancel,
	RequestAssignPreviewClose,
	RequestAssignPreviewAssign,
]);
SelectDriverAlertBack.setNext(RequestAssignPreviewPopup);

//Active Trips Preview Popup
const EndTripConfirmClose = new DisplayNextButton('EndTripConfirm_Close');
const EndTripConfirmCancel = new DisplayNextButton('EndTripConfirm_Cancel');
const EndTripConfirmEnd = new BackendAcessButton(
	'EndTripConfirm_Confirm',
	'EndTrip',
	[ObjectCreate],
	ActionCreator([ongoingTripStore, scheduledRequestsStore], 'DELETE&ADD')
);
const EndTripConfirmPopup = new Popup('EndTripConfirmPopup', [
	EndTripConfirmCancel,
	EndTripConfirmClose,
	EndTripConfirmEnd,
]);

//Active Trips Preview Popup
const CancelActiveTripClose = new DisplayNextButton('CancelActiveTrip_Close');
const CancelActiveTripCancel = new DisplayNextButton('CancelActiveTrip_Cancel');
const CancelActiveTripConfirm = new BackendAcessButton(
	'CancelActiveTrip_Confirm',
	'CancelScheduledRequest',
	[],
	ActionCreator([ongoingTripStore, scheduledRequestsStore], 'DELETE&APPEND')
);
const CancelActiveTripPopup = new Popup('CancelActiveTripPopup', [
	CancelActiveTripCancel,
	CancelActiveTripClose,
	CancelActiveTripConfirm,
]);

//Active Trips Preview Popup
const ActiveTripDetailsClose = new DisplayNextButton('ActiveTripDetails_Close');
const ActiveTripDetailsCancel = new DisplayAlertButton('ActiveTripDetails_Cancel', CancelActiveTripPopup);
const ActiveTripDetailsEnd = new DisplayAlertButton('ActiveTripDetails_End', EndTripConfirmPopup);
const ActiveTripDetailsPrintSlip = new OpenNewWindowButton(
	'ActiveTripDetails_PrintSlip',
	{},
	[]
);
const ActiveTripDetailsPopup = new Popup(
	'ActiveTripDetailsPopup',
	[ActiveTripDetailsCancel, ActiveTripDetailsClose, ActiveTripDetailsEnd, ActiveTripDetailsPrintSlip],
	['click'],
	{ Vehicle: ['RegistrationNo', 'Model'], Driver: ['FirstName', 'LastName'] }
);


const assignedRequestToDriverContainer = new DOMContainer(
	'assignedRequestToDriverContainer',
	{},
	driverStore,
	'AssignedRequestToDriverTemplate'
);
const assignedRequestToVehicleContainer = new DOMContainer(
	'assignedRequestToVehicleContainer',
	{},
	vehicleStore,
	'AssignedRequestToVehicleTemplate'
);
const assignRequestContainer = new DOMContainer(
	'assignAwaitingRequestContainer',
	RequestAssignPreviewPopup,
	requestsToAssignStore,
	'awaitingRequestCardTemplate'
);
const ongoingTripContainer = new DOMContainer(
	'ongoingAwaitingRequestContainer',
	ActiveTripDetailsPopup,
	ongoingTripStore,
	'awaitingRequestCardTemplate'
);
const scheduledHistoryContainer = new DOMContainer(
	'scheduledAwaitingRequestContainer',
	RequestHistoryPreviewPopup,
	scheduledRequestsStore,
	'awaitingRequestHistoryCardTemplate'
);
const vehicleContainer = new DOMContainer(
	'vehiclesContainer',
	VehicleProfileFormPopup,
	vehicleStore,
	'vehicleCardTemplate'
);
const driverContainer = new DOMContainer('driverContainer', DriverProfileFormPopup, driverStore, 'driverCardTemplate');
const AddVehicleButton = new DOMButton('AddVehicleButton', VehicleAddFormPopup);

const assignRequestContainerTab = new DOMTabContainer('AssignRequestsSecTab', assignRequestContainer);
const ongoingTripContainerTab = new DOMTabContainer('OngoingTripsSecTab', ongoingTripContainer);
const scheduledHistoryContainerTab = new DOMTabContainer('ScheduledHistorySecTab', scheduledHistoryContainer);
const vehicleContainerTab = new DOMTabContainer('VehiclesSecTab', vehicleContainer);
const driverContainerTab = new DOMTabContainer('DriversSecTab', driverContainer);

const assignRequestContainerTabButton = new SecondaryTabButton('AssignRequestsSecLink', assignRequestContainerTab);
const ongoingTripContainerTabButton = new SecondaryTabButton('OngoingTripsSecLink', ongoingTripContainerTab);
const scheduledHistoryContainerTabButton = new SecondaryTabButton(
	'ScheduledHistorySecLink',
	scheduledHistoryContainerTab
);
const vehicleContainerTabButton = new SecondaryTabButton('VehiclesSecLink', vehicleContainerTab);
const driverContainerTabButton = new SecondaryTabButton('DriversSecLink', driverContainerTab);

const assignTab = new SecondaryTab(
	'AwaitingRequestsSecTab',
	[assignRequestContainerTabButton, ongoingTripContainerTabButton, scheduledHistoryContainerTabButton],
	assignRequestContainerTabButton
);
const databaseTab = new SecondaryTab(
	'DatabaseSecTab',
	[vehicleContainerTabButton, driverContainerTabButton],
	vehicleContainerTabButton
);
requesterTab.removeFromDOM();

const assignTabButton = new MainTabButton('AwaitingRequestsMainLink', 'AwaitingRequestsMainTab', assignTab);
const requesterTabButton = new MainTabButton('MyRequestsMainLink', 'MyRequestsMainTab', requesterTab);
const databaseTabButton = new MainTabButton('DatabaseMainLink', 'DatabaseMainTab', databaseTab);

const vpmoMainTab = new MainTab(
	'mainNavBarContainer',
	[assignTabButton, requesterTabButton, databaseTabButton],
	requesterTabButton
);

requestsToAssignStore.addObservers(assignRequestContainer);
ongoingTripStore.addObservers(ongoingTripContainer);
scheduledRequestsStore.addObservers(scheduledHistoryContainer);
vehicleStore.addObservers(vehicleContainer);
vehicleStore.setAsssignedRequestContainer(assignedRequestToVehicleContainer);
vehicleStore.addObservers(SelectionVehicleTable);
vehicleStore.addObservers(assignVehicleToDriverTable);
driverStore.addObservers(driverContainer);
driverStore.addObservers(SelectionDriverTable);
driverStore.setAsssignedRequestContainer(assignedRequestToDriverContainer);
