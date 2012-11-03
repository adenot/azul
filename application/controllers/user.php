<?php

use Laravel\Auth;

class User_Controller extends Base_Controller
{
  public function action_index()
  {
    if (Session::has('message'))
    {
      $message = Session::get('message');
    }
    return View::make("login");
  }
  
  public function action_authenticate()
  {
    $email = Input::get('email');
    $password = Input::get('password');
    $remember = Input::get('remember');

    $credentials = array(
      'username' => $email,
      'password' => $password,
      'remember' => $remember
    );
    
    if (Auth::attempt($credentials))
    {
      return Redirect::to('dashboard');
    } else {
      Session::flash('status_error', 'Your email or password is invalid - please try again.');
      return Redirect::to("user");
    }
  }
  
  public function action_create_test_user()
  {
    $user = new User();
    $user->email = "adenot@gmail.com";
    $user->password = Hash::make("visual");
    $user->save();
    Auth::login($user);
    return Redirect::to('dashboard');
  }
  
  public function action_auth_test_user()
  {
    $credentials = array(
        'username' => "adenot@gmail.com",
        'password' => "visual"
    );
    Auth::attempt($credentials);
    return Redirect::to('dashboard');
  }
  
}