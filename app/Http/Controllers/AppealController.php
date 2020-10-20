<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Infrastructure\Appeal;
use Exception;

class AppealController extends Controller
{
    public function allNotRead(){
        try {
            return response(Appeal::getNotRead(),200);
        } catch (Exception $ex) {
            return response([
                'error' => $ex->getMessage()
            ],400);
        }
    }

    public function allNotProcessed(){
        try {
            return response(Appeal::getNotProcessed(),200);
        } catch (Exception $ex) {
            return response([
                'error' => $ex->getMessage()
            ],400);
        }
    }

    public function byId(string $id){
        try {
            return response(Appeal::get($id),200);
        } catch (Exception $ex) {
            return response([
                'error' => $ex->getMessage()
            ],400);
        }
    }

    public function create(Request $request){
        try {
            Appeal::create($request->id,
            $request->from,
            $request->email,
            $request->appeal_text);
            return response(['id'=>$request->id],200);
        } catch (Exception $ex) {
            return response([
                'error' => $ex->getMessage()
            ],400);
        }
    }

    public function markRead(string $id){
        try {
            Appeal::markRead($id);
            return response(['id'=>$id],200);
        } catch (Exception $ex) {
            return response([
                'error' => $ex->getMessage()
            ],400);
        }
    }

    public function markProcessed(string $id){
        try {
            Appeal::markProcessed($id);
            return response(['id'=>$id],200);
        } catch (Exception $ex) {
            return response([
                'error' => $ex->getMessage()
            ],400);
        }
    }

    public function markRejected(string $id, Request $request){
        try {
            Appeal::markRejected($id, $request->reject_reason);
            return response(['id'=>$id],200);
        } catch (Exception $ex) {
            return response([
                'error' => $ex->getMessage()
            ],400);
        }
    }
}
