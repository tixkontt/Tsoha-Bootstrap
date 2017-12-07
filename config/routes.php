<?php

$routes->get('/', function() {
    MatkailijaKontrolleri::etusivu();
});

$routes->get('/etusivu', function() {
    MatkailijaKontrolleri::etusivu();
});


$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});


//********** kirjautuminen*****************
$routes->get('/kirjaudu', function() {
    Kayttajahallinta::kirjaudu();
});

$routes->post('/kirjaudu', function() {
    Kayttajahallinta::kasittele_kirjautuminen();
});

//********** Matkojen käsittely*************

$routes->get('/matka', function() {
    MatkailijaKontrolleri::lisaaMatka();
});

$routes->post('/matka', function() {
    MatkailijaKontrolleri::tallennaUusiMatka();
});

$routes->post('/matka/:id', function($id) {
    MatkailijaKontrolleri::poistaMatka($id);
});


$routes->get('/matkalistaus', function() {
    //HelloWorldController::matkalistaus();
    MatkailijaKontrolleri::matkalistaus();
});


//********henkilöiden käsittely************

$routes->get('/henkilo', function() {
    MatkailijaKontrolleri::lisaaHenkilo();
});


$routes->post('/henkilo', function() {
    MatkailijaKontrolleri::tallennaHenkilo();
    
});

$routes->post('/henkilolistaus', function() {
    MatkailijaKontrolleri::henkilolistaus();
    
});

$routes->get('/paivitahenkilo', function() {
    MatkailijaKontrolleri::paivitahenkilo();
    
});


$routes->get('/:id/paivitahenkilo', function($id) {
    MatkailijaKontrolleri::paivitahenkilo($id);
    
});

$routes->get('/henkilolistaus:id/muokkaahenkiloa', function($id) {
    MatkailijaKontrolleri::muokkaahenkiloa($id);
    
});


$routes->get('/haematka', function() {
    MatkailijaKontrolleri::haematka();
});

$routes->post('/henkilo/:id', function($id) {
    MatkailijaKontrolleri::poistaHenkilo($id);
});