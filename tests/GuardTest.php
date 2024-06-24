<?php

// Test unitaire
class GuardTest {
    public function testGiveAccess() {
        $guard = new Guard();
        $post = new Post(true); // Post privé
        $user = new User(User::ROLE_ANONYMOUS);

        // Test avec un utilisateur anonyme sur un post privé
        try {
            $guard->giveAccess($post, $user);
        } catch (Exception $e) {
            // L'exception devrait être levée ici
            echo "Exception: " . $e->getMessage();
        }

        // Test avec un utilisateur USER sur un post privé
        $user->setRole(User::ROLE_USER);
        $result = $guard->giveAccess($post, $user);
        echo "Nouveau rôle: " . $result->getRole(); // Attendu: ADMIN

        // Test avec un utilisateur ADMIN sur un post privé
        $user->setRole(User::ROLE_ADMIN);
        $result = $guard->giveAccess($post, $user);
        echo "Nouveau rôle: " . $result->getRole(); // Attendu: ADMIN

        // Test avec un utilisateur anonyme sur un post public
        $post = new Post(false); // Post public
        $user->setRole(User::ROLE_ANONYMOUS);
        $result = $guard->giveAccess($post, $user);
        echo "Nouveau rôle: " . $result->getRole(); // Attendu: USER
    }

    public function testRemoveAccess() {
        $guard = new Guard();
        $post = new Post(true); // Post privé
        $user = new User(User::ROLE_ANONYMOUS);

        // Test avec un utilisateur anonyme sur un post privé
        $result = $guard->removeAccess($post, $user);
        echo "Nouveau rôle: " . $result->getRole(); // Attendu: ANONYMOUS

        // Test avec un utilisateur USER sur un post privé
        $user->setRole(User::ROLE_USER);
        $result = $guard->removeAccess($post, $user);
        echo "Nouveau rôle: " . $result->getRole(); // Attendu: ANONYMOUS

        // Test avec un utilisateur ADMIN sur un post privé
        $user->setRole(User::ROLE_ADMIN);
        $result = $guard->removeAccess($post, $user);
        echo "Nouveau rôle: " . $result->getRole(); // Attendu: USER

        // Test avec un utilisateur anonyme sur un post public
        $post = new Post(false); // Post public
        $user->setRole(User::ROLE_ANONYMOUS);
        $result = $guard->removeAccess($post, $user);
        echo "Nouveau rôle: " . $result->getRole(); // Attendu: ANONYMOUS
        
        // Test avec un utilisateur USER sur un post public
        $user->setRole(User::ROLE_USER);
        $result = $guard->removeAccess($post, $user);
        echo "Nouveau rôle: " . $result->getRole(); // Attendu
    }
}