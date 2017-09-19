<!DOCTYPE HTML>
<html>
<head>
<title>Homent</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/forms.css">
<link rel="stylesheet" type="text/css" href="css/datepicker.css">
<link rel="stylesheet" href="ism/css/my-slider.css"/>
<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet"> 
<script src="ism/js/ism-2.2.min.js"></script>
<script src="ism/js/ism-2.2.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.easyModal.js"></script>
<link  href="css/fotorama.css" rel="stylesheet">
<script src="js/fotorama.js"></script>
<script>
  $( function() {
    $( "#przyjazd" ).datepicker();
    $( "#powrot" ).datepicker();
  } );
</script>
<script type="text/javascript">
	$(function() {
		$('.easy-modal').easyModal({
			overlay: 0.2,
		});

		$('.easy-modal-open').click(function(e) {
			var target = $(this).attr('href');
			$(target).trigger('openModal');
			e.preventDefault();
		});

		$('.easy-modal-close').click(function(e) {
			$('.easy-modal').trigger('closeModal');
		});

	});
	</script>
</head>
<body>
<!--MODALE !-->
<div class="easy-modal" id="logowanie">
	<div class="form-logowanie">
		<div class="log">
			<h2 style="padding-bottom: 10px;">Zaloguj się</h2>		
			<center><a href="http://facebook.com"><img src="images/fb-log.png"></a></center>
				<p class="form">Nie publikujemy na tablicy bez Twojej zgody</p>
				<p class="form">Logując się przez Facebooka otrzymujesz <b>5% zniżki</b> na pierwszą rezerwację</p>
			<form class="logowanie" action="index.html">
				<input type="text" id="login" placeholder="Adres e-mail">
				<input type="password" id="password" placeholder="Hasło">
				<input type="submit" id="submit" value="Zaloguj">
			</form>
		</div>
	</div>
</div>
<div class="easy-modal" id="rejestracja">
	<div class="form-rejestracja">
		<div class="log">
			<h2>Zarejestruj się</h2>
			<form class="logowanie" action="index.html">
				<input type="text" id="login" placeholder="Adres e-mail">
				<input type="password" id="password" placeholder="Hasło">
				<input type="password" id="repeat-password" placeholder="Powtórz hasło">
				<input type="submit" id="submit" value="Zarejestruj się">
			</form>
				<p class="form" style="padding-top: 10px; padding-bottom: 10px; font-weight: bold;">lub</p>
			<center><a href="http://facebook.com"><img src="images/fb-log.png"></a></center>
				<p class="form">Nie publikujemy na tablicy bez Twojej zgody</p>			
		</div>
	</div>
</div>
<!--NAWIGACJA!-->
<header>
	<div class="top-left">
		<a href="index.html"><img src="images/logo.png" alt="Logo"></a>
	</div>
	<div class="top-right">
		<div class="top-right-wrapper">
			<button class='add_apartament'>Dodaj apartament</button>
 		</div>	
 		<div class="top-right-wrapper-right">
 		<div class="top-buttons">
			<a href="#"><button class='top-button'>Ulubione</button></a>
			<font color="#a8b7c3">|</font>

			<button class="easy-modal-open" href="#logowanie">Logowanie</button>

			<font color="#a8b7c3">|</font>
			<button class="easy-modal-open" href="#rejestracja">Rejestracja</button>
			</div>
 		</div>
	</div>
</header>
<div class="clear"></div>

<!--CONTENT!-->

<!--SLIDER wraz z wyszukiwarką-->
<div id="search-slider">
	<div class="search">
		<div class="search-wrapper">
			<div class="region">Wpisz miasto, region lub adres</div>
			<div class="przyjazd">Przyjazd</div>
			<div class="przyjazd">Powrót</div>
		<form action="wyniki.html" method="POST" class="form-search">
			<input type="text" id="region" placeholder="np. Kraków lub Mazury">
			<input type="text" id="przyjazd">
			<input type="text" id="powrot">
			<input type="number"  value="0" min="0" max="100" id="nights" >
			<input type="number"  value="0" min="0" max="100" id="persons" >
			<input type="submit" id="submit" value="Szukaj">
		</div>
		</form>
	</div>


<div class="ism-slider" data-transition_type="fade" data-play_type="loop" data-image_fx="none" data-buttons="false" id="slider">
  <ol>
    <li>
      <img src="ism/image/slides/tatry1.jpg">
    </li>
    <li>
      <img src="ism/image/slides/krakow-city.jpg">
    </li>
    <li>
      <img src="ism/image/slides/tatry2.jpg">
    </li>
    <li>
      <img src="ism/image/slides/gdansk.jpg">
    </li>
  </ol>
</div>
</div>


<!--KORZYŚCI!-->
<div id="benefits">
	<div class="ben1"><div class="benefit"><img src="images/procent.png" class="img-ben" alt="tanio">
	<h3>Tanio</h3>
	<p class="ben-descreption">Około 50% taniej niż za hotel.</p>
	</div></div>
	<div class="ben2"><div class="benefit"><img src="images/time.png" class="img-ben" alt="szybko">
	<h3>Szybko</h3>
	<p class="ben-descreption">Zarezerwuj od razu i tylko czekaj na wyjazd.</p>
	</div></div>
	<div class="ben3"><div class="benefit"><img src="images/up.png" class="img-ben" alt="bezpiecznie">
	<h3>Bezpiecznie</h3>
	<p class="ben-descreption">Zaufało nam 23,765 klientów.<br>Znajdź obiekt i sprawdź opinie.</p>
	</div></div>
</div>


<!--APARTAMENTY!-->
<div id="apartaments" style="padding-top: 80px;">
	<h2 class="ap">Apartamenty dla Ciebie</h2>
	<div class="parent">
		<!--APARTAMENT WYSZUKANY!-->
		<a class="divlink" href="apartament.html">
		<div class="child" style="background-image: url('images/1.jpg');">
		<p class="title">Jabłonowscy</p><p class="cena">od <b>260 zł</b> / noc</p></div>
		</a>
		<!--APARTAMENT WYSZUKANY!-->
		<a class="divlink" href="apartament.html">
		<div class="child" style="background-image: url('images/2.jpg');">
		<p class="title">Jabłonowscy</p><p class="cena">od <b>260 zł</b> / noc</p></div>
		</a>
		<!--APARTAMENT WYSZUKANY!-->
		<a class="divlink" href="apartament.html">
		<div class="child" style="background-image: url('images/1.jpg');">
		<p class="title">Jabłonowscy</p><p class="cena">od <b>260 zł</b> / noc</p></div>
		</a>
		<!--APARTAMENT WYSZUKANY!-->
		<a class="divlink" href="apartament.html">
		<div class="child" style="background-image: url('images/2.jpg');">
		<p class="title">Jabłonowscy</p><p class="cena">od <b>260 zł</b> / noc</p></div>
		</a>
		<!--APARTAMENT WYSZUKANY!-->
		<a class="divlink" href="apartament.html">
		<div class="child" style="background-image: url('images/1.jpg');">
		<p class="title">Jabłonowscy</p><p class="cena">od <b>260 zł</b> / noc</p></div>
		</a>
		<!--APARTAMENT WYSZUKANY!-->
		<a class="divlink" href="apartament.html">
		<div class="child" style="background-image: url('images/2.jpg');">
		<p class="title">Jabłonowscy</p><p class="cena">od <b>260 zł</b> / noc</p></div>
		</a>
		<!--APARTAMENT WYSZUKANY!-->
		<a class="divlink" href="apartament.html">
		<div class="child" style="background-image: url('images/1.jpg');">
		<p class="title">Jabłonowscy</p><p class="cena">od <b>260 zł</b> / noc</p></div>
		</a>
		<!--APARTAMENT WYSZUKANY!-->
		<a class="divlink" href="apartament.html">
		<div class="child" style="background-image: url('images/2.jpg');">
		<p class="title">Jabłonowscy</p><p class="cena">od <b>260 zł</b> / noc</p></div>
		</a>
		<!--APARTAMENT WYSZUKANY!-->
		<a class="divlink" href="apartament.html">
		<div class="child" style="background-image: url('images/1.jpg');">
		<p class="title">Jabłonowscy</p><p class="cena">od <b>260 zł</b> / noc</p></div>
		</a>
		<!--APARTAMENT WYSZUKANY!-->
		<a class="divlink" href="apartament.html">
		<div class="child" style="background-image: url('images/2.jpg');">
		<p class="title">Jabłonowscy</p><p class="cena">od <b>260 zł</b> / noc</p></div>
		</a>
		<!--APARTAMENT WYSZUKANY!-->
		<a class="divlink" href="apartament.html">
		<div class="child" style="background-image: url('images/1.jpg');">
		<p class="title">Jabłonowscy</p><p class="cena">od <b>260 zł</b> / noc</p></div>
		</a>
		<!--APARTAMENT WYSZUKANY!-->
		<a class="divlink" href="apartament.html">
		<div class="child" style="background-image: url('images/2.jpg');">
		<p class="title">Jabłonowscy</p><p class="cena">od <b>260 zł</b> / noc</p></div>
		</a>
	</div>
</div>

<!--JAK TO DZIAŁA!-->
<div id="howitworks">
	<div class="how"><h2 class="ap">Jak to działa</h2></div>
		<div class="howit"><p class="howit-p">Dla podróżnych</p></div>
		<div class="howit"><p class="howit-p">Dla właścicieli</p></div>
</div>

<!--FOOTER!-->
<footer>
	<div class="footer-container">
		<div class="foot">
			<h2 class="footer">Najpopularniejsze</h2>
			<ol class="footer">
			<li><a href="">Kraków</a></li>
			<li><a href="">Kraków</a></li>
			<li><a href="">Kraków</a></li>
			<li><a href="">Kraków</a></li>						
			</ol>
		</div>
		<div class="foot">
			<h2 class="footer">Pomoc</h2>
			<ol class="footer">
			<li><a href="">Lorem ipsum</a></li>
			<li><a href="">Lorem ipsum</a></li>
			<li><a href="">Lorem ipsum</a></li>
			<li><a href="">Lorem ipsum</a></li>						
			</ol>
		</div>
		<div class="foot">
			<h2 class="footer">O nas</h2>
			<ol class="footer">
			<li><a href="">Lorem ipsum</a></li>
			<li><a href="">Lorem ipsum</a></li>
			<li><a href="">Lorem ipsum</a></li>
			<li><a href="">Lorem ipsum</a></li>			
			</ol>		
		</div>
		<div class="foot2">
			<h2 class="footer">Bądź na bieżąco</h2>
			<img style="padding-top: 20px;" src="images/placeholderfbgoogle.jpg">
		</div>

		<div class="foot2">
			<h2 class="footer">Zapisz się do newslettera i korzystaj ze zniżek i ofert specjalnych</h2>
			<form class="newsletter">
				<input type="text" id="mail">
				<input type="submit" id="submitnews" value="Zapisz się" name="">
			</form>
		</div>

		<div class="dolnik">
			<h2 class="footer">Podróżuj razem z nami</h2>
			<p class="podrozuj">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus.</p>
		</div>

							
	</div>
</footer>
<div class="down-footer">
	<p class="down-footer">Aby zapewnić najwyższą jakość usług wykorzystujemy informacje przechowywane w przeglądarce internetowej.<br>
	Sprawdź cel, warunki przechowywania lub dostępu do nich w <a class="privacy" href="#">Polityce prywatności</a>
</p>
</div>
<!--KONIEC FOOTERA!-->


</body>
</html>



