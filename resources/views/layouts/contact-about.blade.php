
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@isset($metaDesciption)
		<meta name="description" content="{{ $metaDesciption }}">
	@endisset
	@isset($metaKeywords)
		<meta name="keywords" content="{{ $metaKeywords }}">
	@endisset
	<title>
		Selesta -
		@isset($title)
			{{ $title }}
		@endisset
	</title>

	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/stylesMain.css') }}">
	<link rel="stylesheet" href="{{ asset('css/modal.css') }}">
	<link rel="stylesheet" href="{{ asset('css/mediaMain.css') }}">
	<link rel="icon" type="image/ico" href="{{ asset('pictures/phone/Logos/Selesta1.png') }}">

	<style>
		h1 {
			font-size:3.6rem;
		}

		p {
			font-size:1.8rem;
		}

		header {
			background:#FFFFFF;
		}

		body {
			background: #fbfbfb;
		}

		hr {
			border-top:	1px solid white;
		}



		a:hover {
			color:black;
		}

		.card-header {
			background-color: #9FF1A2 !important;
    		padding: 2rem 4.25rem;
		}

		.card {
			margin-top: 10rem !important;
			margin-bottom: 10rem !important;
		}

		.card-body {
			padding: 3rem 4.25rem;
		}

		ul {
			margin: 0 !important;
			font-size: 1.8rem;
		}

	</style>


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
<body>

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
			<img src="{{ asset('pictures/SVG/menu.svg') }}" alt="menu" id="Tablet-Menu-Mobile" onclick="myFunction()">
			<img src="{{ asset('pictures/logo.png') }}" alt="Logo" id="logo">

			 <label class="modal-btn" for="modal-toggle"><svg id="search-Mobile" width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M16.875 0C7.57002 0 0 7.57002 0 16.875C0 26.18 7.57002 33.75 16.875 33.75C26.18 33.75 33.75 26.18 33.75 16.875C33.75 7.57002 26.18 0 16.875 0ZM23.9062 25.8952L19.147 21.1359C17.5563 22.2305 15.614 22.6911 13.7012 22.4274C11.7884 22.1637 10.0432 21.1946 8.80804 19.7104C7.57293 18.2262 6.93706 16.334 7.02521 14.4051C7.11337 12.4762 7.91919 10.6499 9.28455 9.28455C10.6499 7.91919 12.4762 7.11337 14.4051 7.02521C16.334 6.93706 18.2262 7.57293 19.7104 8.80804C21.1946 10.0432 22.1637 11.7884 22.4274 13.7012C22.6911 15.614 22.2305 17.5563 21.1359 19.147L25.8952 23.9062L23.9062 25.8952Z" fill="#424242"/>
			<path d="M14.7656 19.6875C17.4839 19.6875 19.6875 17.4839 19.6875 14.7656C19.6875 12.0473 17.4839 9.84375 14.7656 9.84375C12.0473 9.84375 9.84375 12.0473 9.84375 14.7656C9.84375 17.4839 12.0473 19.6875 14.7656 19.6875Z" fill="#424242"/>
			</svg></label>
			<ul>

					<li><a href="{{ url('/') }}">Головна</a></li>
					<li><a href="{{ url('/products') }}">Продукція</a></li>
					<li><a href="{{ url('/about') }}">Про нас</a></li>
					<li><a href="{{ url('/contacts') }}">Контакти</a></li>

				<img src="{{ asset('pictures/SVG/menu.svg') }}" alt="menu" id="Tablet-Menu" onclick="myFunction()" >
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
			    	<input type="text" id="search-field"  name="product_name">
			    	<div class="search-buttons">
				   		<button type="submit" class="submit-search">Пошук</button>
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


			<main class="py-4">
					 @yield('content')
			</main>



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

</body>
</html>
