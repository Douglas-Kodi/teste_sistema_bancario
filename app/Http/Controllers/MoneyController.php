<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelUser;
use App\Models\ModelMoney;

class MoneyController extends Controller
{
    private $objUser;
    private $objMoney;
    public function __construct(){
        $this->objUser =new ModelUser();
        $this->objMoney =new ModelMoney();
    }

    public function index()
    {
        //
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
        $id = $request->id;
        $user=$this->objUser->find($id);
        if($user->password == $request->password) {
            if($this->objMoney->create([
                'id_numcc'=>$request->id,
                'valor'=>$request->valor,
                'type'=>$request->type,
            ])){
                return redirect('users/'.$id.'?$adicionado=true');
            }else{
                return redirect('moneys/'.$id.'?$adicionado=false');
            }
        }else{
            return redirect('moneys/'.$id.'?$error=senha_invalida');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $user=$this->objUser->find($id);
        return view('create-money', compact('user')); 
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
