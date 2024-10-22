<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageUploadService
{
    protected $uploadDir = 'upload';

    /**
     * =============================================
     * Upload an image to the specified folder with a prefix and UUID filename.
     *=============================================
     */
    public function uploadImage($imageFile, $prefix)
    {
        // Validate image file types (png, jpg, jpeg, webp)
        $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp'];
        if (!in_array($imageFile->getClientOriginalExtension(), $allowedExtensions)) {
            throw new \Exception('Invalid image type.');
        }

        // Build directory path using current date
        $datePath = now()->format('Y/m/d');
        $directory = public_path("$this->uploadDir/$datePath");

        // Create the directory if it doesn't exist
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Generate UUID filename with prefix
        $filename = $prefix . '_' . Str::uuid() . '.' . $imageFile->getClientOriginalExtension();

        // Move the uploaded file to the public directory
        $imageFile->move($directory, $filename);

        // Return the full URL of the stored image
        return url("$this->uploadDir/$datePath/$filename");
    }

    /**
     * =============================================
     * Delete an image file based on its URL.
     * =============================================
     */
    public function deleteImage($fileUrl)
    {
        // Parse the file path from the URL (after the domain)
        $filePath = str_replace(url('/'), '', $fileUrl);
        $filePath = public_path($filePath);

        // Check if the file exists in the public folder
        if (!File::exists($filePath)) {
            throw new \Exception('File not found.');
        }

        // Attempt to delete the file
        if (!File::delete($filePath)) {
            throw new \Exception('Failed to delete the file.');
        }

        return true;
    }


}
