<?php

namespace App\Http\Controllers;

use App\files;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;

use Storage;


class filesController extends Controller
{
    
	// Landing Page

	public function index()
	{

		return view( 'file.upload', [ 'title' => 'File Upload'] );

	}

	// Upload File

	public function upload(Request $request)
	{

		$rules = array ( 'fileToUpload' => 'max:8000|mimes:mp4,pdf' );

		$validator = Validator::make( $request->all(), $rules );

		if( $validator->fails() )
		{
			$messages = $validator->messages();

			return $validator->errors();
		} else {
			$uploadFile = $request->file('fileToUpload');

			$filename = $uploadFile->getClientOriginalName() . "-" . md5( uniqid( $uploadFile->getClientOriginalName() ) ) . "." . $uploadFile->getClientOriginalExtension();

			$store = Storage::disk('uploads')->put( $filename, file_get_contents($uploadFile) );

			if ( $store )
			{
				$files = new files;

				$files->Filename = $filename;
			}

			if ( $files->save() )
			{
				return response()->json( [ 'fileToUpload' => "Successfully Uploaded. "] );
			}

		}

	}

	// Search & List

	public function search()
	{

		$search = \Request::get( 'search' );

		$data = files::where( 'Filename', 'LIKE', '%' . $search . '%' )->get();

		return view( 'file.list', [ 'lists' => $data] );
	}

	// Play video or Download PDF

	public function view($id)
	{

		$file_name = files::where( 'fileID', $id )->get();

		$extn = pathinfo( $file_name[0]->Filename, PATHINFO_EXTENSION );

		if ( $extn == 'mp4' )
		{
			$file = Storage::disk( 'uploads' )->get( $file_name[0]->Filename );

			return response( $file, 200 )->header( 'Content-type', 'video/mp4' );

		} 
		else if ( $extn == 'pdf' )
		{
			$file = Storage::disk( 'uploads' )->get( $file_name[0]->Filename );

			return response( $file, 200 )->header( 'Content-type', 'application/pdf' )->header( 'Content-type', 'application/download' )->header( 'Content-Disposition', 'attachment; filename="' . $file_name[0]->Filename );
		}

	}

	// Delete PDF or video

	public function delete($id)
	{
		$filename = files::where( 'fileID', $id )->get();

		$file = files::where( 'fileID', $id )->delete();

		if( $file ){
			\Storage::disk( 'uploads' )->delete( $filename[0]->Filename );

			return redirect( '/list' );
		} else {
			return redirect( '/list', [ 'message' => 'Error occur, unable to delete file.' ] );
		}
	}

}
