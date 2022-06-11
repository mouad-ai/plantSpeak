<link rel="stylesheet" href="../styles/shop.css">
<?php
   
   function project($title,$prenom ,$nom,$img){
      return '

         <div class="plante-card" >
         <div class="image">
         
            <img src="'.$img.'" alt="">
         </div>
         
         <div class="plante-content">
         
            <div class="plante-wrapper">
               <div class="title">
               <h3>Projet</h3>
                  Titre : '.$title.' <br>
                  avec : '.$prenom.' '.$nom.'
               </div>
               
            </div>
         </div>
         </div>
      ';
   }
   function reunionV($title,$lien,$img,$date){
      return '

         <div class="plante-card" >
         <div class="image">
         
            <img src="'.$img.'" alt="">
         </div>
         <div class="plante-content">
            <div class="plante-wrapper">
               <div class="title">
               <h3>Reunion Virtuelle</h3>
                  Titre : '.$title.' <br>
                  Lien : '.$lien.' <br>
                  Date : '.$date.'
                 
               </div>
               
            </div>
         </div>
         </div>
      ';
   }
   function reunionP($title,$lieu,$img , $date){
      return '

         <div class="plante-card" >
         <div class="image">
         
            <img src="'.$img.'" alt="">
         </div>
         <div class="plante-content">
            <div class="plante-wrapper">
               <div class="title">
               <h3>Reunion Physique</h3>
                  Titre : '.$title.' <br>
                  Lieu : '.$lieu.'<br>
                   Date : '.$date.'
               </div>
               
            </div>
         </div>
         </div>
      ';
   }
   
   
?>