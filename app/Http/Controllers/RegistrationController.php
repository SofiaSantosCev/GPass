<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\User;
 
class RegistrationController extends Controller
{
    const ID_ROL = 2;
       
    public function store()
    {
        $name = $_POST['user'];
        
        if (!ctype_graph($name)) {
            return response("The user name must be only one word", 400); exit;
        }

        $email = $_POST['email'];
        
        $user = User::where('email', $email)->first();

        if($user != null){
            if ($email == $user->email) {
                return response("The email already exists",400); exit;
            }
        }

        $password = $_POST['password'];
        
        if (strlen($password) < 8) {
            return response("Invalid password. It must be at least 8 characters long.",400); exit;
        }

        $rol_id = self::ID_ROL;

        $user = new User;

        $user->name = $name;
        $user->email = $email;
        $encondedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user->password = $encondedPassword;
        $user->rol_id = $rol_id;

        $user->save();
        var_dump("User created");
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        var_dump("Your account has been deleted");
    }
}
