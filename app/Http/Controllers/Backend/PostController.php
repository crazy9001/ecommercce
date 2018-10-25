<?php
/**
 * Created by PhpStorm.
 * User: PC01
 * Date: 10/25/2018
 * Time: 9:59 AM
 */

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PostRequest;
use App\Models\Content;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\SEO;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;


class PostController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.post.index');
    }

    public function dataTable()
    {
        return Post::dataTable();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->has('id')){
            $post = Post::with(['seo', 'content'])->find($request->id);
            $post->title .= ' - '.time();
            $post->slug .= '-'.time();
            view()->share('post', $post);
            $seo = $post->seo;
            view()->share('seo', $seo);
            $content = $post->content;
            view()->share('content', $content);

        }
        return view('backend.post.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param PostRequest $request
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PostRequest $request)
    {
        $data = $request->except('_token');
        $data['published_date'] = Carbon::createFromFormat('d/m/Y H:i', $data['published_date'])->format('Y-m-d H:i');

        $post = (new Post())->createPost($data);
        return $this->response(route('post.edit', ['id' => $post->id]));
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
        $post = Post::with(['seo', 'content'])->find($id);
        if (!$post) return redirect()->route('post.index');
        $seo = $post->seo;
        $content = $post->content;

        return view('backend.post.edit')
            ->with('post', $post)
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
    public function update($id, PostRequest $request)
    {
        $post = Post::find($id);
        if (!$post) {return redirect()->route('post.index');}

        $data = $request->except(['_token', '_method']);
        $data['published_date'] = Carbon::createFromFormat('d/m/Y H:i', $data['published_date'])->format('Y-m-d H:i');

        $postModel = new Post();
        $postModel->updatePost($data, $id);

        return $this->response();
    }

    /**
     * @param $id
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        return $this->response(null, ['datatable'=>true]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function move($id, Request $request)
    {
        (new Post())->move($id, $request->direction);
        return $this->response(null, ['datatable' => true]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateField($id, Request $request)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->route('post.index');
        }
        $data = $request->except(['_token', '_method']);

        $postModel = new Post();
        $postModel->updatePost($data, $id);

        return $this->response(null, ['datatable' => true]);
    }
}