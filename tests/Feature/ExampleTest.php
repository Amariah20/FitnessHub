<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ExampleTest extends TestCase
{
    /*
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }*/

    public function testadminPermissions(): void
    {

      

        $user= User::where('email', 'u@gmail.com')->first(); //getting a user without admin permission
        $globaladmin= User::where('email', 'globaladmin@gmail.com')->first(); 
        
       
       $this->actingAs($globaladmin);
      

       $response= $this->post("/AdminAccess/{$user->id}/grant-admin-access");
       $response->assertStatus(200);
       
       $user->refresh();
      // dd($user);
     
    }
}
