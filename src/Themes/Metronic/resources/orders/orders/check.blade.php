@extends('zahmetsizce::themes.main')

@section('boxTools')
	{{tool(trans('e.cancel'), 'showOrder', $detail['id'])}}
@endsection

@section('boxBody')
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>{{trans('e.part')}}</th>
				<th>{{trans('e.totalQuantityInInventory')}}</th>
				<th>{{trans('e.neededQuantityForOrder')}}</th>
				<th>{{trans('e.transactions')}}</th>
			</tr>
		</thead>
		<tbody>
			@foreach($detail->getSiparisdetaillari as $e)
				<tr>
					<td>{{$e->getItem['title']}}</td>
					<td>{{$toplamlar[$e['part_id']]}}</td>
					<td>{{$e['kalan']}}</td>
					<td>
						@if(isset($toplamlar[$e['part_id']]))
							@if($toplamlar[$e['part_id']]>0)
								{{tableTool(trans('e.reserve'), 'bookPartOfOrder', $e['id'])}}
							@else
								{{trans('e.cannotReserve')}}
							@endif
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection

@section('pageTitle')
	{{trans('e.checkOrderInInventory')}}
@endsection