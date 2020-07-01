let lastClickedRow = "";
function loadData() {
  $.ajax({
    url: "fetch.php",
    method: "POST",
    data: {
      view: view,
    },
    dataType: "json",
    success: function (data) {},
  });
}

//   setInterval(function() {
//       console.log("every 5s");

//       load_unseen_notification();;
//   }, 5000);
// });

//Write to database
//event is of methodName_button/form_RequestID/VehicleID
function writeToDatabase(event, callback = () => {}) {
  let trigger = event.split("_")[0];
  let type = event.split("_")[1];
  let data = `Method=${trigger}&empID=${empID}&`;
  
  if (type === "form") {
    data += $(`#${trigger}_form`).serialize();
  } else {
    data += `${event.split("_")[2]}=${lastClickedRow.split("-")[1]}`;
  }
  console.log(data);
  $.ajax({
    url: "../func/save2.php",
    type: "POST",
    data: data,
    cache: false,
    success: function (returnArr) {
      console.log(returnArr);
      if (type === "form") {
        $(`#${trigger}_form`).trigger("reset");
      }
      if (callback !== undefined) {
        callback();
      }
      showAlert(returnArr.split("_")[0], returnArr.split("_")[1]);
      //Display the popup of success access or unsucess
    },
  });
}

//Show the success or error alert after ajax query
function showAlert(type, message) {
  document.getElementById("alert-message").innerHTML = message.substring(
    0,
    message.length - 1
  );
  document
    .getElementById("alertdiv")
    .classList.add("alert-".concat(type.substring(1)));
  document.getElementById("alert-ajax").style.display = "block";
  setTimeout(() => {
    document.getElementById("alert-ajax").style.display = "none";
  }, 3000);
}
insertRow("request-table", [""], "request");
//Insert a row to the table
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

//delete Row
function deleteRow(rowid) {
  var row = document.getElementById(rowid);
  row.parentNode.removeChild(row);
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
