<?php

namespace App\Managers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class UserManager implements ManagerInterface
{

  private $request;

  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  /**
   * Register a user
   *
   * @return \App\Models\User
   */
  public function createFromRequest()
  {
    try {
      $user = User::create(
        [
          'name' => $this->request->name,
          'surname' => $this->request->surname,
          'user' => $this->request->user,
          'email' => $this->request->email,
          'password' => bcrypt($this->request->password)
        ]
      );

      return $user;

    } catch (Exception $e) {
      return $e->getTrace();
    }
  }

  /**
   * Get a user
   *
   * @return \App\Models\User
   */
  public function getByIdRequest()
  {
    try {
      $user = User::find($this->request->user_id);

      return $user;
      
    } catch (Exception $e) {
      return $e->getTraceAsString();
    }
  }

  /**
   * Edit a user
   *
   * @return \App\Models\User
   */
  public function editRequest()
  {
    try {
      $user = User::find($this->request->user_id);
      $user->name = $this->request->name;
      $user->surname = $this->request->surname;
      $user->email = $this->request->email;
      $user->user = $this->request->user;
      $user->password = bcrypt($this->request->password);
      $user->update();

      return $user;
      
    } catch (Exception $e) {
      return $e->getTraceAsString();
    }
  }

  /**
   * Remove a user
   *
   * @return \App\Models\User
   */
  public function removeRequest()
  {
    $user = User::find($this->request->user_id);
    $user->delete();
  }

}
