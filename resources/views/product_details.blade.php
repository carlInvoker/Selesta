@extends('layouts.contact-about')

@section('content')

<link href="{{ asset('css/product_details.css') }}" rel="stylesheet" >


	<div class="general-container">
		<div class="product-container">
		 	
			    <img src="{{ url('/images/products/'.$product->product_image) }}" alt="image" onerror="altImage(this)">
				<div class="product-description">
					<h1>{{ $product->product_name }}</h1>
					<p>{!! $product->product_description !!}</p>			
				</div>
			 
		</div>

		<div class="price-container">
		<hr>
		<p><b>Ціна: </b>{!! $product->product_price !!} грн</p>
		<div class="category-container">
			<p><b>Категорія: </b>{!! $product->product_category !!}</p>
			<a href=" {{ url('/products') }}"><button class="btn" id="back">&nbsp;&nbsp;Назад&nbsp;&nbsp;</button></a>
		</div>
	</div>
	</div>

	

  <script>
  function altImage(obj) {
      obj.src = "{{ url('/images/products/alternative.jpg') }}";
  }
  </script>

@endsection
