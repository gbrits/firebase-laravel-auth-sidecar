<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function auth(user) {
  console.log('Initiating Laravel user creation...');
  user.getIdToken(true).then(function(idToken) {
    $.ajax({
      url: '/auth',
      type: "post",
      data: {
        'id_token': idToken,
        'name': user.displayName,
        'email': user.email,
        'photo_url': user.photoURL
      },
      success: function(data) {
        if(data.success) {
          window.location.replace(data.redirectTo);
        } else {
          // Handle Firebase error
        }
      },
      error: function(xhr, textStatus, errorThrown) {
        // Handle Laravel error
      }
    });
  }).catch(function(error) {
    // Handle exception
  });
}
</script>
