<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserControllerTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function testCreateUser()
    {
        $this->post('/users', [
            'name' => 'Human Person',
            'email' => 'hperson@universe.com'
        ])->seeStatusCode(201);

        $response = json_decode($this->response->getContent());

        $this->assertEquals("The user with id 11 has been successfully created.", $response->message);

    }

    public function testGetAllUsersShouldReturn200StatusCode()
    {
        $this->get('/users')->seeStatusCode(200);

    }

    public function testGetAllUsers()
    {
        $this->get('/users');
        $response = json_decode($this->response->getContent());

        $this->assertCount(10, $response);
    }

    public function testGetUser()
    {
        $this->get('/users/1');

        $this->assertResponseStatus(200);

        $response = $this->response->getContent();

        $this->assertNotEmpty($response);

        $this->assertContains("id", $response);

        $this->assertContains("email", $response);
    }


    public function testGetInvalidUser()
    {
        $this->get('/users/11');

        $this->assertResponseStatus(404);

        $response = json_decode($this->response->getContent());

        $this->assertEquals("User not found.", $response->message);
    }


}
