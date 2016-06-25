<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="{{ url('/css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('/css/font-awesome.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}">
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<title>List</title>
</head>
<body>

	<div class="container" style="margin-top: 25px">

		<form action="{{ url('/list') }}" method="GET" role="form" class="form-inline">
			<div class="form-group col-md-4 search">
				<input type="text" name="search" placeholder="Search" class="form-control"/>
				<button type="submit"  class="btn btn-primary"><i class="fa fa-search fa-lg"></i></button>
			</div>
		</form>

		<table class="table table-striped">
			
			<thead>

				<th>Filename</th>
				<th>Date Uploaded</th>
				<th>Action</th>

			</thead>

			<tbody>
				@foreach( $lists as $list )

					<tr>

						<td>{{ $list->Filename }}</td>
						<td>{{ date('m-d-Y', strtotime( $list->created_at )) }}</td>
						<td><a href="{{ url('/view') . '/' . $list->fileID }}" class="btn btn-success"><i class="fa fa-eye fa-lg"></i></a>
							<a href="{{ url('/delete') . '/' . $list->fileID }}" class="btn btn-warning"><i class="fa fa-trash fa-lg"></i></td>

					</tr>

				@endforeach

			</tbody>

		</table>

		@if ( @$message )
			<p class="help-block">{{ $message }}</p>
		@endif

		<a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-home fa-lg"></i> Return to home</a>

	</div>

</body>
</html>