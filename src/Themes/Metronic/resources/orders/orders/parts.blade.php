@extends('zahmetsizce::themes.main')

@set('pluginDatatable', true)

@section('boxTools')
	{{tool(trans('e.newOrder'), 'newOrder')}}
@endsection

@section('boxBody')
	<table class="table table-striped table-bordered table-hover order-column" id="sample_1">
		<thead>
			<tr>
				<th> {{trans('e.orderCode')}} </th>
				<th> {{trans('e.part')}} </th>
				<th> {{trans('e.partCode')}} </th>
				<th> {{trans('e.companyName')}} </th>
				<th> {{trans('e.transactions')}} </th>
			</tr>
		</thead>
		<tbody>
			@foreach($orders as $siparis)
			<tr>
				<td>{{$siparis->getSiparis['order_code']}}</td>
				<td>{{$siparis->getItem['title']}}</td>
				<td>{{$siparis->getItem['part_code']}}</td>
				<td>{{$siparis->getSiparis->getMusteri['name']}}</td>
				<td>
					{{edit('editPartOfOrder', $siparis['id'])}}
					{{show('showOrder', $siparis->getSiparis['id'])}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@endsection

@section('pageTitle')
	{{trans('e.ordersDependsOnPart')}}
@endsection