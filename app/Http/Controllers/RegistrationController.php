<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Users;
 
class RegistrationController extends Controller
{
    const ID_ROL = 2;
       
    public function store()
    {
        $name = $_POST['user'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rol_id = self::ID_ROL;

        $user = new Users;

        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->rol_id = $rol_id;

        $user->save();
    }

    public function destroy($id)
    {
        $user = Users::find($id);
        $user->delete();
    }
}
