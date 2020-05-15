<script type="text/javascript">
    const requestTable = document.querySelector("#request-table");
    const userImage = document.querySelector('.user-img');
    const requestPreview = document.getElementById('request-preview-popup');
    const newRequestBtn = document.querySelector('#request-vehicle-button');
    const requestForm = document.getElementById('vehicle-request-form');
    const requestEntity = <?php echo $_SESSION['json'] ?>;
     //request table entities array
    //const check =sessionStorage.getItem("lastname");
    //console.log(check);
    const userDetails = JSON.parse(<?php echo $_SESSION['user'] ?>); // users details in an array
    const firstname = <?php echo json_encode($_SESSION['firstname']) ?>; // users details in an array
    const lastname = <?php echo json_encode($_SESSION['lastname']) ?>; // users details in an array
    const position= <?php echo json_encode($_SESSION['position']) ?>; // users details in an array
    const email = <?php echo json_encode($_SESSION['email']) ?>; // users details in an array
    const empID = <?php echo json_encode($_SESSION['empid']) ?>; // users details in an array
    const  username= <?php echo json_encode($_SESSION['username']) ?>; // users details in an array
    console.log(empID);
    console.log(typeof(empID));
    
    //jQuery with ajax 
    initiateProfile();
    

    $(document).ready(function() {
        $('#request-preview-confirm-button').on('click', function() {
            let time = $('#new-time').html();
            let date = $('#new-date').html();
            let dropoff = $('#new-dropoff').html();
            let pickup = $('#new-pickup').html();
            //console.log(typeof(pickup));
            
            if (time != "" && date != "" && dropoff != "" && pickup != "") {
                $.ajax({
                    url: "save.php",
                    type: "POST",
                    data: {
                        time: time,
                        date: date,
                        dropoff: dropoff,
                        pickup: pickup,
                        // firstname: firstname,
                        // lastname: lastname,
                        empID: empID,
                        // position:position,
                        // username: username,
                        // email:email
                        // 
                        },
                    cache: false,
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                         if (dataResult.statusCode == 200) {
                             $('#submit-form').find('input:text').val('');
                             //$("#success").show();
                            $('#success').html('Data added successfully !');
                         } else if (dataResult.statusCode == 201) {
                             alert("Error occured !");
                         }

                     }
                });
            } else {
                alert('Please fill all the field !');
            }
        });
    });


    

    function initiateProfile() {
        changeInnerHTML({
            '#user-nam': userDetails[0].name,
            '#user-occupation': userDetails[0].occupation,
            '#user-email': userDetails[0].email
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

    requestTable.onclick = (event) => {
        let tableRow = event.target.parentElement;
        let row_id = (tableRow.children[0].id).split("-");
        let entity = requestEntity[row_id[1]]
        changeInnerHTML({
            '#date-preview': entity.date,
            '#time-preview': entity.time,
            '#pickup-preview': entity.pickup,
            '#drop-preview': entity.drop
        });
        requestPreview.style.display = 'block';
    }

    userImage.addEventListener('click', () => {
        document.getElementById('my-profile').style.display = 'block';
    });

    newRequestBtn.addEventListener('click', () => {
        requestForm.style.display = 'block';
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
        let details = getValuesFromForm('#submit-form', ['date', 'time', 'pickup', 'dropoff'])
        changeInnerHTML({
            '#new-date': details.date,
            '#new-time': details.time,
            '#new-pickup': details.pickup,
            '#new-dropoff': details.dropoff
        });
        document.getElementById('new-request-preview-popup').style.display = 'block';
    });


    document.querySelector('#request-preview-close').addEventListener('click', () => {
        document.getElementById('cancel-request-alert').style.display = 'none';
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