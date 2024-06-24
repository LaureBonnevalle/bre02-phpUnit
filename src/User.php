<?php

class User {
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $roles;

    public function __construct($firstName, $lastName, $email, $password, $roles = ["ANONYMOUS"]) {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->roles = $roles;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        if (empty($firstName)) {
            throw new Exception("First name cannot be empty");
        }
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        if (empty($lastName)) {
            throw new Exception("Last name cannot be empty");
        }
        $this->lastName = $lastName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email address");
        }
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        if (strlen($password) < 8 || !preg_match('/[0-9]/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/[\W]/', $password)) {
            throw new Exception("Password must be at least 8 characters long, contain at least one digit, one uppercase letter, and one special character");
        }
        $this->password = $password;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function setRoles($roles) {
        if (!in_array("ANONYMOUS", $roles) && !in_array("USER", $roles) && !in_array("ADMIN", $roles)) {
            throw new Exception("Roles must include at least 'ANONYMOUS', 'USER', or 'ADMIN'");
        }
        if ((in_array("USER", $roles) || in_array("ADMIN", $roles)) && in_array("ANONYMOUS", $roles)) {
            throw new Exception("A user cannot have 'ANONYMOUS' role if they have 'USER' or 'ADMIN' roles");
        }
        $this->roles = $roles;
    }

    public function hasRole($role): bool
    {
        return in_array($role, $this->roles);
    }

    public function addRole($role): array
    {
        if (!in_array($role, ["ANONYMOUS", "USER", "ADMIN"])) {
            throw new Exception("Invalid role");
        }
        if ($role !== "ANONYMOUS" && in_array("ANONYMOUS", $this->roles)) {
            $this->roles = array_diff($this->roles, ["ANONYMOUS"]);
        }
        if (!in_array($role, $this->roles)) {
            $this->roles[] = $role;
        }
        return $this->roles;
    }

    public function removeRole($role) {
        if (($key = array_search($role, $this->roles)) !== false) {
            unset($this->roles[$key]); // array_diff pour remplacer : remplace ce bloc
        }
        
        if (empty($this->roles)) {
            $this->roles[] = "ANONYMOUS";
        }
        
        return $this->roles;
    }
}
