@extends('zahmetsizce::themes.main')

@set('pluginDatatable', true)

@section('boxTools')
	{{tool(trans('e.new'), 'newCompany')}}
@endsection

@section('boxBody')
	<table class="table table-striped table-bordered table-hover order-column" id="sample_1">
		<thead>
			<tr>
				<th>{{trans('e.companyCode')}}</th>
				<th>{{trans('e.companyName')}}</th>
				<th>{{trans('e.transactions')}}</th>
			</tr>
		</thead>
		<tbody>
			@foreach($companies as $musteri)
			<tr>
				<td>{{$musteri['company_code']}}</td>
				<td>{{$musteri['name']}}</td>
				<td>
					{{edit('editCompany', $musteri['id'])}}
					{{show('showCompany', ['company_id' => $musteri['id']])}}
					{{sil('deleteCompany', $musteri['id'], $musteri['id'])}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@endsection

@section('pageTitle')
	{{trans('e.companies')}}
@endsection