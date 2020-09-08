<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Company;
use App\Models\Ciudad;
use App\Models\User;

class HomeController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
    if (auth()->user()->role->key === "admin"){
      return view('admin.pages.home.index');
    }else{
      return view('home');
    }
  }

  public function users(){
    $users = User::all();
    $departamentos = Departamento::all();
    return view('pages.users.index', compact('users', 'departamentos') );
  }

  
  public function saveSetting(Request $request){

    $company = new Company;
    if (auth()->user()->company_id){
      $company = Company::findOrfail(auth()->user()->company_id);
    }

    $company->fill( $request->all() );
    $company->settings = '{colors: {"primary": "'.$request->primary.'","secondary": "'.$request->secondary.'", "primary_text": "'.$request->primary_text.'", "secondary_text": "'.$request->secondary_text.'"}}';
    $company->save();

    if ($request->image != ""){
      $p = $request->image;
      $base64_str = substr($p, strpos($p, ",")+1);
      $image = base64_decode($base64_str);
      $safeName = $company->id.'.'.'png';
      \Storage::disk('public')->put('companies/'.$company->id.'/'.$safeName, $image);

      $company->logo = $safeName;
      $company->save();
    }

    $this->generateCustomCssCompany( $company );

    if (!auth()->user()->company_id){
      $user = auth()->user();
      $user->company_id = $company->id;
      $user->save();
    }
    
    return response()->json([
      'result' => true,
      'status' => 'success',
      // 'company' => $company
      'aux' => auth()->user()->company_id
    ]);
  }

  public function generateCustomCssCompany( $company ){
    $dataCss = "[class*='sidebar-dark-'] {
      background-color: ". $company->primary .";
    }

    [class*='sidebar-dark-'] .nav-header{
      color: ". $company->primary_text .";
    }
    
    [class*='sidebar-dark-'] .user-panel a:hover {
      color: ". $company->primary_text .";
    }
    
    [class*='sidebar-dark-'] .user-panel .status {
      background: rgba(255, 255, 255, 0.1);
      color: #C2C7D0;
    }
    
    [class*='sidebar-dark-'] .user-panel .status:hover, [class*='sidebar-dark-'] .user-panel .status:focus, [class*='sidebar-dark-'] .user-panel .status:active {
      background: rgba(247, 247, 247, 0.1);
      color: ". $company->primary_text .";
    }
    
    [class*='sidebar-dark'] .user-panel{
      color: ". $company->primary_text .";
    }
    
    .bg-primary{
      background-color: $company->primary  !important;
      border-color: $company->primary  !important;
      color: ". $company->primary_text ." !important;
    }
    
    .bg-primary.btn:not(:disabled):not(.disabled):active, .bg-primary.btn:not(:disabled):not(.disabled).active, .bg-primary.btn:active, .bg-primary.btn.active{
      background-color: $company->primary  !important;
      border-color: $company->primary  !important;
      color: ". $company->primary_text ." !important;
    }
    
    .bg-primary.btn{
      background-color: $company->primary  !important;
      border-color: $company->primary  !important;
      color: ". $company->primary_text ." !important;
    }
    .bg-primary.btn:hover, .bg-primary.btn:focus, .bg-primary.btn:active{
      background-color: $company->primary  !important;
      border-color: $company->primary  !important;
      color: ". $company->primary_text ." !important;
    }
    
    .navbar-light .navbar-nav .nav-link{
      color: ". $company->secondary_text .";
    }
    .navbar-light .navbar-nav .nav-link:hover, .navbar-light .navbar-nav .nav-link:focus{
      color: $company->secondary_text !important;
    }

    .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active, .sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active{
      color: $company->secondary_text;
    }
    
    .nav-sidebar .nav-item > .nav-link{
      color: ". $company->primary_text .";
    }
    .text-primary{
      color: $company->primary !important;
    }
    
    .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active, .sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active{
      background-color: $company->secondary !important;
    }

    [class*='sidebar-dark-'] .nav-sidebar > .nav-item.menu-open > .nav-link, [class*='sidebar-dark-'] .nav-sidebar > .nav-item:hover > .nav-link, [class*='sidebar-dark-'] .nav-sidebar > .nav-item > .nav-link:focus{
      color: $company->primary_text !important;
    }

    .modal-globox .modal-header{
      background-color: $company->primary;
      color: $company->primary_text;
    }

    a {
      color: $company->secondary_text;
    }
    

    ";

    \Storage::disk('public')->put('companies/'.$company->id.'/css/company.css', $dataCss);
  }

  public function getDepartments(){
    $departamentos = Departamento::all();
    $data = array(
      'result' => true,
      'message' => 'succes',
      'departamentos' => $departamentos
    );
    
    return $data;
  }

  public function getCities(Request $request){
    $request->validate([
      'state' => 'required|string|exists:departamentos,cod'
    ]);
    
    $ciudades = Ciudad::where('codDepto', $request->state)->get();

    return response()->json([
      'result' => true,
      'status' => 'success',
      'ciudades' => $ciudades
    ]);
  }
}
