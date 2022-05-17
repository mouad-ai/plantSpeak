<?php
   function cart_product($id,$title,$price,$img,$qty){
      echo '
      <div class="cart-row" id="'.$id.'">
            <div class="cart-item cart-column">
               <img class="cart-item-image" src="'.$img.'" width="100" height="100">
               <span class="cart-item-title">'.$title.'</span>
            </div>
            <span class="cart-price cart-column">'.$price.' DH</span>
            <div class="cart-quantity cart-column">
               <input class="cart-quantity-input" type="number" value="'.$qty.'">
               <button class="btn btn-danger" type="button">Supprimer</button>
            </div>
         </div>';
   }
?>