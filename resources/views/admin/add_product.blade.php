@extends('layouts.admin')

@section('content')
<h2>Введіть поля  -  Продукти</h2>

@if ($errors->any())
    <div class="alert alert-danger" style="font-size:1.8rem; color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

  <form method="POST" action='/admin/addProduct' role="form" enctype="multipart/form-data">

  <div class="form-group">
    <label for="product_name">Назва продукту</label>
    <input type="text" class="form-control" id="product_name" aria-describedby="product_name" placeholder="Назва" name="product_name" value="{{ $product->product_name ?? ''}}">
  </div>
  <div class="form-group">
    <label for="product_description">Опис продукту</label>
    <textarea rows="10" cols="45" id="summary-ckeditor" class="form-control"  name="product_description"> {{ $product->product_description ?? ''}} </textarea>
  </div>

  <div class="form-group">
    <label for="product_price">Ціна</label>
    <input type="number" min="0" step="0.01" class="form-control" id="product_price" name="product_price" value="{{ $product->product_price ?? ''}}">
  </div>

  <div class="input-group mb-3">
    @if($product->product_image ?? '')
      <img src="{{ url('/images/products/'.$product->product_image) }}" alt="image" style="width:100px; height:100px;" id="uploadPreview">
    @else
      <img id="uploadPreview" style="width:100px; height:100px;">
    @endif

    <div class="custom-file">
      <input type="file" class="custom-file-input" id="product_image" aria-describedby="product_image" name="product_image"  onchange="PreviewImage();">
      <label class="custom-file-label" for="product_image" id="product_image_label">{{ $product->product_image ?? 'Оберіть зображення'}}</label>
    </div>
  </div>

  <script type="text/javascript">
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("product_image").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
        document.getElementById("product_image_label").innerText = "Обране зображення";
    };
</script>

  <div class="form-group">
    <label for="product_status">Статус</label>
    <select class="form-control" name="product_status" id="product_status" >
  @if($product ?? '')
    <option value="1" @if ($product->product_status == 1) {!! 'selected="selected"' !!} @endif >Активний</option>
    <option value="0" @if ($product->product_status != 1) {!! 'selected="selected"' !!} @endif >Неактивний</option>
  @else
    <option value="1" selected>Активний</option>
    <option value="0">Неактивний</option>
  @endif
    </select>
  </div>

  <div class="form-group">
    <label for="product_category">Категорія</label>
    <select class="form-control" name="product_category[]" id="product_category" multiple size="10" >
        @if($product ?? '')
          @foreach ($categories as $key => $value)
            <optgroup label="{{ $key }}">
              @foreach ($value as $category)
                  <option value="{{ $category }}" @if ( strpos($product->product_category, $category) !== false) {!! 'selected="selected"' !!} @endif >{{ $category }}</option>
              @endforeach
          @endforeach
        @else
          @foreach ($categories as $key => $value)
            <optgroup label="{{ $key }}">
              @foreach ($value as $category)
                  <option value="{{ $category }}">{{ $category }}</option>
              @endforeach
          @endforeach
        @endif
    </select>
  </div>

  <div class="form-group">
    <label for="title">Заголовок сторінки (максимум 128 символів)</label>
    <input type="text" class="form-control" id="title" aria-describedby="title" placeholder="Заголовок" name="title" value="{{ $product->title ?? ''}}">
  </div>
  <div class="form-group">
    <label for="metaDescription">Опис продукту (максимум 160 символів)</label>
    <textarea rows="5" cols="45"  class="form-control"  name="metaDescription"> {{ $product->metaDescription ?? ''}} </textarea>
  </div>
  <div class="form-group">
    <label for="metaKeywords">Ключові слова (максимум 160 символів, ключові слова через кому)</label>
    <input type="text" class="form-control" id="metaKeywords" aria-describedby="metaKeywords" placeholder="Ключове слово 1,Ключове слово 2..." name="metaKeywords" value="{{ $product->metaKeywords ?? ''}}">
  </div>



  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  @if($product ?? '')
      <input type="hidden" name="product_id" value="{{ $product->product_id }}">
      <button type="submit" class="btn btn-warning">Редагувати</button>
  @else
      <button type="submit" class="btn btn-primary">Додати продукт</button>
  @endif


  <a href="{{ url('admin/products') }}"><button type="button" class="btn btn-secondary">Назад</button></a>
</form>

<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'summary-ckeditor' );
</script>


@endsection
