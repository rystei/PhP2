<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;


class PostController extends Controller
{
    //index serve para mostrar todos os itens
    public function index(Request $request) {
        return Post::all();
    }


    public function store(Request $request) {
        $post = new Post;

        //id, usuario, titulo, descricao
        //$post -> id = $request -> id;
        $post->usuario = $request->usuario;
        $post->titulo = $request->titulo;
        $post->descricao = $request->descricao;

        $post->save();

        return response()->json([
            "message" => "Post criado com sucesso"
        ], 200);


    }

    //Show serve pra mostrar um item
    public function show(Request $request, $id) {

        $post = Post::find($id);

        if (Post::where('id', $id) -> exists()) {
            return response($post, 200);
        }
        else {
            return response() -> json([
                "message" => "Post não encontrado"
            ], 404);
        }
    }


    public function edit(Request $request, $id) {
        if (Post::where('id', $id) -> exists()) {

            $post = Post::find($id);

            $post -> titulo = is_null($request -> titulo) ? $post -> titulo : $request -> titulo;
            $post -> descricao = is_null($request -> descricao) ? $post -> descricao : $request -> descricao;

            $post -> save();

            return response() -> json([
                "message" => "Post editado com sucesso"
            ], 200);
        }
        else {
            return response() -> json([
                "message" => "Post não encontrado"
            ], 200);
        }
    }



    public function destroy(Request $request, $id) {
        if (Post::where('id', $id) -> exists()) {

            $post = Post::find($id);
            $post -> delete();

            return response() -> json([
                "message" => "Post deletado com sucesso"
            ], 200);
        }
        else {
            return response() -> json([
                "message" => "Post não encontrado"
            ], 404);
        }
    }
}
