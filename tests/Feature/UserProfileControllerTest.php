<?php

namespace Tests\Feature;

use App\Services\ImageUploadService;
use App\Services\UserProfileService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserProfileControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $userProfileService;
    protected $imageUploadService;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userProfileService = $this->createMock(UserProfileService::class);
        $this->imageUploadService = $this->createMock(ImageUploadService::class);

        $this->app->instance(UserProfileService::class, $this->userProfileService);
        $this->app->instance(ImageUploadService::class, $this->imageUploadService);

        // Create a user and authenticate
        $this->user = \App\Models\User::factory()->create();
        Auth::login($this->user);
    }

    public function testIndexDisplaysUserProfile()
    {
        // Mock the service method to return a profile
        $this->userProfileService->method('getUserProfile')->willReturn(null);

        $response = $this->get(route('user.profile.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.pages.setting.userprofile-index');
        $response->assertSee('User Profile');
    }

    public function testUpdateOrCreateSuccessfullyUpdatesProfile()
    {
        $this->userProfileService->method('updateOrCreate')->willReturn(true);

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->put(route('user.profile.update'), [
            'profile_picture' => $file,
            'name' => 'John Doe',
            'phone_number' => '1234567890',
            'address' => '123 Main St',
            'city' => 'Sample City',
            'country' => 'Sample Country',
            'gender' => 'male',
            'date_of_birth' => '2000-01-01',
        ]);

        $response->assertRedirect(route('user.profile.index'));
        $response->assertSessionHas('alerts');
    }

    public function testUpdateOrCreateFailsWhenValidationFails()
    {
        $response = $this->put(route('user.profile.update'), [
            'profile_picture' => 'not-an-image',
            'name' => '',
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    public function testUpdateOrCreateHandlesImageUpload()
    {
        $this->imageUploadService->method('uploadImage')->willReturn('path/to/image.jpg');
        $this->userProfileService->method('updateOrCreate')->willReturn(true);

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->put(route('user.profile.update'), [
            'profile_picture' => $file,
            'name' => 'John Doe',
        ]);

        $response->assertRedirect(route('user.profile.index'));
    }
}
