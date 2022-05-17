<?php
   function product($id,$title,$img,$price,$desc){
      return '

         <div class="product-card" id="'.$id.'">
         <div class="image">
            <img src="'.$img.'" alt="">
         </div>
         <div class="product-content">
            <div class="product-wrapper">
               <div class="title">
                  '.$title.'
               </div>
               <p>
                  '.$desc.'
               </p>
               <span class="price">'.$price.' DH</span>
               
               <div class="btns">
                  <button class="outline addCart">Ajouter Au Panier</button>
               </div>
            </div>
         </div>
         </div>
      ';
   }
?>

