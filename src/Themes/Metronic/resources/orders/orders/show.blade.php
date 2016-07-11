@extends('zahmetsizce::themes.main')

@section('boxTools')
	{{toolSil('deleteOrder', $detail['id'], $detail['id'])}}
	{{tool(trans('e.edit'), 'editOrder', $detail['id'])}}
	{{tool(trans('e.orderCheck'), 'checkOrder', $detail['id'])}}
@endsection

@section('content')
	<table class="table table-bordered">
		<tr>
			<th>{{trans('e.orderCode')}}</th>
			<td>{{$detail['order_code']}}</td>
		</tr>
		<tr>
			<th>{{trans('e.company')}}</th>
			<td>{{$detail->getMusteri['name']}}</td>
		</tr>
		<tr>
			<th>{{trans('e.partsOfOrder')}}</th>
			<td>
				@if($detail->getSiparisdetaillari->count() > 0)
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>{{trans('e.part')}}</th>
								<th>{{trans('e.quantity')}}</th>
								<th>{{trans('e.transactions')}}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($detail->getSiparisdetaillari as $e)
								<tr>
									<td>{{$e->getItem['title']}}</td>
									<td>{{$e['quantity']}}</td>
									<td>{{edit('editPartOfOrder', $e['id'])}} {{sil('deletePartOfOrder', $e['id'], $e['id'])}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					{{trans('thereIsAnyPartForOrder')}}
				@endif
			</td>
		</tr>
	</table>
@endsection

@section('pageTitle')
	{{trans('showOrder')}}
@endsection