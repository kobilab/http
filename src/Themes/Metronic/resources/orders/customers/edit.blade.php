@extends('zahmetsizce::themes.main')

@section('boxTools')
	{{tool(trans('e.cancel'), 'showCompany', $detail['id'])}}
@endsection

@section('boxBodyClass') form @endsection

@section('boxBody')
	{{open(['editCompany', $detail['id']])}}
		<div class="form-body">
			{{text(trans('e.companyCode'), 'companyCode', $detail['company_code'])}}
			{{text(trans('e.companyName'), 'name', $detail['name'])}}
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					{{submit(trans('e.edit'))}}
				</div>
			</div>
		</div>
	{{close()}}
@endsection

@section('pageTitle')
	{{trans('e.companyEdit')}}
@endsection

stumb

@extends([[[extends]]])

@sectionBoxTools
	[[[listFields]]]
@endsection

@sectionBoxBody
	[[[open]]]
		<div class="form-body">
			[[[listFields]]]
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					{{submit(trans('e.edit'))}}
				</div>
			</div>
		</div>
	[[[close]]]
@endsection

<?php

return [
	'boxTools'		=> [
		'fields' => [
			['İptal', 'showCompany', $detail['id']]
		],
	],
	'boxBody'	=> [
		'open' => ['editCompany', $detail['id']],
		'fields'	=> [
			['text', 'Müşteri Kodu', 'companyCode', $detail['company_code']]
		],
	],
];


// Main 
return [
	'extends'	=> 'themes.main',
	'boxTools'		=> [
		'listFields' => function($values) {
			return '<a class="btn btn-transparent dark btn-outline btn-circle btn-sm" href="{{route('.$values[1].', '.$values[2].')}}">'.$values[0].'</a>'
		}
	],
	'boxBody'	=> [
		'listFields' => function() {
			// function going to came here
		},
		'close'	=> '</form>',
		'returnOpen' => function($value) {
			Form::open(['route'	=> $value,'class'	=> 'form-horizontal','role'	=> 'form']);
		}
	],
];