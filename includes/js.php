<script type="text/javascript">
    const employee = <?php echo json_encode($_SESSION['employee']); ?>;
    const requestTable = document.querySelector("#request-table");
    const userImage = document.querySelector('.user-img');
    const changePasswordBtn = document.querySelector('#change-password-button');
    const checkMyPasswordBtn = document.querySelector('#check-my-password-button');
    const requestPreview = document.getElementById('request-preview-popup');
    const newRequestBtn = document.querySelector('#request-vehicle-button');
    const requestForm = document.getElementById('vehicle-request-form');
    const requestEntity = <?php echo json_encode($_SESSION['requestsByMe']) ?>;
    

    const firstname = <?php echo json_encode($_SESSION['firstname']) ?>;
    const lastname = <?php echo json_encode($_SESSION['lastname']) ?>;
    const position = <?php echo json_encode($_SESSION['position']) ?>;
    const email = <?php echo json_encode($_SESSION['email']) ?>;
    const empID = <?php echo json_encode($_SESSION['empid']) ?>;
    const username = <?php echo json_encode($_SESSION['username']) ?>;


    //jQuery with ajax 
    initiateProfile();


    $(document).ready(function() {
        $('#request-preview-confirm-button').on('click', function() {
            let time = $('#new-time').html();
            let date = $('#new-date').html();
            let dropoff = $('#new-dropoff').html();
            let pickup = $('#new-pickup').html();
            let purpose = $('#new-purpose').html();
            //console.log(typeof(pickup));

            if (time != "" && date != "" && dropoff != "" && pickup != "") {
                $.ajax({
                    url: "../func/save.php",
                    type: "POST",
                    data: {
                        time: time,
                        date: date,
                        dropoff: dropoff,
                        pickup: pickup,
                        purpose: purpose,
                        firstname: firstname,
                        lastname: lastname,
                        empID: empID,
                        position: position,
                        username: username,
                        email: email
                    },
                    cache: false,
                    success: function(dataResult) {
                        // var dataResult = JSON.parse(dataResult);
                        if (dataResult == true) {
                            document.getElementById('new-request-status').innerHTML="Sent";
                            var x = document.getElementById("request-added-success-snackbar");
                            x.className = x.className+"-show";
                            setTimeout(function() {
                                x.className = "snackbar";
                            }, 3000);
                        }
                    }
                });
                $('#submit-form').find('input:text').val('');

            } else {
                alert('Please fill all the field !');
            }
        });
    });




    function initiateProfile() {
        changeInnerHTML({
            '#user-nam': username,
            '#user-occupation': position,
            '#user-email': email
        });
    }

    function changeInnerHTML(arg) {
        for (let key in arg) {
            document.querySelectorAll(key).forEach((tag) => {
                tag.innerHTML = arg[key];
            })
        }
    }

    function getValuesFromForm(name, values) {
        let arr = {}
        let form = document.querySelector(name);
        values.forEach((key) => {
            arr[key] = form.elements[key].value
        })
        return arr;
    }

    function checkMyPassword(password) {
        if (password != "") {
            $.ajax({
                url: "../func/changePassword.php",
                type: "POST",
                data: {
                    empID: empID,
                    password: password
                },
                cache: false,
                success: function(validity) {
                    if (validity == true) {
                        parent = document.getElementById('password-input');
                        child = `<input type="password" name="new-password" class="form-control" id="new-password-input" placeholder="Enter new password..." required autocomplete="off">
                            <input type="password" name="new-password-again" class="form-control" id="password-again-input" placeholder="Enter password again..." required autocomplete="off">
                            `
                        parent.innerHTML = child;
                        document.getElementById('change-password-header').innerHTML = "Enter new password";
                    } else {
                        document.getElementById('password-error').innerHTML = "Password incorrect";
                    }
                }
            });

        } else {
            document.getElementById('password-error').innerHTML = 'Please enter your password!';
        }
    }

    requestTable.onclick = (event) => {
        let tableRow = event.target.parentElement;
        let row_id = (tableRow.children[0].id).split("-");
        let entity = requestEntity[row_id[1]]
        changeInnerHTML({
            '#date-preview': entity.dateOfTrip,
            '#time-preview': entity.timeOfTrip,
            '#pickup-preview': entity.pickLocation,
            '#drop-preview': entity.dropLocation,
            '#purpose-preview': entity.purpose
        });
        requestPreview.style.display = 'block';
    }

    userImage.addEventListener('click', () => {
        document.getElementById('my-profile').style.display = 'block';
    });

    changePasswordBtn.addEventListener('click', () => {
        document.getElementById('change-password').style.display = 'block';
    });
    checkMyPasswordBtn.addEventListener('click', () => {
        checkMyPassword(document.getElementById("current-password-input").value.trim());
    });

    newRequestBtn.addEventListener('click', () => {
        requestForm.style.display = 'block';
    });

    document.querySelector('#user-profile-form-close').addEventListener('click', () => {
        document.getElementById('my-profile').style.display = 'none';
    });
    document.querySelector('#change-password-close').addEventListener('click', () => {
        //TODO: are you sure popup not the one below,html needed for popup
        document.getElementById('change-password').style.display = 'none';
    });
    document.querySelector('#change-password-cancel-button').addEventListener('click', () => {
        //TODO: are you sure popup for confirm cancelation,html needed for popup
        document.getElementById('change-password').style.display = 'none';
    });
    document.querySelector('#vehicle-request-form-close').addEventListener('click', () => {
        document.getElementById('cancel-request-alert').style.display = 'block';
    });
    document.querySelector('#request-form-close-button').addEventListener('click', () => {
        document.getElementById('cancel-request-alert').style.display = 'block';
    });


    document.querySelector('#request-form-submit-button').addEventListener('click', () => {
        document.getElementById('vehicle-request-form').style.display = 'none';
        let details = getValuesFromForm('#submit-form', ['date', 'time', 'pickup', 'dropoff', 'purpose'])
        changeInnerHTML({
            '#new-date': details.date,
            '#new-time': details.time,
            '#new-pickup': details.pickup,
            '#new-dropoff': details.dropoff,
            '#new-purpose': details.purpose
        });
        document.getElementById('new-request-preview-popup').style.display = 'block';
    });


    document.querySelector('#new-request-preview-close').addEventListener('click', () => {
        document.getElementById('cancel-request-alert').style.display = 'block';
    });

    document.querySelector('#request-preview-close').addEventListener('click', () => {
        document.getElementById('request-preview-popup').style.display = 'none';
    });

    document.querySelector('#request-preview-edit-button').addEventListener('click', () => {
        document.getElementById('new-request-preview-popup').style.display = 'none';
        document.getElementById('vehicle-request-form').style.display = 'block';
    });

    document.querySelector('#request-preview-confirm-button').addEventListener('click', () => {
        document.getElementById('new-request-preview-popup').style.display = 'none';
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