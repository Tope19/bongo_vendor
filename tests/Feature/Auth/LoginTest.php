<?php
namespace Tests\Feature\Auth;

use App\Constants\AppConstants;
use App\Http\Requests\LoginFormRequest;
use App\Models\ServiceProvider;
use App\Models\User; // Make sure to import the User model
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Import Hash facade if needed
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\Factory;

// uses(TestCase::class, RefreshDatabase::class);


it('logs in user with valid credentials', function () {
    // Create a user with a role and email_verified_at
    $user = User::factory()->create([
        'role' => AppConstants::ARTISAN_ROLE,
        'email_verified_at' => now(),
    ]);

    // Create an artisan profile
    $artisan = factory(ServiceProvider::class)->create([
        'user_id' => $user->id,
        'status' => AppConstants::ACTIVE, // Assuming this is the approved status
    ]);

    $this->mock(Auth::class . '_1')
        ->shouldReceive('attempt')
        ->andReturn(true);

    $this->mock(Auth::class . '_2')
        ->shouldReceive('user')
        ->andReturn($user);

    $response = $this->post(route('auth.login.save'), [
        'email' => $user->email,
        'password' => 'password', // Assuming the password for the user
        'remember_me' => 'on',
    ]);

    $response->assertRedirect('/');
    $response->assertSessionHas('success', 'You have successfully logged in.');
});

it('redirects to artisan awaiting-approval route if artisan profile is pending and fields are complete', function () {
    // Create a user with a role and email_verified_at
    $user = User::factory()->create([
        'role' => AppConstants::ARTISAN_ROLE,
        'email_verified_at' => now(),
    ]);

    // Create an artisan profile with pending status and all required fields complete
    $artisan = factory(ServiceProvider::class)->create([
        'user_id' => $user->id,
        'status' => AppConstants::PENDING,
        'country_id' => 1, // Assuming these are the required fields
        'state_id' => 1,
        'city_id' => 1,
        'address' => '123 Main St',
        'id_card' => '123456789',
        'pass_photo' => 'path/to/photo',
        'category_id' => 1,
    ]);

    $this->mock(Auth::class . '_3')
        ->shouldReceive('attempt')
        ->andReturn(true);

    $this->mock(Auth::class . '_4')
        ->shouldReceive('user')
        ->andReturn($user);

    $response = $this->post(route('auth.login.save'), [
        'email' => $user->email,
        'password' => 'password', // Assuming the password for the user
        'remember_me' => 'on',
    ]);

    $response->assertRedirect(route('auth.artisan.awaiting-approval'));
});

it('redirects to artisan personal-info route if artisan profile is pending or fields are incomplete', function () {
    // Create a user with a role and email_verified_at
    $user = User::factory()->create([
        'role' => AppConstants::ARTISAN_ROLE,
        'email_verified_at' => now(),
    ]);

    // Create an artisan profile with pending status and some fields incomplete
    $artisan = factory(ServiceProvider::class)->create([
        'user_id' => $user->id,
        'status' => AppConstants::PENDING,
        'country_id' => 1, // Assuming only one required field is complete
    ]);

    $this->mock(Auth::class . '_5')
        ->shouldReceive('attempt')
        ->andReturn(true);

    $this->mock(Auth::class . '_6')
        ->shouldReceive('user')
        ->andReturn($user);

    $response = $this->post(route('auth.login.save'), [
        'email' => $user->email,
        'password' => 'password', // Assuming the password for the user
        'remember_me' => 'on',
    ]);

    $response->assertRedirect(route('auth.artisan.personal-info'));
});

it('logs out user if invalid credentials provided', function () {
    $this->mock(Auth::class . '_7')
        ->shouldReceive('attempt')
        ->andReturn(false);

    $response = $this->post(route('auth.login.save'), [
        'email' => 'invalid@example.com',
        'password' => 'invalidpassword',
    ]);

    $response->assertRedirect(route('auth.login'));
    $response->assertSessionHas('error', 'Invalid credentials.');
});
