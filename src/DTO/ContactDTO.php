<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class ContactDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 50)]
    public ?string $firstname = null;
    
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 50)]
    public ?string $lastname = null;

    #[Assert\NotBlank]
    #[Assert\Email]
    public ?string $email = null;

    #[Assert\Regex(
        pattern: '/^\+?[0-9\s\-]{7,15}$/',
        message: 'Please enter a valid phone number.'
    )]
    public ?string $phone = null;


    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 300)]
    public ?string $message = null;
}