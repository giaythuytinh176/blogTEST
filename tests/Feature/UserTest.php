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

    public function testLoginAccountOrPasswordNotFound()
    {
        Session::start();
        $data = [
            'email' => 'giaythuytinh176@live.com',
            'password' => '123456',
            '_token' => csrf_token(),
        ];
        $res = $this->post('/admin/login', $data);
        $res->assertStatus(302);
        $res2 = $this->get('/admin/login');
        $res2->assertSeeText('Email or password is incorrect');
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

    public function testInvalidAccessUser()
    {
        Session::start();
        $data = [
            'email' => 'giaythuytinh176@hotmail.com',
            'password' => '0979029556',
            '_token' => csrf_token(),
        ];
        $res = $this->post('/admin/login', $data);
        $res->assertStatus(302);
        $res2 = $this->get('/p/23/them-1-ca-mac-covid-19-viet-nam-ghi-nhan-2554-ca-benh');
        $res2->assertSeeText('Not Found');
    }

    public function testLoginWithAdminSite()
    {
        Session::start();
        $data = [
            'email' => 'giaythuytinh176@gmail.com',
            'password' => '0979029556',
            '_token' => csrf_token(),
        ];
        $res = $this->post('/admin/login', $data);
        $res->assertStatus(302);
        $res2 = $this->get('/admin');
        $res2->assertSeeText('You are admin');
    }

    public function testUserCannotAdmin()
    {
        Session::start();
        $data = [
            'email' => 'giaythuytinh176@hotmail.com',
            'password' => '0979029556',
            '_token' => csrf_token(),
        ];
        $res = $this->post('/admin/login', $data);
        $res->assertStatus(302);
        $res2 = $this->get('/admin');
        $res2->assertDontSeeText('You are admin');
    }

    public function testOnlyAdminSeeHighlightPost()
    {
        Session::start();
        $data = [
            'email' => 'giaythuytinh176@gmail.com',
            'password' => '0979029556',
            '_token' => csrf_token(),
        ];
        $res = $this->post('/admin/login', $data);
        $res->assertStatus(302);
        $res2 = $this->get('/');
        $res2->assertSeeText('Scheduled');
    }

    public function testUserCannotSeeHighlightPost()
    {
        Session::start();
        $data = [
            'email' => 'giaythuytinh176@hotmail.com',
            'password' => '0979029556',
            '_token' => csrf_token(),
        ];
        $res = $this->post('/admin/login', $data);
        $res->assertStatus(302);
        $res2 = $this->get('/');
        $res2->assertDontSeeText('Scheduled');
    }

    public function testUserCannotSeeHidePost()
    {
        Session::start();
        $data = [
            'email' => 'giaythuytinh176@hotmail.com',
            'password' => '0979029556',
            '_token' => csrf_token(),
        ];
        $res = $this->post('/admin/login', $data);
        $res->assertStatus(302);
        $res2 = $this->get('/');
        $res2->assertDontSeeText('Hide');
    }

    public function testAdminCanSeeHidePost()
    {
        Session::start();
        $data = [
            'email' => 'giaythuytinh176@gmail.com',
            'password' => '0979029556',
            '_token' => csrf_token(),
        ];
        $res = $this->post('/admin/login', $data);
        $res->assertStatus(302);
        $res2 = $this->get('/');
        $res2->assertSeeText('Hide');
    }

    public function testUserCannotRegisterAsAAdmin()
    {
        Session::start();
        $data = [
            'email' => uniqid() . '@gmail.com',
            'password' => '0979029556',
            'password_confirmation' => '0979029556',
            'role' => '1', // use fake form to register as a admin
            '_token' => csrf_token(),
        ];
        $res = $this->post('/admin/register', $data);
        $res->assertStatus(302);
        $res2 = $this->get('/admin');
        $res2->assertDontSeeText('You are admin');
    }


}
