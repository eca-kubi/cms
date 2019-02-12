<?php
  /*
   * Base Controller
   * Loads the models and views
   */
  class Controller {
    public function __construct()
    {

    }

    // Load model
    public function model($model){
      // Require model file
      require_once '../app/models/' . ucwords( $model) . '.php';

      // Instatiate model
      return new $model();
    }

    // Load view
      public function view(string $view, array $payload = [])
      {
      // Check for view file
      if(file_exists('../app/views/' . $view . '.php')){
        require_once '../app/views/' . $view . '.php';
      } else {
        // View does not exist
        die('View is missing.');
      }
    }
  }