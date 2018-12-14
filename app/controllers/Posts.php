<?php
  class Posts extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->postModel = $this->model('Post');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get posts
      $posts = $this->postModel->getPosts();

      $payload = [
        'posts' => $posts
      ];

      $this->view('posts/index', $payload);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $payload = [
          'title' => trim($_POST['title']),
          'body' => trim($_POST['body']),
          'user_id' => $_SESSION['user_id'],
          'title_err' => '',
          'body_err' => ''
        ];

        // Validate data
        if(empty($payload['title'])){
          $payload['title_err'] = 'Please enter title';
        }
        if(empty($payload['body'])){
          $payload['body_err'] = 'Please enter body text';
        }

        // Make sure no errors
        if(empty($payload['title_err']) && empty($payload['body_err'])){
          // Validated
          if($this->postModel->addPost($payload)){
            flash('post_message', 'Post Added');
            redirect('posts');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('posts/add', $payload);
        }

      } else {
        $payload = [
          'title' => '',
          'body' => ''
        ];
  
        $this->view('posts/add', $payload);
      }
    }

    public function edit($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $payload = [
          'id' => $id,
          'title' => trim($_POST['title']),
          'body' => trim($_POST['body']),
          'user_id' => $_SESSION['user_id'],
          'title_err' => '',
          'body_err' => ''
        ];

        // Validate data
        if(empty($payload['title'])){
          $payload['title_err'] = 'Please enter title';
        }
        if(empty($payload['body'])){
          $payload['body_err'] = 'Please enter body text';
        }

        // Make sure no errors
        if(empty($payload['title_err']) && empty($payload['body_err'])){
          // Validated
          if($this->postModel->updatePost($payload)){
            flash('post_message', 'Post Updated');
            redirect('posts');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('posts/edit', $payload);
        }

      } else {
        // Get existing post from model
        $post = $this->postModel->getPostById($id);

        // Check for owner
        if($post->user_id != $_SESSION['user_id']){
          redirect('posts');
        }

        $payload = [
          'id' => $id,
          'title' => $post->title,
          'body' => $post->body
        ];
  
        $this->view('posts/edit', $payload);
      }
    }

    public function show($id){
      $post = $this->postModel->getPostById($id);
      $user = $this->userModel->getUserById($post->user_id);

      $payload = [
        'post' => $post,
        'user' => $user
      ];

      $this->view('posts/show', $payload);
    }

    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing post from model
        $post = $this->postModel->getPostById($id);
        
        // Check for owner
        if($post->user_id != $_SESSION['user_id']){
          redirect('posts');
        }

        if($this->postModel->deletePost($id)){
          flash('post_message', 'Post Removed');
          redirect('posts');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('posts');
      }
    }
  }