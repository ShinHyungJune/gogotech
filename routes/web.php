<?php

use App\Enums\KakaoTemplate;
use App\Models\Kakao;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\SurveyUserController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CommissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get("/certifications/create", function (){

    $test = config("app.env") == "local";

    if($test){
        $g_conf_home_dir = resource_path()."/views/kcpcert";

        $g_conf_site_cd      = "S6186";

        $g_conf_web_siteid   = "";

        $g_conf_ENC_KEY      = "E66DCEB95BFBD45DF9DFAEEBCB092B5DC2EB3BF0";

        $g_conf_Ret_URL      = config("app.url")."/respond";

        $g_conf_gw_url       = "https://testcert.kcp.co.kr/kcp_cert/cert_view.jsp";
    }else{
        $g_conf_home_dir = resource_path()."/views/kcpcert";

        $g_conf_site_cd      = "AHX7T";

        $g_conf_web_siteid   = "J22051208164";

        $g_conf_ENC_KEY      = "896b644fa71a00b9c67b5b8da1b86fb386796d91b22b8bab42c552b4096bdd39";

        $g_conf_Ret_URL      = config("app.url")."/respond";

        /* ============================================================================== */
        /* =   02. 인증 테스트/상요 설정                                                = */
        /* = -------------------------------------------------------------------------- = */
        /* = * g_conf_gw_url 설정                                                       = */
        /* = 테스트 시 : src="https://testcert.kcp.co.kr/kcp_cert/cert_view.jsp"        = */
        /* = 실결제 시 : src="https://cert.kcp.co.kr/kcp_cert/cert_view.jsp"            = */
        /* = -------------------------------------------------------------------------- = */
        $g_conf_gw_url       = "https://cert.kcp.co.kr/kcp_cert/cert_view.jsp";
    }

    return view("/kcpcert/WEB_ENC/start",[
        "g_conf_home_dir" => $g_conf_home_dir,
        "g_conf_site_cd" => $g_conf_site_cd,
        "g_conf_web_siteid" => $g_conf_web_siteid,
        "g_conf_ENC_KEY" => $g_conf_ENC_KEY,
        "g_conf_Ret_URL" => $g_conf_Ret_URL,
        "g_conf_gw_url" =>  $g_conf_gw_url
    ]);
});



Route::post("/request", function (\Illuminate\Http\Request $request){

    $test = config("app.env") == "local";

    if($test){
        $g_conf_home_dir = resource_path()."/views/kcpcert";

        $g_conf_site_cd      = "S6186";

        $g_conf_web_siteid   = "";

        $g_conf_ENC_KEY      = "E66DCEB95BFBD45DF9DFAEEBCB092B5DC2EB3BF0";

        $g_conf_Ret_URL      = config("app.url")."/respond";

        $g_conf_gw_url       = "https://testcert.kcp.co.kr/kcp_cert/cert_view.jsp";
    }else{
        $g_conf_home_dir = resource_path()."/views/kcpcert";

        $g_conf_site_cd      = "AHX7T";

        $g_conf_web_siteid   = "J22051208164";

        $g_conf_ENC_KEY      = "896b644fa71a00b9c67b5b8da1b86fb386796d91b22b8bab42c552b4096bdd39";

        $g_conf_Ret_URL      = config("app.url")."/respond";

        /* ============================================================================== */
        /* =   02. 인증 테스트/상요 설정                                                = */
        /* = -------------------------------------------------------------------------- = */
        /* = * g_conf_gw_url 설정                                                       = */
        /* = 테스트 시 : src="https://testcert.kcp.co.kr/kcp_cert/cert_view.jsp"        = */
        /* = 실결제 시 : src="https://cert.kcp.co.kr/kcp_cert/cert_view.jsp"            = */
        /* = -------------------------------------------------------------------------- = */
        $g_conf_gw_url       = "https://cert.kcp.co.kr/kcp_cert/cert_view.jsp";
    }

    return view("/kcpcert/WEB_ENC/request",[
        "g_conf_home_dir" => $g_conf_home_dir,
        "g_conf_site_cd" => $g_conf_site_cd,
        "g_conf_web_siteid" => $g_conf_web_siteid,
        "g_conf_ENC_KEY" => $g_conf_ENC_KEY,
        "g_conf_Ret_URL" => $g_conf_Ret_URL,
        "g_conf_gw_url" =>  $g_conf_gw_url,
        "post" => $request->all(),
        "ct" => new \App\Models\Ct()
    ]);
});

Route::post("/respond", function (\Illuminate\Http\Request $request){

    $test = config("app.env") == "local";

    if($test){
        $g_conf_home_dir = resource_path()."/views/kcpcert";

        $g_conf_site_cd      = "S6186";

        $g_conf_web_siteid   = "";

        $g_conf_ENC_KEY      = "E66DCEB95BFBD45DF9DFAEEBCB092B5DC2EB3BF0";

        $g_conf_Ret_URL      = config("app.url")."/respond";

        $g_conf_gw_url       = "https://testcert.kcp.co.kr/kcp_cert/cert_view.jsp";
    }else{
        $g_conf_home_dir = resource_path()."/views/kcpcert";

        $g_conf_site_cd      = "AHX7T";

        $g_conf_web_siteid   = "J22051208164";

        $g_conf_ENC_KEY      = "896b644fa71a00b9c67b5b8da1b86fb386796d91b22b8bab42c552b4096bdd39";

        $g_conf_Ret_URL      = config("app.url")."/respond";

        /* ============================================================================== */
        /* =   02. 인증 테스트/상요 설정                                                = */
        /* = -------------------------------------------------------------------------- = */
        /* = * g_conf_gw_url 설정                                                       = */
        /* = 테스트 시 : src="https://testcert.kcp.co.kr/kcp_cert/cert_view.jsp"        = */
        /* = 실결제 시 : src="https://cert.kcp.co.kr/kcp_cert/cert_view.jsp"            = */
        /* = -------------------------------------------------------------------------- = */
        $g_conf_gw_url       = "https://cert.kcp.co.kr/kcp_cert/cert_view.jsp";
    }

    return view("/kcpcert/WEB_ENC/respond",[
        "g_conf_home_dir" => "$g_conf_home_dir",
        "g_conf_site_cd" => "$g_conf_site_cd",
        "g_conf_web_siteid" => "$g_conf_web_siteid",
        "g_conf_ENC_KEY" => "$g_conf_ENC_KEY",
        "g_conf_Ret_URL" => "$g_conf_Ret_URL",
        "g_conf_gw_url" =>  $g_conf_gw_url,
        "ct" => new \App\Models\Ct()
    ]);
});
Route::get('/test', function(){
    /*
    $letter = \App\Models\Letter::find(3761);

    $sms = new \App\Models\SMS();

    dd($sms->getLogs($letter)->where("RSLT_CODE2", 0)->count());
    */
});
Route::get('/', [\App\Http\Controllers\PageController::class, "index"])->name("home");
Route::get('/privacyPolicy', [\App\Http\Controllers\PageController::class, "privacyPolicy"])->name("home");
Route::get('/servicePolicy', [\App\Http\Controllers\PageController::class, "servicePolicy"]);
Route::get('/spamPolicy', [\App\Http\Controllers\PageController::class, "spamPolicy"]);

Route::post("/users", [\App\Http\Controllers\UserController::class, "store"]);
Route::post("/verifyNumbers", [\App\Http\Controllers\Api\VerifyNumberController::class, "store"]);
Route::patch("/verifyNumbers", [\App\Http\Controllers\Api\VerifyNumberController::class, "update"]);
Route::post("/certifications", [\App\Http\Controllers\CertificationController::class, "store"]);

Route::middleware("admin")->group(function(){
    Route::get("/users/remove", [\App\Http\Controllers\UserController::class, "remove"]);
    Route::delete("/users", [\App\Http\Controllers\UserController::class, "destroy"]);
    Route::get("/users/edit", [\App\Http\Controllers\UserController::class, "edit"]);
    Route::post("/users/update", [\App\Http\Controllers\UserController::class, "update"]);

    Route::resource("/charges", \App\Http\Controllers\ChargeController::class);
    Route::resource("/books", \App\Http\Controllers\BookController::class);
    Route::post("/contacts/upload", [\App\Http\Controllers\ContactController::class, "upload"]);
    Route::resource("/contacts", \App\Http\Controllers\ContactController::class);
    Route::resource("/letters", \App\Http\Controllers\LetterController::class);
    Route::resource("/refunds", \App\Http\Controllers\RefundController::class);

});

Route::middleware("auth")->group(function(){
    Route::resource("/qnas", \App\Http\Controllers\QnaController::class);

});

Route::get("/logout", [\App\Http\Controllers\UserController::class, "logout"]);


Route::middleware("guest")->group(function(){
    Route::get("/login", [\App\Http\Controllers\UserController::class, "loginForm"])->name("login");
    Route::get("/register", [\App\Http\Controllers\UserController::class, "create"]);
    Route::get("/openLoginPop/{social}", [\App\Http\Controllers\UserController::class, "openSocialLoginPop"]);
    Route::get("/login/{social}", [\App\Http\Controllers\UserController::class, "socialLogin"]);
    Route::post("/login", [\App\Http\Controllers\UserController::class, "login"]);
    Route::post("/register", [\App\Http\Controllers\UserController::class, "register"]);
    Route::resource("/users", \App\Http\Controllers\UserController::class);
    Route::get("/passwordResets/{token}/edit", [\App\Http\Controllers\PasswordResetController::class, "edit"]);
    Route::resource("/passwordResets", \App\Http\Controllers\PasswordResetController::class);
    Route::resource("/findIds", \App\Http\Controllers\FindIdsController::class);

});

Route::get("/login", [\App\Http\Controllers\UserController::class, "loginForm"])->name("login");

Route::get("/mailable", function(){
    return (new \App\Mail\PasswordResetCreated(new \App\Models\User(), new \App\Models\PasswordReset()));
});


Route::get("/rejects/store", [\App\Http\Controllers\RejectController::class, "store"]);
Route::resource("/notices", \App\Http\Controllers\NoticeController::class);
Route::resource("/faqs", \App\Http\Controllers\FaqController::class);

Route::get("/404", [\App\Http\Controllers\ErrorController::class, "notFound"]);
Route::get("/403", [\App\Http\Controllers\ErrorController::class, "unAuthenticated"]);
