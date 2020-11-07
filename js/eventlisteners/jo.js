const requestsToJustifyStore = new Store('requestsToJustify',networkManager);
const justifiedRequestsStore = new Store('justifiedRequests',networkManager);
const vehicleStore = new Store('vehicles',networkManager,'RegistrationNo','RegistrationNo');


const JustifyRequestAlertClose = new DisplayNextButton('JustifyRequestAlert_Close');
const JustifyRequestAlertCancel = new DisplayNextButton('JustifyRequestAlert_Cancel');
const JustifyRequestAlertSelectVehicle = new DisplayNextButton('JustifyRequestAlert_SelectVehicle', {}, [
	ObjectCreate,
]);
const JustifyRequestAlertJustify = new ValidatorButton('JustifyRequestAlert_Justify', {}, [
	ObjectCreate,FormValidate,
	BackendAccess('JOJustify', ActionCreator([requestsToJustifyStore, justifiedRequestsStore], 'DELETE&ADD')),
]);
const JustifyRequestAlertPopup = new Popup('JustifyRequestAlertPopup', [
	JustifyRequestAlertCancel,
	JustifyRequestAlertClose,
	JustifyRequestAlertJustify,
	JustifyRequestAlertSelectVehicle,
]);
JustifyRequestAlertPopup.setDataType('value');

//Select Vehicle
const SelectVehicleAlertClose = new DisplayNextButton('SelectVehicleAlert_Close',JustifyRequestAlertPopup);
const SelectVehicleAlertBack = new DisplayNextButton('SelectVehicleAlert_Goback',JustifyRequestAlertPopup);
const SelectVehicleAlertConfirm = new DisplayNextButton('SelectVehicleAlert_Confirm', JustifyRequestAlertPopup, [ObjectCreate], {
	disabled: 'true',
});
const SelectionVehicleTable = new SelectionTable(
	'selectionVehicleTable',
	{},
	vehicleStore,
	'selectionVehicleTemplate',
	SelectVehicleAlertConfirm,
	'JOSelectedVehicle'
);
const SelectVehicleAlertPopup = new Popup(
	'SelectVehicleAlertPopup',
	[SelectVehicleAlertBack, SelectVehicleAlertClose, SelectVehicleAlertConfirm],
	['click'],{},
	SelectionVehicleTable
);
JustifyRequestAlertSelectVehicle.setNext(SelectVehicleAlertPopup)

//JO

const DeclineRequestAlertClose = new DisplayNextButton('DeclineRequestAlert_Close');
const DeclineRequestAlertCancel = new DisplayNextButton('DeclineRequestAlert_Cancel');
const DeclineRequestAlertDecline = new ValidatorButton('DeclineRequestAlert_Decline', {}, [
	ObjectCreate,FormValidate,
	BackendAccess('JODeny', ActionCreator([requestsToJustifyStore, justifiedRequestsStore], 'DELETE&ADD')),
]);
const DeclineRequestAlertPopup = new Popup('DeclineRequestAlertPopup', [
	DeclineRequestAlertCancel,
	DeclineRequestAlertClose,
	DeclineRequestAlertDecline,
]);

const RequestJustifyPreviewClose = new DisplayNextButton('RequestJustifyPreview_Close');
const RequestJustifyPreviewApprove = new DisplayNextButton('RequestJustifyPreview_Approve', JustifyRequestAlertPopup);
const RequestJustifyPreviewDecline = new DisplayNextButton('RequestJustifyPreview_Decline', DeclineRequestAlertPopup);
const RequestJustifyPreviewPopup = new Popup('RequestJustifyPreviewPopup', [
	RequestJustifyPreviewApprove,
	RequestJustifyPreviewClose,
	RequestJustifyPreviewDecline,
]);
JustifyRequestAlertCancel.setNext(RequestJustifyPreviewPopup);
DeclineRequestAlertCancel.setNext(RequestJustifyPreviewPopup);

const justifyRequestContainer = new DOMContainer(
	'justifyAwaitingRequestContainer',
	RequestJustifyPreviewPopup,
	requestsToJustifyStore,
	'awaitingRequestCardTemplate',
);
const justifiedRequestContainer = new DOMContainer(
	'justifiedAwaitingRequestContainer',
	RequestHistoryPreviewPopup,
	justifiedRequestsStore,
	'awaitingRequestHistoryCardTemplate',
);
const responsiveMenuToggler = new ResponsiveMenuToggler();
const justifyRequestContainerTab = new DOMTabContainer('JustifyRequestsSecTab', justifyRequestContainer);
const justifiedRequestContainerTab = new DOMTabContainer('JustifiedHistorySecTab', justifiedRequestContainer);

const justifyRequestContainerTabButton = new SecondaryTabButton('JustifyRequestsSecLink', justifyRequestContainerTab);
const justifiedRequestContainerTabButton = new SecondaryTabButton(
	'JustifiedHistorySecLink',
	justifiedRequestContainerTab
);

const justifyTab = new SecondaryTab(
	'AwaitingRequestsSecTab',
	[justifyRequestContainerTabButton, justifiedRequestContainerTabButton],
	justifyRequestContainerTabButton
);
requesterTab.removeFromDOM();

const requesterTabButton = new MainTabButton('MyRequestsMainLink', 'MyRequestsMainTab', requesterTab);
const justifyTabButton = new MainTabButton('AwaitingRequestsMainLink', 'AwaitingRequestsMainTab', justifyTab);

const joMainTab = new MainTab('mainNavBarContainer', [justifyTabButton, requesterTabButton], requesterTabButton);


requestsToJustifyStore.addObservers(justifyRequestContainer);
justifiedRequestsStore.addObservers(justifiedRequestContainer);
vehicleStore.addObservers(SelectionVehicleTable);
