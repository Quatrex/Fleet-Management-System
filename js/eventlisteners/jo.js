//Fields
const justifyRequestCard_Fields = ["RequesterName","Designation","Purpose","DateOfTrip","TimeOfTrip","PickLocation","DropLocation"]
const justifiedHistoryCard_Fields = ["RequesterName","Designation","Purpose","DateOfTrip","TimeOfTrip","PickLocation","DropLocation"]

const awaitingRequestStore = new Store([...requestsToJustify,...justifiedRequests]);



//JO
const JustifyRequestAlertClose = new DisplayNextButton('JustifyRequestAlert_Close')
const JustifyRequestAlertCancel = new DisplayNextButton('JustifyRequestAlert_Cancel');
const JustifyRequestAlertJustify = new DisplayNextButton('JustifyRequestAlert_Justify',{},[ObjectCreate,BackendAccess('JOJustify',[ActionCreator(awaitingRequestStore,"UPDATE")])]);
const JustifyRequestAlertPopup = new Popup('JustifyRequestAlertPopup',[JustifyRequestAlertCancel,JustifyRequestAlertClose,JustifyRequestAlertJustify]);

const DeclineRequestAlertClose = new DisplayNextButton('DeclineRequestAlert_Close')
const DeclineRequestAlertCancel = new DisplayNextButton('DeclineRequestAlert_Cancel')
const DeclineRequestAlertDecline = new DisplayNextButton('DeclineRequestAlert_Decline',{},[ObjectCreate,BackendAccess('JODeny',[ActionCreator(awaitingRequestStore,"UPDATE")])]);
const DeclineRequestAlertPopup = new Popup('DeclineRequestAlertPopup',[DeclineRequestAlertCancel,DeclineRequestAlertClose,DeclineRequestAlertDecline]);

const RequestJustifyPreviewClose = new DisplayNextButton('RequestJustifyPreview_Close')
const RequestJustifyPreviewApprove = new DisplayNextButton('RequestJustifyPreview_Approve',JustifyRequestAlertPopup)
const RequestJustifyPreviewDecline = new DisplayNextButton('RequestJustifyPreview_Decline',DeclineRequestAlertPopup);
const RequestJustifyPreviewPopup = new Popup('RequestJustifyPreviewPopup',[RequestJustifyPreviewApprove,RequestJustifyPreviewClose,RequestJustifyPreviewDecline]);
JustifyRequestAlertCancel.setNext(RequestJustifyPreviewPopup);
DeclineRequestAlertCancel.setNext(RequestJustifyPreviewPopup);

const justifyRequestContainer = new DOMContainer('justifyAwaitingRequestCard',justifyRequestCard_Fields,RequestJustifyPreviewPopup,'requestsToJustify','RequestId',awaitingRequestStore,["Pending"],"awaitingRequestCardTemplate")
const justifiedRequestContainer = new DOMContainer('justifiedAwaitingRequestCard',justifiedHistoryCard_Fields,RequestHistoryPreviewPopup,'justifiedRequests','RequestId',awaitingRequestStore,["Justified","Denied","Approved","Cancelled","Scheduled","Completed"],"awaitingRequestCardTemplate")


awaitingRequestStore.addObservers([justifyRequestContainer,justifiedRequestContainer])
