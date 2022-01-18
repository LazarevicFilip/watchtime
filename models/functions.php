<?php
function getAll($table)
{
    global $conn;
    $query = "SELECT * FROM $table";
    $result = $conn->query($query)->fetchAll();
    return $result;
}
function insertUser($fName, $lName, $email, $encryptedPass, $status, $roleId)
{
    global $conn;
    $query = "INSERT INTO korisnici (ime,prezime,email,lozinka,id_uloge,je_aktivan) VALUES (:ime, :prezime,:email,:lozinka,:id_uloge,:je_aktivan)";
    $insert = $conn->prepare($query);
    $insert->bindParam(":ime", $fName);
    $insert->bindParam(":prezime", $lName);
    $insert->bindParam(":email", $email);
    $insert->bindParam(":lozinka", $encryptedPass);
    $insert->bindParam(":id_uloge", $roleId);
    $insert->bindParam(":je_aktivan", $status);

    $result = $insert->execute();
    return $result;
}

function logUser($email, $encryptedPass)
{
    global $conn;
    $query = "SELECT k.id_korisnik AS id,k.ime,k.prezime,k.email,k.vreme_registracije AS vreme,u.naziv AS uloga,COUNT(ko.id_komentar) AS brojKomentara,COUNT(p.id_post) AS brojPostova FROM korisnici k INNER JOIN uloge u ON k.id_uloge = u.id_uloge INNER JOIN postovi p ON p.id_korisnik = k.id_korisnik INNER JOIN komentari ko ON ko.id_korisnik = k.id_korisnik
    WHERE k.email = :email AND k.lozinka = :pass";

    $select = $conn->prepare($query);
    $select->bindParam(":email", $email);
    $select->bindParam(":pass", $encryptedPass);
    $select->execute();
    $result = $select->fetch();
    return $result;
}
function insertPost($title, $desc, $id, $category, $newFileName)
{
    global $conn;

    $query = "INSERT INTO postovi (naslov,tekst,id_korisnik,id_kategorije,slika_src)VALUES(:naslov,:tekst,:id_kor,:id_kat,:putanja)";

    $insert = $conn->prepare($query);
    $insert->bindParam(":naslov", $title);
    $insert->bindParam(":tekst", $desc);
    $insert->bindParam(":id_kor", $id);
    $insert->bindParam(":id_kat", $category);
    $insert->bindParam(":putanja", $newFileName);

    $result = $insert->execute();
    return $result;
}
define("OFFSET_POSTS", 6);
function getAllPostsWithCatandAuthor($limit = 0)
{
    global $conn;

    $query = "SELECT p.id_post AS id,p.naslov,p.tekst,p.datum,k.ime,k.prezime,k.id_korisnik AS idKor,p.slika_src AS src,kat.naziv FROM postovi p INNER JOIN korisnici k ON p.id_korisnik = k.id_korisnik INNER JOIN kategorije kat ON p.id_kategorije = kat.id_kategorije LIMIT :limit ,:offset";

    $select = $conn->prepare($query);
    $limit *= OFFSET_POSTS;
    $select->bindParam(":limit", $limit, PDO::PARAM_INT);

    $offset = OFFSET_POSTS;
    $select->bindParam(":offset", $offset, PDO::PARAM_INT);
    $select->execute();
    $result = $select->fetchAll();
    return $result;
}
function countRows($table)
{
    global $conn;
    $query = "SELECT COUNT(*) AS postsNumber FROM $table";
    $select = $conn->query($query)->fetch();
    return $select;
}
function numberOfPagess($table)
{
    $numberofrows = countRows($table);
    $numberofPages = ceil($numberofrows->postsNumber / OFFSET_POSTS);
    return $numberofPages;
}
function getNewestPosts()
{
    define("OFFSET_NEWESTPOST", 3);
    define("LIMIT_NEWESTPOST", 0);
    global $conn;
    $query = "SELECT  p.id_post AS id,p.naslov,p.tekst,p.datum,k.ime,k.prezime,p.slika_src AS src,kat.naziv FROM postovi p INNER JOIN korisnici k ON p.id_korisnik = k.id_korisnik INNER JOIN kategorije kat ON p.id_kategorije = kat.id_kategorije ORDER BY p.datum DESC LIMIT :limit,:offset ";

    $select = $conn->prepare($query);
    $limit = LIMIT_NEWESTPOST;
    $select->bindParam(":limit", $limit, PDO::PARAM_INT);
    $offset = OFFSET_NEWESTPOST;
    $select->bindParam(":offset", $offset, PDO::PARAM_INT);
    $select->execute();
    $result = $select->fetchAll();
    return $result;
}
function getSinglePost($id)
{
    global $conn;
    $query = "SELECT  p.id_post AS id,p.naslov,p.tekst,p.datum,k.ime,k.prezime,p.slika_src AS src,kat.naziv,kat.id_kategorije FROM postovi p INNER JOIN korisnici k ON p.id_korisnik = k.id_korisnik INNER JOIN kategorije kat ON p.id_kategorije = kat.id_kategorije WHERE p.id_post  = :id";

    $select = $conn->prepare($query);
    $select->bindParam(":id", $id);
    $select->execute();
    $result = $select->fetch();
    return $result;
}
function insertComm($comment, $postId, $userId)
{
    global $conn;
    $query = "INSERT INTO komentari (tekst,id_post,id_korisnik) VALUES (:tekst,:postId,:userId)";
    $insert = $conn->prepare($query);
    $insert->bindParam(":tekst", $comment);
    $insert->bindParam(":postId", $postId);
    $insert->bindParam(":userId", $userId);
    $result = $insert->execute();
    return $result;
}
function getComments($id)
{
    global $conn;
    $query = "SELECT ko.tekst,ko.vreme_unosa,k.ime,k.prezime FROM komentari ko INNER JOIN korisnici k ON ko.id_korisnik = k.id_korisnik WHERE ko.id_post = :id";
    $select = $conn->prepare($query);
    $select->bindParam(":id", $id);
    $select->execute();
    $result = $select->fetchAll();
    return $result;
}
function mostPopularPost()
{
    define("OFFSET_MOSTPOPULAR", 3);
    define("LIMIT_MOSTPOPULAR", 0);
    global $conn;
    $query = "SELECT p.id_post AS id,p.naslov,p.tekst,p.datum,k.ime,k.prezime,p.slika_src AS src,kat.naziv,COUNT(ko.id_komentar) AS brKomenatara FROM postovi p INNER JOIN korisnici k ON p.id_korisnik = k.id_korisnik INNER JOIN kategorije kat ON p.id_kategorije = kat.id_kategorije INNER JOIN komentari ko ON p.id_post = ko.id_post GROUP BY p.id_post,p.naslov,p.tekst,p.datum,k.ime,k.prezime,p.slika_src,kat.naziv ORDER BY COUNT(ko.id_komentar) DESC LIMIT :limit,:offset ";
    $select = $conn->prepare($query);
    $limit = LIMIT_MOSTPOPULAR;
    $select->bindParam(":limit", $limit, PDO::PARAM_INT);
    $offset = OFFSET_MOSTPOPULAR;
    $select->bindParam(":offset", $offset, PDO::PARAM_INT);
    $select->execute();
    $result = $select->fetchAll();
    return $result;
}
define("OFFSET_LINKS", 5);
function allPostsForUSer($id, $limit)
{
    global $conn;
    $query = "SELECT * FROM postovi WHERE id_korisnik = :id LIMIT :limit,:offset";
    $select = $conn->prepare($query);
    $select->bindParam(":id", $id);
    $limit *= OFFSET_LINKS;
    $select->bindParam(":limit", $limit, PDO::PARAM_INT);

    $offset = OFFSET_LINKS;
    $select->bindParam(":offset", $offset, PDO::PARAM_INT);
    $select->execute();
    $result = $select->fetchAll();
    return $result;
}
function countRowsForUser($id)
{
    global $conn;
    $query = "SELECT COUNT(*) AS postsNumber FROM postovi WHERE id_korisnik = :id";
    $select = $conn->prepare($query);
    $select->bindParam(":id", $id);
    $select->execute();
    $result = $select->fetch();
    return $result;
}
function numberOfPagesForUser($rows)
{
    $numberofPages = ceil($rows->postsNumber / OFFSET_POSTS);
    return $numberofPages;
}
function delete($id, $table, $col)
{
    global $conn;
    $query = "DELETE FROM $table WHERE $col = :id";
    $delete = $conn->prepare($query);
    $delete->bindParam(":id", $id);
    $result = $delete->execute();
    return $result;
}
function updatePost($title, $desc, $id_kor, $category, $newFileName, $id_post)
{
    global $conn;

    $query = "UPDATE postovi SET naslov = :naslov,tekst = :tekst,id_korisnik = :id_kor,id_kategorije = :id_kat,slika_src = :src WHERE id_post = :id_post";

    $update = $conn->prepare($query);
    $update->bindParam(":naslov", $title);
    $update->bindParam(":tekst", $desc);
    $update->bindParam(":id_kor", $id_kor);
    $update->bindParam(":id_kat", $category);
    $update->bindParam(":src", $newFileName);
    $update->bindParam(":id_post", $id_post);
    $result = $update->execute();
    return $result;
}
function getAllWithLimit($limit = 0, $table)
{
    global $conn;

    $query = "SELECT * from $table LIMIT :limit ,:offset";

    $select = $conn->prepare($query);
    $limit *= OFFSET_POSTS;
    $select->bindParam(":limit", $limit, PDO::PARAM_INT);

    $offset = OFFSET_POSTS;
    $select->bindParam(":offset", $offset, PDO::PARAM_INT);
    $select->execute();
    $result = $select->fetchAll();
    return $result;
}
function insertMsg($subject, $message, $email)
{
    global $conn;
    $query = "INSERT INTO poruke (email,tema,tekst) VALUES (:email,:subj,:msg)";
    $insert = $conn->prepare($query);
    $insert->bindParam(":email", $email);
    $insert->bindParam(":subj", $subject);
    $insert->bindParam(":msg", $message);

    $result = $insert->execute();
    return  $result;
}
function insertCategory($categories)
{
    global $conn;
    $query = "INSERT INTO kategorije (naziv) VALUES (:naziv)";
    $insert = $conn->prepare($query);
    $insert->bindParam(":naziv", $categories);
    $result = $insert->execute();
    return  $result;
}
function insertSurv($question)
{
    global $conn;
    $query = "INSERT INTO anketa (pitanje,aktivna) VALUES (:question,:active)";
    $active = 0;
    $insert = $conn->prepare($query);
    $insert->bindParam(":question", $question, PDO::PARAM_STR);
    $insert->bindParam(":active", $active, PDO::PARAM_INT);

    $result = $insert->execute();
    return  $result;
}
function insertAnswers($lastId, $a)
{
    global $conn;
    $upit = "INSERT INTO anketa_odgovori (odgovor, id_anketa) VALUES
(:odgovor, :id)";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(":odgovor", $a, PDO::PARAM_STR);
    $prepare->bindParam(":id", $lastId, PDO::PARAM_INT);
    $prepare->execute();
    $res = $prepare->rowCount();
    return $res;
}
function getActiveSurvey()
{
    global $conn;
    $aktivna = 1;
    $query = "SELECT * FROM anketa WHERE aktivna = :aktivna";
    $prepare = $conn->prepare($query);
    $prepare->bindParam(":aktivna", $aktivna, PDO::PARAM_INT);
    $prepare->execute();
    $res = $prepare->fetch();
    return $res;
}
function getOptions($id)
{
    global $conn;
    $query = "SELECT * FROM anketa_odgovori WHERE id_anketa = :id";
    $prepare = $conn->prepare($query);
    $prepare->bindParam(":id", $id, PDO::PARAM_INT);
    $prepare->execute();
    $res = $prepare->fetchAll();
    return $res;
}
function insertAnswears($idAnswear, $idSurvey, $idUser)
{
    global $conn;
    $query = "INSERT INTO anketa_korisnik_odgovor (id_odgovor, id_korisnik,
    id_anketa) VALUES (:answear, :user, :survey)";
    $insert = $conn->prepare($query);
    $insert->bindParam(":answear", $idAnswear, PDO::PARAM_INT);
    $insert->bindParam(":user", $idUser, PDO::PARAM_INT);
    $insert->bindParam(":survey", $idSurvey, PDO::PARAM_INT);
    $result = $insert->execute();
    return $result;
}
