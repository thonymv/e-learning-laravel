<?php
    namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;
    use App\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;


    class UserController extends Controller
    {
        /**
         * Show the profile for the given user.
         *
         * @param  int  $id
         * @return \Illuminate\View\View
         */
        public function store(Request $request){
            if (User::where('email',$request->input('email'))->first()) {
                return response()->json([
                    'res'=>false,
                    'message'=>'email-exist'
                ],200);
            }
            $data = $request->all();
            $data['permissions'] = 0;
            $data['password'] = Hash::make($data['password']);
            return User::create($data);
        }

        public function storeAdmin(Request $request){
            if (User::where('email',$request->input('email'))->first()) {
                return response()->json([
                    'res'=>false,
                    'message'=>'email-exist'
                ],200);
            }
            $data = $request->all();
            $data['permissions'] = 1;
            $data['password'] = Hash::make($data['password']);
            return User::create($data);
        }


        public function login(Request $request)
        {
            $user = User::where('email',$request->input('email'))->first();
            if (!is_null($user) && Hash::check($request->password,$user->password)) {
                $token = $user->createToken('academia-qa')->accessToken;
                return response()->json([
                    'res'=>true,
                    'token'=>$token,
                    'name'=>$user["name"],
                    'message'=>'bienvenido '.$user['name']
                ],200);
            }else{
                return response()->json([
                    'res'=>false,
                    'message'=>'Correo o contraseña incorrecta'
                ],200);
            }
        }

        public function loginAdmin(Request $request)
        {
            $user = User::where('email',$request->input('email'))->first();
            if (!is_null($user) && Hash::check($request->password,$user->password) && $user->permissions) {
                $token = $user->createToken('academia-qa')->accessToken;
                return response()->json([
                    'res'=>true,
                    'token'=>$token,
                    'name'=>$user["name"],
                    'message'=>'bienvenido '.$user['name']
                ],200);
            }else{
                return response()->json([
                    'res'=>false,
                    'message'=>'Correo o contraseña incorrecta'
                ],200);
            }
        }

        public function logout_all(){
            $user = auth()->user();
            $user->tokens->each(function ($token,$key){
                $token->delete();
            });
            $user->save();
            return response()->json([
                'res'=>true,
                'message'=>'Se ha cerrado la sesión correctamente'
            ],200);
        }

        public function logout(Request $request){
            $result = $request->user()->token()->revoke(); 
            if ($result) {
                return response()->json([
                    'res'=>true,
                    'message'=>'Se ha cerrado la sesión correctamente'
                ],200);
            }else{
                return response()->json([
                    'res'=>false,
                    'message'=>'No se pudo cerrar la sesión correctamente'
                ],400);
            }
        }
        
        public function getUsers()
        {
            return response()->json(User::all(),200);
        }
    }