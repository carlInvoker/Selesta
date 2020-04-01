@extends('layouts.admin')

@section('content')
<div class="table-header">
  <h2>Слайди</h2>
  <a href="{{ url('admin/addSlide') }}"><button type="button" class="btn btn-dark">Додати новий слайд</button></a>
</div>

<div class="table-responsive">
  <table class="data-table table table-hover ">
    <thead>
      <tr>
        <th>Заголовок</th>
        <th>Опис</th>
        <th>Назва продукту</th>
        <th>Зображення слайда</th>
        <th>Редагувати</th>
        <th>Статус</th>
      </tr>
    </thead>
    <tbody>

    </tbody>
  </table>
</div>
@endsection

@push('changeStatus')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('js/axios/axios.min.js') }}"></script>
<script src="{{ url('js/ellipsis.js') }}"></script>
<!-- <script src="{{ url('js/axios/require.js') }}"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> -->


<script>
    $(function () {
     var table = $('.data-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{ url('/admin/sliders') }}",
         columns: [
             {data: 'sliders_header', name: 'sliders_header'},
             {data: 'sliders_description', name: 'sliders_description', orderable: false, searchable: false},
             {data: 'sliders_product_name', name: 'sliders_product_name'},
             {data: 'sliders_image', name: 'sliders_image', orderable: false, searchable: false},
             {data: 'edit', name: 'edit', orderable: false, searchable: false},
             {data: 'status', name: 'status', orderable: false, searchable: false},
         ],
         columnDefs: [ {
             targets: 1,
             render: $.fn.dataTable.render.ellipsis(255)
         }]
     });
    });
</script>

<script>
  function altImage(obj) {
      obj.src = "{{ url('/images/products/alternative.jpg') }}";
  }
</script>

<script>
    // let actionButtons = document.getElementsByClassName('actionButton');
    //
    // Array.from(actionButtons).forEach((actionButton) => {
    //       actionButton.onclick =


        function changeStatus(obj) {
            let url = obj.value;
            var self = obj;

            axios.post(url, {
            })
            .then(function (response) {
              // console.log(response);
              if(response.data.sliderStatus == 1) {
                self.classList.remove("btn-danger");
                self.classList.add("btn-success");
                self.innerText = '\xa0\xa0' + 'Активний' + '\xa0\xa0';
              }
              else {
                self.classList.remove("btn-success");
                self.classList.add("btn-danger");
                self.innerText = "Неактивний";
              }
            })
            .catch(function (error) {
              console.log(error);
            });
        }
    // });
</script>


@endpush
