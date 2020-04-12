<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Сучасна натуральна косметика на основі оливкової олії для догляду за обличчям, руками, тілом та волоссям - SELESTA.">
	<meta name="keywords" content="Косметика,догляд за волоссям,тілом,руками,Selesta">
	<title>Головна - Selesta</title>

	<link rel="stylesheet" href="{{ asset('css/aos-master/dist/aos.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/stylesMain.css') }}">
	<link rel="stylesheet" href="{{ asset('css/modal.css') }}">
	<link rel="stylesheet" href="{{ asset('css/mediaMain.css') }}">
	<link rel="icon" type="image/ico" href="{{ asset('pictures/phone/Logos/Selesta1.png') }}">

	<script src="{{ url('js/axios/axios.min.js') }}"></script>
	<script type="text/javascript">
		function altImage(obj) {
			obj.src = "{{ url('/images/products/alternative.jpg') }}";
		}
	</script>

	<script type="text/javascript">

		function search(form, e) {
				e.preventDefault();
				const formData = new FormData(form);
				const data = {};
				for (let [key, val] of formData.entries()) {
					Object.assign(data, { [key]: val })
				}

				axios.get('/searchMain', {
					headers: {'content-type': 'application/json'},
					params: { data:data }
				})
				.then(function (response) {
					var products = document.getElementById('found-product-container');
					products.innerHTML = '';
					// const div = document.createElement('div');
					if(response.data.length == 0)
					{
						products.insertAdjacentHTML('afterbegin', "<div style='font-size:1.8rem; margin-bottom:200px;'>Нічого не знайдено...</div>");
					}
					else {
						for (let i = 0; i < response.data.length; i++) {
								 products.insertAdjacentHTML('afterbegin', "<div class='found-product-item'>" +
								 "<img src='/images/products/" + response.data[i].product_image + "' alt='image' onerror='altImage(this)'>" +
								 "<div class='products-description'>" +
								 "<h2>" + response.data[i].product_name + "</h2>" +
								 "<p>" + response.data[i].product_price + " грн </p>" +
								 "<a href='/details/" + response.data[i].product_id + "'><button class='btn' id='product-details'>Деталі</button></a> </div></div>");
						}
					}
				})
				.catch(function (error) {
					console.log(error);
				});
		}

	</script>


</head>
<body style="overflow-x: hidden">

	<noscript>
	  <h1 style="padding:25px; border: 1px solid red;">
			  Ця сторінка потребує увімкнений Javascript.
			<br/>
			<br/>
			<br/>
			<br/>
		   Увімкніть Javascript щоб переглянути сторінку !
		</h1>
	</noscript>

	<header>
		<div class="header-wrapper">
			<img src="pictures/SVG/menu.svg" alt="menu" id="Tablet-Menu-Mobile" onclick="myFunction()">
			<img src="pictures/logo.png" alt="Logo" id="logo">

			 <label class="modal-btn" for="modal-toggle"><svg id="search-Mobile" width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M16.875 0C7.57002 0 0 7.57002 0 16.875C0 26.18 7.57002 33.75 16.875 33.75C26.18 33.75 33.75 26.18 33.75 16.875C33.75 7.57002 26.18 0 16.875 0ZM23.9062 25.8952L19.147 21.1359C17.5563 22.2305 15.614 22.6911 13.7012 22.4274C11.7884 22.1637 10.0432 21.1946 8.80804 19.7104C7.57293 18.2262 6.93706 16.334 7.02521 14.4051C7.11337 12.4762 7.91919 10.6499 9.28455 9.28455C10.6499 7.91919 12.4762 7.11337 14.4051 7.02521C16.334 6.93706 18.2262 7.57293 19.7104 8.80804C21.1946 10.0432 22.1637 11.7884 22.4274 13.7012C22.6911 15.614 22.2305 17.5563 21.1359 19.147L25.8952 23.9062L23.9062 25.8952Z" fill="#424242"/>
			<path d="M14.7656 19.6875C17.4839 19.6875 19.6875 17.4839 19.6875 14.7656C19.6875 12.0473 17.4839 9.84375 14.7656 9.84375C12.0473 9.84375 9.84375 12.0473 9.84375 14.7656C9.84375 17.4839 12.0473 19.6875 14.7656 19.6875Z" fill="#424242"/>
			</svg></label>
			<ul>

					<li><a href="{{ url('/') }}">Головна</a></li>
					<li><a href="{{ url('/products') }}">Продукція</a></li>
					<li><a href="{{ url('/about') }}">Про нас</a></li>
					<li><a href="{{ url('/contacts') }}">Контакти</a></li>

				<img src="pictures/SVG/menu.svg" alt="menu" id="Tablet-Menu" onclick="myFunction()" >
			<label class="modal-btn" for="modal-toggle"><svg id="search" width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M16.875 0C7.57002 0 0 7.57002 0 16.875C0 26.18 7.57002 33.75 16.875 33.75C26.18 33.75 33.75 26.18 33.75 16.875C33.75 7.57002 26.18 0 16.875 0ZM23.9062 25.8952L19.147 21.1359C17.5563 22.2305 15.614 22.6911 13.7012 22.4274C11.7884 22.1637 10.0432 21.1946 8.80804 19.7104C7.57293 18.2262 6.93706 16.334 7.02521 14.4051C7.11337 12.4762 7.91919 10.6499 9.28455 9.28455C10.6499 7.91919 12.4762 7.11337 14.4051 7.02521C16.334 6.93706 18.2262 7.57293 19.7104 8.80804C21.1946 10.0432 22.1637 11.7884 22.4274 13.7012C22.6911 15.614 22.2305 17.5563 21.1359 19.147L25.8952 23.9062L23.9062 25.8952Z" fill="#424242"/>
			<path d="M14.7656 19.6875C17.4839 19.6875 19.6875 17.4839 19.6875 14.7656C19.6875 12.0473 17.4839 9.84375 14.7656 9.84375C12.0473 9.84375 9.84375 12.0473 9.84375 14.7656C9.84375 17.4839 12.0473 19.6875 14.7656 19.6875Z" fill="#424242"/>
			</svg></label>
			</ul>

			  <input id="modal-toggle" type="checkbox">
			  <label class="modal-backdrop-main" for="modal-toggle"></label>
			  <div class="modal-content-main">
			    <label class="modal-close" for="modal-toggle">&#x2715;</label>
			    <h2>Пошук</h2>
			    <p>Введіть ваш запит</p>


			    <form onsubmit="search(this, event)" id="submit_form">
			    	<input type="text" id="search-field" name="product_name">
			    	<div class="search-buttons">
				   		<button type="submit" class="submit-search"><span>Пошук</span></button>
				   		<label class="modal-content-btn" for="modal-toggle">Назад</label>
			   		</div>
			    </form>

			    <div class="found-product-container" id="found-product-container">

			 	  </div>
			  </div>
		</div>
	</header>

	<div id="myLinks">
		<a href="{{ url('/') }}">Головна</a>
		<a href="{{ url('/products') }}">Продукція</a>
		<a href="{{ url('/about') }}">Про нас</a>
		<a href="{{ url('/contacts') }}">Контакти</a>
 	</div>

	<section id="mainPage">
		<img src="pictures/mainPage.png" alt="main" id="mainPageImage">
		<img src="pictures/phone/mainPagePhone.png" alt="main" id="mainPageImagePhone">
		<div class="mainPageBlock">
			<div class="leftMainPageBlock">

					<h2>Середземноморські традиційні рецепти краси!</h2>
					<p>
						Сучасна натуральна косметика на
						основі оливкової олії для догляду за
						обличчям, руками, тілом та волоссям -
						SELESTA.
					</p>
					<a href="/catalog"><button id="callToAction"> Наш каталог</button></a>

			</div>

			<div class="rightMainPageBlock">
				<img src="{{ asset('pictures/gr.jpg') }}" alt="cosmetics" id="cosmetics">
			</div>
		</div>
	</section>

	<section id="Categories">
		<h2>Категорії товарів</h2>

		<div class="goods">

			<div class="good-item" data-aos="fade-right" style="z-index: 1000">
				<img src="{{ asset('pictures/FOR_CATEGORIES_MAIN/hair-care_edited.png') }}" alt="hair-care">
			 	<div class="outer-category-container">
					<div class="category-name">
						<p>Догляд за волоссям</p>
						<ol class="sub-menu">
		       				<li class="menu-item"><a href="{{ url('/products?product_category=Шампуні%20та%20кондиціонери') }}">Шампуні та кондиціонери</a></li>
		       				<li class="menu-item"><a href="{{ url('/products?product_category=Маски%20для%20волосся') }}">Маски для волосся</a></li>
		        			<li class="menu-item"><a href="{{ url('/products?product_category=Масло%20для%20волосся') }}">Масло для волосся</a></li>
     					</ol>
					</div>
				</div>
			</div>

			<div class="good-item"  data-aos="fade-right" style="z-index: 999">
				<img src="{{ asset('pictures/FOR_CATEGORIES_MAIN/soap_edited.png') }}" alt="soap">
				<div class="outer-category-container">
					<div class="category-name">
						<p>Мило та гелі для душу</p>
						<ol class="sub-menu">
		       				<li class="menu-item"><a href="{{ url('/products?product_category=Гелі%20для%20душу') }}">Гелі для душу</a></li>
		       				<li class="menu-item"><a href="{{ url('/products?product_category=Гліцеринове%20мило') }}">Гліцеринове мило</a></li>
		        			<li class="menu-item"><a href="{{ url('/products?product_category=Рослинне%20мило') }}">Рослинне мило</a></li>
		        			<li class="menu-item"><a href="{{ url('/products?product_category=Традиційне%20милоу') }}">Традиційне мило</a></li>
		        			<li class="menu-item"><a href="{{ url('/products?product_category=Рідке%20мило') }}">Рідке мило</a></li>
     					</ol>
					</div>
				</div>
			</div>

			<div class="good-item" data-aos="fade-left" style="z-index: 998;">
				<img src="{{ asset('pictures/FOR_CATEGORIES_MAIN/creams_edited.png') }}" alt="creams">
				<div class="outer-category-container">
					<div class="category-name">
						<p>Крем та маски</p>
						<ol class="sub-menu">
		       				<li class="menu-item"><a href="{{ url('/products?product_category=Креми%20для%20обличчя%20та%20рук') }}">Креми для обличчя та рук</a></li>
		       				<li class="menu-item"><a href="{{ url('/products?product_category=Маски%20для%20обличчя') }}">Маски обличчя</a></li>
		        			<li class="menu-item"><a href="{{ url('/products?product_category=Вазелін') }}">Вазелін</a></li>
     					</ol>
					</div>
				</div>
			</div>

			<div class="good-item" data-aos="fade-left" style="z-index: 997;">
				<img src="{{ asset('pictures/FOR_CATEGORIES_MAIN/for_face_edited.png') }}" alt="for_face">
				<div class="outer-category-container">
					<div class="category-name">
						<p>Догляд за обличчям<a href="{{ url('/products?product_category=Догляд%20за%обличчям') }}"></a></p>
					</div>
				</div>
			</div>

			<div class="good-item"  data-aos="fade-right" style="z-index: 996">
				<img src="{{ asset('pictures/FOR_CATEGORIES_MAIN/anti-age_edited.png') }}" alt="anti-age">
				<div class="outer-category-container">
					<div class="category-name">
						<p>Антивікові засоби<a href="{{ url('/products?product_category=Антивікові%20засоби') }}"></a></p>
					</div>
				</div>
			</div>

				<div class="good-item" data-aos="fade-right" style="z-index: 995">
				<img src="{{ asset('pictures/FOR_CATEGORIES_MAIN/collection_edited.png') }}" alt="collections">
				<div class="outer-category-container">
					<div class="category-name">
						<p>Спеціальні набори<a href="{{ url('/products?product_category=Спеціальні%20набори') }}"></a></p>
					</div>
				</div>
			</div>

			<div class="good-item" data-aos="fade-left" style="z-index: 994">
				<img src="{{ asset('pictures/FOR_CATEGORIES_MAIN/anticelulite_edited.png') }}" alt="anticelulite">
				<div class="outer-category-container">
					<div class="category-name">
						<p>Антицелюлітні засоби<a href="{{ url('/products?product_category=Антицелюлітні%20засоби') }}"></a></p>
					</div>
				</div>
			</div>

			<div class="good-item" data-aos="fade-left" style="z-index: 993">
				<img src="{{ asset('pictures/FOR_CATEGORIES_MAIN/anti-sun_edited.png') }}" alt="anti-sun">
				<div class="outer-category-container">
					<div class="category-name">
						<p>Захист від сонця<a href="{{ url('/products?product_category=Сонцезахистні%20креми') }}"></a></p>
					</div>
				</div>
			</div>
		</div>

	</section>

	<section id="Slider">
		<h2>Спробуйте зараз</h2>
		<div class="hr-block" id="top-line"></div>
		<div class="slider-container">

					<img src="{{ asset('pictures/left-arrow.svg') }}" alt="left-arrow" class="desktop-arrow" onclick="plusDivs(-1)">
					<div class="all-slides">

					@if($sliders ?? '')
						@foreach ($sliders as $slider)
			 				<div class="mySlides animate-fading">
								<img src="/images/slider/{{ $slider->sliders_image }}" class="slider-image" alt="slider-image" >
								<div class="slider-details">
									<h3>{{ $slider->sliders_header }}</h3>
									<p>
										{!! $slider->sliders_description !!}
									</p>
									<button>Дізнатися більше<a href="/details/{{$slider->product_id}}"></a></button>
								</div>
							</div>
					  @endforeach
					@endif

				</div>
				<img src="{{ asset('pictures/right-arrow.svg') }}" alt="right-arrow" class="desktop-arrow" onclick="plusDivs(-1)">

		</div>

		<div class="slider-container-mobile">

			@if($sliders ?? '')
				@foreach ($sliders as $slider)
			<div class="mySlides-mobile animate-fading">
				<h3>{{ $slider->sliders_header }}</h3>

					{!! $slider->sliders_description !!}


				<div class="slider-container-left-mobile">
					<img src="{{ asset('pictures/left-arrow.svg') }}" alt="left-arrow" class="arrows" onclick="plusDivsMobile(-1)">
					<img src="/images/slider/{{ $slider->sliders_image }}" class="slider-image-mobile" alt="slider-image">
					<img src="{{ asset('pictures/right-arrow.svg') }}" alt="right-arrow" class="arrows" onclick="plusDivsMobile(1)">
				</div>
				<div class="button-container-mobile">
					<button>Дізнатися більше<a href="/details/{{$slider->product_id}}"></a></button>
				</div>
			</div>
			@endforeach
		@endif

		</div>

		<div class="hr-block"></div>
	</section>

	<section id="About">
		<h2 data-aos="fade-left">Selesta Life Ukraine</h2>

		<div class="details-container" data-aos="fade-right">

			<div class="details-item" id="Details-left-item">
				<img src="{{ asset('pictures/SVG/Ingridients.svg') }}" alt="Ingridients">
				<h3>НАТУРАЛЬНІ ІНГРІДІЄНТИ</h3>
				<p>
					Косметичні та гігієнічні засоби "SELESTA" виготовлені з натуральних інгредієнтів на основі чистої оливкової олії, з додаванням екстрактів цілющих рослинних
				</p>
			</div>

			<div class="details-item" id="Details-central-item">
				<img src="{{ asset('pictures/SVG/no-allergens.svg') }}" alt="no-allergens">
				<h3>БЕЗ АЛЕРГЕНІВ</h3>
				<p>
					В нашій продукції ні у якому разі не використовуються:
					парабен, триклозан, формальдегід, етиловий спирт, синтетичні зволожувачі, важкі метали
					та інші компоненти, які викликають алергію.
				</p>
			</div>

			<div class="details-item" id="Details-right-item">
				<img src="{{ asset('pictures/SVG/standarts.svg') }}" alt="standarts">
				<h3>ВІДПОВІДАЄ СТАНДАРТАМ</h3>
				<p>
					Наша продукція пройшла дерматологічні тестування, а уся сировина, яку ми використовуємо, не проходить тести на тваринах."
				</p>
			</div>

		</div>

		<img src="{{ asset('pictures/logo_serit.jpg') }}" alt="logos" id="Logo_serit" data-aos="fade-right">

		<div class="logos-block" data-aos="fade-right">
			<img src="{{ asset('pictures/phone/Logos/Selesta1.png') }}" alt="Logo1">

			<img src="{{ asset('pictures/phone/Logos/Selesta2.png') }}" alt="Logo2">

			<img src="{{ asset('pictures/phone/Logos/Selesta3.png') }}" alt="Logo3">

			<img src="{{ asset('pictures/phone/Logos/Selesta4.png') }}" alt="Logo4">

			<img src="{{ asset('pictures/phone/Logos/Selesta5.png') }}" alt="Logo5">

			<img src="{{ asset('pictures/phone/Logos/Selesta6.png') }}" alt="Logo6">
		</div>
	</section>

	<footer>
		<div class="bottom-menu">

			<ul>
				<li><a href="{{ url('/') }}">Головна</a></li>
				<li><a href="{{ url('/products') }}">Продукція</a></li>
				<li><a href="{{ url('/about') }}">Про нас</a></li>
			</ul>

			<div class="social-container">
				<a href="https://www.facebook.com/SelestaUkraine/"><svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M28 14.0867C28 6.30469 21.7289 0 14 0C6.26588 0 0 6.30469 0 14.0867C0 21.116 5.11788 26.9444 11.8125 28V18.1595H8.25738V14.0876H11.8125V10.9824C11.8125 7.45276 13.8994 5.50351 17.0984 5.50351C18.6305 5.50351 20.2344 5.7782 20.2344 5.7782V9.24441H18.466C16.73 9.24441 16.1875 10.3317 16.1875 11.4455V14.0867H20.0699L19.446 18.1587H16.1875V27.9991C22.8769 26.9435 28 21.1151 28 14.0858V14.0867Z" fill="white"/>
</svg></a>
			</div>

		</div>
		<hr>

		<div class="copyright">
			<p class="copyright-text">
				Copyright © 2020. Selesta Ukraine Hair & Skin Care products
			</p>
			<p class="phone-number">
				Тел: 044 337-08-70
			</p>
		</div>

	</footer>

	<script>

	function myFunction() {
	  var x = document.getElementById("myLinks");
	  if (x.style.display === "block") {
	    x.style.display = "none";
	  } else {
	    x.style.display = "block";
	  }
	}

	</script>

	<script>
		var slideIndex = 1;
		carousel();
		var timer;
		function plusDivs(n) {
		  window.clearTimeout(timer);
		  showDivs(slideIndex += n);
		  timer = window.setTimeout(carousel, 7000);
		}

		function showDivs(n) {
		  var i;
		  var x = document.getElementsByClassName("mySlides");
		  if (n > x.length) {slideIndex = 1}
		  if (n < 1) {slideIndex = x.length}
		  for (i = 0; i < x.length; i++) {
		     x[i].style.display = "none";
		  }
		  x[slideIndex-1].style.display = "flex";
		}

		function carousel() {
		  var i;
		  var x = document.getElementsByClassName("mySlides");
		  for (i = 0; i < x.length; i++) {
		    x[i].style.display = "none";
		  }
		  slideIndex++;
		  if (slideIndex > x.length) {slideIndex = 1}
		  x[slideIndex-1].style.display = "flex";
		  timer = window.setTimeout(carousel, 7000);
		}

	</script>

		<script>

		var slideIndexMobile = 1;
		carouselMobile();
		var timerMobile;
		function plusDivsMobile(n) {
		  window.clearTimeout(timerMobile);
		  showDivsMobile(slideIndexMobile += n);
		  timerMobile = window.setTimeout(carouselMobile, 7000);
		}

		function showDivsMobile(n) {
		  var i;
		  var x = document.getElementsByClassName("mySlides-mobile");
		  if (n > x.length) {slideIndexMobile = 1}
		  if (n < 1) {slideIndexMobile = x.length}
		  for (i = 0; i < x.length; i++) {
		     x[i].style.display = "none";
		  }
		  x[slideIndexMobile-1].style.display = "block";
		}

		function carouselMobile() {
		  var i;
		  var x = document.getElementsByClassName("mySlides-mobile");
		  for (i = 0; i < x.length; i++) {
		    x[i].style.display = "none";
		  }
		  slideIndexMobile++;
		  if (slideIndexMobile > x.length) {slideIndexMobile = 1}
		  x[slideIndexMobile-1].style.display = "block";
		  timerMobile = window.setTimeout(carouselMobile, 7000);
		}
	</script>

	<script src="{{ asset('css/aos-master/dist/aos.js') }}"></script>
	<script>
	  AOS.init({
	  	duration: 1200,
	  	disable: "mobile",
	  });
	</script>
</body>
</html>
