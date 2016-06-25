<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="{{ url('/css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('/css/font-awesome.css') }}">
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<title>{{ $title }}</title>
</head>
<body ng-app="sampleApp">
	<div class="container" ng-controller="myCtrl">
		<h2>Upload A File(MP4/PDF)</h2>
		<form enctype="multipart/form-data" method="post" id="uploadFile" action="{{ url('/') }}">
			
			{{ csrf_field() }}

			<label>Upload File: </label>
			<input type="file" file-model="myFile" name="fileToUpload" id="fileToUpload" class="form-control" ng-model="fileToUpload" required/>
			<button type="button" ng-click="uploadFile()" name="save" id="save_id" class="btn btn-primary" style="margin-top: 10px"><i class="fa fa-upload fa-lg"></i> Upload File </button>
			<!-- <p class="help-block loading"><i class="fa fa-spinner fa-spin fa-2x" style="display: inline-block; margin-top: 5px"></i> Please Wait</p> -->

		</form>
		<p class="help-block" id="errorMessage"></p>
		<a href="{{ url('/list') }}" class="btn btn-success" style="margin-top: 15px"><i class="fa fa-list fa-lg"></i> List</a>
	</div> 

	<script type="text/javascript" src="{{ url('/js/jquery-3.0.0.js') }}"></script>
	<script type="text/javascript">
		
		var sampleApp = angular.module( 'sampleApp', []);

		sampleApp.directive( 'fileModel', [ '$parse', function( $parse ) {
			return {
				restrict: 'A',
				link: function( scope, element, attrs ) {
					var model = $parse( attrs.fileModel );
					var modelSetter = model.assign;

					element.bind( 'change', function() {
						scope.$apply( function () {
							modelSetter( scope, element[0].files[0] );
						});
					});
				}
			};
		} ] );

		sampleApp.service( 'fileUpload', [ '$http', function( $http ) {
			this.uploadFileUrl = function( file, uploadUrl ) {
				var fd = new FormData();
				fd.append( 'fileToUpload', file );
				$http.post( uploadUrl, fd, {
					transformRequest: angular.identity,
					headers: { 'Content-Type': undefined }
				})
				.success( function( response ) {
					document.getElementById( 'errorMessage' ).textContent = response.fileToUpload;
				})
				.error( function() {

				});
			}
		}] );

		sampleApp.controller( 'myCtrl', [ '$scope', 'fileUpload', function( $scope, fileUpload ) {
			$scope.uploadFile = function() {
				var file = $scope.myFile;
				// console.log( file );
				var uploadUrl = window.location.origin;
				// fileUpload.uploadFileUrl( file, uploadUrl );
			}
		}] );

	</script>

</body>
</html>