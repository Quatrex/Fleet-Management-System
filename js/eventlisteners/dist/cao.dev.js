"use strict";

var requestsToApproveStore = new Store('requestsToApprove', networkManager);
var approvedRequestsStore = new Store('approvedRequests', networkManager); //CAO

var ApproveRequestAlertClose = new DisplayAlertButton('ApproveRequestAlert_Close', CancelRequestAlertPopup);
var ApproveRequestAlertCancel = new DisplayNextButton('ApproveRequestAlert_Cancel');
var ApproveRequestAlertApprove = new ValidatorButton('ApproveRequestAlert_Approve', {}, [ObjectCreate, FormValidate, BackendAccess('CAOApprove', ActionCreator([requestsToApproveStore, approvedRequestsStore], "DELETE&ADD"))]);
var ApproveRequestAlertPopup = new Popup('ApproveRequestAlertPopup', [ApproveRequestAlertCancel, ApproveRequestAlertClose, ApproveRequestAlertApprove]);
var DenyRequestAlertClose = new DisplayAlertButton('DenyRequestAlert_Close', CancelRequestAlertPopup);
var DenyRequestAlertCancel = new DisplayNextButton('DenyRequestAlert_Cancel');
var DenyRequestAlertDeny = new ValidatorButton('DenyRequestAlert_Decline', {}, [ObjectCreate, FormValidate, BackendAccess('CAODeny', ActionCreator([requestsToApproveStore, approvedRequestsStore], "DELETE&ADD"))]);
var DenyRequestAlertPopup = new Popup('DenyRequestAlertPopup', [DenyRequestAlertCancel, DenyRequestAlertClose, DenyRequestAlertDeny]);
var RequestApprovePreviewClose = new DisplayNextButton('RequestApprovePreview_Close');
var RequestApprovePreviewApprove = new DisplayNextButton('RequestApprovePreview_Approve', ApproveRequestAlertPopup);
var RequestApprovePreviewDecline = new DisplayNextButton('RequestApprovePreview_Decline', DenyRequestAlertPopup);
var RequestApprovePreviewPopup = new Popup('RequestApprovePreviewPopup', [RequestApprovePreviewApprove, RequestApprovePreviewClose, RequestApprovePreviewDecline]);
ApproveRequestAlertCancel.setNext(RequestApprovePreviewPopup);
DenyRequestAlertCancel.setNext(RequestApprovePreviewPopup);
var approveRequestContainer = new DOMContainer('approveAwaitingRequestContainer', RequestApprovePreviewPopup, requestsToApproveStore, "awaitingRequestCardTemplate");
var approvedHistoryContainer = new DOMContainer('approvedAwaitingRequestContainer', RequestHistoryPreviewPopup, approvedRequestsStore, "awaitingRequestCardTemplate");
var approveRequestContainerTab = new DOMTabContainer('ApproveRequestsSecTab', approveRequestContainer);
var approvedHistoryContainerTab = new DOMTabContainer('ApprovedHistorySecTab', approvedHistoryContainer);
var approveRequestContainerTabButton = new SecondaryTabButton('ApproveRequestsSecLink', approveRequestContainerTab);
var approvedHistoryContainerTabButton = new SecondaryTabButton('ApprovedHistorySecLink', approvedHistoryContainerTab);
var approveTab = new SecondaryTab('AwaitingRequestsSecTab', [approveRequestContainerTabButton, approvedHistoryContainerTabButton], approveRequestContainerTabButton);
requesterTab.removeFromDOM();
var approveTabButton = new MainTabButton('AwaitingRequestsMainLink', 'AwaitingRequestsMainTab', approveTab);
var requesterTabButton = new MainTabButton('MyRequestsMainLink', 'MyRequestsMainTab', requesterTab);
var caoMainTab = new MainTab('mainNavBarContainer', [approveTabButton, requesterTabButton], requesterTabButton);
requestsToApproveStore.addObservers(approveRequestContainer);
approvedRequestsStore.addObservers(approvedHistoryContainer);