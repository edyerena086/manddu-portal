<?php

namespace Tests\Unit\Front\Candidate\Account;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class StoreTest extends TestCase
{
	use RefreshDatabase, WithoutMiddleware;
	private $url = "/candidate/account/store";

    public function test_send_no_data()
    {
    	$response = $this->json('POST', $this->url);

    	$response->assertStatus(422);
    }

    public function test_send_no_name()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'nombre' => [
	    				'El campo nombre es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_last_name()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'apellidoPaterno' => [
	    				'El campo apellido paterno es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_send_no_email()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'correoElectronico' => [
	    				'El campo correo electronico es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_no_correct_email_syntax()
    {
    	$data = [
    		'correoElectronico' => 'test@recluta'
    	];
    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'correoElectronico' => [
	    				'El campo correo electronico no es un correo válido.'
	    			]
    			]
    		]);
    }

    public function test_no_unique_email()
    {
    	$user = factory(\ReclutaTI\User::class)->create();
    	$data = [
    		'correoElectronico' => $user->email
    	];
    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'correoElectronico' => [
	    				'El campo correo electronico ya ha sido registrado.'
	    			]
    			]
    		]);
    }

    public function test_send_no_password()
    {
    	$response = $this->json('POST', $this->url);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'password' => [
	    				'El campo contraseña es obligatorio.'
	    			]
    			]
    		]);
    }

    public function test_password_and_confirmation_not_match()
    {
    	$data = [
    		'password' => 'Huo0lpaw@',
    		'password_confirmation' => 'hola'
    	];
    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(422)
    		->assertJson([
    			'errors' => [
    				'password' => [
	    				'La confirmación del campo contraseña no coincide.'
	    			]
    			]
    		]);
    }

    public function test_success()
    {
    	$data = [
    		'nombre' => 'Jhon',
    		'apellidoPaterno' => 'Doe',
    		'correoElectronico' => 'jd.test@reclutati.com',
    		'password' => 'Huo0lpaw@',
    		'password_confirmation' => 'Huo0lpaw@'
    	];
    	$response = $this->json('POST', $this->url, $data);

    	$response
    		->assertStatus(200)
    		->assertJson([
    			'errors' => false
    		]);
    }
}
