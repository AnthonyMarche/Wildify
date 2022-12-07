<?php

namespace App\Model;

use App\Model\Connection;
use PDO;

class AdminManager extends Connection
{
// FEATURE GESTION USERS //
    public function selectOneUser(int $id): array
    {
        $sql = "SELECT ID_user, username, email, password FROM user WHERE ID_user=:id";
        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function getAllMusics(): array
    {
        $sql = "SELECT songs.ID_song, songs.title, songs.artist, songs.image_url, genre.genre, user.username FROM songs
        JOIN genre ON genre.ID_genre = songs.genre_ID_genre
        JOIN user ON user.ID_user = songs.user_ID_user";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getOneMusic(int $id): array
    {
        $sql = "SELECT songs.ID_song, songs.title, songs.artist, songs.image_url, genre.genre, user.username FROM songs
        JOIN genre ON genre.ID_genre = songs.genre_ID_genre
        JOIN user ON user.ID_user = songs.user_ID_user
        WHERE songs.ID_song=:id";
        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function deleteUsersSongs(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM songs WHERE user_ID_user=:id");
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function deleteUsersLikes(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM `like` WHERE user_ID_user=:id");
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
