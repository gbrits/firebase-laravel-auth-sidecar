  <link rel="stylesheet" href="/gbrits/firebase/auth.css" />
  <div id="noticeboard" class="noticeboard"></div>
  <div id="firebaseui-auth-container"></div>
  <script src="https://www.gstatic.com/firebasejs/5.8.2/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/5.8.2/firebase-auth.js"></script>
  <script>
  var token = "{{ csrf_token() }}";
  var config = {
    apiKey: "{{ config('gbrits.firebase.auth.api_key') }}",
    authDomain: "{{ config('gbrits.firebase.auth.auth_domain') }}",
  };
  firebase.initializeApp(config);
  </script>
  @if (!Auth::check())
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
