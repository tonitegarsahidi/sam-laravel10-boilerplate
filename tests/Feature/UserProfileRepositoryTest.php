<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserProfile;
use App\Repositories\UserProfileRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions; // Import the trait
use Tests\TestCase;

class UserProfileRepositoryTest extends TestCase
{
    use DatabaseTransactions; // Use the DatabaseTransactions trait

    protected UserProfileRepository $userProfileRepository;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userProfileRepository = new UserProfileRepository();

        // Create a user without specifying the ID
        $this->user = User::factory()->create(); // This generates a user with a unique ID
    }

    public function testGetProfileReturnsUserProfile()
    {
        $userProfile = UserProfile::factory()->create(['user_id' => $this->user->id]);

        $result = $this->userProfileRepository->getProfile($this->user->id);

        $this->assertEquals($userProfile->id, $result->id);
    }

    public function testCreateSuccessfullyCreatesUserProfile()
    {
        $data = [
            'user_id' => $this->user->id, // Use the generated user's ID
            'date_of_birth' => '2000-01-01',
            'gender' => 'male',
            'address' => '123 Main St',
            'city' => 'Metropolis',
            'country' => 'Countryland',
            'profile_picture' => 'profile_picture.jpg',
        ];

        $userProfile = $this->userProfileRepository->create($data);

        $this->assertNotNull($userProfile);
        $this->assertEquals('123 Main St', $userProfile->address);
    }

    public function testUpdateSuccessfullyUpdatesUserProfile()
    {
        $userProfile = UserProfile::factory()->create(['user_id' => $this->user->id]);

        $data = [
            'address' => '456 Elm St',
            'city' => 'Gotham',
        ];

        $updatedProfile = $this->userProfileRepository->update($this->user->id, $data);

        $this->assertEquals('456 Elm St', $updatedProfile->address);
        $this->assertEquals('Gotham', $updatedProfile->city);
    }

    public function testUpdateThrowsExceptionForNonExistentProfile()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("User Profile not found");

        $data = [
            'address' => '789 Oak St',
        ];

        $this->userProfileRepository->update(999, $data); // Assuming 999 does not exist
    }
}
