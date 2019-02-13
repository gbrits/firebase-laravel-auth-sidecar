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
        auth(currentUser, token);
      } else {
        alert('This user still needs to be verified.');
        firebase.auth().onAuthStateChanged(function(user) {
          user.sendEmailVerification();
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
