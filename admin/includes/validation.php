<?php
    include_once("includes/conn.php");
    class Validation{
        private $name; 
        private $value;
        private $errors = [];
    
        public function __construct($name, $value){
            $this->name = $name;
            $this->value = $value;
        }

        public function required():bool{
            if (empty($this->value) || trim($this->value) === "") {
                $this->errors[] = "The {$this->name} field is required.";
                return false;
            }
            return true;
        }

        public function regex($pattern):bool{
            if (!preg_match($pattern, $this->value)) {
                $this->errors[] = "The {$this->name} format is invalid.";
                return false;
            }
            return true;
        }
        
        public function hasErrors(): bool {
            return !empty($this->errors);
        }
    
        public function getErrors(): array {
            return $this->errors;
        }
    }
?>