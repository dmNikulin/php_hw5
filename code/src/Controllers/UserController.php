<?php

namespace Geekbrains\Application1\Controllers;

use Geekbrains\Application1\Render;
use Geekbrains\Application1\Models\User;

class UserController {

    public function actionAddUser() {
        return "Тут добавляется юзер";
    }

    public function actionIndex() {
        $users = User::getAllUsersFromStorage();
        
        $render = new Render();

        if(!$users){
            return $render->renderPage(
                'user-empty.twig',
                [
                    'title' => 'Список пользователей в хранилище',
                    'message' => "Список пуст или не найден"
                ]);
        }
        else{
            return $render->renderPage(
                'user-index.twig',
                [
                    'title' => 'Список пользователей в хранилище',
                    'users' => $users
                ]);
        }
    }
    public function actionSave() {

        $address = "./storage/birthdays.txt";
        $name = $_GET['name'];
        $date = $_GET['birthday'];
        $data = $name . ", " . $date . "\r\n";
        
        $file = fopen($address, 'a');

        if(fwrite($file, $data)){
            return "Запись $data успешно сохранена";
        }

        else {
            return "Произошла ошибка!";
        }
    }
}