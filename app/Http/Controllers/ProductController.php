<?php
namespace App\Http\Controllers;

use Storage;
use App\Product;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class ProductController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getindex() {
		try {
	        $contents = Storage::disk('local')->get('file.txt');
	    } catch (Illuminate\Filesystem\FileNotFoundException $exception) {
	        $contents = '';
	    }

	    $contents_array = explode(PHP_EOL, $contents);

	    $i = 0;
	    foreach ($contents_array as $key => $value) {
	        $contents_array[$i] = json_decode($value);
	        $i ++;
	    }
	    if(!empty($contents_array) && $contents_array[0] != ""){
	        $contents_array = $contents_array;
	    } else {
	        $contents_array = [];
	    }

	    return view('products', [
	        'products' => $contents_array
	    ]);
	}

	/**
	 * add product
	 *
	 * @return Response
	 */
	public function postindex(Request $request) {
		 $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'quantity' => 'required|Numeric',
            'price' => 'required|Numeric'
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        try {
            $contents = Storage::disk('local')->get('file.txt');
        } catch (Illuminate\Filesystem\FileNotFoundException $exception) {
            $contents = '';
        }
       
        $contents_array = explode(PHP_EOL, $contents);
        
        if(!empty($contents_array) && trim($contents_array[0]) != "") {
            $count = count($contents_array);
        } else {
            $count = 0;   
        }

        $product = new Product;

        $total_val = $request->quantity * $request->price;

        $arrayName = array(
                            'id' => $count,
                            'name' => $request->name, 
                            'quantity' => $request->quantity, 
                            'price' => $request->price,
                            'total' => $total_val,
                            'created_at' => date('d-m-Y h:i:s')
                            );

        $product->json = json_encode($arrayName);
        if($count >= 1) {
            Storage::disk('local')->append('file.txt', $product->json);
        } else {            
            Storage::disk('local')->put('file.txt', $product->json);
        }   
        return redirect('/');
	}

	/**
	 * edit product view
	 *
	 * @return Response
	 */
	public function getEdit($product) {
		  	try {
		        $contents = Storage::disk('local')->get('file.txt');
		    } catch (Illuminate\Filesystem\FileNotFoundException $exception) {
		        $contents = '';
		    }

		    $contents_array = explode(PHP_EOL, $contents);
		    $i = 0;
		    $current = [];
		    foreach ($contents_array as $key => $value) {
		        if($product == $i) {
		            $current = json_decode($value);
		        }            
		        $i ++;
		    }
		    return view('edit', [
		        'single_product' => $current
		    ]);
	}

	/**
	 * edit product
	 *
	 * @return Response
	 */
	public function postEdit(Request $request) {
		  	$validator = Validator::make($request->all(), [
	            'id' => 'required|Integer',
	            'name' => 'required|max:255',
	            'quantity' => 'required|Numeric',
	            'price' => 'required|Numeric'
	        ]);

	        if ($validator->fails()) {
	            return redirect('/')
	                ->withInput()
	                ->withErrors($validator);
	        }
	        $total_val = $request->quantity * $request->price;

	        $arrayName = array(
	                            'id' => $request->id,
	                            'name' => $request->name, 
	                            'quantity' => $request->quantity, 
	                            'price' => $request->price,
	                            'total' => $total_val,
	                            'created_at' => date('d-m-Y h:i:s')
	                            );

	        try {
	            $contents = Storage::disk('local')->get('file.txt');
	        } catch (Illuminate\Filesystem\FileNotFoundException $exception) {
	            $contents = '';
	        }

	        $contents_array = explode(PHP_EOL, $contents);
	        $i = 0;
	        $contents_value = '';
	        foreach ($contents_array as $key => $value) {            
	            if($request->id == $i) {
	                $value = json_encode($arrayName);
	                $contents_array[$i] = $value;
	            }           
	            $contents_value .= $value;             
	            $i ++;            
	            if($i < count($contents_array)) {
	                $contents_value .= PHP_EOL;    
	            }
	        }
	        //print_r($contents_value);die;
	        Storage::disk('local')->put('file.txt', $contents_value);
	        return redirect('/');
	}
}
