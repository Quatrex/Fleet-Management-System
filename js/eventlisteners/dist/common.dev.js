"use strict";

var requestsByMeStore = new Store('requestsByMe');
var ongoingRequestsStore = new Store('ongoingRequests');
var pastRequestsStore = new Store('pastRequests');
var CancelRequestAlertClose = new DisplayNextButton('CancelRequestAlert_Close');
var CancelRequestAlertCancel = new DisplayNextButton('CancelRequestAlert_Cancel');
var CancelRequestAlertConfirm = new DisplayNextButton('CancelRequestAlert_Confirm', {}, [RemoveAllPopup]);
var CancelRequestAlertPopup = new Popup('CancelRequestAlertPopup', [CancelRequestAlertClose, CancelRequestAlertCancel, CancelRequestAlertConfirm]);
var CancelAddedRequestAlertClose = new DisplayNextButton('CancelAddedRequestAlert_Close');
var CancelAddedRequestAlertCancel = new DisplayNextButton('CancelAddedRequestAlert_Cancel');
var CancelAddedRequestAlertConfirm = new DisplayNextButton('CancelAddedRequestAlert_Confirm', {}, [ObjectCreate, BackendAccess('CancelRequest', ActionCreator([requestsByMeStore, pastRequestsStore], "DELETE&ADD")), RemoveAllPopup]);
var CancelAddedRequestAlertPopup = new Popup('CancelAddedRequestAlertPopup', [CancelAddedRequestAlertClose, CancelAddedRequestAlertCancel, CancelAddedRequestAlertConfirm]);
var NewRequestPreviewClose = new DisplayAlertButton('NewRequestPreview_Close', CancelRequestAlertPopup);
var NewRequestPreviewEdit = new DisplayNextButton('NewRequestPreview_Edit');
var NewRequestPreviewConfirm = new DisplayNextButton('NewRequestPreview_Confirm', {}, [BackendAccess('RequestAdd', ActionCreator([requestsByMeStore], "ADD"))]);
var NewRequestPreviewPopup = new Popup('NewRequestPreviewPopup', [NewRequestPreviewClose, NewRequestPreviewConfirm, NewRequestPreviewEdit]); //cancel request next setup

var VehicleRequestFormClose = new DisplayAlertCheckButton('VehicleRequestForm_Close', CancelRequestAlertPopup);
var VehicleRequestFormCancel = new DisplayAlertCheckButton('VehicleRequestForm_Cancel', CancelRequestAlertPopup);
var VehicleRequestFormSubmit = new ValidatorButton('VehicleRequestForm_Submit', NewRequestPreviewPopup, [ObjectCreate, FormValidate, DateValidator]);
var VehicleRequestFormPopup = new Popup('VehicleRequestForm', [VehicleRequestFormCancel, VehicleRequestFormClose, VehicleRequestFormSubmit]);
NewRequestPreviewEdit.setNext(VehicleRequestFormPopup);
VehicleRequestFormPopup.setDataType('value');
var DriverDetailPopupClose = new DisplayNextButton('DriverDetailPopup_Close');
var DriverDetailPopup = new Popup('DriverDetailPopup', [DriverDetailPopupClose]);
var VehicleDetailPopupClose = new DisplayNextButton('VehicleDetailPopup_Close');
var VehicleDetailPopup = new Popup('VehicleDetailPopup', [VehicleDetailPopupClose]);
var OngoingRequestPreviewClose = new DisplayNextButton('OngoingRequestPreview_Close');
var OngoingRequestPreviewRequestCancel = new DisplayAlertButton('OngoingRequestPreviewRequestCancel', CancelAddedRequestAlertPopup);
var OngoingRequestPreviewDriverDetial = new DisplayAlertButton('Info_Driver_OngoingRequestPreview', DriverDetailPopup);
var OngoingRequestPreviewVehicleDetail = new DisplayAlertButton('Info_Vehicle_OngoingRequestPreview', VehicleDetailPopup);
var OngoingRequestPreviewPopup = new Popup('OngoingRequestPreviewPopup', [OngoingRequestPreviewClose, OngoingRequestPreviewRequestCancel, OngoingRequestPreviewDriverDetial, OngoingRequestPreviewVehicleDetail], ['click'], {
  'Vehicle': ['RegistrationNo'],
  'Driver': ['FirstName', 'LastName']
});
DriverDetailPopupClose.setNext(OngoingRequestPreviewPopup);
VehicleDetailPopupClose.setNext(OngoingRequestPreviewPopup);
var PendingRequestPreviewClose = new DisplayNextButton('PendingRequestPreview_Close');
var PendingRequestPreviewRequestCancel = new DisplayAlertButton('PendingRequestPreviewRequestCancel', CancelAddedRequestAlertPopup);
var PendingRequestPreviewPopup = new Popup('PendingRequestPreviewPopup', [PendingRequestPreviewClose, PendingRequestPreviewRequestCancel]);
var RequestHistoryPreviewClose = new DisplayNextButton('RequestHistoryPreview_Close');
var RequestHistoryPreviewPopup = new Popup('RequestHistoryPreviewPopup', [RequestHistoryPreviewClose], ['click'], {
  'Vehicle': ['registration'],
  'Driver': ['firstName', 'lastName']
});
var ChangeProfilePicturePopupClose = new DisplayNextButton('ChangeProfilePictureForm_Close');
var ChangeProfilePicturePopupCancel = new DisplayNextButton('ChangeProfilePictureForm_Cancel');
var ChangeProfilePicturePopupSubmit = new DisplayNextButton('ChangeProfilePictureForm_Submit', {}, [ObjectCreate, BackendAccessWithPicture('ChangeProfilePicture')]);
var ChangeProfilePicturePopup = new Popup('ChangeProfilePictureForm', [ChangeProfilePicturePopupClose, ChangeProfilePicturePopupCancel, ChangeProfilePicturePopupSubmit]);
var UserProfilePopupClose = new DisplayNextButton('UserProfilePopup_Close');
var UserProfilePictureChange = new DisplayNextButton('change-profile-picture-button', ChangeProfilePicturePopup);
var UserProfilePopup = new Popup('UserProfilePopup', [UserProfilePopupClose, UserProfilePictureChange]);
var NewRequestButton = new DOMButton('NewRequestButton', VehicleRequestFormPopup);
var UserProfileEditButton = new DOMButton('UserProfileEditButton', UserProfilePopup);
var pendingRequestTable = new DOMContainer('pendingRequestsContainer', PendingRequestPreviewPopup, requestsByMeStore, "cardTemplate");
var ongoingRequestTable = new DOMContainer('ongoingRequestsContainer', OngoingRequestPreviewPopup, ongoingRequestsStore, "cardTemplate");
var requestHistoryTable = new DOMContainer('pastRequestsContainer', RequestHistoryPreviewPopup, pastRequestsStore, "cardTemplate");
var pendingRequestTab = new DOMTabContainer('PendingRequestsSecTab', pendingRequestTable);
var ongoingRequestTab = new DOMTabContainer('OngoingRequestsSecTab', ongoingRequestTable);
var requestHistoryTab = new DOMTabContainer('HistorySecTab', requestHistoryTable);
var pendingRequestTabButton = new SecondaryTabButton('PendingRequestsSecLink', pendingRequestTab);
var ongoingRequestTabButton = new SecondaryTabButton('OngoingRequestsSecLink', ongoingRequestTab);
var requestHistoryTabButton = new SecondaryTabButton('HistorySecLink', requestHistoryTab);
var requesterTab = new SecondaryTab('MyRequestsSecTab', [pendingRequestTabButton, ongoingRequestTabButton, requestHistoryTabButton], pendingRequestTabButton);
requesterTab.render();
requestsByMeStore.addObservers(pendingRequestTable);
ongoingRequestsStore.addObservers(ongoingRequestTable);
pastRequestsStore.addObservers(requestHistoryTable);

var readURL = function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $("#".concat(input.dataset.imageid)).attr('src', e.target.result);
    };

    console.log("#".concat(input.dataset.imageid));
    reader.readAsDataURL(input.files[0]);
  }
};

$(".file-upload").on('change', function () {
  readURL(this);
});
$(".upload-button").on('click', function () {
  $(".file-upload").click();
});