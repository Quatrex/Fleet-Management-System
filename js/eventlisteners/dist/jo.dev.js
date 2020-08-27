"use strict";

var requestsToJustifyStore = new Store('requestsToJustify', networkManager);
var justifiedRequestsStore = new Store('justifiedRequests', networkManager);
var vehicleStore = new Store('vehicles', networkManager, 'RegistrationNo', 'RegistrationNo');
var JustifyRequestAlertClose = new DisplayNextButton('JustifyRequestAlert_Close');
var JustifyRequestAlertCancel = new DisplayNextButton('JustifyRequestAlert_Cancel');
var JustifyRequestAlertSelectVehicle = new DisplayNextButton('JustifyRequestAlert_SelectVehicle', {}, [ObjectCreate]);
var JustifyRequestAlertJustify = new ValidatorButton('JustifyRequestAlert_Justify', {}, [ObjectCreate, FormValidate, BackendAccess('JOJustify', ActionCreator([requestsToJustifyStore, justifiedRequestsStore], 'DELETE&ADD'))]);
var JustifyRequestAlertPopup = new Popup('JustifyRequestAlertPopup', [JustifyRequestAlertCancel, JustifyRequestAlertClose, JustifyRequestAlertJustify, JustifyRequestAlertSelectVehicle]);
JustifyRequestAlertPopup.setDataType('value'); //Select Vehicle

var SelectVehicleAlertClose = new DisplayNextButton('SelectVehicleAlert_Close', JustifyRequestAlertPopup);
var SelectVehicleAlertBack = new DisplayNextButton('SelectVehicleAlert_Goback', JustifyRequestAlertPopup);
var SelectVehicleAlertConfirm = new DisplayNextButton('SelectVehicleAlert_Confirm', JustifyRequestAlertPopup, [ObjectCreate], {
  disabled: 'true'
});
var SelectionVehicleTable = new SelectionTable('selectionVehicleTable', {}, vehicleStore, 'selectionVehicleTemplate', SelectVehicleAlertConfirm, 'JOSelectedVehicle');
var SelectVehicleAlertPopup = new Popup('SelectVehicleAlertPopup', [SelectVehicleAlertBack, SelectVehicleAlertClose, SelectVehicleAlertConfirm], ['click'], {}, SelectionVehicleTable);
JustifyRequestAlertSelectVehicle.setNext(SelectVehicleAlertPopup); //JO

var DeclineRequestAlertClose = new DisplayNextButton('DeclineRequestAlert_Close');
var DeclineRequestAlertCancel = new DisplayNextButton('DeclineRequestAlert_Cancel');
var DeclineRequestAlertDecline = new ValidatorButton('DeclineRequestAlert_Decline', {}, [ObjectCreate, FormValidate, BackendAccess('JODeny', ActionCreator([requestsToJustifyStore, justifiedRequestsStore], 'DELETE&ADD'))]);
var DeclineRequestAlertPopup = new Popup('DeclineRequestAlertPopup', [DeclineRequestAlertCancel, DeclineRequestAlertClose, DeclineRequestAlertDecline]);
var RequestJustifyPreviewClose = new DisplayNextButton('RequestJustifyPreview_Close');
var RequestJustifyPreviewApprove = new DisplayNextButton('RequestJustifyPreview_Approve', JustifyRequestAlertPopup);
var RequestJustifyPreviewDecline = new DisplayNextButton('RequestJustifyPreview_Decline', DeclineRequestAlertPopup);
var RequestJustifyPreviewPopup = new Popup('RequestJustifyPreviewPopup', [RequestJustifyPreviewApprove, RequestJustifyPreviewClose, RequestJustifyPreviewDecline]);
JustifyRequestAlertCancel.setNext(RequestJustifyPreviewPopup);
DeclineRequestAlertCancel.setNext(RequestJustifyPreviewPopup);
var justifyRequestContainer = new DOMContainer('justifyAwaitingRequestContainer', RequestJustifyPreviewPopup, requestsToJustifyStore, 'awaitingRequestCardTemplate');
var justifiedRequestContainer = new DOMContainer('justifiedAwaitingRequestContainer', RequestHistoryPreviewPopup, justifiedRequestsStore, 'awaitingRequestCardTemplate');
var justifyRequestContainerTab = new DOMTabContainer('JustifyRequestsSecTab', justifyRequestContainer);
var justifiedRequestContainerTab = new DOMTabContainer('JustifiedHistorySecTab', justifiedRequestContainer);
var justifyRequestContainerTabButton = new SecondaryTabButton('JustifyRequestsSecLink', justifyRequestContainerTab);
var justifiedRequestContainerTabButton = new SecondaryTabButton('JustifiedHistorySecLink', justifiedRequestContainerTab);
var justifyTab = new SecondaryTab('AwaitingRequestsSecTab', [justifyRequestContainerTabButton, justifiedRequestContainerTabButton], justifyRequestContainerTabButton);
requesterTab.removeFromDOM();
var requesterTabButton = new MainTabButton('MyRequestsMainLink', 'MyRequestsMainTab', requesterTab);
var justifyTabButton = new MainTabButton('AwaitingRequestsMainLink', 'AwaitingRequestsMainTab', justifyTab);
var joMainTab = new MainTab('mainNavBarContainer', [justifyTabButton, requesterTabButton], requesterTabButton);
requestsToJustifyStore.addObservers(justifyRequestContainer);
justifiedRequestsStore.addObservers(justifiedRequestContainer);
vehicleStore.addObservers(SelectionVehicleTable);