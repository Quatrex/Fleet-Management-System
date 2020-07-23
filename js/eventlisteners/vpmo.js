//Add a vehicle
const VehicleAddFormClose = new DisplayNextGenerator('VehicleAddForm_Close')
const VehicleAddFormSubmit = new DisplayNextGenerator('VehicleAddForm_Submit',{},[ObjectCreate,BackendAccess('AddVehicle')]);
const VehicleAddFormPopup = new Popup('VehicleAddForm',[VehicleAddFormClose,VehicleAddFormSubmit]);

//Vehicle Delete Confirm
const DeleteVehicleAlertClose = new DisplayNextGenerator('DeleteVehicleAlert_Close')
const DeleteVehicleAlertCancel = new DisplayNextGenerator('DeleteVehicleAlert_Cancel')
const DeleteVehicleAlertDelete = new DisplayNextGenerator('DeleteVehicleAlert_Delete',{},[BackendAccess('DeleteVehicle'),RemoveAllPopup]);
const DeleteVehicleAlertPopup = new Popup('DeleteVehicleAlertPopup',[DeleteVehicleAlertCancel,DeleteVehicleAlertClose,DeleteVehicleAlertDelete]);

//Vehicle Edit Profile Form
const VehicleProfileEditFormClose = new DisplayAlertButton('VehicleProfileEditForm_Close', CancelRequestAlertPopup)
const VehicleProfileEditFormCancel = new DisplayNextGenerator('VehicleProfileEditForm_Cancel')
const VehicleProfileEditFormConfirm = new DisplayNextGenerator('VehicleProfileEditForm_Confirm',{},[ObjectCreate,BackendAccess('UpdateVehicle')],{disabled:'true'});
const VehicleProfileEditFormPopup = new Popup('VehicleProfileEditForm',[VehicleProfileEditFormCancel,VehicleProfileEditFormClose,VehicleProfileEditFormConfirm],['click','keyup']);
VehicleProfileEditFormPopup.setDataType('value');

//Vehicle Profile Form
const VehicleProfileFormClose = new DisplayNextGenerator('VehicleProfileForm_Close')
const VehicleProfileFormEdit = new DisplayNextGenerator('VehicleProfileForm_Edit',VehicleProfileEditFormPopup);
const VehicleProfileFormDelete = new DisplayAlertButton('VehicleProfileForm_Delete',DeleteVehicleAlertPopup);
const VehicleProfileFormPopup = new Popup('VehicleProfileForm',[VehicleProfileFormEdit,VehicleProfileFormClose,VehicleProfileFormDelete]);
VehicleProfileFormPopup.setDataType('value');
VehicleProfileEditFormCancel.setNext(VehicleProfileFormPopup);
DeleteVehicleAlertCancel.setNext(VehicleProfileFormPopup);
DeleteVehicleAlertClose.setNext(VehicleProfileFormPopup);

//Driver Profile Form
const DriverProfileFormClose = new DisplayNextButton('DriverProfileForm_Close')
const DriverProfileFormEdit = new DisplayNextButton('DriverProfileForm_Edit')
const DriverProfileFormPopup = new Popup('DriverProfileForm',[DriverProfileFormEdit,DriverProfileFormClose]);
DriverProfileFormPopup.setDataType('value');

//Assign Final Preview
const RequestFinalDetailsClose = new DisplayAlertButton('RequestFinalDetails_Close', CancelRequestAlertPopup)
const RequestFinalDetailsBack = new DisplayNextButton('RequestFinalDetails_Back')
const RequestFinalDetailsConfirm = new DisplayNextButton('RequestFinalDetails_Confirm',{},[BackendAccess('Schedule')]);
const RequestFinalDetailsPopup = new Popup('RequestFinalDetailsPopup',[RequestFinalDetailsBack,RequestFinalDetailsClose,RequestFinalDetailsConfirm]);

//Select Vehicle
const SelectVehicleAlertClose = new DisplayNextButton('SelectVehicleAlert_Close')
const SelectVehicleAlertBack = new DisplayNextButton('SelectVehicleAlert_Goback')
const SelectVehicleAlertConfirm = new DisplayNextButton('SelectVehicleAlert_Confirm',RequestFinalDetailsPopup,[],{disabled:'true'});
const SelectionVehicleTable = new SelectionTable('selectionVehicleTable',[],{},'vehicles','registration',SelectVehicleAlertConfirm,'Vehicle')
const SelectVehicleAlertPopup = new Popup('SelectVehicleAlertPopup',[SelectVehicleAlertBack,SelectVehicleAlertClose,SelectVehicleAlertConfirm],['click'],SelectionVehicleTable);
RequestFinalDetailsBack.setNext(SelectVehicleAlertPopup);
//Select Driver

const SelectDriverAlertClose = new DisplayNextButton('SelectDriverAlert_Close')
const SelectDriverAlertBack = new DisplayNextButton('SelectDriverAlert_Goback')
const SelectDriverAlertConfirm = new DisplayNextButton('SelectDriverAlert_Confirm', SelectVehicleAlertPopup,[],{disabled:'true'});
const SelectionDriverTable = new SelectionTable('selectionDriverTable',[],{},'drivers','driverId',SelectDriverAlertConfirm,'Driver','Vehicle','assignedVehicleID')
const SelectDriverAlertPopup = new Popup('SelectDriverAlertPopup',[SelectDriverAlertBack,SelectDriverAlertClose,SelectDriverAlertConfirm],['click'],SelectionDriverTable);
SelectVehicleAlertBack.setNext(SelectDriverAlertPopup);

//Request Assign Preview
const RequestAssignPreviewClose = new DisplayNextButton('RequestAssignPreview_Close')
const RequestAssignPreviewCancel = new DisplayNextButton('RequestAssignPreview_Cancel')
const RequestAssignPreviewAssign = new DisplayNextButton('RequestAssignPreview_Assign', SelectDriverAlertPopup);
const RequestAssignPreviewPopup = new Popup('RequestAssignPreviewPopup',[RequestAssignPreviewCancel,RequestAssignPreviewClose,RequestAssignPreviewAssign]);
SelectDriverAlertBack.setNext(RequestAssignPreviewPopup);

//Active Trips Preview Popup
const EndTripConfirmClose = new DisplayNextButton('EndTripConfirm_Close')
const EndTripConfirmCancel = new DisplayNextButton('EndTripConfirm_Cancel')
const EndTripConfirmEnd = new DisplayNextButton('EndTripConfirm_End', {},[BackendAccess('EndTrip'),RemoveAllPopup]);
const EndTripConfirmPopup = new Popup('EndTripConfirmPopup',[EndTripConfirmCancel,EndTripConfirmClose,EndTripConfirmEnd]);

//Active Trips Preview Popup
const AciveTripDetailsClose = new DisplayNextButton('AciveTripDetails_Close')
const AciveTripDetailsCancel = new DisplayNextButton('AciveTripDetails_Cancel')
const AciveTripDetailsEnd = new DisplayAlertButton('AciveTripDetails_End', EndTripConfirmPopup);
const AciveTripDetailsPopup = new Popup('AciveTripDetailsPopup',[AciveTripDetailsCancel,AciveTripDetailsClose,AciveTripDetailsEnd]);


const assignRequestTable = new Table('assignRequestTable',["RequestId",,"Purpose","Status","DateOfTrip","TimeOfTrip","PickLocation","DropLocation"],RequestAssignPreviewPopup,'requestsToAssign',"RequestId")
const ongoingTripTable = new Table('ongoingTripTable',["RequestId",,"Purpose","Status","DateOfTrip","TimeOfTrip","PickLocation","DropLocation"],AciveTripDetailsPopup,'scheduledRequests',"RequestId")
const scheduledHistoryTable = new Table('scheduledHistoryTable',["RequestId",,"Purpose","Status","DateOfTrip","TimeOfTrip","PickLocation","DropLocation"],RequestHistoryPreviewPopup,'scheduledRequests',"RequestId")
const vehicleTable = new Table('vehicleTable',["registration",,"model","status","fuelType"],VehicleProfileFormPopup,'vehicles',"registration")
const driverTable = new Table('driverTable',["firstName","assignedVehicleID","email"],DriverProfileFormPopup,'drivers',"driverId")
const AddVehicleButton = new DOMButton('AddVehicleButton',VehicleAddFormPopup)
