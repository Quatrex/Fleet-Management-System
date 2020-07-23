//JO
const JustifyRequestAlertClose = new DisplayNextButton('JustifyRequestAlert_Close')
const JustifyRequestAlertCancel = new DisplayNextButton('JustifyRequestAlert_Cancel');
const JustifyRequestAlertJustify = new DisplayNextButton('JustifyRequestAlert_Justify',{},[ObjectCreate,BackendAccess('JOJustify')]);
const JustifyRequestAlertPopup = new Popup('JustifyRequestAlertPopup',[JustifyRequestAlertCancel,JustifyRequestAlertClose,JustifyRequestAlertJustify]);

const DeclineRequestAlertClose = new DisplayNextButton('DeclineRequestAlert_Close')
const DeclineRequestAlertCancel = new DisplayNextButton('DeclineRequestAlert_Cancel')
const DeclineRequestAlertDecline = new DisplayNextButton('DeclineRequestAlert_Decline',{},[ObjectCreate,BackendAccess('JODeny')]);
const DeclineRequestAlertPopup = new Popup('DeclineRequestAlertPopup',[DeclineRequestAlertCancel,DeclineRequestAlertClose,DeclineRequestAlertDecline]);

const RequestJustifyPreviewClose = new DisplayNextButton('RequestJustifyPreview_Close')
const RequestJustifyPreviewApprove = new DisplayNextButton('RequestJustifyPreview_Approve',JustifyRequestAlertPopup)
const RequestJustifyPreviewDecline = new DisplayNextButton('RequestJustifyPreview_Decline',DeclineRequestAlertPopup);
const RequestJustifyPreviewPopup = new Popup('RequestJustifyPreviewPopup',[RequestJustifyPreviewApprove,RequestJustifyPreviewClose,RequestJustifyPreviewDecline]);
JustifyRequestAlertCancel.setNext(RequestJustifyPreviewPopup);
DeclineRequestAlertCancel.setNext(RequestJustifyPreviewPopup);

const justifyRequestTable = new Table('justifyRequestTable',["RequestId","RequesterName","Designation","Purpose","DateOfTrip","TimeOfTrip"],RequestJustifyPreviewPopup,'requestsToJustify','RequestId')
const justifiedHistoryTable = new Table('justifiedHistoryTable',["RequestId","RequesterName","Purpose","Status","DateOfTrip","TimeOfTrip"],RequestHistoryPreviewPopup,'justifiedRequests','RequestId')
