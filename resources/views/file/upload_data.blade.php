<!DOCTYPE html>
<html>
<head>
	<title>List</title>
</head>
<body>

	<table>
		
		<thead>
			
			<th>ID</th>
			<th>Filename</th>
			<th>Date Upload</th>

		</thead>

		<tbody>
			@foreach( $lists as $list )

				<tr>

					<td>{{ $list->id }}</td>
					<td>{{ $list->Filename }}</td>
					<td>{{ $list->created_at }}</td>

				</tr>

			@foreach

		</tbody>

	</table>

</body>
</html>