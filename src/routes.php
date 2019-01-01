<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->post('/daftar/post', function (Request $request, Response $response){
    $daftar = $request->getParsedBody();
    $sql = "INSERT INTO daftar (lokasi, jumlah, latitude, longitude) VALUES (:lokasi, :jumlah, :latitude, :longitude)";
    $stmt = $this->db->prepare($sql);
    $data = [
        ":lokasi" => $daftar["lokasi"],
        ":jumlah" => $daftar["jumlah"],
        ":latitude" => $daftar["latitude"],
        ":longitude" => $daftar["longitude"]
    ];
    $stmt->execute($data);
    return $response->withJson(["status" => "success", "data" => "data success added"], 200);
});


$app->get('/daftar/get', function (Request $request, Response $response){
    $sql = "SELECT * FROM daftar";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get('/daftar/get/{id}', function (Request $request, Response $response, $args){
    $id = $args['id'];
    $sql = "SELECT * FROM daftar where id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["id" => $id]);
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get('/daftar/getLokasi/{lokasi}', function (Request $request, Response $response, $args){
    $id = $args['lokasi'];
    $sql = "SELECT * FROM daftar where lokasi = :lokasi";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["lokasi" => $id]);
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get('/daftar/cari/{lokasi}', function (Request $request, Response $response, $args){
    $id = $args['lokasi'];
    $lokasi = $id."%";
    $sql = "SELECT * FROM daftar where lokasi LIKE '$lokasi'";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->delete('/daftar/delete/{id}', function(Request $request, Response $response, $args){
    $id = $args['id'];
    $sql = "Delete from daftar where id=:id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["id" => $id]);
    return $response->withJson(["status" => "success", "data" => "data has been deleted"], 200);
});

$app->post("/daftar/put/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $daftar = $request->getParsedBody();
    $sql = "UPDATE daftar SET id=:id, lokasi=:lokasi, jumlah=:jumlah, latitude=:latitude, longitude=:longitude  WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id,
        ":lokasi" => $daftar["lokasi"],
        ":jumlah" => $daftar["jumlah"],
        ":latitude" => $daftar["latitude"],
        ":longitude" => $daftar["longitude"]
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "data has been updated"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
});
