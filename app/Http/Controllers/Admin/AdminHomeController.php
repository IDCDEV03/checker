<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\form_choice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\formChk;

class AdminHomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function list_form(){
        $list_form = formChk::all();   
        return view('admin.list_form',compact('list_form'));
    }

    public function create_form(){

        $data_type = DB::table('form_types')
        ->get();

        return view('admin.create_form',compact('data_type'));
    }

    public function insert_form(Request $request){
        $form_id = Str::upper(Str::random(15)); 
        $id = Auth::user()->user_id;
        
        DB::table('form_chks')->insert([
            'user_id' => $id,
            'form_id' => $form_id,
            'form_name' => $request->form_name,
            'form_type' => $request->form_type,
            'form_category' => $request->form_category,
            'created_at' => Carbon::now()
        ]);

        foreach ($request->category_name as $key => $value) {
            $category_id = Str::upper(Str::random(12)); 
            DB::table('form_categories')->insert([
                'form_id'=>$form_id,
                'category_id'=>$category_id,
                'category_name'=>$value,
                'created_at' => Carbon::now()
            ]);
        }

        return redirect()->route('admin_form')->with('success', 'สร้างฟอร์มเรียบร้อยแล้ว');
    }

    public function formDetail($id){
        $formDetail = DB::table('form_categories')
        ->where('form_categories.form_id','=',$id)
        ->get();

        $formName = DB::table('form_chks')
        ->where('form_id','=',$id)
        ->get();

        return view('admin.formDetail',['id'=>$id],compact('formDetail','formName'));
    }

    public function formDetailChoice($id){
        $category_choice = DB::table('form_choices')
        ->where('category_id','=',$id)
        ->get();    
        
        $categoryName = DB::table('form_categories')
        ->where('category_id','=',$id)
        ->get();

        return view('admin.formDetailChoice',['id'=>$id],compact('category_choice','categoryName'));
    }
  
    public function formPreview($id){
        $formPreview = DB::table('form_chks')
        ->select('form_chks.form_id','form_chks.form_name','form_categories.category_id','form_categories.category_name')
        ->join('form_categories','form_chks.form_id','=','form_categories.form_id')        
        ->where('form_chks.form_id','=',$id)
        ->get();
        
        $formName = DB::table('form_chks')
        ->where('form_id','=',$id)
        ->get();

        return view('admin.formPreview',compact('formPreview','formName'));
    }

    //CRUDข้อตรวจ

    
    public function add_chk_choice($id){
        $form_chk = DB::table('form_chks')
        ->join('form_categories','form_chks.form_id','=','form_categories.form_id')
        ->where('form_categories.category_id','=',$id)
        ->get();
        return view('admin.add_choice',compact('form_chk'));
    }

    public function insert_choice(Request $request,$id){

        $form_id = $request->form_id;

        for($i=0;$i<count($request->addmore);$i++)
        {
            DB::table('form_choices')->insert([
                'form_id' => $form_id,
                'category_id' => $id,
                'form_choice' =>$request->addmore[$i],
                'choice_type' => $request->choice_type[$i],
                'created_at' => Carbon::now()
            ]);
        }

        //foreach ($request->addmore as $key => $value) {
        //    DB::table('form_choices')->insert([
        //        'form_id' => $form_id,
        //        'category_id' => $id,
        //        'form_choice' =>$value,
        //        'choice_type' => $request->choice_type,
         //       'created_at' => Carbon::now()
        //    ]);
        //}       
     
        return redirect()->route('admin_formDetail',['id'=>$form_id])->with('success','บันทึกเรียบร้อยแล้ว');
    }

    public function formChoiceEdit($id){

        $ChoiceEdit = DB::table('form_choices')
        ->join('form_categories','form_choices.category_id','=','form_categories.category_id')
        ->where('form_choices.id','=',$id)
        ->get();

        return view('admin.formChoiceEdit',['id'=>$id],compact('ChoiceEdit'));
    }

    public function formChoiceEditPic($id){

        $ChoiceEdit = DB::table('form_choices')
        ->join('form_categories','form_choices.category_id','=','form_categories.category_id')
        ->where('form_choices.id','=',$id)
        ->get();

        return view('admin.formChoiceEditPic',['id'=>$id],compact('ChoiceEdit'));
    }

    public function formChoiceUpdate(Request $request,$id){
        $cate_id = $request->cate_id;

        DB::table('form_choices')->where('id','=',$id)
        ->update([
            'form_choice' => $request->choiceEdit,
            'choice_type' => $request->choice_type,
            'updated_at' => Carbon::now()
        ]);

        $category_choice = DB::table('form_choices')
        ->where('category_id','=',$cate_id)
        ->get();    
        
        $categoryName = DB::table('form_categories')
        ->where('category_id','=',$cate_id)
        ->get();

        return redirect()->route('admin_formDetailChoice',['id'=>$cate_id])
        ->with('category_choice', $category_choice)
        ->with('categoryName', $categoryName)
        ->with('success','บันทึกเรียบร้อยแล้ว');
    }

    public function formChoiceUpdatePic(Request $request,$id){
        $cate_id = $request->cate_id;
        $request->validate([
            'img_choice' => 'required|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        $imageName = time() . '.' . $request->img_choice->extension();  
        $request->img_choice->move(public_path('file'), $imageName);

        DB::table('form_choices')->where('id','=',$id)
        ->update([
            'choice_img' => $imageName,
            'updated_at' => Carbon::now()
        ]);

        $category_choice = DB::table('form_choices')
        ->where('category_id','=',$cate_id)
        ->get();    
        
        $categoryName = DB::table('form_categories')
        ->where('category_id','=',$cate_id)
        ->get();

        return redirect()->route('admin_formDetailChoice',['id'=>$cate_id])
        ->with('category_choice', $category_choice)
        ->with('categoryName', $categoryName)
        ->with('success','บันทึกเรียบร้อยแล้ว');
    }

    public function formChoiceDelete($id,$cid)
    {
        DB::table('form_choices')->where('id','=',$id)
        ->delete();

        $category_choice = DB::table('form_choices')
        ->where('category_id','=',$cid)
        ->get();    
        
        $categoryName = DB::table('form_categories')
        ->where('category_id','=',$cid)
        ->get();

        return redirect()->route('admin_formDetailChoice',['id'=>$cid])
        ->with('category_choice', $category_choice)
        ->with('categoryName', $categoryName)
        ->with('success','ลบข้อมูลเรียบร้อยแล้ว');
    }

    //CRUDหมวดหมู่

    public function formCategoryEdit($id){

        $CategoryEdit = DB::table('form_categories')
        ->join('form_chks','form_chks.form_id','=','form_categories.form_id')
        ->where('form_categories.category_id','=',$id)
        ->get();

        return view('admin.formCategoryEdit',['id'=>$id],compact('CategoryEdit'));
    }

    public function formCategoryUpdate(Request $request,$id){
        $form_id = $request->form_id;

        DB::table('form_categories')->where('category_id','=',$id)
        ->update([
            'category_name' => $request->category_name,
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('admin_formDetail',['id'=>$form_id])->with('success','บันทึกเรียบร้อยแล้ว');
    }

    public function formCategoryDelete($cid,$form_id)
    {

        DB::table('form_categories')->where('category_id','=',$cid)
        ->delete();

        DB::table('form_choices')->where('category_id','=',$cid)
        ->delete();
         
        $formName = DB::table('form_chks')
        ->where('form_id','=',$form_id)
        ->get();

        return redirect()->route('admin_formDetail',['id'=>$form_id])
        ->with('formDetail', $formName)
        ->with('success','ลบข้อมูลเรียบร้อยแล้ว');
    }

    
}
