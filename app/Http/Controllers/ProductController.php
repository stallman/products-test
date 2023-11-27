<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$products = Product::all();
		return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'min:10',
                'max:255'
            ],
            'article' => [
                'required',
                'string',
                'regex:/^[a-zA-Z0-9 ]+$/',
                'unique:products',
                'max:255'
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $data = array();
        $i = 0;
        if (isset($request->datakeys)) {
            foreach ($request->datakeys as $dkey) {
                $data[$dkey] = $request->datavalues[$i++];
            }
        }

		$product = new Product();
		$product->data = $data;
        $product->article = $request->article;
        $product->name = $request->name;
        $product->status = $request->status;
        $product->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'min:10',
                'max:255'
            ],
            'article' => [
                'required',
                'string',
                'regex:/^[a-zA-Z0-9 ]+$/',
                'exists:products',
                'max:255',
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $data = array();
        $i = 0;
        if (isset($request->datakeys)) {
            foreach ($request->datakeys as $dkey) {
                $data[$dkey] = $request->datavalues[$i++];
            }
        }

		$product->data = $data;
        $product->article = $request->article;
        $product->name = $request->name;
        $product->status = $request->status;
        $product->update();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back();
    }
}
