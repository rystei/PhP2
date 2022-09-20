<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Http\Request;


class CommentController extends Controller
{

    public function index() {
        return Comment::all();
    }


    public function store(Request $request, $id) {

        if(Post::where('id', $id) -> exists()) {

        //id, descricao, usuario, fk_postagem_id
        $comment = new Comment;

        $comment -> usuario = $request -> usuario;
        $comment -> descricao = $request -> descricao;
        $comment -> fk_postagem_id = $id;

        $comment -> save();

        return response()->json([
            "message" => "Comentario criado com sucesso"
        ], 200);

        }
        else {
            return response() -> json([
                "message" => "Post nao encontrado"
            ], 404);
        }

    }


    public function show(Request $request, $id) {

        $comment = Comment::find($id);

        if (Comment::where('id', $id) -> exists()) {
            return response($comment, 200);
        }
        else {
            return response() -> json([
                "message" => "Comentario nao encontrado"
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {

        $comment = Comment::find($id);

        if (Comment::where('id', $id) -> exists()) {

            $comment = Comment::find($id);

            $comment -> descricao = is_null($request -> descricao) ? $comment -> descricao : $request -> descricao;

            $comment -> save();

            return response() -> json([
                "message" => "Comentario editado com sucesso"
            ], 200);
        }
        else {
            return response() -> json([
                "message" => "Comentario nao encontrado"
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (Comment::where('id', $id) -> exists()) {

            $comment = Comment::find($id);
            $comment -> delete();

            return response() -> json([
                "message" => "Comentario deletado com sucesso"
            ], 200);
        }
        else {
            return response() -> json([
                "message" => "Comentario não encontrado"
            ], 404);
        }
    }

}
