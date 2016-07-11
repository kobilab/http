@extends('zahmetsizce::themes.main')

@section('boxTools')
	{{tool(trans('e.cancel'), 'orders')}}
@endsection

@section('boxBodyClass') form @endsection

@section('boxBody')
	{{open('newOrder')}}
		<div class="form-body">
			{{text(trans('e.orderCod'), 'orderCode')}}
			{{select(trans('e.company'), 'companyId', listThem($companies, 'id', 'name'))}}
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-3 col-md-9">
					{{submit(trans('e.add'))}}
				</div>
			</div>
		</div>
	{{close()}}
@endsection

@section('pageTitle')
	{{trans('e.newOrder')}}
@endsection