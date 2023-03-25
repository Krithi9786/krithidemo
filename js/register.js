
$('#SignUpForm').submit(function (e) {
  e.preventDefault();
  var Useremail = $('#Useremail').val();
  var Userpassword = $('#Userpassword').val();
  var UserConfirmPassword = $('#UserConfirmPassword').val();

  if (Useremail === '') {
    alert('Email is required');
    return false;
  }
  if (Userpassword === '') {
    alert('Password is required');
    return false;
  }
  if (UserConfirmPassword === '') {
    alert('Confirm Password is Required');
    return false;
  }
  if (UserConfirmPassword !== Userpassword) {
    alert('Passwords do not match');
    return false;
  }

  $.ajax({
    url: 'php/register.php',
    type: 'POST',
    data: {
      Useremail: Useremail,
      Userpassword: Userpassword
    },
    dataType: 'json',
    success: function (response) {

      window.location.href = 'profile.html';
    },
    error: function (jqXHR, textStatus, errorThrown) {

      alert('Error' + errorThrown);
    }
  });
});

