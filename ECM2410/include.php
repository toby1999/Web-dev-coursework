<?php
class Authentication {
  // In a class somewhere
  static $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

  public function getBase62Char($num) {
    return $chars[$num];
  }

  public function generateRandomString($nbLetters){
    $randString="";

    for($i=0; $i < $nbLetters; $i++){
      $rand = mt_rand(0,61);
      //$randChar = getBase62Char($rand);
      $randChar = self::$chars[$rand];
      $randString .= $randChar;
    }
    return $randString;
  }
  public function hashPassword($password, $salt) {
    if (CRYPT_SHA512 == 1) {
      $hash = crypt($password, '$6$'.$salt);
      return $hash;
    }
  }
  public function isPasswordOk($password, $salt, $hash) {
    $hashCheck = self::hashPassword($password, $salt);
    return ($hashCheck == $hash);
  }
  public function isLoggedOn() {
    $loggedOn = false;
    if (isset($_SESSION['username'])) {
      $loggedOn = true;
    }
    return $loggedOn;
  }
  public function test() {
    return "Hello world";
  }
}
