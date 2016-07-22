@extends('zahmetsizce::themes.main')

@set('pluginDatatable', true)

@section('content')
	<table class="table table-striped table-bordered table-hover order-column" id="sample_1">
		<thead>
			<tr>
				<th> {{trans('e.orderCode')}} </th>
				<th> {{trans('e.companyName')}} </th>
				<th> {{trans('e.transactions')}} </th>
			</tr>
		</thead>
		<tbody>
			@foreach($orders as $siparis)
			<tr>
				<td>{{$siparis['order_code']}}</td>
				<td>{{$siparis->getCompany['name']}}</td>
				<td>
					{{edit('editOrder', $siparis['id'])}}
					{{show('showOrder', $siparis['id'])}}
					{{sil('deleteOrder', $siparis['id'], $siparis['id'])}}
					{{linka(trans('e.addPartToOrder'), 'addPartToOrder', $siparis['id'])}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@endsection

@section('pageTitle')
	{{trans('e.orders')}}
@endsection