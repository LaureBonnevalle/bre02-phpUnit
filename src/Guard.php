<?php

class Guard {
    public function giveAccess(Post $post, User $user): User {
        if ($post->isPrivate()) {
            if ($user->isAnonymous()) {
                throw new Exception("L'utilisateur ne peut pas être anonyme.");
            } elseif ($user->isAdmin()) {
                // Rien ne se passe si l'utilisateur est déjà admin.
            } else {
                $user->setRole(User::ROLE_ADMIN);
            }
        } else {
            if ($user->isAnonymous()) {
                $user->setRole(User::ROLE_USER);
            }
            // Rien ne se passe si l'utilisateur est déjà user ou admin.
        }
        return $user;
    }

    public function removeAccess(Post $post, User $user): User {
        if ($post->isPrivate()) {
            if ($user->isAnonymous()) {
                // Rien ne se passe si l'utilisateur est déjà anonyme.
            } elseif ($user->isAdmin()) {
                $user->setRole(User::ROLE_USER);
            } else {
                $user->setRole(User::ROLE_ANONYMOUS);
            }
        } else {
            if ($user->isAnonymous()) {
                // Rien ne se passe si l'utilisateur est déjà anonyme.
            } elseif ($user->isAdmin()) {
                $user->setRole(User::ROLE_USER);
            } else {
                $user->setRole(User::ROLE_ANONYMOUS);
            }
        }
        return $user;
    }
}


        