<?php

namespace App\Http\Controllers;

use App\Cv;
use Illuminate\Http\Request;

class CvController extends Controller
{
    //
    public function addCv(Request $request){
        $req = $request->all();
        $res = array();
        $cv = new Cv;
        foreach($req as $key=>$value){
            if(!$value){
                $res['err_code'] = 2;
                $res['msg'] = $key.'未填写！';
                return json_encode($res);
                break;
            }
            $cv[$key] = $value;
        }
    }
    public function editCv(){}
    public function delCv(){}
    public function getCvById(){}

    public function addEdu(){}
    public function delEdu(){}
    public function editEdu(){}
    public function getEduByCvId(){}
    public function getEduById(){}

    public function addExp(){}
    public function delExp(){}
    public function editExp(){}
    public function getExpByCvId(){}
    public function getExpById(){}

    public function addProject(){}
    public function delProject(){}
    public function editProject(){}
    public function getProjectByCvId(){}
    public function getProjectById(){}

    public function addPrize(){}
    public function delPrize(){}
    public function editPrize(){}
    public function getPrizeByCvId(){}
    public function getPrizeById(){}

    public function addMemberExp(Request $id){

    }
    public function delMemberExp(){}
    public function editMemberExp(){}
    public function getMemberExpByCvId(){}
    public function getMemberExpById(){}
}
