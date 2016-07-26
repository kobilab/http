 @extends('zahmetsizce::themes.main')

@section('content')
<h3 class="page-title"> Yeni Parça </h3>
<div class="row">
	<div class="col-md-12">
		{{open('newPart')}}
			<div class="form-body">
				{{text('Parça Kodu', 'part_code', Input::old('part_code', null))}}
				{{text('Başlık', 'title', Input::old('title', null))}}
				{{select('Öntanımlı Bom', 'default_bom', listThem($boms, 'id', 'title', true), Input::old('default_bom', null))}}
				{{select('Kopyala', 'copy', listThem($parts, 'id', 'title', true), Input::old('copy', null))}}
			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-2 col-md-9">
						{{addButton()}}
					</div>
				</div>
			</div>
		{{close()}}
	</div>
</div>

@endsection

@section('title')
	Yeni Parça
@endsection

@section('breadcrumb')
{{breadcrumb([
	['Home', 'homePage'],
	['Üretim Yapılandırma', '#'],
	['Parçalar', 'parts'],
	['Yeni']
])}}
@endsection