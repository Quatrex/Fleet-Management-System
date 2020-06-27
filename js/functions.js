function addRecord(formID, addMethod, empID) {
  let data = $(formID).serialize();
  data += `&AddMethod=${addMethod}&empID=${empID}`;
  $.ajax({
    url: "../func/save.php",
    type: "POST",
    data: data,
    cache: false,
    success: function (result) {
        col
      $(formID).find("input:text").val("");
      //Display the popup of success access or unsucess
    },
  });
}
