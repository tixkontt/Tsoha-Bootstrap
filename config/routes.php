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
    HelloWorldController::matka();
  });
  
    $routes->get('/henkilo', function() {
    HelloWorldController::henkilo();
  });
  
      $routes->get('/mainPage', function() {
    HelloWorldController::mainPage();
  });

