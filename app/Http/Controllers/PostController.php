<?php

namespace App\Http\Controllers;

use App\DataTables\PostDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\PostRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Laracasts\Flash\Flash;
use Response;

class PostController extends AppBaseController
{
    /** @var  PostRepository */
    private $postRepository;

    public function __construct(PostRepository $postRepo)
    {
        $this->middleware('auth');
        
        $this->postRepository = $postRepo;
    }

    /**
     * Display a listing of the Post.
     *
     * @param PostDataTable $postDataTable
     * @return Response
     */
    public function index(PostDataTable $postDataTable)
    {
        return $postDataTable->render('posts.index');
    }

    /**
     * Show the form for creating a new Post.
     *
     * @return Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created Post in storage.
     *
     * @param CreatePostRequest $request
     *
     * @return Response
     */
    public function store(CreatePostRequest $request)
    {

        $input = $request->all();

        $input["user_id"] = auth()->user()->id;

        $post = $this->postRepository->create($input);

        if (isset($request->images)) {

            $file = $request->file('images')[0];
            $post->addMedia($file)->preservingOriginal()->toMediaCollection('featured-image');

            foreach ($request->images as $image) {

                // $path = $image->getClientOriginalName();
                $post->addMedia($image)->toMediaCollection('post-images');
            }

        }


        $post->tags()->sync($request->tags);


        Flash::success('Post saved successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified Post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified Post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->find($id);
        $images = Post::find($id)->getMedia('post-images');

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        return view('posts.edit')->with(compact('post','images'));
    }

    /**
     * Update the specified Post in storage.
     *
     * @param  int              $id
     * @param UpdatePostRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostRequest $request)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        $post = $this->postRepository->update($request->all(), $id);

        if (isset($request->images)) {
            
            if(!$request->images[0] == null){

                $post->clearMediaCollection('featured-image');
                
                $post->clearMediaCollection('post-images');
                
                $file = $request->images[0];
                $post->addMedia($file)->preservingOriginal()->toMediaCollection('featured-image');
                
                foreach ($request->images as $image) {
                    
                    // $path = $image->getClientOriginalName();
                    $post->addMedia($image)->toMediaCollection('post-images');
                }
                
                
            }
            
        }
        $post->tags()->sync($request->tags);

        Flash::success('Post updated successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified Post from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        if(Gate::allows('isAdmin') || Gate::allows('isEditor')){

            $post = $this->postRepository->find($id);
            
            if (empty($post)) {
                Flash::error('Post not found');
                
                return redirect(route('posts.index'));
            }
            
            $this->postRepository->delete($id);
            
            $post->tags()->sync([]);
            
            Flash::success('Post deleted successfully.');
            
            return redirect(route('posts.index'));
        } else {
            return back()->with('message', 'Unauthorized action');
        }
    }
}
