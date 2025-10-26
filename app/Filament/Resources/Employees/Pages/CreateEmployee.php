<?php

namespace App\Filament\Resources\Employees\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (isset($data['image']) && $data['image'] instanceof TemporaryUploadedFile) {
            $upload = Cloudinary::upload($data['image']->getRealPath(), [
                'folder' => 'employees',
            ]);
            $data['image'] = $upload->getSecurePath(); // => URL của ảnh
        }

         $user = User::create([
            'name' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $data['user_id'] = $user->id;

        // Xóa các trường user khỏi dữ liệu employee
        unset($data['username'], $data['email'], $data['password']);

        return $data;
    }
    protected function afterCreate(): void
    {
        // Gán roles (nếu có)
        if ($this->record && request()->input('data.roles')) {
            $this->record->roles()->sync(request()->input('data.roles'));
        }
    }
}
