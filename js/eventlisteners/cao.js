
//CAO
const ApproveRequestAlertClose = new DisplayAlertButton('ApproveRequestAlert_Close', CancelRequestAlertPopup)
const ApproveRequestAlertCancel = new DisplayNextButton('ApproveRequestAlert_Cancel')
const ApproveRequestAlertApprove = new DisplayNextButton('ApproveRequestAlert_Approve',{},[ObjectCreate,BackendAccess('CAOApprove')]);
const ApproveRequestAlertPopup = new Popup('ApproveRequestAlertPopup',[ApproveRequestAlertCancel,ApproveRequestAlertClose,ApproveRequestAlertApprove]);

const DenyRequestAlertClose = new DisplayAlertButton('DenyRequestAlert_Close', CancelRequestAlertPopup)
const DenyRequestAlertCancel = new DisplayNextButton('DenyRequestAlert_Cancel')
const DenyRequestAlertDeny = new DisplayNextButton('DenyRequestAlert_Decline',{},[ObjectCreate,BackendAccess('CAODeny')]);
const DenyRequestAlertPopup = new Popup('DenyRequestAlertPopup',[DenyRequestAlertCancel,DenyRequestAlertClose,DenyRequestAlertDeny]);

const RequestApprovePreviewClose = new DisplayNextButton('RequestApprovePreview_Close')
const RequestApprovePreviewApprove = new DisplayNextButton('RequestApprovePreview_Approve',ApproveRequestAlertPopup)
const RequestApprovePreviewDecline = new DisplayNextButton('RequestApprovePreview_Decline',DenyRequestAlertPopup);
const RequestApprovePreviewPopup = new Popup('RequestApprovePreviewPopup',[RequestApprovePreviewApprove,RequestApprovePreviewClose,RequestApprovePreviewDecline]);
ApproveRequestAlertCancel.setNext(RequestApprovePreviewPopup);
DenyRequestAlertCancel.setNext(RequestApprovePreviewPopup);

const approveRequestTable = new Table('approveRequestTable',["RequestId",,"Purpose","Status","DateOfTrip","TimeOfTrip","PickLocation","DropLocation"],RequestApprovePreviewPopup,'requestsToApprove','RequestId')
const approvedHistoryTable = new Table('approvedHistoryTable',["RequestId",,"Purpose","Status","DateOfTrip","TimeOfTrip","PickLocation","DropLocation"],RequestHistoryPreviewPopup,'approvedRequests','RequestId')
