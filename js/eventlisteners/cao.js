
//Fields
const approveRequestCard_Fields = ["RequesterName","Designation","Purpose","DateOfTrip","TimeOfTrip","PickLocation","DropLocation"]
const approvedHistoryCard_Fields = ["RequesterName","Designation","Purpose","DateOfTrip","TimeOfTrip","PickLocation",]


const awaitingRequestStore = new Store([...requestsToApprove,...approvedRequests]);


//CAO
const ApproveRequestAlertClose = new DisplayAlertButton('ApproveRequestAlert_Close', CancelRequestAlertPopup)
const ApproveRequestAlertCancel = new DisplayNextButton('ApproveRequestAlert_Cancel')
const ApproveRequestAlertApprove = new DisplayNextButton('ApproveRequestAlert_Approve',{},[ObjectCreate,BackendAccess('CAOApprove',[ActionCreator(awaitingRequestStore,"UPDATE")])]);
const ApproveRequestAlertPopup = new Popup('ApproveRequestAlertPopup',[ApproveRequestAlertCancel,ApproveRequestAlertClose,ApproveRequestAlertApprove]);

const DenyRequestAlertClose = new DisplayAlertButton('DenyRequestAlert_Close', CancelRequestAlertPopup)
const DenyRequestAlertCancel = new DisplayNextButton('DenyRequestAlert_Cancel')
const DenyRequestAlertDeny = new DisplayNextButton('DenyRequestAlert_Decline',{},[ObjectCreate,BackendAccess('CAODeny',[ActionCreator(awaitingRequestStore,"UPDATE")])]);
const DenyRequestAlertPopup = new Popup('DenyRequestAlertPopup',[DenyRequestAlertCancel,DenyRequestAlertClose,DenyRequestAlertDeny]);

const RequestApprovePreviewClose = new DisplayNextButton('RequestApprovePreview_Close')
const RequestApprovePreviewApprove = new DisplayNextButton('RequestApprovePreview_Approve',ApproveRequestAlertPopup)
const RequestApprovePreviewDecline = new DisplayNextButton('RequestApprovePreview_Decline',DenyRequestAlertPopup);
const RequestApprovePreviewPopup = new Popup('RequestApprovePreviewPopup',[RequestApprovePreviewApprove,RequestApprovePreviewClose,RequestApprovePreviewDecline]);
ApproveRequestAlertCancel.setNext(RequestApprovePreviewPopup);
DenyRequestAlertCancel.setNext(RequestApprovePreviewPopup);

const approveRequestContainer = new DOMContainer('approveAwaitingRequestCard',approveRequestCard_Fields,RequestApprovePreviewPopup,'RequestId',awaitingRequestStore,"awaitingRequestCardTemplate",["Justified"])
const approvedHistoryContainer = new DOMContainer('approvedAwaitingRequestCard',approvedHistoryCard_Fields,RequestHistoryPreviewPopup,'RequestId',awaitingRequestStore,"awaitingRequestCardTemplate",["Denied","Approved","Cancelled","Scheduled","Completed"])

awaitingRequestStore.addObservers([approveRequestContainer,approvedHistoryContainer])

