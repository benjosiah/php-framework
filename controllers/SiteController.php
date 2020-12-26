<?php


namespace app\controllers;

use app\core\Application;
use app\core\Auth;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\models\User;
use http\Header;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['contact']));
    }

    public function contact(){

        return $this->render('contact',['name'=>'josiah']);
    }
    public function user(){
        $this->setLayout('Auth');
        return $this->render('user',['name'=>'josiah']);
    }
    public function home(){
        $this->setLayout('main');
        return $this->render('home',['name'=>'josiah']);
    }

    public function submitContact(Request $request){
        
        $form=$request->form();
         $validate=$request->validate($form,
             [
             'email'=> ['required', 'email', 'unique'=>'email:users'],
             "subject" => ['required'],
             "body"=> ['required', 'min'=>10, 'max'=>260]
            ]);

//           var_dump($this->auth()->make('users', $form));

    }
    public function register(Request $request){

        $form=$request->form();
        $validate=$request->validate($form,
            [
                'email'=> ['required', 'email', 'unique'=>'email:users'],
                "firstname" => ['required'],
                "lastname" => ['required'],
                "password"=> ['required', 'min'=>10]
            ]);
             var_dump($validate);

        $this->auth()->make('users', ['email'=>$form['email']]);
        // return $this->redirect("/");
        // $message= new User();
        // $message->fillables['email']= $form['email'];
        // $message->fillables['firstname']= $form['firstname'];
        // $message->fillables['lastname']= $form['lastname'];
        // $message->fillables['password']= $this->encrypt($form['password']);
        // $message->save();
        // return redirect('/login');
    }

    public function logout()
    {
       $this->auth()->logOut();
       return $this->redirect("/");
    }


}