<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class PostTest extends TestCase {
    public function testPostCreation() {
        $post = new Post("Title", "Content", "title-slug");

        $this->assertEquals("Title", $post->getTitle());
        $this->assertEquals("Content", $post->getContent());
        $this->assertEquals("title-slug", $post->getSlug());
        $this->assertFalse($post->isPrivate());
    }

    public function testEmptyTitleThrowsException() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Title cannot be empty");
        new Post("", "Content", "title-slug");
    }

    public function testEmptyContentThrowsException() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Content cannot be empty");
        new Post("Title", "", "title-slug");
    }
    

    public function testInvalidSlugThrowsException() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Slug cannot be empty and must contain only URL safe characters");
        new Post("Title", "Content", "invalid slug!");
    }

    public function testSetPrivate() {
        $post = new Post("Title", "Content", "title-slug");
        $post->setPrivate(true);
        $this->assertTrue($post->isPrivate());
    }
}

