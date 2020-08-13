
//Fields
const approveRequestCard_Fields = ["RequesterName","Designation","Purpose","DateOfTrip","TimeOfTrip","PickLocation","DropLocation"]
const approvedHistoryCard_Fields = ["RequesterName","Designation","Purpose","DateOfTrip","TimeOfTrip","PickLocation",]

const requestsToApproveStore = new Store('requestsToApprove');
const approvedRequestsStore = new Store('approvedRequests');


//CAO
const ApproveRequestAlertClose = new DisplayAlertButton('ApproveRequestAlert_Close', CancelRequestAlertPopup)
const ApproveRequestAlertCancel = new DisplayNextButton('ApproveRequestAlert_Cancel')
const ApproveRequestAlertApprove = new ValidatorButton('ApproveRequestAlert_Approve',{},[ObjectCreate,FormValidate,BackendAccess('CAOApprove',ActionCreator([requestsToApproveStore,approvedRequestsStore],"DELETE&ADD"))]);
const ApproveRequestAlertPopup = new Popup('ApproveRequestAlertPopup',[ApproveRequestAlertCancel,ApproveRequestAlertClose,ApproveRequestAlertApprove]);

const DenyRequestAlertClose = new DisplayAlertButton('DenyRequestAlert_Close', CancelRequestAlertPopup)
const DenyRequestAlertCancel = new DisplayNextButton('DenyRequestAlert_Cancel')
const DenyRequestAlertDeny = new ValidatorButton('DenyRequestAlert_Decline',{},[ObjectCreate,FormValidate,BackendAccess('CAODeny',ActionCreator([requestsToApproveStore,approvedRequestsStore],"DELETE&ADD"))]);
const DenyRequestAlertPopup = new Popup('DenyRequestAlertPopup',[DenyRequestAlertCancel,DenyRequestAlertClose,DenyRequestAlertDeny]);

const RequestApprovePreviewClose = new DisplayNextButton('RequestApprovePreview_Close')
const RequestApprovePreviewApprove = new DisplayNextButton('RequestApprovePreview_Approve',ApproveRequestAlertPopup)
const RequestApprovePreviewDecline = new DisplayNextButton('RequestApprovePreview_Decline',DenyRequestAlertPopup);
const RequestApprovePreviewPopup = new Popup('RequestApprovePreviewPopup',[RequestApprovePreviewApprove,RequestApprovePreviewClose,RequestApprovePreviewDecline]);
ApproveRequestAlertCancel.setNext(RequestApprovePreviewPopup);
DenyRequestAlertCancel.setNext(RequestApprovePreviewPopup);

const approveRequestContainer = new DOMContainer('approveAwaitingRequestCard',approveRequestCard_Fields,RequestApprovePreviewPopup,requestsToApproveStore,"awaitingRequestCardTemplate")
const approvedHistoryContainer = new DOMContainer('approvedAwaitingRequestCard',approvedHistoryCard_Fields,RequestHistoryPreviewPopup, approvedRequestsStore,"awaitingRequestCardTemplate")


const approveRequestContainerTab = new DOMTabContainer('ApproveRequestsSecTab',approveRequestContainer);
const approvedHistoryContainerTab = new DOMTabContainer('ApprovedHistorySecTab',approvedHistoryContainer);

const approveRequestContainerTabButton = new SecondaryTabButton('ApproveRequestsSecLink',approveRequestContainerTab);
const approvedHistoryContainerTabButton = new SecondaryTabButton('ApprovedHistorySecLink',approvedHistoryContainerTab);

const approveTab = new SecondaryTab('AwaitingRequestsSecTab',[approveRequestContainerTabButton,approvedHistoryContainerTabButton],approveRequestContainerTabButton);
requesterTab.removeFromDOM();

const approveTabButton = new MainTabButton('AwaitingRequestsMainLink','AwaitingRequestsMainTab',approveTab);
const requesterTabButton = new MainTabButton('MyRequestsMainLink','MyRequestsMainTab',requesterTab);

const caoMainTab = new MainTab('mainNavBarContainer',[approveTabButton,requesterTabButton],requesterTabButton)


requestsToApproveStore.addObservers(approveRequestContainer)
approvedRequestsStore.addObservers(approvedHistoryContainer)

