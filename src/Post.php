
<?php


class Post {
    private $title;
    private $content;
    private $slug;
    private $private;

    public function __construct($title, $content, $slug, $private = false) {
        $this->setTitle($title);
        $this->setContent($content);
        $this->setSlug($slug);
        $this->private = $private;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        if (empty($title)) {
            throw new Exception("Title cannot be empty");
        }
        $this->title = $title;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        if (empty($content)) {
            throw new Exception("Content cannot be empty");
        }
        $this->content = $content;
    }

    public function getSlug() { //permet de determiner un titre de post compatible avec url
        return $this->slug;
    }

    public function setSlug($slug) {
        if (empty($slug) || !preg_match('/^[a-zA-Z0-9-_]+$/', $slug)) {
            throw new Exception("Slug cannot be empty and must contain only URL safe characters");
        }
        $this->slug = $slug;
    }

    public function isPrivate() {
        return $this->private;
    }

    public function setPrivate($private) {
        $this->private = $private;
    }
}
