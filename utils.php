<?php
function show_array($arr)
{
   if (count($arr) == 0) return;
   echo "<table>";

   // thead
   echo "<thead>";
   foreach ($arr as $key => $object) {
      foreach ($object as $prop => $value) {
         echo "<th>$prop</th>";
      }
      break;
   }
   echo "</thead>";

   // tbody
   echo "<tbody>";
   foreach ($arr as $key => $object) {
      echo "<tr>";
      foreach ($object as $prop => $value) {
         echo "<td>$value</td>";
      }
      echo "</tr>";
   }
   echo "<tbody>";
   echo "</table>";
}


?>