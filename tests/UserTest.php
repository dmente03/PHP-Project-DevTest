<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    public function testsUsersAreCreatedCorrectly()
    {
      $password = Hash::make('toptal');

      $payload = [
          'name' => 'Daniel Silvestre',
          'email' => 'm.c.d.tec@gmail.com',
          'password' => $password
      ];

      $this->json('POST', '/api/users', $payload)
          ->assertResponseStatus(201)
          ->seeJson(['id' => 1, 'name' => 'Daniel Silvestre', 'email' => 'm.c.d.tec@gmail.com']);
    }

    public function testsUsersAreUpdatedCorrectly()
    {
        $password = Hash::make('toptal');

        $user = factory(\App\User::class)->create([
            'name' => 'Daniel Silvestre',
            'email' => 'm.c.d.tec@gmail.com',
            'password' => $password
        ]);

        $payload = [
            'id' => 1,
            'name' => 'Daniel Alves',
            'email' => 'm.c.d.tec@gmail.com',
            'password' => $password
        ];

        $response = $this->json('PUT', '/api/users/' . $user->id, $payload)
            ->assertResponseStatus(200)
            ->seeJson(['id' => 1, 'name' => 'Daniel Alves', 'email' => 'm.c.d.tec@gmail.com']);
    }

    public function testsUsersAreDeletedCorrectly()
    {
        $password = Hash::make('toptal');

        $user = factory(\App\User::class)->create([
            'name' => 'Daniel Silvestre',
            'email' => 'm.c.d.tec@gmail.com',
            'password' => $password
        ]);

        $this->json('DELETE', '/api/users/' . $user->id, [])
            ->assertResponseStatus(204);
    }

    public function testUsersAreListedCorrectly()
    {
        $password = Hash::make('toptal');

        factory(\App\User::class)->create([
            'name' => 'Daniel Silvestre',
            'email' => 'm.c.d.tec@gmail.com',
            'password' => $password
        ]);

        factory(\App\User::class)->create([
            'name' => 'Daniel Alves',
            'email' => 'm.c.d.tec@gmail.com.br',
            'password' => $password
        ]);

        $response = $this->json('GET', '/api/users', [])
            ->assertResponseStatus(200)
            ->seeJson([ 'name' => 'Daniel Silvestre', 'email' => 'm.c.d.tec@gmail.com' ])
            ->seeJson([ 'name' => 'Daniel Alves', 'email' => 'm.c.d.tec@gmail.com.br' ]);
    }
}
