<?php

class User extends Eloquent {
  
  public static $timestamps = true;
  
  public function agents()
  {
    return $this->has_many('Agent');
  }
}
