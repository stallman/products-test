@extends('layout.master')

@section('content')
<section class="content m-3">
	<table class="table table-striped">
	<thead class="thead-dark">
    <tr>
      <th scope="col">Артикул</th>
      <th scope="col">Название</th>
      <th scope="col">Статус</th>
      <th scope="col">Атрибуты</th>
	  <th scope="col"></th>
    </tr>
  </thead>
	@foreach ($products as $product)
	<tr>
		<td><a href="#editModal" data-toggle="modal" 
				data-name="{{$product->name}}" data-article="{{$product->article}}" 
				data-status="{{$product->status}}" data-id="{{$product->id}}"
				data-attrs="{{json_encode($product->data)}}">{{$product->article}}</a></td>
		<td>{{$product->name}}</td>
		<td>{{$product->status}}</td>
		<td>
			@if(isset($product->data))

			@foreach($product->data as $key => $val)
				<div><b>{{$key}}</b>: {{$val}}<div>
			@endforeach
			
			@endif
		</td>
		<td>
			<form action="{{route('products.destroy', $product->id)}}" method="POST">
				@csrf
				@method('DELETE')
				<button type="submit" class="btn btn-danger"><i class='fas fa-trash'></i></button>
			</form>
		</td>
	</tr>
	@endforeach
	</table>
	<hr/>
	<a class="btn btn-primary" href="#addModal" data-toggle="modal">Добавить</a>
</section>

<div id="addModal" class="modal fade addModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Добавить продукт</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="{{route('products.store')}}" method="post">
				@csrf
				<label>Артикул</label>
				<input name="article" class="form-control mb-3" id="" placeholder="" required="" value="" type="text" >
				<label>Название</label>
				<input name="name" class="form-control mb-3" id="" placeholder="" required="" value="" type="text" >
				<label>Статус</label>
				<select name="status" class="form-control mb-3" id="" required="">
					<option checked value="available">Доступен</option>
					<option value="unavailable">Не доступен</option>
				</select>
				<label>Аттрибуты</label>
				<div id="attrs">
				</div>
				<a href="#" id="addAttr">+ Добавить аттрибут</a>
				<hr/>
				<button type="submit" class="btn btn-primary">Добавить</button>
				</form>
			</div>
		</div>
	</div>
</div>


<div id="editModal" class="modal fade editModal" >
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Редактировать продукт</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="" method="post">
				@method('put')
				@csrf
				<label>Артикул</label>
				<input name="article" class="form-control mb-3" id="article" placeholder="" required="" value="" type="text" >
				<label>Название</label>
				<input name="name" class="form-control mb-3" id="name" placeholder="" required="" value="" type="text" >
				<label>Статус</label>
				<select name="status" class="form-control mb-3" id="status" required="">
					<option checked value="available">Доступен</option>
					<option value="unavailable">Не доступен</option>
				</select>
				<label>Аттрибуты</label>
				<div id="attrs">
				</div>
				<a href="#" id="addAttr">+ Добавить аттрибут</a>
				<hr/>
				<button type="submit" class="btn btn-primary">Сохранить</button>
				</form>
			</div>
		</div>
	</div>
</div>
  

@endsection