const networkManager = new NetworkManager();
const requestsByMeStore = new Store('requestsByMe',networkManager);
const ongoingRequestsStore = new Store('ongoingRequests',networkManager);
const pastRequestsStore = new Store('pastRequests',networkManager);
const UserStore = new User();

const CancelRequestAlertClose = new DisplayNextButton('CancelRequestAlert_Close');
const CancelRequestAlertCancel = new DisplayNextButton('CancelRequestAlert_Cancel');
const CancelRequestAlertConfirm = new DisplayNextButton('CancelRequestAlert_Confirm', {}, [RemoveAllPopup])
const CancelRequestAlertPopup = new Popup('CancelRequestAlertPopup', [CancelRequestAlertClose, CancelRequestAlertCancel, CancelRequestAlertConfirm]);

const CancelAddedRequestAlertClose = new DisplayNextButton('CancelAddedRequestAlert_Close');
const CancelAddedRequestAlertCancel = new DisplayNextButton('CancelAddedRequestAlert_Cancel');
const CancelAddedRequestAlertConfirm = new BackendAcessButton('CancelAddedRequestAlert_Confirm','CancelRequest', [ObjectCreate], ActionCreator([requestsByMeStore, pastRequestsStore], "DELETE&ADD"))
const CancelAddedRequestAlertPopup = new Popup('CancelAddedRequestAlertPopup', [CancelAddedRequestAlertClose, CancelAddedRequestAlertCancel, CancelAddedRequestAlertConfirm]);

const NewRequestPreviewClose = new DisplayAlertButton('NewRequestPreview_Close', CancelRequestAlertPopup)
const NewRequestPreviewEdit = new DisplayNextButton('NewRequestPreview_Edit')
const NewRequestPreviewConfirm = new BackendAcessButton('NewRequestPreview_Confirm', 'RequestAdd', [], ActionCreator([requestsByMeStore], "ADD"))
const NewRequestPreviewPopup = new Popup('NewRequestPreviewPopup', [NewRequestPreviewClose, NewRequestPreviewConfirm, NewRequestPreviewEdit]);
//cancel request next setup

const VehicleRequestFormClose = new DisplayAlertCheckButton('VehicleRequestForm_Close', CancelRequestAlertPopup)
const VehicleRequestFormCancel = new DisplayAlertCheckButton('VehicleRequestForm_Cancel', CancelRequestAlertPopup)
const VehicleRequestFormSubmit = new ValidatorButton('VehicleRequestForm_Submit', NewRequestPreviewPopup, [ObjectCreate, FormValidate, DateValidator]);
const VehicleRequestFormPopup = new Popup('VehicleRequestForm', [VehicleRequestFormCancel, VehicleRequestFormClose, VehicleRequestFormSubmit],['click']);
NewRequestPreviewEdit.setNext(VehicleRequestFormPopup);
VehicleRequestFormPopup.setDataType('value');

const DriverDetailPopupClose = new DisplayNextButton('DriverDetailPopup_Close')
const DriverDetailPopup = new Popup('DriverDetailPopup', [DriverDetailPopupClose]);

const VehicleDetailPopupClose = new DisplayNextButton('VehicleDetailPopup_Close')
const VehicleDetailPopup = new Popup('VehicleDetailPopup', [VehicleDetailPopupClose]);

const OngoingRequestPreviewClose = new DisplayNextButton('OngoingRequestPreview_Close')
const OngoingRequestPreviewDriverDetial = new DisplayAlertButton('Info_Driver_OngoingRequestPreview', DriverDetailPopup)
const OngoingRequestPreviewVehicleDetail = new DisplayAlertButton('Info_Vehicle_OngoingRequestPreview', VehicleDetailPopup)
const OngoingRequestPreviewPopup = new Popup('OngoingRequestPreviewPopup', [OngoingRequestPreviewClose, OngoingRequestPreviewDriverDetial, OngoingRequestPreviewVehicleDetail], ['click'], { 'Vehicle': ['RegistrationNo'], 'Driver': ['FirstName', 'LastName'] });
DriverDetailPopupClose.setNext(OngoingRequestPreviewPopup);
VehicleDetailPopupClose.setNext(OngoingRequestPreviewPopup);


const PendingRequestPreviewClose = new DisplayNextButton('PendingRequestPreview_Close');
const PendingRequestPreviewRequestCancel = new DisplayAlertButton('PendingRequestPreviewRequestCancel', CancelAddedRequestAlertPopup);
const PendingRequestPreviewPopup = new Popup('PendingRequestPreviewPopup', [PendingRequestPreviewClose, PendingRequestPreviewRequestCancel]);

const RequestHistoryPreviewClose = new DisplayNextButton('RequestHistoryPreview_Close');
const RequestHistoryPreviewPopup = new Popup('RequestHistoryPreviewPopup', [RequestHistoryPreviewClose], ['click'], { 'Vehicle': ['RegistrationNo'], 'Driver': ['FirstName', 'LastName'] });

const ChangeProfilePicturePopupClose = new DisplayNextButton('ChangeProfilePictureForm_Close');
const ChangeProfilePicturePopupCancel = new DisplayNextButton('ChangeProfilePictureForm_Cancel');
const ChangeProfilePicturePopupSubmit = new BackendAcessButton('ChangeProfilePictureForm_Submit', 'ChangeProfilePicture', [ObjectCreate], ActionCreator([UserStore], "UPDATE"),'PHOTO');
const ChangeProfilePicturePopup = new Popup('ChangeProfilePictureForm', [ChangeProfilePicturePopupClose, ChangeProfilePicturePopupCancel, ChangeProfilePicturePopupSubmit]);


const ChangePasswordPopupClose = new DisplayNextButton('ChangePasswordForm_Close');
const ChangePasswordPopupCancel = new DisplayNextButton('ChangePasswordForm_Cancel');
const ChangePasswordPopupSubmit = new BackendAcessButton('ChangePasswordForm_Submit', 'ChangePassword', [ObjectCreate, FormValidate]);
const ChangePasswordPopup = new Popup('ChangePasswordForm', [ChangePasswordPopupClose, ChangePasswordPopupCancel, ChangePasswordPopupSubmit]);

const UserProfilePopupClose = new DisplayNextButton('UserProfilePopup_Close');
const UserProfilePictureChange = new DisplayNextButton('UserProfilePictureChange', ChangeProfilePicturePopup);
const UserPasswordChange = new DisplayNextButton('UserPasswordChange', ChangePasswordPopup);
const UserProfilePopup = new Popup('UserProfilePopup', [UserProfilePopupClose, UserProfilePictureChange, UserPasswordChange]);
ChangeProfilePicturePopupClose.setNext(UserProfilePopup);
ChangeProfilePicturePopupCancel.setNext(UserProfilePopup);
ChangeProfilePicturePopupSubmit.setNext(UserProfilePopup);


const NewRequestButton = new DOMButton('NewRequestButton', VehicleRequestFormPopup)
const UserProfileEditButton = new DOMButton('UserProfileEditButton', UserProfilePopup)
const pendingRequestTable = new DOMContainer('pendingRequestsContainer', PendingRequestPreviewPopup, requestsByMeStore, "cardTemplate");
const ongoingRequestTable = new DOMContainer('ongoingRequestsContainer', OngoingRequestPreviewPopup, ongoingRequestsStore, "cardTemplate");
const requestHistoryTable = new DOMContainer('pastRequestsContainer', RequestHistoryPreviewPopup, pastRequestsStore, "cardTemplate");

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

var readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $(`#${input.dataset.imageid}`).attr('src', e.target.result);
        }
        console.log(`#${input.dataset.imageid}`);
        reader.readAsDataURL(input.files[0]);
    }
}

$(".file-upload").on('change', function() {
    readURL(this);
});

$(".upload-button").on('click', function() {
    $(".file-upload").click();
});

