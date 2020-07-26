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
const driverCard_Fields = ['firstName', 'assignedVehicleID', 'email'];

const awaitingRequestStore = new Store([...requestsToAssign, ...scheduledRequests, ...scheduledRequests]);
const vehicleStore = new Store(vehicles);
const driverStore = new Store(drivers);

//Add a vehicle
const VehicleAddFormClose = new DisplayNextButton('VehicleAddForm_Close');
const VehicleAddFormSubmit = new DisplayNextButton('VehicleAddForm_Submit', {}, [
	ObjectCreate,
	BackendAccess('AddVehicle', [ActionCreator(vehicleStore, 'ADD')]),
]);
const VehicleAddFormPopup = new Popup('VehicleAddForm', [VehicleAddFormClose, VehicleAddFormSubmit]);

//Vehicle Delete Confirm
const DeleteVehicleAlertClose = new DisplayNextButton('DeleteVehicleAlert_Close');
const DeleteVehicleAlertCancel = new DisplayNextButton('DeleteVehicleAlert_Cancel');
const DeleteVehicleAlertDelete = new DisplayNextButton('DeleteVehicleAlert_Delete', {}, [
	BackendAccess('DeleteVehicle', [ActionCreator(vehicleStore, 'DELETE')]),
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
	[ObjectCreate, BackendAccess('UpdateVehicle', [ActionCreator(vehicleStore, 'UPDATE')])],
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
	BackendAccess('Schedule', [ActionCreator(awaitingRequestStore, 'UPDATE')]),
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
	[],
	{},
	'vehicles',
	'registration',
	vehicleStore,
	'',
	SelectVehicleAlertConfirm,
	'Vehicle'
);
const SelectVehicleAlertPopup = new Popup(
	'SelectVehicleAlertPopup',
	[SelectVehicleAlertBack, SelectVehicleAlertClose, SelectVehicleAlertConfirm],
	['click'],
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
	[],
	{},
	'drivers',
	'driverId',
	driverStore,
	'',
	SelectDriverAlertConfirm,
	'Driver',
	'Vehicle',
	'assignedVehicleID'
);
const SelectDriverAlertPopup = new Popup(
	'SelectDriverAlertPopup',
	[SelectDriverAlertBack, SelectDriverAlertClose, SelectDriverAlertConfirm],
	['click'],
	SelectionDriverTable
);
SelectVehicleAlertBack.setNext(SelectDriverAlertPopup);

//Assign Vehicle To Driver
const AssignVehicleToDriverClose = new DisplayNextButton('AssignVehicleToDriver_Close');
const AssignVehicleToDriverBack = new DisplayNextButton('AssignVehicleToDriver_Goback');
const AssignVehicleToDriverConfirm = new DisplayNextButton(
	'AssignVehicleToDriver_Confirm',
	{},
	[
		BackendAccess('AssignVehicleToDriver', [
			ActionCreator(vehicleStore, 'UPDATE'),
			ActionCreator(driverStore, 'UPDATE'),
		]),
	],
	{ disabled: 'true' }
);
const assignVehicleToDriverTable = new SelectionTable(
	'assignVehicleToDriverTable',
	[],
	{},
	'vehicles',
	'registration',
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
const EndTripConfirmEnd = new DisplayNextButton('EndTripConfirm_End', {}, [
	ObjectCreate,
	BackendAccess('EndTrip', [ActionCreator(awaitingRequestStore, 'UPDATE')]),
	RemoveAllPopup,
]);
const EndTripConfirmPopup = new Popup('EndTripConfirmPopup', [
	EndTripConfirmCancel,
	EndTripConfirmClose,
	EndTripConfirmEnd,
]);

//Active Trips Preview Popup
const ActiveTripDetailsClose = new DisplayNextButton('ActiveTripDetails_Close');
const ActiveTripDetailsCancel = new DisplayNextButton('ActiveTripDetails_Cancel');
const ActiveTripDetailsEnd = new DisplayAlertButton('ActiveTripDetails_End', EndTripConfirmPopup);
const ActiveTripDetailsPrintSlip = new DisplayNextButton(
	'ActiveTripDetails_PrintSlip',
	[],
	[BackendAccess('PrintSlip')]
);
const ActiveTripDetailsPopup = new Popup('ActiveTripDetailsPopup', [
	ActiveTripDetailsCancel,
	ActiveTripDetailsClose,
	ActiveTripDetailsEnd,
	ActiveTripDetailsPrintSlip,
]);

const assignRequestContainer = new DOMContainer(
	'assignAwaitingRequestCard',
	assignRequestCard_Fields,
	RequestAssignPreviewPopup,
	'requestsToAssign',
	'RequestId',
	awaitingRequestStore,
	['Approved'],
	'awaitingRequestCardTemplate'
);
const ongoingTripContainer = new DOMContainer(
	'ongoingAwaitingRequestCard',
	ongoingTripCard_Fields,
	ActiveTripDetailsPopup,
	'scheduledRequests',
	'RequestId',
	awaitingRequestStore,
	['Scheduled'],
	'awaitingRequestCardTemplate'
);
const scheduledHistoryContainer = new DOMContainer(
	'scheduledAwaitingRequestCard',
	scheduledHistoryCard_Fields,
	RequestHistoryPreviewPopup,
	'scheduledRequests',
	'RequestId',
	awaitingRequestStore,
	['Completed', 'Cancelled'],
	'awaitingRequestCardTemplate'
);
const vehicleContainer = new DOMContainer(
	'vehicleContainer',
	vehicleCard_Fields,
	VehicleProfileFormPopup,
	'vehicles',
	'registration',
	vehicleStore,
	[],
	'vehicleCardTemplate'
);
const driverContainer = new DOMContainer(
	'driverContainer',
	driverCard_Fields,
	DriverProfileFormPopup,
	'drivers',
	'driverId',
	driverStore,
	[],
	'employeeCardTemplate'
);
const AddVehicleButton = new DOMButton('AddVehicleButton', VehicleAddFormPopup);

awaitingRequestStore.addObservers([assignRequestContainer, ongoingTripContainer, scheduledHistoryContainer]);
vehicleStore.addObservers([vehicleContainer]);
driverStore.addObservers([driverContainer]);
