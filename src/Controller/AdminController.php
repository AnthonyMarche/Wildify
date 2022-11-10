<?php

namespace App\Controller;

use App\Model\AdminManager;

class AdminController extends AbstractController
{
    public function showAllUsers(): string
    {
        $adminManager = new AdminManager();
        $users = $adminManager->getAllUsers();

      
        return $this->twig->render('Setting/Admin/admin.html.twig', ['users' => $users]);
    }

    public function showDeleteUser($id): string
    {
        $adminManager = new AdminManager();
        $admin = $adminManager->selectOneUser($id);

        //var_dump($admin);
        //die();

        return $this->twig->render('Setting/Admin/admin-delete.html.twig', ['admin' => $admin]);
    }
}