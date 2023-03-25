
$('#LoginForm').submit(function (e) {
  e.preventDefault();

  var Useremail = $('#Useremail').val();
  var Userpassword = $('#Userpassword').val();

  if (Useremail == '') {
    alert("Email is required")
    return false;
  }
  if (Userpassword == '') {
    alert("Password is required")
    return false;
  }

  $.ajax({
    url: 'php/login.php',
    type: 'POST',
    data: {
      Useremail: Useremail,
      Userpassword: Userpassword
    },
    dataType: 'json',
    success: function (response) {
      if (response.Status) {
        localStorage.setItem('user',response.user)
        window.location.href = 'profile.html';
      } else {
        alert(response.Message)
      }
    },
    error: function (xhr, status, error) {
      console.log("xhr", xhr)
    }
  });
});
