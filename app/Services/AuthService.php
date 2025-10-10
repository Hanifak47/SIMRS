<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use GuzzleHttp\Psr7\UploadedFile;

class AuthService
{
    private $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        
        // dd("asnaskjk");
        $this->authRepository = $authRepository;
    }

    public function register(array $data)
    {
        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }

        return $this->authRepository->register($data);
    }

    public function login(array $data)
    {
        // dd("asnaskjk");
        return $this->authRepository->login($data);
    }

    public function tokenLogin(array $data)
    {
        return $this->authRepository->tokenLogin($data);
    }

    public function uploadPhoto(UploadedFile $photo)
    {
        // disimpan pada folder user
        return $photo->store('user', 'public');
    }


}