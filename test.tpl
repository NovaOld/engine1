<html lang="pl-PL">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<nav class="lewe-menu-produkcja">
<img class="menu-img" src="img/produkcja.jpg" alt="Produkcja">
<div>
<a href="#">Podgląd</a>
</div>
<div>
<a href="#">Budynki</a>
</div>
<div>
<a href="#">Surowce</a>
</div>
<div>
<a href="#">Badania</a>
</div>
<div>
<a href="#">Stocznia</a>
</div>
<div>
<a href="#">Flota</a>
</div>
<div>
<a href="#">Technologia</a>
</div>
<div>
<a href="#">Galaktyka</a>
</div>
<div>
<a href="#">Obrona</a>
</div>
</nav>

	<div class="header">
	<select class="planety">
		<!--<option value="planeta1" selected="selected"></option>
		<option value="planeta2" selected="selected">planeta2</option>
		<option value="planeta3" selected="selected">planeta3</option>
		<option value="planeta4" selected="selected">planeta4</option>-->
                {select_planetlist}
		</select>
		<div>
		<img class="res-img" src="img/metal.gif" alt="Metal">
		<p>Metal</p>
		<p class="r-ok {metal_over}">{metal_src}</p>
		</div>
		<div>
		<img class="res-img" src="img/crystal.gif" alt="Kryształ">
		<p>Kryształ</p>
		<p class="r-ok {crystal_over}">{crystal_src}</p>
		</div>
		<div>
		<img class="res-img" src="img/deuterium.gif" alt="Deuter">
		<p>Deuter</p>
		<p class="r-ok {deuterium_over}">{deuterium_src}</p>
		</div>
		<div>
		<img class="res-img" src="img/energy.gif" alt="Energia">
		<p>Energia</p>
		<p class="r-ok {energy_over}">{energy_free}/{energy_max}</p>
		</div>
	</div>

</body>
</html>