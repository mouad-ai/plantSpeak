<div id="sidebar">
   <h3>CATEGORIES</h3>
   <div class="checklist categories">
      <ul>
         <li><a><span><span class="x"></span><span class="y"></span></span>Souris</a></li>
         <li><a><span><span class="x"></span><span class="y"></span></span>Clavier</a></li>
         <li><a><span><span class="x"></span><span class="y"></span></span>Pc Bureau</a></li>
         <li><a><span><span class="x"></span><span class="y"></span></span>Casque</a></li>
         <li><a><span><span class="x"></span><span class="y"></span></span>Pc Portable</a></li>
      </ul>
   </div>

   <h3>PRIX (DHS)</h3>
   <div style="display: flex ; gap:10px;margin-top:15px">
      <input type="number" class="number-input" id="min-price" placeholder="Min">
      <input type="number" class="number-input" id="max-price" placeholder="Max">
   </div>
   <form action="shop.php" class="triparprix" method="get">
      <label for="priceRange">
         <h3 class="priceRange">
            TRI PAR PRIX
         </h3>
      </label>
      <div class="pricerange-wrapper">
         <select name="priceRange" id="priceRange">
            <option value="relevance" <?php if (isset($_GET["priceRange"]) and $_GET["priceRange"] == 'relevance') echo "selected"; ?>>
               Pertinence
            </option>
            <option value="croissant" <?php if (isset($_GET["priceRange"]) and $_GET["priceRange"] == 'croissant') echo "selected"; ?>> Tri par
               tarif
               croissant</option>
            <option value="decroissant" <?php if (isset($_GET["priceRange"]) and  $_GET["priceRange"] == 'decroissant') echo "selected"; ?>>
               Tri
               par
               tarif
               décroissant</option>
         </select>
         <input class="btn-outline" type="submit" value="Go" />
      </div>
   </form>
</div>