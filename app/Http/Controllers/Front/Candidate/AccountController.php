<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate;

use Auth;
use ReclutaTI\User;
use ReclutaTI\Candidate;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class AccountController extends Controller
{
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
    	return view('front.candidate.account.index');
    }

    /**
     * [login description]
     * @param  LoginRequest $request [description]
     * @return [type]                [description]
     */
    public function login(LoginRequest $request)
    {
    	$credentials = [
    		'email' => $request->correoElectronico,
    		'password' => $request->password
    	];

    	if (Auth::attempt($credentials)) {
    		return redirect()->intended('canidate/dashboard');
    	} else {
    		return back()->withErrors(['msg', 'Combinación de correo electrónico y contarseña incorrecta']);
    	}
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
    	return view('front.candidate.account.create');
    }

    /**
     * This method create a new candidate account
     * 
     * @param  StoreRequest $request 
     * @return json                	returns true or false depens if both record are saved
     */
    public function store(StoreRequest $request)
    {
    	$response;

    	$user = new User();
    	$user->name = strtolower($request->nombre);
    	$user->email = $request->correoElectronico;
    	$user->password = bcrypt($request->password);

    	if ($user->save()) {
    		//Save new candidate record
    		$candidate = new Candidate();
    		$candidate->user_id = $user->id;
    		$candidate->last_name = $request->apellidoPaterno;

    		if ($candidate->save()) {
    			$response = [
    				'errors' => false,
    				'message' => 'Se ha creado con éxito tu cuenta.'
    			];
    		} else {
    			$user->delete();
    			$response = [
    				'errors' => true,
    				'message' => 'No se ha podido crear tu cuenta.',
    				'error_code' => 's002'
    			];
    		}
    	} else {
    		$response = [
    			'errors' => true,
    			'message' => 'No se ha podido crear tu cuenta.',
    			'error_code' => 's001'
    		];
    	}

    	return response()->json($response);
    }

    /**
     * [logout description]
     * @return [type] [description]
     */
    public function logout()
    {
    	Auth::logout();

    	return redirect()->intended('candidate');
    }
}
