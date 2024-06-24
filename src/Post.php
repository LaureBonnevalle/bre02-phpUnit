
<?php


class Post {
    private string $title;
    private string $content;
    private string $slug;
    private bool $private;

    public function __construct(string $title, string $content,string $slug,bool  $private = false) {
        $this->setTitle($title);
        $this->setContent($content);
        $this->setSlug($slug);
        $this->private = $private;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle($title) : void {
        if (empty($title)) {
            throw new Exception("Title cannot be empty");
        }
        $this->title = $title;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function setContent($content) :void {
        if (empty($content)) {
            throw new Exception("Content cannot be empty");
        }
        $this->content = $content;
    }

    public function getSlug(): string {
        return $this->slug;
    }

    public function setSlug($slug) : void{
        if (empty($slug) || !preg_match('/^[a-zA-Z0-9-_]+$/', $slug)) {
            throw new Exception("Slug cannot be empty and must contain only URL safe characters");
        }
        $this->slug = $slug;
    }

    public function isPrivate() : ? bool {
        return $this->private;
    }

    public function setPrivate($private) : void {
        $this->private = $private;
    }
    
    
}
