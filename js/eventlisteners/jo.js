//Fields
const justifyRequestCard_Fields = ["RequesterName","Designation","Purpose","DateOfTrip","TimeOfTrip","PickLocation","DropLocation"]
const justifiedHistoryCard_Fields = ["RequesterName","Designation","Purpose","DateOfTrip","TimeOfTrip","PickLocation","DropLocation"]

const requestsToJustifyStore = new Store('requestsToJustify');
const justifiedRequestsStore = new Store('justifiedRequests');



//JO
const JustifyRequestAlertClose = new DisplayNextButton('JustifyRequestAlert_Close')
const JustifyRequestAlertCancel = new DisplayNextButton('JustifyRequestAlert_Cancel');
const JustifyRequestAlertJustify = new DisplayNextButton('JustifyRequestAlert_Justify',{},[ObjectCreate,BackendAccess('JOJustify',ActionCreator([requestsToJustifyStore,justifiedRequestsStore],"DELETE&ADD"))]);
const JustifyRequestAlertPopup = new Popup('JustifyRequestAlertPopup',[JustifyRequestAlertCancel,JustifyRequestAlertClose,JustifyRequestAlertJustify]);

const DeclineRequestAlertClose = new DisplayNextButton('DeclineRequestAlert_Close')
const DeclineRequestAlertCancel = new DisplayNextButton('DeclineRequestAlert_Cancel')
const DeclineRequestAlertDecline = new DisplayNextButton('DeclineRequestAlert_Decline',{},[ObjectCreate,BackendAccess('JODeny',ActionCreator([requestsToJustifyStore,justifiedRequestsStore],"DELETE&ADD"))]);
const DeclineRequestAlertPopup = new Popup('DeclineRequestAlertPopup',[DeclineRequestAlertCancel,DeclineRequestAlertClose,DeclineRequestAlertDecline]);

const RequestJustifyPreviewClose = new DisplayNextButton('RequestJustifyPreview_Close')
const RequestJustifyPreviewApprove = new DisplayNextButton('RequestJustifyPreview_Approve',JustifyRequestAlertPopup)
const RequestJustifyPreviewDecline = new DisplayNextButton('RequestJustifyPreview_Decline',DeclineRequestAlertPopup);
const RequestJustifyPreviewPopup = new Popup('RequestJustifyPreviewPopup',[RequestJustifyPreviewApprove,RequestJustifyPreviewClose,RequestJustifyPreviewDecline]);
JustifyRequestAlertCancel.setNext(RequestJustifyPreviewPopup);
DeclineRequestAlertCancel.setNext(RequestJustifyPreviewPopup);

const justifyRequestContainer = new DOMContainer('justifyAwaitingRequestCard',justifyRequestCard_Fields,RequestJustifyPreviewPopup,'RequestId',requestsToJustifyStore,"awaitingRequestCardTemplate")
const justifiedRequestContainer = new DOMContainer('justifiedAwaitingRequestCard',justifiedHistoryCard_Fields,RequestHistoryPreviewPopup,'RequestId',justifiedRequestsStore,"awaitingRequestCardTemplate")

const justifyRequestContainerTab = new DOMTabContainer('JustifyRequestsSecTab',justifyRequestContainer);
const justifiedRequestContainerTab = new DOMTabContainer('JustifiedHistorySecTab',justifiedRequestContainer);

const justifyRequestContainerTabButton = new SecondaryTabButton('JustifyRequestsSecLink',justifyRequestContainerTab);
const justifiedRequestContainerTabButton = new SecondaryTabButton('JustifiedHistorySecLink',justifiedRequestContainerTab);

const justifyTab = new SecondaryTab('AwaitingRequestsSecTab',[justifyRequestContainerTabButton,justifiedRequestContainerTabButton],justifyRequestContainerTabButton);
requesterTab.removeFromDOM();

const requesterTabButton = new MainTabButton('MyRequestsMainLink','MyRequestsMainTab',requesterTab);
const justifyTabButton = new MainTabButton('AwaitingRequestsMainLink','AwaitingRequestsMainTab',justifyTab);

const joMainTab = new MainTab('mainNavBarContainer',[justifyTabButton,requesterTabButton],requesterTabButton)


requestsToJustifyStore.addObservers(justifyRequestContainer)
justifiedRequestsStore.addObservers(justifiedRequestContainer)
