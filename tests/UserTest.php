<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {
    public function testUserCreation() {
        $user = new User("John", "Doe", "john.doe@example.com", "Password1!");

        $this->assertEquals("John", $user->getFirstName());
        $this->assertEquals("Doe", $user->getLastName());
        $this->assertEquals("john.doe@example.com", $user->getEmail());
        $this->assertEquals("Password1!", $user->getPassword());
        $this->assertEquals(["ANONYMOUS"], $user->getRoles());
    }

    public function testEmptyFirstNameThrowsException() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("First name cannot be empty");
        new User("", "Doe", "john.doe@example.com", "Password1!");
    }

    public function testEmptyLastNameThrowsException() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Last name cannot be empty");
        new User("John", "", "john.doe@example.com", "Password1!");
    }

    public function testInvalidEmailThrowsException() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Invalid email address");
        new User("John", "Doe", "invalid-email", "Password1!");
    }

    public function testInvalidPasswordThrowsException() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Password must be at least 8 characters long, contain at least one digit, one uppercase letter, and one special character");
        new User("John", "Doe", "john.doe@example.com", "pass");
    }

    public function testAddRole() {
        $user = new User("John", "Doe", "john.doe@example.com", "Password1!");
        $user->addRole("USER");
        $this->assertEquals(["USER"], $user->getRoles());
    }

    public function testRemoveRole() {
        $user = new User("John", "Doe", "john.doe@example.com", "Password1!", ["USER"]);
        $user->removeRole("USER");
        //var_dump(["ANONYMOUS"]);
        //var_dump($user->getRoles());
        $this->assertContains("ANONYMOUS", $user->getRoles());
    }
}
