<?php

namespace Tests\Feature;

use App\Services\ImageUploadService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ImageUploadServiceTest extends TestCase
{
    protected $imageUploadService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->imageUploadService = new ImageUploadService();
    }

    public function testUploadImageSuccessfully()
    {
        // Create a fake image file
        $file = UploadedFile::fake()->image('avatar.jpg');

        // Call the uploadImage method
        $url = $this->imageUploadService->uploadImage($file, 'profile');

        // Get the relative path from the returned URL
        $relativePath = str_replace(url('/'), '', $url); // Remove the domain from the URL

        // Check that the file was stored
        $this->assertStringContainsString('upload/', $url);
        $this->assertFileExists(public_path($relativePath)); // Check existence with relative path
    }

    public function testUploadImageThrowsExceptionForInvalidType()
    {
        // Create a fake text file
        $file = UploadedFile::fake()->create('document.txt', 100);

        // Assert that an exception is thrown
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid image type.');

        // Attempt to upload the invalid file
        $this->imageUploadService->uploadImage($file, 'profile');
    }

    public function testDeleteImageSuccessfully()
    {
        // Create a fake image file to test deletion
        $file = UploadedFile::fake()->image('avatar.jpg');
        $url = $this->imageUploadService->uploadImage($file, 'profile');

        // Check that the file exists before deletion
        $relativePath = str_replace(url('/'), '', $url);
        $this->assertFileExists(public_path($relativePath));

        // Now delete the file using the deleteImage method
        $result = $this->imageUploadService->deleteImage($url);

        // Check that the file no longer exists
        $this->assertTrue($result);
        $this->assertFileDoesNotExist(public_path($relativePath));
    }

    public function testDeleteImageThrowsExceptionForNonExistentFile()
    {
        // Attempt to delete a non-existent file
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('File not found.');

        // Call deleteImage with a non-existent URL
        $this->imageUploadService->deleteImage('http://example.com/non-existent.jpg');
    }

    public function testDeleteImageThrowsExceptionOnFailedDeletion()
{
    // Create a fake image file
    $file = UploadedFile::fake()->image('avatar.jpg');
    $url = $this->imageUploadService->uploadImage($file, 'profile');

    // Check that the file exists before attempting to delete
    $relativePath = str_replace(url('/'), '', $url);
    $this->assertFileExists(public_path($relativePath));

    // Mock the File facade to return true for exists and throw an exception on delete
    File::shouldReceive('exists')
        ->once()
        ->with(public_path($relativePath))
        ->andReturn(true);

    File::shouldReceive('delete')
        ->once()
        ->with(public_path($relativePath))
        ->andReturn(false); // Simulate a failed deletion

    // Expect an exception to be thrown
    $this->expectException(\Exception::class);
    $this->expectExceptionMessage('Failed to delete the file.');

    // Attempt to delete the file
    $this->imageUploadService->deleteImage($url);
}
}
