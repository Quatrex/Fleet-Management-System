//Fields
const assignRequestCard_Fields = [
	'RequesterName',
	'Designation',
	'Purpose',
	'DateOfTrip',
	'TimeOfTrip',
	'PickLocation',
	'DropLocation',
];
const ongoingTripCard_Fields = [
	'RequesterName',
	'Designation',
	'Purpose',
	'DateOfTrip',
	'TimeOfTrip',
	'PickLocation',
	'DropLocation',
];
const scheduledHistoryCard_Fields = [
	'RequesterName',
	'Designation',
	'Purpose',
	'DateOfTrip',
	'TimeOfTrip',
	'PickLocation',
	'DropLocation',
];
const vehicleCard_Fields = ['registration', 'model', 'purchasedYear'];
const driverCard_Fields = ['firstName', 'lastName','assignedVehicleID', 'email'];
// const driverSelction_Fields = ['firstName', 'lastName','assignedVehicleID', 'email'];

const requestsToAssignStore = new Store('requestsToAssign');
const ongoingTripStore = new Store('scheduledRequests');
const scheduledRequestsStore = new Store('scheduledHistoryRequests');
const vehicleStore = new Store('vehicles');
const driverStore = new Store('drivers');

//Add a vehicle
const VehicleAddFormClose = new DisplayNextButton('VehicleAddForm_Close');
const VehicleAddFormSubmit = new DisplayNextButton('VehicleAddForm_Submit', {}, [
	ObjectCreate,
	BackendAccess('AddVehicle', ActionCreator([vehicleStore], 'ADD')),
]);
const VehicleAddFormPopup = new Popup('VehicleAddForm', [VehicleAddFormClose, VehicleAddFormSubmit]);

//Vehicle Delete Confirm
const DeleteVehicleAlertClose = new DisplayNextButton('DeleteVehicleAlert_Close');
const DeleteVehicleAlertCancel = new DisplayNextButton('DeleteVehicleAlert_Cancel');
const DeleteVehicleAlertDelete = new DisplayNextButton('DeleteVehicleAlert_Delete', {}, [
	BackendAccess('DeleteVehicle', ActionCreator([vehicleStore], 'DELETE')),
	RemoveAllPopup,
]);
const DeleteVehicleAlertPopup = new Popup('DeleteVehicleAlertPopup', [
	DeleteVehicleAlertCancel,
	DeleteVehicleAlertClose,
	DeleteVehicleAlertDelete,
]);

//Vehicle Edit Profile Form
const VehicleProfileEditFormClose = new DisplayAlertButton('VehicleProfileEditForm_Close', CancelRequestAlertPopup);
const VehicleProfileEditFormCancel = new DisplayNextButton('VehicleProfileEditForm_Cancel');
const VehicleProfileEditFormConfirm = new DisplayNextButton(
	'VehicleProfileEditForm_Confirm',
	{},
	[ObjectCreate, BackendAccess('UpdateVehicle', ActionCreator([vehicleStore], 'UPDATE'))],
	{ disabled: 'true' }
);
const VehicleProfileEditFormPopup = new Popup(
	'VehicleProfileEditForm',
	[VehicleProfileEditFormCancel, VehicleProfileEditFormClose, VehicleProfileEditFormConfirm],
	['click', 'keyup']
);
VehicleProfileEditFormPopup.setDataType('value');

//Vehicle Profile Form
const VehicleProfileFormClose = new DisplayNextButton('VehicleProfileForm_Close');
const VehicleProfileFormEdit = new DisplayNextButton('VehicleProfileForm_Edit', VehicleProfileEditFormPopup);
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
const RequestFinalDetailsConfirm = new DisplayNextButton('RequestFinalDetails_Confirm', {}, [
	ObjectCreate,
	BackendAccess('Schedule', ActionCreator([requestsToAssignStore, ongoingTripStore], 'DELETE&ADD')),
]);
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
	vehicleCard_Fields,
	{},
	'registration',
	vehicleStore,
	'selectionVehicleTemplate',
	SelectVehicleAlertConfirm,
	'Vehicle'
);
const SelectVehicleAlertPopup = new Popup(
	'SelectVehicleAlertPopup',
	[SelectVehicleAlertBack, SelectVehicleAlertClose, SelectVehicleAlertConfirm],
	['click'],{},
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
	driverCard_Fields,
	{},
	'driverId',
	driverStore,
	'selectionDriverTemplate',
	SelectDriverAlertConfirm,
	'Driver',
	'Vehicle',
	'assignedVehicleID'
);
const SelectDriverAlertPopup = new Popup(
	'SelectDriverAlertPopup',
	[SelectDriverAlertBack, SelectDriverAlertClose, SelectDriverAlertConfirm],
	['click'],{},
	SelectionDriverTable
);
SelectVehicleAlertBack.setNext(SelectDriverAlertPopup);

//Assign Vehicle To Driver
const AssignVehicleToDriverClose = new DisplayNextButton('AssignVehicleToDriver_Close');
const AssignVehicleToDriverBack = new DisplayNextButton('AssignVehicleToDriver_Goback');
const AssignVehicleToDriverConfirm = new DisplayNextButton(
	'AssignVehicleToDriver_Confirm',
	{},
	[BackendAccess('AssignVehicleToDriver', ActionCreator([vehicleStore, driverStore], 'UPDATE&UPDATE'))],
	{ disabled: 'true' }
);
const assignVehicleToDriverTable = new SelectionTable(
	'assignVehicleToDriverTable',
	vehicleCard_Fields,
	{},
	'registration',
	vehicleStore,
	'selectionVehicleTemplate',
	AssignVehicleToDriverConfirm,
	'assignedVehicleID'
);
const AssignVehicleToDriverPopup = new Popup(
	'AssignVehicleToDriverPopup',
	[AssignVehicleToDriverBack, AssignVehicleToDriverClose, AssignVehicleToDriverConfirm],
	['click'],
	assignVehicleToDriverTable
);

//Driver Profile Form
const DriverProfileFormClose = new DisplayNextButton('DriverProfileForm_Close');
const DriverProfileFormAssignVehicle = new DisplayNextButton(
	'DriverProfileForm_AssignVehicle'
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
const EndTripConfirmEnd = new DisplayNextButton('EndTripConfirm_End', {}, [
	ObjectCreate,
	BackendAccess('EndTrip', ActionCreator([ongoingTripStore,scheduledRequestsStore], 'DELETE&ADD')),
	RemoveAllPopup,
]);
const EndTripConfirmPopup = new Popup('EndTripConfirmPopup', [
	EndTripConfirmCancel,
	EndTripConfirmClose,
	EndTripConfirmEnd,
]);

//Active Trips Preview Popup
const ActiveTripDetailsClose = new DisplayNextButton('ActiveTripDetails_Close');
const ActiveTripDetailsCancel = new DisplayNextButton('ActiveTripDetails_Cancel', {}, [
	BackendAccess('CancelTrip', ActionCreator([ongoingTripStore,scheduledRequestsStore], 'UPDATE')),
]);
const ActiveTripDetailsEnd = new DisplayAlertButton('ActiveTripDetails_End', EndTripConfirmPopup);
const ActiveTripDetailsPrintSlip = new OpenNewWindowButton(
	'ActiveTripDetails_PrintSlip',
	[],
	[BackendAccess('PrintSlip')]
);
const ActiveTripDetailsPopup = new Popup('ActiveTripDetailsPopup', [
	ActiveTripDetailsCancel,
	ActiveTripDetailsClose,
	ActiveTripDetailsEnd,
	ActiveTripDetailsPrintSlip,
],['click'],{'Vehicle':['registration'],'Driver':['firstName','lastName']});

const assignRequestContainer = new DOMContainer(
	'assignAwaitingRequestCard',
	assignRequestCard_Fields,
	RequestAssignPreviewPopup,
	'RequestId',
	requestsToAssignStore,
	'awaitingRequestCardTemplate'
);
const ongoingTripContainer = new DOMContainer(
	'ongoingAwaitingRequestCard',
	ongoingTripCard_Fields,
	ActiveTripDetailsPopup,
	'RequestId',
	ongoingTripStore,
	'awaitingRequestCardTemplate',
);
const scheduledHistoryContainer = new DOMContainer(
	'scheduledAwaitingRequestCard',
	scheduledHistoryCard_Fields,
	RequestHistoryPreviewPopup,
	'RequestId',
	scheduledRequestsStore,
	'awaitingRequestCardTemplate',
);
const vehicleContainer = new DOMContainer(
	'vehicleContainer',
	vehicleCard_Fields,
	VehicleProfileFormPopup,
	'registration',
	vehicleStore,
	'vehicleCardTemplate'
);
const driverContainer = new DOMContainer(
	'driverContainer',
	driverCard_Fields,
	DriverProfileFormPopup,
	'driverId',
	driverStore,
	'driverCardTemplate'
);
const AddVehicleButton = new DOMButton('AddVehicleButton', VehicleAddFormPopup);

const assignRequestContainerTab = new DOMTabContainer('AssignRequestsSecTab',assignRequestContainer);
const ongoingTripContainerTab = new DOMTabContainer('OngoingTripsSecTab',ongoingTripContainer);
const scheduledHistoryContainerTab = new DOMTabContainer('ScheduledHistorySecTab',scheduledHistoryContainer);
const vehicleContainerTab = new DOMTabContainer('VehiclesSecTab',vehicleContainer);
const driverContainerTab = new DOMTabContainer('DriversSecTab',driverContainer);

const assignRequestContainerTabButton = new SecondaryTabButton('AssignRequestsSecLink',assignRequestContainerTab);
const ongoingTripContainerTabButton = new SecondaryTabButton('OngoingTripsSecLink',ongoingTripContainerTab);
const scheduledHistoryContainerTabButton = new SecondaryTabButton('ScheduledHistorySecLink',scheduledHistoryContainerTab);
const vehicleContainerTabButton = new SecondaryTabButton('VehiclesSecLink',vehicleContainerTab);
const driverContainerTabButton = new SecondaryTabButton('DriversSecLink',driverContainerTab);

const assignTab = new SecondaryTab('AwaitingRequestsSecTab',[assignRequestContainerTabButton,ongoingTripContainerTabButton,scheduledHistoryContainerTabButton],assignRequestContainerTabButton);
const databaseTab = new SecondaryTab('DatabaseSecTab',[vehicleContainerTabButton,driverContainerTabButton],vehicleContainerTabButton);
requesterTab.removeFromDOM();

const assignTabButton = new MainTabButton('AwaitingRequestsMainLink','AwaitingRequestsMainTab',assignTab);
const requesterTabButton = new MainTabButton('MyRequestsMainLink','MyRequestsMainTab',requesterTab);
const databaseTabButton = new MainTabButton('DatabaseMainLink','DatabaseMainTab',databaseTab);

const vpmoMainTab = new MainTab('mainNavBarContainer',[assignTabButton,requesterTabButton,databaseTabButton],requesterTabButton)

requestsToAssignStore.addObservers(assignRequestContainer);
ongoingTripStore.addObservers(ongoingTripContainer);
scheduledRequestsStore.addObservers(scheduledHistoryContainer);
vehicleStore.addObservers(vehicleContainer);
vehicleStore.addObservers(SelectionVehicleTable);
driverStore.addObservers(driverContainer);
driverStore.addObservers(SelectionDriverTable);
