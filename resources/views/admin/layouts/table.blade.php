@php($user = auth()->user())

@extends('admin.layouts.app')
@include('admin.parts.nav')

@section('content')
	<div class="header pb-8 pt-5 pt-md-8"></div>
	{{-- BLUE BACKGROUND --}}
	<div class="container-fluid mt--7">
		<div class="row">
			<div class="col">
				<div class="card shadow-lg p-3 mb-5 bg-body rounded">
					<div class="card-header text-dark bg-light">
						<div class="row">
							<div class="col-8">
								<h3 class="mb-0 pb-0">{{ $table['title'] ?? '' }}</h3>
							</div>
							<div class="col-4 text-right">
								{!! $action_btns ?? '' !!}
							</div>
						</div>
					</div>

					<div class="table-responsive py-4">
						<div id="datatable-basic_wrapper">
							<table id="{{ $table['id'] ?? '' }}-table" data-url="{{ $table['url'] ?? '' }}" class="table dataTable table-success table-striped">
								<thead class="thead-light">
								<tr>
									@isset($table['columns'])
										@foreach ($table['columns'] as $table_column)
											<th>{{ $table_column }}</th>
										@endforeach
									@endisset
								</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('styles')
	<link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
@endpush

@push('scripts')
	<script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
@endpush

