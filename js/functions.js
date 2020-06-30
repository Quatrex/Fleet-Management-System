$(document).ready(function () {
  $("#request-preview-confirm-button").on("click", function () {
    writeToDatabase("#submit-form", "RequestAdd", empID);
  });
  insertRow("request-table", [
    "514",
    "Nikan",
    "Pending",
    "2020-12-13",
    "12:30:00",
  ]);
});

function loadData() {
  $.ajax({
    url: "fetch.php",
    method: "POST",
    data: {
      view: view,
    },
    dataType: "json",
    success: function (data) {
      $(".dropdown-menu").html(data.notification);

      if (data.unseen_notification > 0) {
        $(".count").html(data.unseen_notification);
      }
    },
  });
}

//   setInterval(function() {
//       console.log("every 5s");

//       load_unseen_notification();;
//   }, 5000);
// });

//Write to database
function writeToDatabase(formID, addMethod, empID) {
  let data = $(formID).serialize();
  console.log(data);

  data += `&AddMethod=${addMethod}&empID=${empID}`;
  $.ajax({
    url: "../func/save2.php",
    type: "POST",
    data: data,
    cache: false,
    success: function (result) {
      console.log(result);
      $(formID).trigger("reset");
      //Display the popup of success access or unsucess
    },
  });
}

function insertRow(tableName, cellData, type) {
  let newRow = document.getElementById(tableName).insertRow(1);
  let i = 0;
  if (type == "request") {
    let th = document.createElement("th");
    th.innerHTML = cellData[0];
    newRow.appendChild(th);
    i = 1;
  }
  let cellValue;
  for (i; i < cellData.length; i++) {
    cellValue = newRow.insertCell(i);
    cellValue.innerHTML = cellData[i];
  }
}

//initiate the user profile with details
function initiateProfile() {
  changeInnerHTML({
    "#user-nam": username,
    "#user-occupation": position,
    "#user-email": email,
  });
}

function changeInnerHTML(arg) {
  for (let key in arg) {
    document.querySelectorAll(key).forEach((tag) => {
      tag.innerHTML = arg[key];
    });
  }
}


function getValuesFromForm(name, values) {
  let arr = {};
  let form = document.querySelector(name);
  values.forEach((key) => {
    arr[key] = form.elements[key].value;
  });
  return arr;
}

function checkMyPassword(password) {
  if (password != "") {
    $.ajax({
      url: "../func/changePassword.php",
      type: "POST",
      data: {
        empID: empID,
        password: password,
      },
      cache: false,
      success: function (validity) {
        if (validity == true) {
          parent = document.getElementById("password-input");
          child = `<input type="password" name="new-password" class="form-control" id="new-password-input" placeholder="Enter new password..." required autocomplete="off">
                      <input type="password" name="new-password-again" class="form-control" id="password-again-input" placeholder="Enter password again..." required autocomplete="off">
                      `;
          parent.innerHTML = child;
          document.getElementById("change-password-header").innerHTML =
            "Enter new password";
        } else {
          document.getElementById("password-error").innerHTML =
            "Password incorrect";
        }
      },
    });
  } else {
    document.getElementById("password-error").innerHTML =
      "Please enter your password!";
  }
}

//for making selected driver bold

function toggleBack(table, tableRow, type) {
  const rows = table.querySelectorAll("tr");
  console.log(tableRow);
  const name = tableRow.querySelector("td").innerHTML;
  console.log(name);
  const vehicleName = document.querySelector(`#${type}`);
  rows.forEach((element) => {
    if (element === tableRow) {
      element.classList.toggle("selected");
      if (element.classList.contains("selected")) {
        vehicleName.innerHTML = name;
      } else {
        vehicleName.innerHTML = "";
      }
    } else {
      if (element.classList.contains("selected")) {
        element.classList.remove("selected");
      }
    }
  });
}
