<script>
    //*******************Justification Table *******************/
    document.querySelector("#justify-request-table").onclick = (event) => {
        let tableRow = event.target.parentElement;
        let row_id = (tableRow.children[0].id).split("-");
        let entity = requestEntity[row_id[1]]
        changeInnerHTML({
            '#date-preview': entity.date,
            '#time-preview': entity.time,
            '#pickup-preview': entity.pickLocation,
            '#drop-preview': entity.dropLocation
        });
        document.getElementById('request-justify-preview-popup').style.display = 'block';

    };

    //************Denied Table ******************/
    document.querySelector("#denied-table").onclick = (event) => {
        let tableRow = event.target.parentElement;
        let row_id = (tableRow.children[0].id).split("-");
        let entity = requestEntity[row_id[1]]
        changeInnerHTML({
            '#date-preview': entity.date,
            '#time-preview': entity.time,
            '#pickup-preview': entity.pickLocation,
            '#drop-preview': entity.dropLocation
        });
        document.getElementById('request-details-popup').style.display = 'block';
    };
    //***********************Justify Request ********************/
    // Preview
    document.querySelector('#request-details-approve-button').addEventListener('click', () => {
        document.getElementById('request-justify-preview-popup').style.display = 'none';
        document.getElementById('justify-request-alert').style.display = 'block';
    });

    document.querySelector('#request-details-decline-button').addEventListener('click', () => {
        document.getElementById('request-justify-preview-popup').style.display = 'none';
        document.getElementById('cancel-request-alert-justify').style.display = 'block';
    });

    document.querySelector('#request-justify-preview-close').addEventListener('click', () => {
        document.getElementById('request-justify-preview-popup').style.display = 'none';
    });

    //Preview End

    //Decline Poup
    //Decline Button
    document.querySelector('#decline-alert-decline-button').addEventListener('click', () => {
        document.getElementById('cancel-request-alert-justify').style.display = 'none';
    });
    //Decline Cancel Button
    document.querySelector('#decline-alert-cancel-button').addEventListener('click', () => {
        document.getElementById('cancel-request-alert-justify').style.display = 'none';
        document.getElementById('request-justify-preview-popup').style.display = 'block';
    });
    //Decline PopUp x button
    document.querySelector('#confirm-alert-close-decline').addEventListener('click', () => {
        document.getElementById('cancel-request-alert-justify').style.display = 'none';
        document.getElementById('request-justify-preview-popup').style.display = 'block';
    });
    //Justify Popup
    //Cancel Button
    document.querySelector('#justify-alert-cancel-button').addEventListener('click', () => {
        document.getElementById('justify-request-alert').style.display = 'none';
        document.getElementById('request-justify-preview-popup').style.display = 'block';
    });
    //Justify button
    document.querySelector('#justify-alert-justify-button').addEventListener('click', () => {
        document.getElementById('justify-request-alert').style.display = 'none';

    });
    //Justify Pop Up x Button
    document.querySelector('#confirm-alert-close-approve').addEventListener('click', () => {
        document.getElementById('justify-request-alert').style.display = 'none';
        document.getElementById('request-justify-preview-popup').style.display = 'block';
    });

    //***********************Justify Request End *******/



    //***********************Request Denied Preview**************/
    document.querySelector('#request-denied-preview-close').addEventListener('click', () => {
        document.getElementById('request-denied-preview-popup').style.display = 'none';
    });
</script>