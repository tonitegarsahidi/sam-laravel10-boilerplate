<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserProfile;
use App\Repositories\UserProfileRepository;
use App\Repositories\UserRepository;
use App\Services\ImageUploadService;
use App\Services\UserProfileService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Mockery;
use Tests\TestCase;

class UserProfileServiceTest extends TestCase
{
    private $userProfileService;
    private $userProfileRepository;
    private $userRepository;
    private $imageUploadService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userProfileRepository = Mockery::mock(UserProfileRepository::class);
        $this->userRepository = Mockery::mock(UserRepository::class);
        $this->imageUploadService = Mockery::mock(ImageUploadService::class);

        $this->userProfileService = new UserProfileService(
            $this->userProfileRepository,
            $this->userRepository,
            $this->imageUploadService
        );
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testGetUserProfileReturnsProfile()
    {
        $userId = 1;
        $expectedProfile = new UserProfile(['user_id' => $userId]);

        $this->userProfileRepository
            ->shouldReceive('getProfile')
            ->with($userId)
            ->once()
            ->andReturn($expectedProfile);

        $profile = $this->userProfileService->getUserProfile($userId);

        $this->assertEquals($expectedProfile, $profile);
    }

    public function testUpdateOrCreateCreatesNewProfile()
    {
        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('commit')->once();

        $userId = 1;
        $validatedData = [
            'name' => 'John Doe',
            'phone_number' => '123456789',
            'date_of_birth' => '2000-01-01',
            'gender' => 'male',
            'address' => '123 Street',
            'city' => 'City',
            'country' => 'Country',
            'profile_picture' => 'path/to/new/profile_picture.jpg',
        ];

        $this->userRepository
            ->shouldReceive('update')
            ->with($userId, Mockery::any())
            ->once();

        $this->userProfileRepository
            ->shouldReceive('getProfile')
            ->with($userId)
            ->once()
            ->andReturn(null); // Simulate that the user has no profile

        // Mock the create method to return a new UserProfile instance
        $mockedProfile = new UserProfile(['user_id' => $userId]);
        $this->userProfileRepository
            ->shouldReceive('create')
            ->with(Mockery::any())
            ->once()
            ->andReturn($mockedProfile); // Return the mocked profile

        $profile = $this->userProfileService->updateOrCreate($userId, $validatedData);

        $this->assertNotNull($profile);
    }


    public function testUpdateOrCreateUpdatesExistingProfile()
    {
        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('commit')->once();

        $userId = 1;
        $validatedData = [
            'name' => 'John Doe',
            'phone_number' => '987654321',
            'date_of_birth' => '2000-01-01',
            'gender' => 'male',
            'address' => '456 Avenue',
            'city' => 'City',
            'country' => 'Country',
            'profile_picture' => 'path/to/updated/profile_picture.jpg',
        ];

        // Mock existing user data
        $existingUser = new User(['id' => $userId]);
        $this->userRepository
            ->shouldReceive('update')
            ->with($userId, Mockery::any())
            ->once();

        // Mock the existing profile
        $existingProfile = new UserProfile(['user_id' => $userId, 'profile_picture' => 'old/path/to/profile_picture.jpg']);
        $this->userProfileRepository
            ->shouldReceive('getProfile')
            ->with($userId)
            ->once()
            ->andReturn($existingProfile); // Simulate that the user already has a profile

        // Mock the update method to return the updated UserProfile instance
        $this->userProfileRepository
            ->shouldReceive('update')
            ->with($userId, Mockery::any())
            ->once()
            ->andReturn(new UserProfile(['user_id' => $userId])); // Return the updated profile

        $profile = $this->userProfileService->updateOrCreate($userId, $validatedData);

        $this->assertNotNull($profile);
    }


    public function testUpdateOrCreateHandlesException()
    {
        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('rollback')->once();

        $userId = 1;
        $validatedData = [
            'name' => 'Test User',
        ];

        $this->userRepository
            ->shouldReceive('update')
            ->with($userId, Mockery::any())
            ->once()
            ->andThrow(new \Exception('Update failed'));

        $result = $this->userProfileService->updateOrCreate($userId, $validatedData);

        $this->assertFalse($result);
    }
}
