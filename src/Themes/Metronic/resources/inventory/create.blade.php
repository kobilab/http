@extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Yeni Lot Girişi </h3>
<div class="row">
	<div class="col-md-12">
		{{open('newLot')}}
			<div class="form-body">
				{{text('Lot Kodu', 'lot_code')}}
				{{select('Parça', 'part_id', listThem($parts, 'id', 'title'), $partId)}}
				{{text('Adet', 'quantity')}}
			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-2 col-md-10">
						{{addButton()}}
					</div>
				</div>
			</div>
		{{close()}}
	</div>
</div>

@endsection

@section('title')
	Yeni Lot Girişi
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Depo', '#'],
	['Lotlar', 'lots'],
	['Yeni']
])}}
@endsection