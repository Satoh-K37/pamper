<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegulationsController extends Controller
{
  // 
  public function privacyPolicyShow(Request $request)
  {
    // pプライバシーポリシーのページに遷移
      return view('regulations.privacy_policy');
  }

  public function termsShow(Request $request)
  {
    // 利用規約のページに遷移
      return view('regulations.terms_use');
  }
}
