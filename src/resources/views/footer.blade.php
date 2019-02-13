<script>
function auth(user, token) {
  user.getToken(true).then(function(idToken) {
    $.ajax({
      url: '/auth',
      type: "post",
      data: {
        'id_token': idToken,
        'name': user.displayName,
        'email': user.email,
        'photo_url': user.photoURL,
        '_token': token
      },
      success: function(data){
        if(data.success) {
          window.location.replace(data.redirectTo);
        }
        else {
          alert(data.message);
        }
      },
      error: function(xhr, textStatus, errorThrown) {
        alert(textStatus);
      }
    });
  }).catch(function(error) {
    alert(error);
  });
}
</script>
