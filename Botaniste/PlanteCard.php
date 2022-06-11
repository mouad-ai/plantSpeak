<link rel="stylesheet" href="../styles/shop.css">
<?php
   function plante($id,$title,$desc,$img){
      return '

         <div class="plante-card" id="'.$id.'">
         <div class="image">
            <img src="'.$img.'" alt="">
         </div>
         <div class="plante-content">
            <div class="plante-wrapper">
               <div class="title">
                  '.$title.'
               </div>
               <p>
                  '.$desc.'
               </p>
               
               <div class="btns">
                  <button class="outline consulter">Consulter</button>
               </div>
            </div>
         </div>
         </div>
      ';
   }
   function etudaint($title,$desc,$img){
      return '

         <div class="plante-card" >
         <div class="image">
            <img src="'.$img.'" alt="">
         </div>
         <div class="plante-content">
            <div class="plante-wrapper">
               <div class="title">
                  Niveau : '.$title.'
                  Universite : '.$desc.'
               </div>
               
            </div>
         </div>
         </div>
      ';
   }
   function stagaire($title,$img){
      return '

         <div class="plante-card" >
         <div class="image">
            <img src="'.$img.'" alt="">
         </div>
         <div class="plante-content">
            <div class="plante-wrapper">
               <div class="title">
                  Duree : '.$title.'
                 
               </div>
               
            </div>
         </div>
         </div>
      ';
   }
   function equiipe($no,$prenom,$nom,$img){
      return '

         <div class="plante-card" >
         <div class="image">
            <img src="'.$img.'" alt="">
         </div>
         <div class="plante-content">
            <div class="plante-wrapper">
               <div class="title">
                  Votre equipe : '.$no.' <br>
                 Votre superviseur : '.$prenom.' '.$nom.'
               </div>
               
            </div>
         </div>
         </div>
      ';
   }
?>