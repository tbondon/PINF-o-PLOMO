<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}

?>

</div>
<!-- fin du content --> 

</div>
<!-- fin du wrap -->

<div id="footer">
  <div class="container">
  </div>
</div>

</body>
</html>