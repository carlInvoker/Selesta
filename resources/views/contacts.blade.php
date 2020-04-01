@extends('layouts.contact-about', ['title' => 'Контакти'])

@section('content')
<link href="{{ asset('css/about.css') }}" rel="stylesheet" >
    <div class="about-container">

            <div class="about-header"><h1 id="contactsHeader">  Контакти </h1></div>
                <div class="about-body">
							 		<ul>
							 			<li> <b>Назва:</b> ТОВ "ЛЕОРОН" Україна 	</li>
										<li> <b>Email:</b> selestalife@ukr.net	</li>
										<li> <b>Телефон:</b> (044)337-08-70	</li>
										<li> <b>Вебсайт:</b> http://www.selesta.in.ua 	</li>
                    <br>
                    <br>
		 								<p>Завантажити інформацію у вигляді: <b>Візитна картка vCard</b></p>
							 		</ul>
                </div>

        </div>
    </div>

@endsection
