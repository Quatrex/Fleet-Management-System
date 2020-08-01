//Fields
const pendingRequestTable_Fields = ["Purpose","Status","DateOfTrip","TimeOfTrip","PickLocation","DropLocation"]
const ongoingRequestTable_Fields = ["Purpose","DateOfTrip","TimeOfTrip","PickLocation","DropLocation"]
const requestHistoryTable_Fields = ["Purpose","Status","DateOfTrip","TimeOfTrip","PickLocation","DropLocation"]

const myRequestStore = new Store([...requestsByMe,...ongoingRequests,...pastRequests]);

const CancelRequestAlertClose = new DisplayNextButton('CancelRequestAlert_Close');
const CancelRequestAlertCancel = new DisplayNextButton('CancelRequestAlert_Cancel');
const CancelRequestAlertConfirm = new DisplayNextButton('CancelRequestAlert_Confirm',{},[RemoveAllPopup])
const CancelRequestAlertPopup = new Popup('CancelRequestAlertPopup',[CancelRequestAlertClose,CancelRequestAlertCancel,CancelRequestAlertConfirm]);

const CancelAddedRequestAlertClose = new DisplayNextButton('CancelAddedRequestAlert_Close');
const CancelAddedRequestAlertCancel = new DisplayNextButton('CancelAddedRequestAlert_Cancel');
const CancelAddedRequestAlertConfirm = new DisplayNextButton('CancelAddedRequestAlert_Confirm',{},[ObjectCreate,BackendAccess('CancelRequest',[ActionCreator(myRequestStore,"UPDATE")]),RemoveAllPopup])
const CancelAddedRequestAlertPopup = new Popup('CancelAddedRequestAlertPopup',[CancelAddedRequestAlertClose,CancelAddedRequestAlertCancel,CancelAddedRequestAlertConfirm]);

const NewRequestPreviewClose = new DisplayAlertButton('NewRequestPreview_Close',CancelRequestAlertPopup)
const NewRequestPreviewEdit = new DisplayNextButton('NewRequestPreview_Edit')
const NewRequestPreviewConfirm = new DisplayNextButton('NewRequestPreview_Confirm',{},[BackendAccess('RequestAdd',[ActionCreator(myRequestStore,"ADD")])])
const NewRequestPreviewPopup = new Popup('NewRequestPreviewPopup',[NewRequestPreviewClose,NewRequestPreviewConfirm,NewRequestPreviewEdit]);
//cancel request next setup

const VehicleRequestFormClose = new DisplayAlertButton('VehicleRequestForm_Close',CancelRequestAlertPopup)
const VehicleRequestFormCancel = new DisplayAlertButton('VehicleRequestForm_Cancel',CancelRequestAlertPopup)
const VehicleRequestFormSubmit = new ValidatorButton('VehicleRequestForm_Submit',NewRequestPreviewPopup,[ObjectCreate,FormValidate,DateValidator]);
const VehicleRequestFormPopup = new Popup('VehicleRequestForm',[VehicleRequestFormCancel,VehicleRequestFormClose,VehicleRequestFormSubmit],['click','keyup']);
NewRequestPreviewEdit.setNext(VehicleRequestFormPopup);

const OngoingRequestPreviewClose = new DisplayNextButton('OngoingRequestPreview_Close')
const OngoingRequestPreviewRequestCancel = new DisplayAlertButton('OngoingRequestPreviewRequestCancel',CancelAddedRequestAlertPopup)
const OngoingRequestPreviewPopup = new Popup('OngoingRequestPreviewPopup',[OngoingRequestPreviewClose,OngoingRequestPreviewRequestCancel]);

const PendingRequestPreviewClose = new DisplayNextButton('PendingRequestPreview_Close')
const PendingRequestPreviewRequestCancel = new DisplayAlertButton('PendingRequestPreviewRequestCancel',CancelAddedRequestAlertPopup)
const PendingRequestPreviewPopup = new Popup('PendingRequestPreviewPopup',[PendingRequestPreviewClose,PendingRequestPreviewRequestCancel]);

const RequestHistoryPreviewClose = new DisplayNextButton('RequestHistoryPreview_Close')
const RequestHistoryPreviewPopup = new Popup('RequestHistoryPreviewPopup',[RequestHistoryPreviewClose]);

const UserProfilePopupClose = new DisplayNextButton('UserProfilePopup_Close')
const UserProfilePopup = new Popup('UserProfilePopup',[UserProfilePopupClose]);


const NewRequestButton = new DOMButton('NewRequestButton',VehicleRequestFormPopup)
const UserProfileEditButton = new DOMButton('UserProfileEditButton',UserProfilePopup)
const pendingRequestTable = new DOMContainer('pendingRequestCard',pendingRequestTable_Fields,PendingRequestPreviewPopup,"RequestId",myRequestStore,"cardTemplate",["Pending","Approved","Justified"]);
const ongoingRequestTable = new DOMContainer('ongoingRequestCard',ongoingRequestTable_Fields,OngoingRequestPreviewPopup,"RequestId",myRequestStore,"cardTemplate",["Scheduled"]);
const requestHistoryTable = new DOMContainer('pastRequestCard',requestHistoryTable_Fields,RequestHistoryPreviewPopup,"RequestId",myRequestStore,"cardTemplate",["Denied","Cancelled","Completed"]);

myRequestStore.addObservers([pendingRequestTable,ongoingRequestTable,requestHistoryTable])
