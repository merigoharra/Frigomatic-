<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class PasswordUpdate
{

    private $oldpassword;

    private $newPassword;

    /**
     * @Assert\EqualTo(propertyPath="newPassword", message="Mot de passe non identique")
     */
    private $confirmPassword;

    public function getOldpassword(): ?string
    {
        return $this->oldpassword;
    }

    public function setOldpassword(string $oldpassword): self
    {
        $this->oldpassword = $oldpassword;
        return $this;
    }

    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    public function setNewPassword(string $newPassword): self
    {
        $this->newPassword = $newPassword;
        return $this;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(string $confirmPassword): self
    {
        $this->confirmPassword = $confirmPassword;
        return $this;
    }

}