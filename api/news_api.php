<?php
   include('../models/news.php');

   $news_model = new News_Info();

   if(isset($_POST)&&!empty($_POST)){
     $news_model->News_Title=$_POST['News_Title'];
     $news_model->News_Image=$_POST['News_Image'];
     $news_model->News_Date=$_POST['News_Date'];
     $news_model->News_Text=$_POST['News_Text'];
     $news_model->Cat_ID=$_POST['Cat_ID'];
     $news_model->News_Type=$_POST['News_Type'];
     $news_model->Sub_News_Type=$_POST['Sub_News_Type'];
     $news_model->Internal_Sub_News=$_POST['Internal_Sub_News'];
   }

   else if (isset($_GET['News_Type'])){
      echo json_encode($news_model->getSingleRows($_GET['News_Type']));
   }

   echo json_encode($news_model->getRows());
?>