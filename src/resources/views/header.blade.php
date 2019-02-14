<script src="https://www.gstatic.com/firebasejs/5.8.2/firebase.js"></script>
<script>
  var token = "{{ csrf_token() }}";
  var config = {
    apiKey: "{{ config('gbrits.firebase.auth.api_key') }}",
    authDomain: "{{ config('gbrits.firebase.auth.auth_domain') }}",
    databaseURL: "{{ config('gbrits.firebase.auth.database_url') }}",
    projectId: "{{ config('gbrits.firebase.auth.project_id') }}",
    storageBucket: "{{ config('gbrits.firebase.auth.storage_bucket') }}",
    messagingSenderId: "{{ config('gbrits.firebase.auth.messaging_sender_id') }}"
  };
  firebase.initializeApp(config);
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
    'signInSuccessWithAuthResult': function(currentUser, credential, redirectUrl) {
      if (currentUser.emailVerified) {
        auth(currentUser);
      } else {
        firebase.auth().onAuthStateChanged(function(currentUser) {
          if (currentUser.emailVerified) {
            console.log('Email is verified');
            window.verifiedEmail = true;
            auth(currentUser, token); // Create Laravel counterpart
          }
          else {
            console.log('Email is not verified');
            window.verifiedEmail = false;
            currentUser.sendEmailVerification();
            $('#firebaseui-response').html('<div class="alert alert-success text-center" role="alert">An email has been sent to verify your account<br />Check your spam folder if you haven\'t received it</div>');
          }
        });
      }
      return false;
    }
  },
  'credentialHelper': firebaseui.auth.CredentialHelper.NONE
};
var ui = new firebaseui.auth.AuthUI(firebase.auth());
ui.start('#firebaseui-auth-container', uiConfig);
</script>
