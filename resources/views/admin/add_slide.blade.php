@extends('layouts.admin')

@section('content')
<h2>Введіть дані для слайдера</h2>

@if ($errors->any())
    <div class="alert alert-danger" style="font-size:1.8rem; color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('js/select2.full.min.js') }}"></script>

<link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">

  <form method="POST" action='/admin/addSlide' role="form" enctype="multipart/form-data">

  <div class="form-group">
    <label for="slider_header">Заголовок слайда</label>
    <input type="text" class="form-control" id="sliders_header" aria-describedby="sliders_header" placeholder="Заголовок" name="sliders_header" value="{{ $slider->sliders_header ?? ''}}">
  </div>
  <div class="form-group">
    <label for="summary-ckeditor	">Опис продукту в слайдері</label>
    <textarea rows="10" cols="45" id="summary-ckeditor" class="form-control"  name="sliders_description"> {{ $slider->sliders_description ?? ''}} </textarea>
  </div>


  <div class="input-group mb-3">
    @if($slider->sliders_image ?? '')
      <img src="{{ url('/images/slider/'.$slider->sliders_image) }}" alt="image" style="width:100px; height:100px;" id="uploadPreview">
    @else
      <img id="uploadPreview" style="width:100px; height:100px;">
    @endif

    <div class="custom-file">
      <input type="file" class="custom-file-input" id="sliders_image" aria-describedby="sliders_image" name="sliders_image"  onchange="PreviewImage();">
      <label class="custom-file-label" for="sliders_image" id="sliders_image_label">{{ $slider->sliders_image ?? 'Оберіть зображення'}}</label>
    </div>
  </div>

  <script type="text/javascript">
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("sliders_image").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
        document.getElementById("sliders_image_label").innerText = "Обране зображення";
    };
</script>

  <div class="form-group">
    <label for="sliders_status">Статус</label>
    <select class="form-control" name="sliders_status" id="sliders_status" >
  @if($slider ?? '')
    <option value="1" @if ($slider->sliders_status == 1) {!! 'selected="selected"' !!} @endif >Активний</option>
    <option value="0" @if ($slider->sliders_status != 1) {!! 'selected="selected"' !!} @endif >Неактивний</option>
  @else
    <option value="1" selected>Активний</option>
    <option value="0">Неактивний</option>
  @endif
    </select>
  </div>

  <div class="form-group">
    <label for="product_id">Назва продукту</label>
    <select class="form-control select2" name="product_id" id="product_id"  >
        @if($products ?? '')
          @if($slider ?? '')
            @foreach ($products as $product)
              <option value="{{ $product->product_id }}" @if($product->product_id == $slider->product_id) {!! 'selected="selected"' !!} @endif >{{ $product->product_name }}</option>
            @endforeach
          @else
            @foreach ($products as $product)
              <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
            @endforeach
          @endif
        @endif
    </select>
  </div>

  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  @if($slider ?? '')
      <input type="hidden" name="sliders_id" value="{{ $slider->sliders_id }}">
      <button type="submit" class="btn btn-warning">Редагувати</button>
  @else
      <button type="submit" class="btn btn-primary">Додати продукт</button>
  @endif


  <a href="{{ url('admin/sliders') }}"><button type="button" class="btn btn-secondary">Назад</button></a>
</form>

<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'summary-ckeditor' );
</script>

<script>
    $('.select2').select2();
</script>

@endsection
