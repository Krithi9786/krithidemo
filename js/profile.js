
$("#updateProfileForm").submit(function (e) {
  e.preventDefault();

  var UserName = $("$UserName").val()
  var Age = $("$Age").val()
  var Dob = $("$Dob").val()
  var Contact = $("$Contact").val()

  if (UserName === '') {
    alert('Name is required');
    return false;
  }
  if (Age === '') {
    alert('Age is required');
    return false;
  }
  if (Dob === '') {
    alert('Dob is Required');
    return false;
  }

  if (Contact === '') {
    alert('Contact is Required');
    return false;
  }

  $.ajax({
    url: "php/profile.php",
    type: "POST",
    data: {
      UserName : UserName,
      Age : Age,
      Dob : Dob,
      Contact : Contact,
    },
    dataType: "json",
    success: function (data) {
      alert(response.Message)
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("xhr", xhr)
    }
  });
});

