@extends('layouts.contact-about', ['title' => 'Каталог'])

@section('content')

	<link href="{{ asset('css/catalog.css') }}" rel="stylesheet" >

	<div class="outer-catalog-container">

		<h1>Каталог:</h1>

		<div class="catalog-container">

			<div class="catalog-section">
				<h2>Догляд за волоссям</h2>
				<ul>
					<li><a href="{{ url('/products?product_category=Шампуні%20та%20кондиціонери') }}">Шампуні та кондиціонери</a> </li>
					<li><a href="{{ url('/products?product_category=Маски%20для%20волосся') }}">Маски для волосся</a> </li>
					<li><a href="{{ url('/products?product_category=Масло%20для%20волосся') }}">Масло для волосся </a> </li>
				</ul>
			</div>

			<div class="catalog-section">
				<h2>Мило та гелі для душу </h2>
				<ul>
					<li><a href="{{ url('/products?product_category=Гелі%20для%20душу') }}">Гелі для душу</a> </li>
					<li><a href="{{ url('/products?product_category=Гліцеринове%20мило') }}">Гліцеринове мило</a> </li>
					<li><a href="{{ url('/products?product_category=Рослинне%20мило') }}">Рослинне мило</a> </li>
					<li><a href="{{ url('/products?product_category=Традиційне%20милоу') }}">Традиційне мило</a> </li>
					<li><a href="{{ url('/products?product_category=Рідке%20мило') }}">Рідке мило</a> </li>

				</ul>
			</div>

			<div class="catalog-section">
				<h2>Креми та маски</h2>
				<ul>
					<li><a href="{{ url('/products?product_category=Креми%20для%20обличчя%20та%20рук') }}">Креми для обличчя та рук</a> </li>
					<li><a href="{{ url('/products?product_category=Маски%20для%20обличчя') }}">Маски для обличчя</a> </li>
					<li><a href="{{ url('/products?product_category=Вазелін') }}">Вазелін</a> </li>
				</ul>
			</div>

			<div class="catalog-section">
				<h2>Інше</h2>
				<ul>
					<li><a href="{{ url('/products?product_category=Догляд%20за%обличчям') }}">Догляд за обличчям</a> </li>
					<li><a href="{{ url('/products?product_category=Антивікові%20засоби') }}">Антивікові засоби</a> </li>
					<li><a href="{{ url('/products?product_category=Антицелюлітні%20засоби') }}">Антицелюлітні засоби </a> </li>
					<li><a href="{{ url('/products?product_category=Засоби%20проти%20проти') }}">Засоби проти лупи  </a> </li>
					<li><a href="{{ url('/products?product_category=Сонцезахистні%20креми') }}">Сонцезахистні креми</a> </li>
					<li><a href="{{ url('/products?product_category=Спеціальні%20набори') }}">Спеціальні набори </a></li>
				</ul>
			</div>



		</div>

	</div>


@endsection
