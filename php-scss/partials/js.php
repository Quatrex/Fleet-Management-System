<script type="text/javascript">
    console.log('working?');

    document.querySelector("#request-table").onclick = (event) => {
        let tableRow = event.target.parentElement;
        console.log(tableRow);
        document.getElementById('request-preview-popup_1').style.display = 'block';
    }
    document.querySelector('.user-img').addEventListener('click', () => {
        document.getElementById('my-profile').style.display = 'block';
    });
    document.querySelectorAll('.navigation-link').forEach(function(navlink) {
        navlink.addEventListener('click', () => {
            document.querySelector(".underline").style.transform = 'translate3d(' + navlink.dataset.index * 100 + '%,0,0)';
        });
    });
    document.querySelector('#request-vehicle-button').addEventListener('click', () => {
        document.getElementById('vehicle-request-form').style.display = 'block';
    });
    document.querySelector('#my-profile-close').addEventListener('click', () => {
        document.getElementById('my-profile').style.display = 'none';
    });
    document.querySelector('#vehicle-request-form-close').addEventListener('click', () => {
        document.getElementById('cancel-request-alert').style.display = 'block';
    });
    document.querySelector('#request-form-close-button').addEventListener('click', () => {
        document.getElementById('cancel-request-alert').style.display = 'block';
    });
    document.querySelector('#request-form-submit-button').addEventListener('click', () => {
        document.getElementById('vehicle-request-form').style.display = 'none';
        document.getElementById('request-preview-popup').style.display = 'block';
    });

    document.querySelector('#request-preview-close').addEventListener('click', () => {
        document.getElementById('cancel-request-alert').style.display = 'none';
    });
    document.querySelector('#request-preview-close_1').addEventListener('click', () => {
        document.getElementById('request-preview-popup_1').style.display = 'none';
    });

    document.querySelector('#request-preview-edit-button').addEventListener('click', () => {
        document.getElementById('request-preview-popup').style.display = 'none';
        document.getElementById('vehicle-request-form').style.display = 'block';
    });

    document.querySelector('#request-preview-confirm-button').addEventListener('click', () => {
        document.getElementById('request-preview-popup').style.display = 'none';
        document.getElementById('request-details-popup').style.display = 'block';
    });


    document.querySelector('#request-details-close').addEventListener('click', () => {
        document.getElementById('request-details-popup').style.display = 'none';
    });
    document.querySelector('#request-details-exit-button').addEventListener('click', () => {
        document.getElementById('request-details-popup').style.display = 'none';
    });

    document.querySelector('#confirm-alert-close').addEventListener('click', () => {
        document.getElementById('cancel-request-alert').style.display = 'none';
    });
    document.querySelector('#confirm-alert-no-button').addEventListener('click', () => {
        document.getElementById('cancel-request-alert').style.display = 'none';
    });
    document.querySelector('#confirm-alert-yes-button').addEventListener('click', () => {
        document.querySelectorAll('.popup').forEach((popup) => {
            popup.style.display = 'none';
        });
    });
</script>