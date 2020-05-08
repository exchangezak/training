<?php
    class Utilisateur{
        protected $user_name;
        protected $user_pass;
        
        public function __construct($n, $p){
            $this->user_name = $n;
            $this->user_pass = $p;
        }
        
        public function getNom(){
            return $this->user_name;
        }
    }
?>