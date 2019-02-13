<?php

namespace Gbrits\Firebase\Auth\Http;

use Gbrits\Firebase\Auth\User;
use Illuminate\Support\Facades\Validator;
use Gbrits\Firebase\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;

class AuthController extends Controller
{
  use RegistersUsers, AuthenticatesUsers;
  protected $redirectTo = '/';
  public function __construct()
  {
    $this->middleware('guest');
  }
  protected function validator(array $data)
  {
    return Validator::make($data, [
      'name'          => 'required|max:255',
      'id_token'      => 'required'
    ]);
  }
  protected function create(array $data)
  {
    $user = User::create([
      'name' => $data['name'],
      'id_token' => $data['id_token']
    ]);
    return $user;
  }
}
