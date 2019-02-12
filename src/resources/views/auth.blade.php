<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>
    {{ getEnv('APP_NAME')}}
  </title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="/gbrits/firebase/auth.css" />
</head>
<body>
  <header id="header">
    <div class="text-center">
      <a href="/" class="logo"><img src="/images/logo.png" /></a>
    </div>
  </header>
  <div class="container">
    <div class="page-header text-center">
      <h1 class="h3">{{ getEnv('APP_NAME')}} account</h1>
    </div>
    <div id="noticeboard" class="noticeboard"></div>
  </div>

  <div class="auth container">
    <div class="row">
      <div class="col-10 offset-1 col-md-6 offset-md-3">
        <div id="firebaseui-auth-container"></div>
      </div>
    </div>
  </div>

  <script src="https://www.gstatic.com/firebasejs/5.8.2/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/5.8.2/firebase-auth.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script>
  var token = "{{ csrf_token() }}";
  var config = {
    apiKey: "{{ config('gbrits.firebase.auth.api_key') }}",
    authDomain: "{{ config('gbrits.firebase.auth.auth_domain') }}",
  };
  firebase.initializeApp(config);
  </script>
  @if (Auth::check())
  @else
  <script src='/gbrits/firebase/auth.js'></script>
  @endif
  <script>
  function notice(message) {
    $("#noticeboard").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> ' + message + '</div>');
  }
  </script>
  <script src="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.js"></script>
  <link type="text/css" rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.css" />
  <script type="text/javascript">
  var uiConfig = {
    'signInSuccessUrl': '/',
    'signInOptions': [
      firebase.auth.FacebookAuthProvider.PROVIDER_ID,
      firebase.auth.EmailAuthProvider.PROVIDER_ID
    ],
    'tosUrl': null,
    'callbacks': {
      'signInSuccess': function(currentUser, credential, redirectUrl) {
        if (currentUser.emailVerified) {
          auth(currentUser, token);
        } else {
          notice("{!! trans('gbrits.firebase.auth.warning_verify_email') !!}");
        }
        return false;
      }
    }
  };

  var ui = new firebaseui.auth.AuthUI(firebase.auth());
  ui.start('#firebaseui-auth-container', uiConfig);
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
