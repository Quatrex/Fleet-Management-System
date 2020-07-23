const CancelRequestAlertClose = new DisplayNextButton('CancelRequestAlert_Close');
const CancelRequestAlertCancel = new DisplayNextButton('CancelRequestAlert_Cancel');
const CancelRequestAlertConfirm = new DisplayNextButton('CancelRequestAlert_Confirm',{},[RemoveAllPopup])
const CancelRequestAlertPopup = new Popup('CancelRequestAlertPopup',[CancelRequestAlertClose,CancelRequestAlertCancel,CancelRequestAlertConfirm]);

const CancelAddedRequestAlertClose = new DisplayNextButton('CancelAddedRequestAlert_Close');
const CancelAddedRequestAlertCancel = new DisplayNextButton('CancelAddedRequestAlert_Cancel');
const CancelAddedRequestAlertConfirm = new DisplayNextButton('CancelAddedRequestAlert_Confirm',{},[BackendAccess('CancelRequest'),RemoveAllPopup])
const CancelAddedRequestAlertPopup = new Popup('CancelAddedRequestAlertPopup',[CancelAddedRequestAlertClose,CancelAddedRequestAlertCancel,CancelAddedRequestAlertConfirm]);

const NewRequestPreviewClose = new DisplayAlertButton('NewRequestPreview_Close',CancelRequestAlertPopup)
const NewRequestPreviewEdit = new DisplayNextButton('NewRequestPreview_Edit')
const NewRequestPreviewConfirm = new DisplayNextButton('NewRequestPreview_Confirm',{},[BackendAccess('RequestAdd')])
const NewRequestPreviewPopup = new Popup('NewRequestPreviewPopup',[NewRequestPreviewClose,NewRequestPreviewConfirm,NewRequestPreviewEdit]);
//cancel request next setup

const VehicleRequestFormClose = new DisplayAlertButton('VehicleRequestForm_Close',CancelRequestAlertPopup)
const VehicleRequestFormCancel = new DisplayAlertButton('VehicleRequestForm_Cancel',CancelRequestAlertPopup)
const VehicleRequestFormSubmit = new DisplayNextButton('VehicleRequestForm_Submit',NewRequestPreviewPopup,[ObjectCreate]);
const VehicleRequestFormPopup = new Popup('VehicleRequestForm',[VehicleRequestFormCancel,VehicleRequestFormClose,VehicleRequestFormSubmit]);
NewRequestPreviewEdit.setNext(VehicleRequestFormPopup);

const OngoingRequestPreviewClose = new DisplayNextButton('OngoingRequestPreview_Close')
const OngoingRequestPreviewRequestCancel = new DisplayAlertButton('OngoingRequestPreviewRequestCancel',CancelAddedRequestAlertPopup)
const OngoingRequestPreviewPopup = new Popup('OngoingRequestPreviewPopup',[OngoingRequestPreviewClose,OngoingRequestPreviewRequestCancel]);

const PendingRequestPreviewClose = new DisplayNextButton('PendingRequestPreview_Close')
const PendingRequestPreviewRequestCancel = new DisplayAlertButton('PendingRequestPreviewRequestCancel',CancelAddedRequestAlertPopup)
const PendingRequestPreviewPopup = new Popup('PendingRequestPreviewPopup',[PendingRequestPreviewClose,PendingRequestPreviewRequestCancel]);

const RequestHistoryPreviewClose = new DisplayNextButton('RequestHistoryPreview_Close')
const RequestHistoryPreviewPopup = new Popup('RequestHistoryPreviewPopup',[RequestHistoryPreviewClose]);

const NewRequestButton = new DOMButton('NewRequestButton',VehicleRequestFormPopup)
const pendingRequestTable = new Table('pendingRequestTable',["RequestId","Purpose","Status","DateOfTrip","TimeOfTrip","PickLocation","DropLocation"],PendingRequestPreviewPopup,'requestsByMe',"RequestId")
const ongoingRequestTable = new Table('ongoingRequestTable',["RequestId","Purpose","DateOfTrip","TimeOfTrip","PickLocation","DropLocation"],OngoingRequestPreviewPopup,'ongoingRequests',"RequestId")
const requestHistoryTable = new Table('requestHistoryTable',["RequestId","Purpose","Status","DateOfTrip","TimeOfTrip","PickLocation","DropLocation"],RequestHistoryPreviewPopup,'pastRequests',"RequestId")
