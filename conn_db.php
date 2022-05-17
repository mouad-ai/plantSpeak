<?php
   function connect_db(){
      return mysqli_connect('localhost', 'root', '', 'shop');
   }
?>