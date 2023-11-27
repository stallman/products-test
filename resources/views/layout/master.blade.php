<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.0/css/all.min.css" integrity="sha512-ykRBEJhyZ+B/BIJcBuOyUoIxh0OfdICfHPnPfBy7eIiyJv536ojTCsgX8aqrLQ9VJZHGz4tvYyzOM0lkgmQZGw==" crossorigin="anonymous" referrerpolicy="no-referrer" />		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"  />		
		
	</head>
	<body>
    	@yield('content')
	    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		<script>
			$('[data-toggle="tooltip"]').tooltip();
      		@if ($errors->any())
      		@foreach ($errors->all() as $error)
          		toastr.error('{{$error}}')
      		@endforeach
      		@endif

			
			$( document ).ready(function() {
				$('.addModal #addAttr').on('click', function() {
					var modal = $(this)
					$('.addModal #attrs').append("<div class='attr d-flex flex-row align-items-end'><div class='m-2'><label>Название</label><input class='form-control' name='datakeys[]'></input></div><div class='m-2'><label>Значение</label><input class='form-control' name='datavalues[]'></input></div><div style='cursor: pointer' class='dela m-4'><i class='fas fa-trash fa-lg'></i></div></div>");
					$(document).on('click', '.dela', function(e) {
						$(this).parent().remove();
				    });
				})

				$('.editModal #addAttr').on('click', function() {
					var modal = $(this)
					$('.editModal #attrs').append("<div class='attr d-flex flex-row align-items-end'><div class='m-2'><label>Название</label><input class='form-control' name='datakeys[]'></input></div><div class='m-2'><label>Значение</label><input class='form-control' name='datavalues[]'></input></div><div style='cursor: pointer' class='dela m-4'><i class='fas fa-trash fa-lg'></i></div></div>");
					$(document).on('click', '.dela', function(e) {
						$(this).parent().remove();
				    });
				})
				
				$('#editModal').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget)
					var modal = $(this)
					modal.find('form').attr('action', '/products/'+button.data('id'));
					modal.find('#name').val(button.data('name'));
					modal.find('#article').val(button.data('article'));
					$('.editModal #attrs').html('');
					$.each(button.data('attrs'), function(key, data){
						$('.editModal #attrs').append("<div class='attr d-flex flex-row align-items-end'><div class='m-2'><label>Название</label><input class='form-control' name='datakeys[]' value='"+key+"'></input></div><div class='m-2'><label>Значение</label><input class='form-control' name='datavalues[]' value='"+data+"'></input></div><div style='cursor: pointer' class='dele m-4'><i class='fas fa-trash fa-lg'></i></div></div>");
						$(document).on('click', '.dele', function(e) {
							$(this).parent().remove();
				   		});
					});

					//modal.find('#attrs').val(button.data('article'));
    			});
			});
		</script>
	<body>
</html>