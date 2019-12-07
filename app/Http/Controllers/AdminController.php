<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Question            as Q;
use App\Language            as L;
use App\Level               as Lv;
use App\FourOptional        as FO;
use App\MultipleChoice1     as MC1;
use App\MultipleChoice2     as MC2;
use App\Essay               as E;
use App\SavedData           as SD;
use App\User                as U;
use Auth;
class AdminController extends Controller
{
    public function index()
    {
    	$Q = DB::table('levels')
            ->where(['language'=>1])
    		->join('languages', 'languages.id', '=', 'levels.language')
            ->join('questions', 'questions.id', '=', 'levels.question')
            ->join('types', 'types.id', '=', 'questions.type')
    		->get();
    	$oper = array(
    		'questions'		=> $Q
    	);
        // dd($Q);
    	return view('admin.abcd', $oper);
    }

    public function language()
    {
        $oper = array(
            'data'      => L::orderBy('thread')->get()
        );
        return view('admin.language.index', $oper);
    }

    public function languageadd()
    {
        $oper = array(
            'action'        => route('language.create'),
            'back'          => route('h2a.language')
        );
        return view('admin.language.add', $oper);
    }

    public function languagecreate(Request $request)
    {
        $this->validate($request, [
            'name'      => 'unique:languages|required'
        ]);
        L::create([
            'name'      => $request->name
        ]);
        return redirect()->route('h2a.language');
    }

    public function question($language, $type)
    {
        $levels = DB::table('levels')
                ->join('questions', 'questions.id', '=', 'levels.question')
                // ->join('types', 'questions.type', '=', 'types.id')
                ->where(['language'=>$language, 'type'=>$type]);
                // ->get();
        if($type==2){
            $levels = $levels->join('multiple_choice1s', 'multiple_choice1s.id', '=', 'questions.number');
            $levels = $levels->select('multiple_choice1s.*', 'questions.type', 'levels.name', 'levels.id as lvl')->get();
        }else if($type==3){
            $levels = $levels->join('multiple_choice2s', 'multiple_choice2s.id', '=', 'questions.number');
            $levels = $levels->select('multiple_choice2s.*', 'questions.type', 'levels.name', 'levels.id as lvl')->get();
        }else{
            $levels = $levels->join('essays', 'essays.id', '=', 'questions.number');
            $levels = $levels->select('essays.*', 'questions.type', 'levels.name', 'levels.id as lvl')->get();
        }
        $oper = array(
            'data'      => $levels,
            'language'  => $language,
            'type'      => $type
        );
        // if($type==1) return view('admin.question.essay', $oper);
        return view('admin.question', $oper);
    }

    public function questionadd($language, $type)
    {
        $oper = array(
            'language'  => $language,
            'type'      => $type
        );
        if($type==3){
            return view('admin.question.add3', $oper);
        }else if($type==1){
            return view('admin.question.add1', $oper);
        }
        return view('admin.question.add', $oper);
    }

    public function questioncreate(Request $request, $language, $type)
    {
        if($type!=1){
            #validasi
            $this->validate($request, [
                'level'         => 'required|min:1|max:15',
                'a'             => 'required',
                'b'             => 'required',
                'c'             => 'required',
                'd'             => 'required',
                'answer'        => 'required',
                'score'         => 'required'
                ]
            );
        }else{
            $this->validate($request, [
                'level'         => 'required|min:1|max:15',
                'answer'        => 'required',
                'score'         => 'required'
                ]
            );
        }
        #cek level sudah ada?
        $lvlexist = Lv::where(['language'=>$language,'name'=>$request->level])->count()>0;
        if($lvlexist) return redirect()->back()->with('error', 'Level sudah ada!!!');
        $tbl = "";
        #jika pilgan tipe radio
        if($type==2){
            $qexist = MC1::where(['question'=>$request->question])->count()>0;
            if(!$qexist){
                MC1::create([
                    'question'  => $request->question,
                    'a'         => $request->a,
                    'b'         => $request->b,
                    'c'         => $request->c,
                    'd'         => $request->d,
                    'answer'    => $request->answer,
                    'score'     => $request->score
                ]);
            }
            $tbl = MC1::where(['question'=>$request->question])->first();
        }
        #jika pilgan cekbox
        else if($type==3){
            $answer = "";
            foreach ($request->answer as $a) {
                $answer .= $a.",";
            }
            $qexist = MC2::where(['question'=>$request->question])->count()>0;
            if(!$qexist){
                MC2::create([
                    'question'  => $request->question,
                    'a'         => $request->a,
                    'b'         => $request->b,
                    'c'         => $request->c,
                    'd'         => $request->d,
                    'answer'    => rtrim($answer,','),
                    'score'     => $request->score
                ]);
            }
            $tbl = MC2::where(['question'=>$request->question])->first();
        }
        #jika essay
        else{
            $qexist = E::where(['question'=>$request->question])->count()>0;
            if(!$qexist){
                E::create([
                    'question'  => $request->question,
                    'answer'    => $request->answer,
                    'score'     => $request->score
                ]);
            }
            $tbl = E::where(['question'=>$request->question])->first();
        }
        #cek pertanyaan sudah ada?
        $exist = Q::where(['type'=>$type,'number'=>$tbl->id])->count()>0;
        if(!$exist){
            Q::create([
                'type'      => $type,
                'number'    => $tbl->id
            ]);
        }
        #menyimpan data level
        $Q = Q::where(['type'=>$type, 'number'=>$tbl->id])->first();
        Lv::create([
            'name'      => $request->level,
            'language'  => $language, 
            'question'  => $Q->id
        ]);
        return redirect()->route('h2a.question', [$language, $type])->with('success', 'Data berhasil ditambah');
    }

    public function questionedit($language, $type, $id)
    {
        $levels = DB::table('levels')
                ->join('questions', 'questions.id', '=', 'levels.question')
                // ->join('types', 'questions.type', '=', 'types.id')
                ->where(['language'=>$language, 'type'=>$type, 'levels.id'=>$id]);
                // ->get();
        if($type==2){
            $levels = $levels->join('multiple_choice1s', 'multiple_choice1s.id', '=', 'questions.number');
            $levels = $levels->select('multiple_choice1s.*', 'questions.type', 'levels.name', 'levels.id as lvl')->first();
        }else if($type==3){
            $levels = $levels->join('multiple_choice2s', 'multiple_choice2s.id', '=', 'questions.number');
            $levels = $levels->select('multiple_choice2s.*', 'questions.type', 'levels.name', 'levels.id as lvl')->first();
        }else{
            $levels = $levels->join('essays', 'essays.id', '=', 'questions.number');
            $levels = $levels->select('essays.*', 'questions.type', 'levels.name', 'levels.id as lvl')->first();
        }
        // dd($levels);
        $oper = array(
            'data'      => $levels,
            'language'  => $language,
            'type'      => $type,
            'answer'    => explode(',', $levels->answer)
        );
        if($type==3){
            return view('admin.question.edit3', $oper);
        }else if($type==1){
            return view('admin.question.edit1', $oper);
        }
        return view('admin.question.edit', $oper);
    }

    public function questionupdate(Request $request, $language, $type)
    {
        if($type!=1){
            #validasi
            $this->validate($request, [
                // 'level'         => 'required|min:1|max:15',
                'a'             => 'required',
                'b'             => 'required',
                'c'             => 'required',
                'd'             => 'required',
                'answer'        => 'required',
                'score'         => 'required'
                ]
            );
        }else{
            $this->validate($request, [
                // 'level'         => 'required|min:1|max:15',
                'answer'        => 'required',
                'score'         => 'required'
                ]
            );
        }
        $Lv = Lv::find($request->id);
        // dd($Lv);
        $Q = Q::find($Lv->question);
        if($Q->type==2){
            MC1::where(['id'=>$Q->number])
                ->update([
                    'question'  => $request->question,
                    'a'         => $request->a,
                    'b'         => $request->b,
                    'c'         => $request->c,
                    'd'         => $request->d,
                    'answer'    => $request->answer,
                    'score'     => $request->score
                ]);
        }else if($Q->type==3){
            $answer = "";
            foreach ($request->answer as $a) {
                $answer .= $a.",";
            }
            MC2::where(['id'=>$Q->number])
                ->update([
                    'question'  => $request->question,
                    'a'         => $request->a,
                    'b'         => $request->b,
                    'c'         => $request->c,
                    'd'         => $request->d,
                    'answer'    => rtrim($answer, ','),
                    'score'     => $request->score
                ]);
        }else{
            E::where(['id'=>$Q->number])
                ->update([
                    'question'  => $request->question,
                    'answer'    => $request->answer,
                    'score'     => $request->score
                ]);
        }
        return redirect()->route('h2a.question', [$language, $type])->with('success', 'Data berhasil diubah');
    }

    public function questiondelete(Request $request)
    {
        $Lv = Lv::find($request->level);
        // dd($Lv);
        $Q = Q::find($Lv->question);
        if($Q->type==2){
            MC1::destroy($Q->number);
        }else if($Q->type==3){
            MC2::destroy($Q->number);
        }else{
            E::destroy($Q->number);
        }
        Lv::destroy($request->level);
        Q::destroy($Lv->question);
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function add($language)
    {
        $language = L::findOrFail($language)->name;
        $oper = array(
            'language'      => $language
        );
        return view('admin.add', $oper);
    }

    public function essay()
    {
    	$Q = DB::table('questions')->where(['language'=>1, 'question_type'=>2])
    		->join('essays', 'essays.id', '=', 'questions.question')
    		->get();
    	$oper = array(
    		'questions'		=> $Q
    	);
    	return view('admin.essay', $oper);
    }

    public function abcdadd()
    {
    	return view('admin.abcdadd');
    }

    public function essayadd()
    {
    	return view('admin.essayadd');
    }

    public function abcdstore(Request $request)
    {
    	FO::create([
    		'question'		=> $request->question,
    		'a'				=> $request->a,
    		'b'				=> $request->b,
    		'c'				=> $request->c,
    		'd'				=> $request->d,
    		'answer'		=> strtolower($request->answer)
    	]);
    	$FO = FO::where(['question'=>$request->question])->first();
    	$Q = DB::table('questions')->where(['language'=>1])->orderBy('level', 'desc')->first();
    	Q::create([
    		'language'		=> 1,
    		'question'		=> $FO->id,
    		'question_type'	=> 1,
    		'level'			=> $Q->level+1,
    	]);
    	return redirect()->route('h2a');
    }

    public function essaystore(Request $request)
    {
    	E::create([
    		'question'		=> $request->question,
    		'answer'		=> strtolower($request->answer)
    	]);
    	$E = E::where(['question'=>$request->question])->first();
    	$Q = DB::table('questions')->where(['language'=>1])->orderBy('level', 'desc')->first();
    	Q::create([
    		'language'		=> 1,
    		'question'		=> $E->id,
    		'question_type'	=> 2,
    		'level'			=> $Q->level+1,
    	]);
    	return redirect()->route('essay');
    }
}
