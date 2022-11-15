<?php
require_once './app/models/review.model.php';
require_once './app/views/api.view.php';

class ReviewApiController{
    private $model;
    private $view;
    private $data;  

    function __construct(){
        $this->model = new ReviewModel();
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
    }

    private function getData(){
        return json_decode($this->data);
    }

    public function getReviews(){
        //Ordenamiento asc y desc por campo 
        $fields = ['id_review', 'review', 'name', 'email', 'rating', 'id_album_fk', 'album'];
        $orderByWL = ['asc', 'desc'];
        
            if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderByWL) && in_array($_GET['sort'], $fields)) {               
                $sort = $_GET['sort'];
                $orderBy = $_GET['orderBy'];           
                $reviews = $this->model->order($sort, $orderBy);
                $this->view->response($reviews, 200);
            }
            else if (!isset($_GET['orderBy']) && isset($_GET['sort']) && in_array($_GET['sort'], $fields)) {               
                    $sort = $_GET['sort'];
                    $orderBy = "ASC";           
                    $reviews = $this->model->order($sort, $orderBy);
                    $this->view->response($reviews, 200);                 
            }                                    
        
        //paginacion
        if (isset($_GET['limit'])&& isset($_GET['start'])){ 
            if (is_numeric($_GET['limit'])){
                if ($_GET['limit']){
                    $limit = $_GET['limit'];
                }else{
                    $limit=4;
                }
            if (isset($_GET['start'])){
                if (is_numeric($_GET['start'])){              
                    $start = $_GET['start'];
                }            
                else {
                    $start = 0;
                }
                $from = ((int)$start-1)*(int)$limit;
                $reviews = $this->model->getAllPages($from, $limit);
                $this->view->response($reviews, 200);    
            }
            }
        }
        else if(!isset($_GET['limit']) && isset($_GET['start'])){            
            if (is_numeric($_GET['start'])){              
                $start = $_GET['start'];
            }            
            else {
                $start = 0;
            }
            $limit = 4;
            $from = ((int)$start-1)*(int)$limit;
            $reviews = $this->model->getAllPages($from, $limit);
            $this->view->response($reviews, 200);    
        }       
        else{
            $reviews = $this->model->getAll();
            $this->view->response($reviews, 200); 
        } 
    }

    public function getReview($params = null) {
        $id = $params[":ID"];
        $review = $this->model->get($id);

        if ($review) {
            $this->view->response($review, 200);
        } else {
            $this->view->response("La reseña con id=$id no existe.", 404);
        }
    }

    public function deleteReview($params = null) {
        $id = $params[":ID"];
        $review = $this->model->get($id);
        if ($review) {
            $this->model->delete($id);
            $this->view->response($review, 200);            
        } else {
            $this->view->response("La reseña con id=$id no existe.", 404);
        }
    }

    public function insertReview($params = null) {
        $review = $this->getData();

        if (empty($review->review) || empty($review->name) || empty($review->email) || empty($review->rating) || empty($review->id_album_fk)){
            $this->view->response("Complete todos los datos", 400);
        }
        else {
            if(($review->rating>0) && ($review->rating<6)){
                $id = $this->model->insert($review->review, $review->name, $review->email, $review->rating, $review->id_album_fk);            
                $review = $this->model->get($id);
                $this->view->response($review, 201);
            }
            else{
                $this->view->response("El valor de rating es incorrecto. Ingrese un valor de 1 a 5.", 400);
            }
        }
    }
  
    public function updateReview($params = null) {
        $id = $params[':ID'];
        $data = $this->getData();       
        $review = $this->model->get($id);
        if ($review) {
            if(($data->rating>0) && ($data->rating<6)){
                $this->model->update($id, $data->review, $data->name, $data->email, $data->rating, $data->id_album_fk);
                $review = $this->model->get($id);
                $this->view->response($review, 200);     
            } 
            else {
                $this->view->response("El valor de rating es incorrecto. Ingrese un valor de 1 a 5.", 400);
            }         
                     
        } else {
            return $this->view->response("La reseña con id=$id no existe.", 404);
        }
    }
}

    

  
