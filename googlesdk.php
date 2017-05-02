
<html>
  <head>
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <meta name="google-signin-client_id" content="400434178712-2o6blbbroti9loksohq0f4hbc36vjt5e.apps.googleusercontent.com"></head>
  <body>
    <script type="text/javascript">
      function handleClientLoad() {
        // Loads the client library and the auth2 library together for efficiency.
        // Loading the auth2 library is optional here since `gapi.client.init` function will load
        // it if not already loaded. Loading it upfront can save one network request.
        gapi.load('client:auth2', initClient);
      }

      function initClient() {
        // Initialize the client with API key and People API, and initialize OAuth with an
        // OAuth 2.0 client ID and scopes (space delimited string) to request access.
        gapi.client.init({
			apiKey:'zkI6EiFr9WAZQk4-Fy4FBHVU',
            //apiKey: 'AIzaSyD8hLfelsjFGA4y477JESpWFdMKydc-F9o',
            discoveryDocs: ["https://people.googleapis.com/$discovery/rest?version=v1"],
            clientId: '400434178712-2o6blbbroti9loksohq0f4hbc36vjt5e.apps.googleusercontent.com',
            scope: 'profile'
        }).then(function () {
          // Listen for sign-in state changes.
          gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

          // Handle the initial sign-in state.
          updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
        });
      }

      function updateSigninStatus(isSignedIn) {
        // When signin status changes, this function is called.
        // If the signin status is changed to signedIn, we make an API call.
        if (isSignedIn) {
          makeApiCall();
        }
      }

      function handleSignInClick(event) {
        // Ideally the button should only show up after gapi.client.init finishes, so that this
        // handler won't be called before OAuth is initialized.
        gapi.auth2.getAuthInstance().signIn();
      }

      function handleSignOutClick(event) {
        gapi.auth2.getAuthInstance().signOut();
      }

      function makeApiCall() {
        // Make an API call to the People API, and print the user's given name.
        gapi.client.people.people.get({
          resourceName: 'people/me'
        }).then(function(response) {
          console.log('Hello, ' + response.result.names[0].givenName);
        }, function(reason) {
          console.log('Error: ' + reason.result.error.message);
        });
      }
    </script>
    <script async defer src="https://apis.google.com/js/api.js"
      onload="this.onload=function(){};handleClientLoad()"
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>
    <!--<button id="signin-button" onclick="handleSignInClick()">Sign In</button>
    <button id="signout-button" onclick="handleSignOutClick()">Sign Out</button>-->
	
	<div class="g-signin2" data-onsuccess="onSignIn"></div>
	
	<script>
	function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
}
</script>
  </body>
</html>