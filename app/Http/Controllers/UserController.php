<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelUser;
use App\Models\ModelMoney;

class UserController extends Controller
{
    private $objUser;
    private $objMoney;
    public function __construct(){
        $this->objUser =new ModelUser();
        $this->objMoney =new ModelMoney();
    }

    public function index()
    {
        $user=$this->objUser->orderBy('id', 'ASC')->paginate(8);
        return view('dashboard-user', compact('user')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-user'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cpf = preg_replace( '/[^0-9]/is', '', $request->cpf);
        if(strlen($cpf) != 11) {
            return redirect('users?$error=cpf_invalido');
        }
        if(preg_match('/(\d)\1{10}/', $cpf)) {
            return redirect('users?$error=cpf_invalido');
        }
        for($t = 9; $t < 11; $t++) {
            for($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if($cpf[$c] != $d) {
                return redirect('users?$error=cpf_invalido');
            }
        }
        $num_repetido = 1;
        $randnum = rand(1000000000000000, 9999999999999999);
        $existingNums = $this->objUser::all();
        while($num_repetido == 0){
            $num_repetido = 0;
            foreach($existingNums as $existingNum){
                if($existingNum->numcc == $randnum) {
                    $randnum = rand(1000000000000000, 9999999999999999);
                    $existingNum = $this->objUser::where('numcc', 'like', $randnum);
                    $num_repetido = 1;
                }
            }
        }
        foreach($existingNums as $existingNum){
            if($existingNum->cpf == $request->cpf) {
                return redirect('users?$error=cpf_repetido');
            }
            if($existingNum->email == $request->email) {
                return redirect('users?$error=email_repetido');
            }
        }
        if($this->objUser->create([
            'numcc'=>$randnum,
            'name'=>$request->name,
            'cpf'=>$request->cpf,
            'email'=>$request->email,
            'password'=>$request->password,
        ])){
            return redirect('users?$adicionado=true');
        }else{
            return redirect('users?$adicionado=false');
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
        $moneys=$this->objMoney::orderByDesc('id')->get();
        return view('show-user', compact('user', 'moneys'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=$this->objUser->find($id);
        return view('create-user', compact('user'));
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
        $cpf = preg_replace( '/[^0-9]/is', '', $request->cpf);
        if(strlen($cpf) != 11) {
            return redirect('users/'.$id.'/edit?$error=cpf_invalido');
        }
        if(preg_match('/(\d)\1{10}/', $cpf)) {
            return redirect('users/'.$id.'/edit?$error=cpf_invalido');
        }
        for($t = 9; $t < 11; $t++) {
            for($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if($cpf[$c] != $d) {
                return redirect('users/'.$id.'/edit?$error=cpf_invalido');
            }
        }
        $existingNums = $this->objUser::all();
        foreach($existingNums as $existingNum){
            if($existingNum->id != $id){
                if($existingNum->cpf == $request->cpf) {
                    return redirect('users/'.$id.'/edit?$error=cpf_repetido');
                }
                if($existingNum->email == $request->email) {
                    return redirect('users/'.$id.'/edit?$error=email_repetido');
                }
            }
        }
        if($this->objUser->where(['id'=>$id])->update([
            'name'=>$request->name,
            'cpf'=>$request->cpf,
            'email'=>$request->email,
            'password'=>$request->password,
        ])){
            return redirect('users/'.$id.'/edit?$alterado=true');
        }else{
            return redirect('users/'.$id.'/edit?$alterado=false');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del=$this->objUser->destroy($id);

        return($del)?"Yes":"No";
    }
}
