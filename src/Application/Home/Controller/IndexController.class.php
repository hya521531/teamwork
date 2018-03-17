<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        
        $this->display("Index:index");

        }
    public function login(){

    	$username=I('username');
    	$password=I('password');
    	$db=D('user');
    	if($username != NULL && $password !=NULL)
    	{
    		$map['username']=$username;
    		$res=$db->where($map)->select();
    		if($res[0]['password']==$password)

    		{
    			if($res[0]['type']==0)
    			$this->display("Stu:index");
    			else $this->display("Tea:index");
    			session("user_id",$username);

    		}
    		else{$this->redirect("Index:index");}
    	}
    	else $this->redirect("Index:index");
    }
    public function my_info(){

    	//echo session('user_id');
    	$db=D('info');
    	$map['stu_num']=session('user_id');
    	$res=$db->where($map)->select();
    	// var_dump($res);exit();
    	$this->assign("info_list",$res);
    	$this->display("Stu:my");

    }
    public function my_grade(){

    	//echo session('user_id');
    	$db=D('chengji');
    	$map['stu_num']=session('user_id');
    	$res=$db->where($map)->select();
    	// var_dump($res);exit();
    	$this->assign("chengji_list",$res);
    	$this->display("Stu:guard");

    }
    public function logout(){

    	// session('user_id')=NULL;
    	// var_dump(session('user_id'));exit();
    	session(null);
    	$this->redirect("Index:index");
    }
    public function changepass(){
    	$this->display("Stu:ChangePasswd");
    }
    public function changeps(){
    	$new=I('password');
    	$db=D('user');
    	$map['password']=$new;
    	$user=session('user_id');
    	$db->where('username='.$user)->save($map);
    	session(NULL);
    	$this->redirect("Index:index");
    }
    public function stu_info_all()
    {
    	$db=D('chengji');
    	$res=$db->select();
    	$this->assign("stu_list",$res);
    	$this->display('Tea:all_stu');
    }
    public function add_stu(){

    	$this->display("Tea:addStudent");
    }
    public function delete_stu(){

    	$this->display("Tea:deleteStudent");
    }
    public function edit_stu(){

    	$this->display("Tea:alertStudent");
    }
    public function add_stu_fu(){

    	$map['id']=null;
    	$map['stu_num']=I('stu_num');
    	$map['name']=I('name');
    	$map['gaoshu']=I('gaoshu');
    	$map['english']=I('english');
    	$map['shujujiegou']=I('shujujiegou');
    	$map['shujuku']=I('shujuku');
    	// var_dump($map);exit();
    	$db=D('chengji');
    	$db->add($map);
		
		
		$db2=D('user');
		$map2['username']=$map['stu_num'];
		$map2['password']=$map['stu_num'];
		$db2->add($map2);
    	$this->redirect("Index:stu_info_all");
    }
    public function delete_stu_fu(){

    	$map['stu_num']=I('stu_num');
    	$db=D('chengji');
    	$db->where($map)->delete();
    	$this->redirect("Index:stu_info_all");
    }
    public function edit_stu_fu(){

    	$map['stu_num']=I('stu_num');
    	$map['name']=I('name');
    	$map['gaoshu']=I('gaoshu');
    	$map['english']=I('english');
    	$map['shujujiegou']=I('shujujiegou');
    	$map['shujuku']=I('shujuku');
    	// var_dump($map);exit();
    	$db=D('chengji');
    	$db->where('stu_num='.$map['stu_num'])->save($map);
    	$this->redirect("Index:stu_info_all");

    }
}