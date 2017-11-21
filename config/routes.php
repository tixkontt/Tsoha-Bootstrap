<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/login', function() {
    HelloWorldController::login();
  });

    $routes->get('/matka', function() {
    MatkailijaKontrolleri::lisaaMatka();
  });
  
      $routes->get('/matkalistaus', function() {
    //HelloWorldController::matkalistaus();
    MatkailijaKontrolleri::matkalistaus();
  });
  
    $routes->get('/henkilo', function() {
    MatkailijaKontrolleri::lisaaHenkilo();
  });
  
      $routes->get('/index', function() {
    HelloWorldController::index();
  });

