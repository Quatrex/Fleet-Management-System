//##############           Header         ###################
//Row
document.querySelector("#request-table").onclick = (event) => {
    let tableRow = event.target.parentElement;
    console.log(tableRow);
    document.getElementById('request-preview-popup_1').style.display = 'block';
}

//##############           Header         ###################
//user name text-click
document.querySelector('.user-img').addEventListener('click', () => {
    document.getElementById('my-profile').style.display = 'block';
});

//navigation menu link-click
document.querySelectorAll('.navigation-link').forEach(function(navlink) {
    navlink.addEventListener('click', () => {
        document.querySelector(".underline").style.transform = 'translate3d(' + navlink.dataset.index * 100 + '%,0,0)';
    });
});


//##############           Content         ###################

//Request vehicle button -click
document.querySelector('#request-vehicle-button').addEventListener('click', () => {
    document.getElementById('vehicle-request-form').style.display = 'block';
});


//##############           My profile pop up         ###################

//close button-click
document.querySelector('#my-profile-close').addEventListener('click', () => {
    document.getElementById('my-profile').style.display = 'none';
});


//##############          Vehicle request form pop up         ###################

//x button-click
document.querySelector('#vehicle-request-form-close').addEventListener('click', () => {
    document.getElementById('cancel-request-alert').style.display = 'block';
});

//close button-click
document.querySelector('#request-form-close-button').addEventListener('click', () => {
    document.getElementById('cancel-request-alert').style.display = 'block';
});

//submit button-click
document.querySelector('#request-form-submit-button').addEventListener('click', () => {
    document.getElementById('vehicle-request-form').style.display = 'none';
    document.getElementById('request-preview-popup').style.display = 'block';
});


//##############          Vehicle request preview pop up         ###################

//x button-click
document.querySelector('#request-preview-close').addEventListener('click', () => {
    document.getElementById('cancel-request-alert').style.display = 'none';
});
document.querySelector('#request-preview-close_1').addEventListener('click', () => {
    document.getElementById('request-preview-popup_1').style.display = 'none';
});

//edit button-click
document.querySelector('#request-preview-edit-button').addEventListener('click', () => {
    document.getElementById('request-preview-popup').style.display = 'none';
    document.getElementById('vehicle-request-form').style.display = 'block';
});

//confirm button-click
document.querySelector('#request-preview-confirm-button').addEventListener('click', () => {
    document.getElementById('request-preview-popup').style.display = 'none';
    document.getElementById('request-details-popup').style.display = 'block';
});


//##############          Vehicle request details pop up         ###################

//x button-click
document.querySelector('#request-details-close').addEventListener('click', () => {
    document.getElementById('request-details-popup').style.display = 'none';
});

//exit button-click
document.querySelector('#request-details-exit-button').addEventListener('click', () => {
    document.getElementById('request-details-popup').style.display = 'none';
});


//##############          Confirm alert         ###################

//x button-click
document.querySelector('#confirm-alert-close').addEventListener('click', () => {
    document.getElementById('cancel-request-alert').style.display = 'none';
});

//no button-click
document.querySelector('#confirm-alert-no-button').addEventListener('click', () => {
    document.getElementById('cancel-request-alert').style.display = 'none';
});

//yes button-click
document.querySelector('#confirm-alert-yes-button').addEventListener('click', () => {
    document.querySelectorAll('.popup').forEach((popup) => {
        popup.style.display = 'none';
    });
});