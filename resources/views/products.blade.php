@extends('layouts.contact-about')

@section('content')

<link href="{{ asset('css/products.css') }}" rel="stylesheet" >
<script src="{{ url('js/axios/axios.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

	<div class="general-container">


			<nav id="navigationMain">
				<form onsubmit="search(this, event)" id="submit_formMain">
					<div class="form-group">
					    <label for="product_name">Назва продукту</label>
					    <input type="text" class="form-control"  placeholder="Назва" name="product_name" value="">
					</div>

					<div class="form-group">
				    <label for="product_category">Категорія</label>
					    <select class="form-control" name="category" id="category" >
										  <option value="0" selected>*Всі*</option>
					        <optgroup label="Догляд за волоссям">
											<option value="Шампуні та кондиціонери">Шампуні та кондиціонери</option>
											<option value="Маски для волосся">Маски для волосся</option>
											<option value="Масло для волосся ">Масло для волосся </option>
									</optgroup>
									<optgroup label="Мило та гелі для душу">
										 	<option value="Гелі для душу">Гелі для душу</option>
									 		<option value="Гліцеринове мило">Гліцеринове мило</option>
									 		<option value="Рослинне мило">Рослинне мило</option>
											<option value="Традиційне мило">Традиційне мило</option>
											<option value="Рідке мило">Рідке мило</option>
									</optgroup>
									<optgroup label="Креми та маски">
											<option value="Креми для обличчя та рук">Креми для обличчя та рук</option>
										  <option value="Маски для обличчя">Маски для обличчя</option>
										  <option value="Вазелін">Вазелін</option>
									</optgroup>
									<optgroup label="Інші засоби">
							        <option value="Догляд за обличчям"><b>Догляд за обличчям</b></option>
							        <option value="Антивікові засоби"><b>Антивікові засоби</b></option>
							        <option value="Спеціальні набори"><b>Спеціальні набори</b></option>
							        <option value="Антицелюлітні засоби"><b>Антицелюлітні засоби</b></option>
							        <option value="Захист від сонця"><b>Захист від сонця</b></option>
							        <option value="Інше"><b>Інше</b></option>
									</optgroup>
					    </select>

				 	</div>

				 	<div class="form-group">
					    <label for="product_price">Ціна грн</label>
					    <div class="number-container"  >
						    <input   type="number" min="0" step="0.01" class="form-control"  name="minPrice" value="" placeholder="Від">
						    -
						    <input   type="number" min="0" step="0.01" class="form-control" name="maxPrice" value="" placeholder="До">
					    </div>
					</div>
					<div class="buttons">
					 <div id="hideButton" class="btn btn-secondary" onclick="toggleFilter()">&nbsp;&nbsp;&nbsp;&nbsp;Назад&nbsp;&nbsp;&nbsp;&nbsp;</div>
					 <button type="submit" class="btn btn-dark">&nbsp;&nbsp;Пошук&nbsp;&nbsp;</button>
					</div>
				</form>
			</nav>

			<div class="product-content">

				<div class="products-header">
					<button class="btn btn-warning filter" onclick="toggleFilter()">&nbsp;&nbsp;<b>Фільтр</b>&nbsp;&nbsp;<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15.2494 0H0.750994C0.0848062 0 -0.25135 0.808313 0.220681 1.28034L6.00012 7.06066V13.5C6.00012 13.7447 6.11952 13.9741 6.32002 14.1144L8.82003 15.8638C9.31324 16.2091 10.0001 15.8592 10.0001 15.2494V7.06066L15.7797 1.28034C16.2508 0.80925 15.9169 0 15.2494 0Z" fill="black"/>
					</svg>
					&nbsp;&nbsp;
					</button>
					<h1>Продукція <p id="categoryLabel" style="font-size:1.4rem; margin:10px 2px;">{{ $category ?? '' }}</p></h1>
					<button class="btn btn-warning filter" id="hiddenEl" style="visibility: hidden;">&nbsp;&nbsp;<b>Фільтр</b>&nbsp;&nbsp;<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15.2494 0H0.750994C0.0848062 0 -0.25135 0.808313 0.220681 1.28034L6.00012 7.06066V13.5C6.00012 13.7447 6.11952 13.9741 6.32002 14.1144L8.82003 15.8638C9.31324 16.2091 10.0001 15.8592 10.0001 15.2494V7.06066L15.7797 1.28034C16.2508 0.80925 15.9169 0 15.2494 0Z" fill="black"/>
					</svg>
					&nbsp;&nbsp;</button>
				</div>

				<div class="products-container" id='products-container'>
					@if(!$products->isEmpty())
						@foreach ($products as $product)
						  @if($loop->iteration % 3 == 0)
							  <div class="products-item third-item" >
							@else
							  <div class="products-item" >
							@endif
				          <img src="{{ url('/images/products/'.$product->product_image) }}" alt="image" onerror="altImage(this)">
								  <div class="products-description">
								     <h2>{!! $product->product_name !!}</h2>
								     <p>{!! $product->product_price !!} грн</p>
								     <a href=" {{ url('/details/'.$product->product_id) }}"><button class="btn" id="product-details">Деталі</button></a>
								  </div>
							  </div>
						@endforeach
					@else
						<h2 style="margin:	40px 20px;">Продукцію не знайдено...</h2>
					@endif
				</div>
			</div>

	</div>

  <script>
  function altImage(obj) {
      obj.src = "{{ url('/images/products/alternative.jpg') }}";
  }

	var media = window.matchMedia("(max-width: 1100px)");
	media.addListener(toggleFilter);

	function toggleFilter() {

	  var x = document.getElementById("navigationMain");
		if(media.matches) {
		  if (x.style.display === "block") {
		    x.style.display = "none";
		  } else {
		    x.style.display = "block";
		  }
		}
		else {
			x.style.display = "block";
		}
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

				axios.get('/searchCategory', {
					headers: {'content-type': 'application/json'},
					params: { data:data }
				})
				.then(function (response) {
					var products = document.getElementById('products-container');
					products.innerHTML = '';
					var categoryLabel =  document.getElementById('categoryLabel');
					categoryLabel.innerHTML = '';
					// const div = document.createElement('div');
					if(response.data.length == 0)
					{

						products.insertAdjacentHTML('afterbegin', "<div style='font-size:1.8rem; margin-bottom:200px;'>Нічого не знайдено...</div>");
					}
					else {
						for (let i = 0; i < response.data.length; i++) {
							if(i % 3 == 0) {
								 products.insertAdjacentHTML('afterbegin', "<div class='products-item third-item'>" +
								 "<img src='/images/products/" + response.data[i].product_image + "' alt='image' onerror='altImage(this)'>" +
								 "<div class='products-description'>" +
								 "<h2>" + response.data[i].product_name + "</h2>" +
								 "<p>" + response.data[i].product_price + " грн </p>" +
								 "<a href='/details/" + response.data[i].product_id + "'><button class='btn' id='product-details'>Деталі</button></a> </div></div>");
							}
							else {
								 products.insertAdjacentHTML('afterbegin', "<div class='products-item'>" +
								 "<img src='/images/products/" + response.data[i].product_image + "' alt='image' onerror='altImage(this)'>" +
								 "<div class='products-description'>" +
								 "<h2>" + response.data[i].product_name + "</h2>" +
								 "<p>" + response.data[i].product_price + " грн </p>" +
								 "<a href='/details/" + response.data[i].product_id + "'><button class='btn' id='product-details'>Деталі</button></a> </div></div>");
							}
						}
					}
					toggleFilter();
				})
				.catch(function (error) {
					console.log(error);
				});
		}

	</script>



@endsection
