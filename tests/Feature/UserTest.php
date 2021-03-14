<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
//    public function test_example()
//    {
//        $response = $this->get('/admin/login');
//        $response->assertStatus(200);
//    }

    public function testShowFormLogin()
    {
        $response = $this->get('/admin/login');
        $response->assertViewIs('backend.user.auth-login-social');
        $response->assertSeeText('Login');
    }

    public function testShowFormRegister()
    {
        $response = $this->get('/admin/register');
        $response->assertViewIs('backend.user.auth-register-social');
        $response->assertSeeText('Create Account');
    }

    public function testLoginUsernameNull()
    {
        Session::start();
        $data = [
            'email' => null,
            'password' => '123456',
            '_token' => csrf_token(),
        ];
        $res = $this->post('/admin/login', $data);
        $res->assertStatus(302);
        $res2 = $this->get('/admin/login');
        $res2->assertSeeText('Email is required');
    }

    public function testLoginPasswordNull()
    {
        Session::start();
        $data = [
            'email' => 'giaythuytinh176@gmail.com',
            'password' => null,
            '_token' => csrf_token(),
        ];
        $res = $this->post('/admin/login', $data);
        $res->assertStatus(302);
        $res2 = $this->get('/admin/login');
        $res2->assertSeeText('Password is required');
    }

    public function testRegisterUsernameNull()
    {
        Session::start();
        $data = [
            'email' => null,
            'password' => '123456',
            'password_confirmation' => '123456',
            '_token' => csrf_token(),
        ];
        $res = $this->post('/admin/register', $data);
        $res->assertStatus(302);
        $res2 = $this->get('/admin/register');
        $res2->assertSeeText('Email is required');
    }

    public function testRegisterPasswordNull()
    {
        Session::start();
        $data = [
            'email' => 'giaythuytinh176@live.com',
            'password' => null,
            'password_confirmation' => null,
            '_token' => csrf_token(),
        ];
        $res = $this->post('/admin/register', $data);
        $res->assertStatus(302);
        $res2 = $this->get('/admin/register');
        $res2->assertSeeText('Password is required');
    }

    public function testRegisterUsernameExist()
    {
        Session::start();
        $data = [
            'email' => 'giaythuytinh176@gmail.com',
            'password' => 'abc123',
            'password_confirmation' => 'abc123',
            '_token' => csrf_token(),
        ];
        $res = $this->post('/admin/register', $data);
        $res->assertStatus(302);
        $res2 = $this->get('/admin/register');
        $res2->assertSeeText('Email is existed');
    }

    public function testLogout()
    {
        Session::start();
        $data = [
            'email' => 'giaythuytinh176@gmail.com',
            'password' => '0979029556',
            '_token' => csrf_token(),
        ];
        $res = $this->post('/admin/login', $data);
        $res->assertStatus(302);
        $res2 = $this->get('/admin/logout');
        $res2->assertSessionHas('toastr::messages');
    }


}
