
<div class="overview">
	<div>
	<p class="planeta-nazwa"><b>{planet_name}</b></p>
	</div>
	<div class="tid">
	<p>Czas aktualny:</p>
	<p>{data}</p>
	<p id="godzina">{godzina}</p>
	</div>
	<div>
	<img class="planeta" src="img/planeta04.jpg" alt="Planeta">
	</div>
	<div class="wydarzenia"><b>Wydarzenia:</b></div>
       <div class="sojusz wrogi szpieg">
        <p><span></span><span class="pogrubiona"></span> </p></div>
</div>
<script>


function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('godzina').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>
	<!--<div class="sojusz wrogi szpieg">
	<p>Flota Wroga zbliża się do planety {planet_name} i osiągnie ją w czasie<span>{time}</span> misja:<span class="pogrubiona"> {misja} </span> </p>
	</div>
	<div class="sojusz wrogi szpieg">
	<p>Flota Sojusznika zbliża się do planety {planet_name} i osiągnie ją w czasie: <span>{time}</span> misja:<span class="pogrubiona"> {misja} </span> </p>
	</div>
	<div class="sojusz wrogi szpieg">
	<p>Flota Wroga zbliża się do planety {planet_name} i osiągnie ją w czasie<span>{time}</span> misja:<span class="pogrubiona"> {misja} </span> </p>
	</div>-->

