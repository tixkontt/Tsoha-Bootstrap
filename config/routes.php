<?php

$routes->get('/', function() {
    MatkailijaKontrolleri::etusivu();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/kirjaudu', function() {
    MatkailijaKontrolleri::kirjaudu();
});

//$routes->post('/kirjaudu', function() {
  //  MatkailijaKontrolleri::tallenna();
//});

$routes->get('/matka', function() {
    MatkailijaKontrolleri::lisaaMatka();
});

$routes->post('/matka', function() {
    MatkailijaKontrolleri::tallennaUusiMatka();
});

$routes->get('/matkalistaus', function() {
    //HelloWorldController::matkalistaus();
    MatkailijaKontrolleri::matkalistaus();
});

$routes->get('/henkilo', function() {
    MatkailijaKontrolleri::lisaaHenkilo();
});


$routes->post('/henkilo', function() {
    MatkailijaKontrolleri::tallennaMatkailija();
    
});

$routes->get('/etusivu', function() {
    MatkailijaKontrolleri::etusivu();
});

$routes->get('/haematka', function() {
    MatkailijaKontrolleri::haematka();
});
