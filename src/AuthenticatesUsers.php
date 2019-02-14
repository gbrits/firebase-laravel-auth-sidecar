<?php

namespace Gbrits\Firebase\Auth;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;

/**
* Class AuthenticatesUsers.
*/
trait AuthenticatesUsers
{

  public function redirectPath() {
    return '/';
  }

  public function getAuth(Request $request) {
    $firebaseAuth = property_exists($this, 'firebaseAuthView') ? $this->firebaseAuthView : 'gbrits.firebase.auth';
    return view($firebaseAuth);
  }

  public function postAuth(Request $request) {
    $data = $request->all();
    $validator = $this->validator($data);
    if ($validator->fails()) {
      return $this->onFail($validator->errors()->first());
    }

    JWT::$leeway = 8; # 8 seconds of leeway for verification.

    $content = file_get_contents("https://www.googleapis.com/robot/v1/metadata/x509/securetoken@system.gserviceaccount.com");
    $kids = json_decode($content, true);

    # Decode the token to read it
    $jwt = JWT::decode($request->input('id_token'), $kids, array('RS256'));
    # Get the Firebase Project ID for comparison
    $fbpid = property_exists($this, 'firebaseProjectId') ? $this->firebaseProjectId : config('gbrits.firebase.auth.project_id');
    # For confirming with Google's (deprecated) Identity Toolkit
    $issuer = 'https://securetoken.google.com/' . $fbpid;

    if($jwt->aud != $fbpid)
      return $this->onFail('Invalid audience');
    elseif($jwt->iss != $issuer)
      return $this->onFail('Invalid issuer');
    elseif(empty($jwt->sub))
      return $this->onFail('Invalid user');
    else {
      $uid = $jwt->sub;
      $user = $this->firebaseLogin($uid, $request);
      if($user) {
        return response()->json(['success' => true, 'redirectTo' => '/']);
      } else {
        return $this->onFail('Error');
      }
    }

  }

  protected function onFail($message) {
    return response()->json(['success' => false, 'message' => $message]);
  }

  protected function firebaseLogin($uid, $request) {
    //$user = Auth::getProvider()->retrieveById($uid);
    $user = User::where('id_token',$uid)->first();
    if (is_null($user)){
      $this->firebaseRegister($uid, $request);
    } else {
      $remember = $request->has('remember') ? $request->input('remember') : false;
      return Auth::loginUsingId($user->id, $remember);
    }
  }

  protected function firebaseRegister($uid, $request) {
    $data['id_token'] = $uid;
    $data['name'] = $request->has('name') ? $request->input('name') : null;
    $data['email'] = $request->has('email') ? $request->input('email') : null;
    $data['photo_url'] = $request->has('photo_url') ? $request->input('photo_url') : null;
    
    // Any additional data you want in your user database at this point
    # $name = trim($data['name']);
    # $data['last_name'] = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
    # $data['first_name'] = trim( preg_replace('#'.$data['last_name'].'#', '', $name ) );
    # $data['mobile'] = '000';
    # $data['password'] = bcrypt('password');
    # $data['type'] = 'Full Time'; // Part Time, Contractor
    # $data['role'] = 'manager'; // staff
    # $data['team'] = 'Administration'; // Field Crew
    # $data['job_title'] = 'New Recruit';
    # $data['employment_status'] = 'Active'; // Resigned

    $this->create($data);
  }

  protected function validator(array $data)
  {
    return Validator::make($data, [
      'id_token'      => 'required',
      'name'          => 'required|max:255',
      'email'         => 'required',
    ]);
  }

}
