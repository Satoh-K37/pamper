<?php
 header("Access-Control-Allow-Origin: *");
 
 //echo $_FILES['file']['name'];
 
 move_uploaded_file($_FILES['file']['tmp_name'], './uploads/'.$_FILES['file']['name']);