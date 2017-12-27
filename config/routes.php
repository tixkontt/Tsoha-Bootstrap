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

$routes->post('/etusivu', function() {
    Kayttajahallinta::kirjaudu_ulos();
});

$routes->get('/luouusikayttaja', function() {
    Kayttajahallinta::luouusikayttajalomake();
});

$routes->post('/luouusikayttaja', function() {
    Kayttajahallinta::luouusikayttaja();
});

$routes->get('/omattiedot', function() {
    Kayttajahallinta::omattiedot();
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

//$routes->post('/matka/:id', function($id) {
//    MatkailijaKontrolleri::muokkaamatkaa($id);
//});

// ****** Hakusivut ******

$routes->get('/hakusivu', function() {
    MatkailijaKontrolleri::hakusivu();
});

//*** matkojen haut ******
$routes->get('/matkalistaus', function() {
    MatkailijaKontrolleri::matkalistaus();
});

$routes->post('/matkalistaus', function() {
    MatkailijaKontrolleri::matkalistaus();
});

$routes->get('/haematka', function() {
//    MatkailijaKontrolleri::haematkalaisetyhdestamaasta();
    MatkailijaKontrolleri::haematka();
});


//******************'''//************hakulistaus
//$routes->post('/haematka/:id', function($id) {
//    MatkailijaKontrolleri::haematkalaisetyhdestamaasta($id);
//});

$routes->post('/haematka', function() {
    MatkailijaKontrolleri::HaeMatkatYhdestaMaasta();
});

////*******************
//$routes->post('/henkilonmatkat/:id', function($id) {
//    MatkailijaKontrolleri::haematka($id);
//});

$routes->get('/henkilonmatkat/:id', function($id) {
    MatkailijaKontrolleri::haeyhdenhenkilonmatkat($id);
});

//$routes->post('/henkilonmatkat', function($id) {
//    MatkailijaKontrolleri::haeyhdenhenkilonmatkat($id);
//});


$routes->get('/paivitamatka/:id', function($id) {//haetaan matkan muokkaussivuu näkyviin
    MatkailijaKontrolleri::muokkaamatkaa($id);
});

$routes->post('/paivitamatka/:id', function($id) {//lähetetään tiedot >>> muokkaamatkaa
    MatkailijaKontrolleri::paivitamatka($id);
});

$routes->get('/matkallanyt', function(){
MatkailijaKontrolleri::ketkaovatmatkallanyt();    
});

$routes->post('/ketkaovatmatkallanyt', function(){
MatkailijaKontrolleri::ketkaovatmatkallanyt();    
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

//$routes->get('/paivitahenkilo/:id', function($id) { //update
//    MatkailijaKontrolleri::paivitahenkilo($id);
//});

$routes->post('/muokkaahenkiloa/:id', function($id) { //update
    MatkailijaKontrolleri::paivitahenkilo($id);
});

$routes->get('/muokkaahenkiloa/:id', function($id) { // tuo näkyviin muokkaussivu
    MatkailijaKontrolleri::muokkaahenkiloa($id);
});


// //Tee myös POST versio

$routes->post('/henkilo/:id', function($id) {
    MatkailijaKontrolleri::poistaHenkilo($id);
});
