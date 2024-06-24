<?php
use PHPUnit\Framework\TestCase;

class GuardTest extends TestCase
{
    public function testGiveAccessForPrivatePost()
    {
        $user = new User("John", "Doe", "john@example.com", "P@ssw0rd", ["USER"]);
        $post = new Post("My Private Post", "This is a private post content.", "my-private-post", true);

        $guard = new Guard();
        $resultUser = $guard->giveAccess($post, $user);

        $this->assertTrue($resultUser->hasRole("ADMIN"));
    }

    public function testGiveAccessForPublicPost()
    {
        $user = new User("Jane", "Smith", "jane@example.com", "P@ssw0rd", ["ANONYMOUS"]);
        $post = new Post("My Public Post", "This is a public post content.", "my-public-post", false);

        $guard = new Guard();
        $resultUser = $guard->giveAccess($post, $user);

        $this->assertFalse($resultUser->hasRole("USER"));
    }

    public function testRemoveAccessForPrivatePost()
    {
        $user = new User("Alice", "Johnson", "alice@example.com", "P@ssw0rd", ["USER"]);
        $post = new Post("My Private Post", "This is a private post content.", "my-private-post", true);

        $guard = new Guard();
        $resultUser = $guard->removeAccess($post, $user);

        $this->assertTrue($resultUser->hasRole("ANONYMOUS"));
    }

    public function testRemoveAccessForPublicPost()
    {
        $user = new User("Bob", "Brown", "bob@example.com", "P@ssw0rd", ["ADMIN"]);
        $post = new Post("My Public Post", "This is a public post content.", "my-public-post", false);

        $guard = new Guard();
        $resultUser = $guard->removeAccess($post, $user);

        $this->assertFalse($resultUser->hasRole("USER"));
    }
}
