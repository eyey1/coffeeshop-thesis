<?php 

namespace Core;
use Core\Session;

class Authenticator 
{
  public function attemp($email, $password)
  {
    $users = (App::resolve(Database::class))->query("SELECT * FROM tblemployees WHERE email = :email", [
      'email' => $email
    ])->find();

      if ($users) {
          if (password_verify($password, $users['password'])) {
            $this->login([
              'id' => $users['employeeID'],
              'email' => $email,
              'position' => $users['position'],
            ]);

            return true;
        }
      }

    return false;
  }

  public static function login($user) {
    $_SESSION['user'] = [
      'id' => $user['id'],
      'email' => $user['email'],
      'position' => $user['position'],
    ];
  
    session_regenerate_id();
  }
  
  public static function logout() {
    Session::destroy();
  }
}

?>