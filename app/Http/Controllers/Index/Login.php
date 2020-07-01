<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Illuminate\Support\Facades\Mail;
use App\Mail\Sendcode;
use App\Member;
use Illuminate\Support\Facades\Cookie;

class Login extends Controller
{
    //登录表单
    public function login(){
        // echo 11;
        return view("index/login");
    }

    //登陆
    public function dologin(){ 
        $post = Request()->except('_token');
        //dump($post);
        if(empty($post['name'])){
            return redirect('/login')->with('msg','用户名不能为空!');
        }
        if(empty($post['password'])){
            return redirect('/login')->with('msg','密码不能为空!');
        }
        $member = Member::where('name',$post['name'])->first();
        if(empty($member)){
            return redirect('/login')->with('msg','用户名或者密码错误');
        }
        if(decrypt($member->password)!=$post['password']){
            return redirect('/login')->with('msg','用户名或者密码错误');
        }
        if(isset($post['rember'])){
            Cookie::queue('member',serialize($member),60*24*7);
        }
        request()->session()->put('member',$member);
        return redirect('/');
    }

    //退出
	 public function logout(){
        Request()->session()->flush();
        return redirect('/login/');
       
        }

    //注册
    public function reg(){
        return view("index/reg");
    }

    //发送短信
    public function send(Request $request){
        // 用户登录名称 zhuang@1958789868382717.onaliyun.com
        // AccessKey ID LTAI4G7G4u4N9SVNQER6KkHS
        // SECRET DOXJ6R3O0mwiFPOTeso1xX8NhiyHYq
        $name=$request->name;
        // echo $name;
        //判断验证name  是手机还是 邮箱
        $reg='/^1[2|3|4|5|6|7|8|9]\d{9}$/';
        // dd(preg_match($reg,$name));
        $reg_email= '/^\w{3,}@([a-z]{2,7}|[0-9]{3})\.(com|cn)$/';
        $code=rand(1000,9999);
        if(preg_match($reg,$name)){
            //手机发送验证码
            $res=$this->sendSms($name,$code);
            if($res['Message']=='OK'){
                $request->session()->put('code',$code);
                return json_encode(['code'=>'0','msg'=>'短信发送成功']);
            }
        }else if(preg_match($reg_email,$name)){
            //邮箱发送验证码
            $this->sendMail($name,$code);
            $request->session()->put('code',$code);
            return json_encode(['code'=>'0','msg'=>'邮件发送成功']);
        }else{
            return json_encode(['code'=>'0','msg'=>'请输入正确的手机号或者邮箱']);
        }
    }

    //封装发送短信
    public function sendSms($mobile,$code){
        // Download：https://github.com/aliyun/openapi-sdk-php
        // Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

        AlibabaCloud::accessKeyClient('LTAI4G7G4u4N9SVNQER6KkHS', 'DOXJ6R3O0mwiFPOTeso1xX8NhiyHYq')
        ->regionId('cn-hangzhou')
        ->asDefaultClient();

        try {
        $result = AlibabaCloud::rpc()
        ->product('Dysmsapi')
        // ->scheme('https') // https | http
        ->version('2017-05-25')
        ->action('SendSms')
        ->method('POST')
        ->host('dysmsapi.aliyuncs.com')
        ->options([
                        'query' => [
                        'RegionId' => "cn-hangzhou",
                        'PhoneNumbers' => $mobile,
                        'SignName' => "开心小铺",
                        'TemplateCode' => "SMS_190720159",
                        'TemplateParam' => "{code:$code}",
                        ],
                    ])
                    ->request();
            return $result->toArray();
        } catch (ClientException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        }

    }

    //封装发送邮件
    public function sendMail($mail,$code){
        Mail::to($mail)->send(new SendCode($code));
    }

    public function doreg(Request $request){
        $post=$request->except('_token');
        // dump($post);
        $code=$request->session()->get('code');
        // dd($code);
        //验证验证码是否正确
        if($post['code']!=$code){
            return redirect('/reg')->with('msg','验证码不对');
        }
        //判断两次密码是否一致
        if($post['password']!=$post['repassword']){
            return redirect('/reg')->with('msg','两次密码不一致');
        }
        //入库
        $reg='/^1[2|3|4|5|6|7|8|9]\d{9}$/';
        // dd(preg_match($reg,$name));
        $reg_email= '/^\w{3,}@([a-z]{2,7}|[0-9]{3})\.(com|cn)$/';
        if(preg_match($reg,$post['name'])){
            $post['mobile']=$post['name'];
        }else if(preg_match($reg_email,$post['name'])){
            $post['email']=$post['name'];
        }else{
            return redirect('/reg')->with('msg','您的手机号或者邮箱不对');
        }

        $post['password']=encrypt($post['password']);
        unset($post['repassword']);
        unset($post['code']);
        // dd($post);
        $res=Member::create($post);
        // dd($res);
        if($res){
            return redirect('/login'); 
        }
    }

}
