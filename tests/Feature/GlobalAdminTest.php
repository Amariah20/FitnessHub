<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GlobalAdminTest extends TestCase
{
    /**
     * A basic feature test example.
     */

     //THIS DOES NOT WORK
    public function adminPermissions(): void
    {
       $user= User::where('email', 'u@gmail.com')->first(); //getting a user without admin permission
        //$user= User::where ('is_admin', 0)->where('email', '!=', 'globaladmin@gmail.com')->first();
        
       $globaladmin= User::where('email', 'globaladmin@gmail.com')->first(); 
       
       $this->actingAs($globaladmin);

       $response= $this->post("/AdminAccess/{$user->id}/grant-admin-access");
       
       $response->assertStatus(200);
       $user->refresh();

       $this->assertEquals(1, $user->is_admin);
       dd($response->content());

    }
}
