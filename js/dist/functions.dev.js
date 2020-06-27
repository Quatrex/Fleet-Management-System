"use strict";

function addRecord(formID, addMethod, empID) {
  var data = $(formID).serialize();
  data += "&AddMethod=".concat(addMethod, "&empID=").concat(empID);
  $.ajax({
    url: "../func/save.php",
    type: "POST",
    data: data,
    cache: false,
    success: function success(result) {
      $(formID).find('input:text').val(''); //Display the popup of success access or unsucess
    }
  });
}