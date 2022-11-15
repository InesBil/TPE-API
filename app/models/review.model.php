<?php

class ReviewModel {

    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_discography;charset=utf8' , 'root', '');
    }

    function getAll() {
        $query = $this->db->prepare('SELECT review.id_review, review.review, review.name, review.email, review.rating, albums.album FROM review INNER JOIN albums ON review.id_album_fk = albums.id');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);      
    }
    
    function get($id) {
        $query = $this->db->prepare('SELECT review.id_review, review.review, review.name, review.email, review.rating, albums.album FROM review INNER JOIN albums ON review.id_album_fk = albums.id WHERE `id_review` = ? ');
        $query->execute([$id]);
        return  $query->fetch(PDO::FETCH_OBJ);       
    }

    function insert($review, $name, $email, $rating, $id_album_fk) {
        $query = $this->db->prepare('INSERT INTO review (review, name, email, rating, id_album_fk) VALUES(?, ?, ?, ?, ?)');
        $query->execute([$review, $name, $email, $rating, $id_album_fk]);
        return $this->db->lastInsertId();
    }

    function delete($id) {
        $query = $this->db->prepare('DELETE FROM review WHERE id_review=?');
        $query->execute([$id]);
    }

    function update($id, $review, $name, $email, $rating, $id_album_fk){
        $query = $this->db->prepare('UPDATE review SET review=?, name=?, email=?, rating=?, id_album_fk=? WHERE id_review=?');
        $query->execute([$review, $name, $email, $rating, $id_album_fk, $id]);
    }

    function order($sort, $orderBy) {
        $query = $this->db->prepare('SELECT review.id_review, review.review, review.name, review.email, review.rating, albums.album FROM review INNER JOIN albums ON review.id_album_fk = albums.id ORDER BY '.$sort.' '.$orderBy);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);      
    }

    public function getAllPages($from, $limit){
        $query = $this->db->prepare("SELECT review.id_review, review.review, review.name, review.email, review.rating, albums.album FROM review INNER JOIN albums ON review.id_album_fk = albums.id LIMIT $from,$limit"); 
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);        
    }
 
}
