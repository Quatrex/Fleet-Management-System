//Fields
const pendingRequestTable_Fields = ["Purpose", "Status", "DateOfTrip", "TimeOfTrip", "PickLocation", "DropLocation"]
const ongoingRequestTable_Fields = ["Purpose", "DateOfTrip", "TimeOfTrip", "PickLocation", "DropLocation"]
const requestHistoryTable_Fields = ["Purpose", "Status", "DateOfTrip", "TimeOfTrip", "PickLocation", "DropLocation"]

const requestsByMeStore = new Store('requestsByMe');
const ongoingRequestsStore = new Store('ongoingRequests');
const pastRequestsStore = new Store('pastRequests');


const CancelRequestAlertClose = new DisplayNextButton('CancelRequestAlert_Close');
const CancelRequestAlertCancel = new DisplayNextButton('CancelRequestAlert_Cancel');
const CancelRequestAlertConfirm = new DisplayNextButton('CancelRequestAlert_Confirm', {}, [RemoveAllPopup])
const CancelRequestAlertPopup = new Popup('CancelRequestAlertPopup', [CancelRequestAlertClose, CancelRequestAlertCancel, CancelRequestAlertConfirm]);

const CancelAddedRequestAlertClose = new DisplayNextButton('CancelAddedRequestAlert_Close');
const CancelAddedRequestAlertCancel = new DisplayNextButton('CancelAddedRequestAlert_Cancel');
const CancelAddedRequestAlertConfirm = new DisplayNextButton('CancelAddedRequestAlert_Confirm', {}, [ObjectCreate, BackendAccess('CancelRequest', ActionCreator([requestsByMeStore, pastRequestsStore], "DELETE&ADD")), RemoveAllPopup])
const CancelAddedRequestAlertPopup = new Popup('CancelAddedRequestAlertPopup', [CancelAddedRequestAlertClose, CancelAddedRequestAlertCancel, CancelAddedRequestAlertConfirm]);

const NewRequestPreviewClose = new DisplayAlertButton('NewRequestPreview_Close', CancelRequestAlertPopup)
const NewRequestPreviewEdit = new DisplayNextButton('NewRequestPreview_Edit')
const NewRequestPreviewConfirm = new DisplayNextButton('NewRequestPreview_Confirm', {}, [BackendAccess('RequestAdd', ActionCreator([requestsByMeStore], "ADD"))])
const NewRequestPreviewPopup = new Popup('NewRequestPreviewPopup', [NewRequestPreviewClose, NewRequestPreviewConfirm, NewRequestPreviewEdit]);
//cancel request next setup

const VehicleRequestFormClose = new DisplayAlertButton('VehicleRequestForm_Close', CancelRequestAlertPopup)
const VehicleRequestFormCancel = new DisplayAlertButton('VehicleRequestForm_Cancel', CancelRequestAlertPopup)
const VehicleRequestFormSubmit = new ValidatorButton('VehicleRequestForm_Submit', NewRequestPreviewPopup, [ObjectCreate, FormValidate, DateValidator]);
const VehicleRequestFormPopup = new Popup('VehicleRequestForm', [VehicleRequestFormCancel, VehicleRequestFormClose, VehicleRequestFormSubmit], ['click', 'keyup']);
NewRequestPreviewEdit.setNext(VehicleRequestFormPopup);


const DriverDetailPopupClose = new DisplayNextButton('DriverDetailPopup_Close')
const DriverDetailPopup = new Popup('DriverDetailPopup', [DriverDetailPopupClose]);

const VehicleDetailPopupClose = new DisplayNextButton('VehicleDetailPopup_Close')
const VehicleDetailPopup = new Popup('VehicleDetailPopup', [VehicleDetailPopupClose]);

const OngoingRequestPreviewClose = new DisplayNextButton('OngoingRequestPreview_Close')
const OngoingRequestPreviewRequestCancel = new DisplayAlertButton('OngoingRequestPreviewRequestCancel', CancelAddedRequestAlertPopup)
const OngoingRequestPreviewDriverDetial = new DisplayAlertButton('Info_Driver_OngoingRequestPreview', DriverDetailPopup)
const OngoingRequestPreviewVehicleDetail = new DisplayAlertButton('Info_Vehicle_OngoingRequestPreview', VehicleDetailPopup)
const OngoingRequestPreviewPopup = new Popup('OngoingRequestPreviewPopup', [OngoingRequestPreviewClose, OngoingRequestPreviewRequestCancel, OngoingRequestPreviewDriverDetial, OngoingRequestPreviewVehicleDetail], ['click'], { 'Vehicle': ['registration'], 'Driver': ['firstName', 'lastName'] });
DriverDetailPopupClose.setNext(OngoingRequestPreviewPopup);
VehicleDetailPopupClose.setNext(OngoingRequestPreviewPopup);


const PendingRequestPreviewClose = new DisplayNextButton('PendingRequestPreview_Close');
const PendingRequestPreviewRequestCancel = new DisplayAlertButton('PendingRequestPreviewRequestCancel', CancelAddedRequestAlertPopup);
const PendingRequestPreviewPopup = new Popup('PendingRequestPreviewPopup', [PendingRequestPreviewClose, PendingRequestPreviewRequestCancel]);

const RequestHistoryPreviewClose = new DisplayNextButton('RequestHistoryPreview_Close');
const RequestHistoryPreviewPopup = new Popup('RequestHistoryPreviewPopup', [RequestHistoryPreviewClose], ['click'], { 'Vehicle': ['registration'], 'Driver': ['firstName', 'lastName'] });

const ChangeProfilePicturePopupClose = new DisplayNextButton('ChangeProfilePictureForm_Close');
const ChangeProfilePicturePopupCancel = new DisplayNextButton('ChangeProfilePictureForm_Cancel');
const ChangeProfilePicturePopupSubmit = new DisplayNextButton('ChangeProfilePictureForm_Submit', {}, [ObjectCreate, BackendAccessForPicture('ChangeProfilePicture')]);
const ChangeProfilePicturePopup = new Popup('ChangeProfilePictureForm', [ChangeProfilePicturePopupClose, ChangeProfilePicturePopupCancel, ChangeProfilePicturePopupSubmit]);

const UserProfilePopupClose = new DisplayNextButton('UserProfilePopup_Close');
const UserProfilePictureChange = new DisplayNextButton('change-profile-picture-button', ChangeProfilePicturePopup);
const UserProfilePopup = new Popup('UserProfilePopup', [UserProfilePopupClose, UserProfilePictureChange]);

const NewRequestButton = new DOMButton('NewRequestButton', VehicleRequestFormPopup)
const UserProfileEditButton = new DOMButton('UserProfileEditButton', UserProfilePopup)
const pendingRequestTable = new DOMContainer('pendingRequestsCard', pendingRequestTable_Fields, PendingRequestPreviewPopup, requestsByMeStore, "cardTemplate");
const ongoingRequestTable = new DOMContainer('ongoingRequestsCard', ongoingRequestTable_Fields, OngoingRequestPreviewPopup, ongoingRequestsStore, "cardTemplate");
const requestHistoryTable = new DOMContainer('pastRequestsCard', requestHistoryTable_Fields, RequestHistoryPreviewPopup, pastRequestsStore, "cardTemplate");

const pendingRequestTab = new DOMTabContainer('PendingRequestsSecTab', pendingRequestTable);
const ongoingRequestTab = new DOMTabContainer('OngoingRequestsSecTab', ongoingRequestTable);
const requestHistoryTab = new DOMTabContainer('HistorySecTab', requestHistoryTable);

const pendingRequestTabButton = new SecondaryTabButton('PendingRequestsSecLink', pendingRequestTab);
const ongoingRequestTabButton = new SecondaryTabButton('OngoingRequestsSecLink', ongoingRequestTab);
const requestHistoryTabButton = new SecondaryTabButton('HistorySecLink', requestHistoryTab);

const requesterTab = new SecondaryTab('MyRequestsSecTab', [pendingRequestTabButton, ongoingRequestTabButton, requestHistoryTabButton], pendingRequestTabButton);
requesterTab.render();


requestsByMeStore.addObservers(pendingRequestTable)
ongoingRequestsStore.addObservers(ongoingRequestTable)
pastRequestsStore.addObservers(requestHistoryTable)

function readURL(input, imageid) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#'.concat(imageid)).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

// $('#ChangeProfilePicture').on('change', function() {
//     readURL(this);
// });

$(".file-upload").on('change', function() {
    readURL(this, this.dataset.imageid);
});

$(".upload-button").on('click', function() {
    $(".file-upload").click();
});