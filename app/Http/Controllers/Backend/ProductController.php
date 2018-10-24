<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/24/2018
 * Time: 1:56 PM
 */

namespace App\Http\Controllers\Backend;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ProductController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.product.index');
    }

    public function dataTable()
    {
        return Product::dataTable();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->has('id')) {
            $product = Product::with(['seo', 'content'])->find($request->id);
            if ($product) {
                $seo = $product->seo;
                $content = $product->content;

                if ($product->start_promotion && $product->stop_promotion) {
                    $product->has_time_promotion = 1;
                    $product->time_promotion = Carbon::createFromFormat('Y-m-d H:i:s', $product->start_promotion)->format('d/m/Y H:i') . ' - ' . Carbon::createFromFormat('Y-m-d H:i:s', $product->stop_promotion)->format('d/m/Y H:i');
                }
                $product->title .= ' - ' . time();
                $product->slug .= '-' . time();

                view()->share('product', $product);
                view()->share('seo', $seo);
                view()->share('content', $content);
            }

        }
        return view('backend.product.create');
    }

    private function filter($data)
    {
        $data['published_date'] = Carbon::createFromFormat('d/m/Y H:i', $data['published_date'])->format('Y-m-d H:i');

        if (@$data['has_time_promotion']) {
            $time_promotion = explode(" - ", $data['time_promotion']);
            $data['start_promotion'] = Carbon::createFromFormat('d/m/Y H:i', $time_promotion[0])->format('Y-m-d H:i');
            $data['stop_promotion'] = Carbon::createFromFormat('d/m/Y H:i', $time_promotion[1])->format('Y-m-d H:i');
        } else {
            $data['start_promotion'] = null;
            $data['stop_promotion'] = null;
        }

        if (@$data['price']) {
            $data['price'] = str_replace(",", "", $data['price']);
            if(!is_numeric($data['price'])){
                $data['price'] = 0;
            }
        }
        if (@$data['price_promotion']) {
            $data['price_promotion'] = str_replace(",", "", $data['price_promotion']);
            if(!is_numeric($data['price_promotion'])){
                $data['price_promotion'] = 0;
            }
        }

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $this->filter($request->except('_token'));

        $product = (new Product())->createProduct($data);
        return $this->response(route('product.edit', ['id' => $product->id]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $product = Product::with(['seo', 'content'])->find($id);
        if (!$product) return redirect()->route('product.index');
        $seo = $product->seo;
        $content = $product->content;

        if ($product->start_promotion && $product->stop_promotion) {
            $product->has_time_promotion = 1;
            $product->time_promotion = Carbon::createFromFormat('Y-m-d H:i:s', $product->start_promotion)->format('d/m/Y H:i') . ' - ' . Carbon::createFromFormat('Y-m-d H:i:s', $product->stop_promotion)->format('d/m/Y H:i');
        }

        return view('backend.product.edit')
            ->with('product', $product)
            ->with('seo', $seo)
            ->with('content', $content);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id, ProductRequest $request)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.index');
        }

        $data = $this->filter($request->except(['_token', '_method']));

        $productModel = new Product();
        $productModel->updateProduct($data, $id);

        return $this->response();
    }

    public function updateField($id, Request $request)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.index');
        }
        $data = $request->except(['_token', '_method']);

        $productModel = new Product();
        $productModel->updateProduct($data, $id);

        return $this->response(null, ['datatable' => true]);
    }

    /**
     * @param $id
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return $this->response(null, ['datatable' => true]);
    }

    public function move($id, Request $request)
    {
        (new Product())->move($id, $request->direction);
        return $this->response(null, ['datatable' => true]);
    }

}