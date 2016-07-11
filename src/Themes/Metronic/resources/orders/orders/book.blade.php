@extends('zahmetsizce::themes.main')

@set('pluginDatatable', true)

@section('boxTools')
	{{tool(trans('e.cancel'), 'showOrder', $detail['id'])}}
@endsection

@section('boxBodyClass') form @endsection

@section('boxBody')
	{{open(['bookPartOfOrder', $detail['id']])}}
		<table class="table table-striped table-bordered table-hover order-column" id="sample_1">
			<thead>
				<tr>
					<th> {{trans('e.lotCode')}} </th>
					<th> {{trans('e.quantity')}} </th>
					<th> {{trans('e.transactions')}} </th>
				</tr>
			</thead>
			<tbody>
				@foreach($detail->getUygunLotlar as $each)
				<tr>
					<td>{{$each['lot_code']}}</td>
					<td>{{$each['quantity']}}</td>
					<td>
						{{Form::text($each['id'].'lot', Input::old($each['id'].'lot', 0), ['class'=>'form-control'])}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{submit(trans('e.reserve'))}}
	{{close()}}
@endsection

@section('boxTitle')
	{{trans('e.reservePartForOrder')}}
	<br/>
	<small>
		{{trans('e.neededQuantityForOrder' ['quantity' => $detail['kalan']])}}
	</small>
@endsection

@section('pageTitle')
	{{trans('e.reservePartForOrder')}}
@endsection