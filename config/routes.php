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

$routes->get('/luouusikayttaja', function() {
Kayttajahallinta::luouusikayttaja();
    
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

// ****** matkojen haku ******

$routes->get('/matkalistaus', function() {
    MatkailijaKontrolleri::matkalistaus();
});

$routes->get('/haematka', function() {
    MatkailijaKontrolleri::haematka();
});

$routes->get('/muokkaa_matkaa/:id', function($id) {
    MatkailijaKontrolleri::haeYksiMatka($id);
});

//********henkilöiden käsittely************

$routes->get('/henkilo', function() {
    MatkailijaKontrolleri::lisaaHenkilo();
});


$routes->post('/henkilo', function() {
    MatkailijaKontrolleri::tallennaHenkilo();
    
});

$routes->get('/henkilolistaus', function() {
    MatkailijaKontrolleri::henkilolistaus();
    
});

$routes->get('/paivitahenkilo/:id', function($id) { //update
    MatkailijaKontrolleri::paivitahenkilo($id);
    
});

$routes->get('/muokkaahenkiloa/:id', function($id) { //edit
    MatkailijaKontrolleri::muokkaahenkiloa($id);
    
});

$routes->get('/muokkaahenkiloa/:id', function($id) { //edit
    MatkailijaKontrolleri::muokkaahenkiloa($id);
    
});
// //Tee myös POST versio

$routes->post('/henkilo/:id', function($id) {
    MatkailijaKontrolleri::poistaHenkilo($id);
});