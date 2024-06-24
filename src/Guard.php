<?php

class Guard {

    public function giveAccess(Post $post, User $user): User {
        if ($post->isPrivate()===true) {
            if ($user->hasRole("ANONYMOUS")) {
                throw new Exception("L'utilisateur ne peut pas être anonyme.");
            } elseif ($user->hasRole("USER")) {
                $user->addRole("ADMIN");
            }
        } elseif ($post->isPrivate()) {
            if ($user->hasRole("ANONYMOUS")) {
                $user->addRole("USER");
            }
        }
        return $user;
    }
    
    public function removeAccess(Post $post, User $user): User {
        if ($post->isPrivate()=== true) {
            if ($user->hasRole("USER")) {
                $user->removeRole("USER");
                $user->addRole("ANONYMOUS");
            } elseif ($user->hasRole("ADMIN")) {
                $user->removeRole("ADMIN");
                $user->addRole("USER");
            }
        } elseif ($post->isPrivate()) {
            if ($user->hasRole("USER")) {
                $user->removeRole("USER");
                $user->addRole("ANONYMOUS");
            } elseif ($user->hasRole("ADMIN")) {
                $user->removeRole("ADMIN");
                $user->addRole("USER");
            }
        }
        return $user;
    }
}