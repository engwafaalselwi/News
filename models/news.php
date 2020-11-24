<?php

include ('../db_config.php');
    class News_Info{
        public $News_ID;
        public $News_Title;
        public $News_Image;
        public $News_Date;
        public $News_Text;
        public $Cat_ID;
        public $News_Type;
        public $Sub_News_Type;
        public $Internal_Sub_News;
        public $database;

        function __construct(){
            $this->database = new DBConfig();
        }
        function getRows(){
          $pdo=$this->database->connect();

          $stmt=$pdo->prepare("select * from news_table ");

          $stmt->execute();

          return $stmt->fetchAll(PDO::FETCH_OBJ);

        }
//select Info news by News_Type : 

        function getSingleRows($News_Type){

            $pdo=$this->database->connect();
  
            $stmt=$pdo->prepare("select * from table_news where News_ID in (select * from category_news where News_Type = ?");
  
            $stmt->execute([$News_Type]);
  
            return $stmt->fetchAll(PDO::FETCH_OBJ);
  
          }

          function addRow1($data){

            try{
              $pdo=$this->database->connect();
              $stmt=$pdo->prepare('insert into news_Table values(null,?,?,now(),?)');
              $stmt->execute([$this->News_Title,$this->News_Image,$this->News_Date,$this->News_Text]);

              return true;

            }catch(PDOException $ex){
              return false;

            }
          }

          function addRow2($data){

            try{
              $pdo=$this->database->connect();
              $stmt=$pdo->prepare('insert into category_news values(null,?,?,?)');
              $stmt->execute([$this->News_Type,$this->Sub_News_Type,$this->Internal_Sub_News]);

              return true;

            }catch(PDOException $ex){
              return false;

            }
          }

          function updateRow($Cat_ID){
            
              try{
                $pdo=$this->database->connect();
                 $stmt=  $pdo->prepare("update category SET  
                  News_Type=?,Sub_News_Type =? WHERE  Cat_ID=?");
                   $stmt->execute([$this->News_Type,$this->Sub_News_Type,$this->Cat_ID]);
                     return true;
            
             }
                 catch(PDOException $e){
             return false;
                 }
            
          

          }
          function deleteRow($Cat_ID){
            try{
              $pdo=$this->database->connect();
             $stmt=  $pdo->prepare("delete FROM category WHERE Cat_ID=?");
                 return $stmt->execute([$Cat_ID]);
          }
             catch(PDOException $e){
          return false;
             }
          }
        }

        
    










?>