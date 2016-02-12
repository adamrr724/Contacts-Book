<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Contact.php";
    require_once __DIR__."/../src/Address.php";

    session_start();
    if (empty($_SESSION['contact-list'])) {
        $_SESSION['contact-list'] = array();
    }

    $app = new Silex\Application();

       $app['debug'] = true;

      $app->register(new Silex\Provider\TwigServiceProvider(), array(
      	 'twig.path' => __DIR__.'/../views'
      ));

      $app->get("/", function() use ($app){
          return $app['twig']->render('address_book.html.twig', array('contacts' => Contact::getAll()));
      });

      $app->post("/show", function() use ($app) {
          $contact = new Contact($_POST['name'], $_POST['phone'], new Address($_POST['street'], $_POST['city'], $_POST['state']));
          $contact->save();
          return $app['twig']->render('contact_added.html.twig', array('contact' => $contact));
      });

      $app->post("/clear", function() use ($app){
          Contact::reset();
          return $app['twig']->render('deleted_contacts.html.twig', array('contacts' => Contact::getAll()));
      });

      $app->get("/list", function() use ($app){
          return $app['twig']->render('address_book.html.twig', array('contacts' => Contact::getAll()));
      });

      $app->get("/new", function() use ($app){
          return $app['twig']->render('new_contact.html.twig');
      });

      return $app;
?>
