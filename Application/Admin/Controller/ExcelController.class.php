<?php
namespace Admin\Controller;
use Think\Controller;

class ExcelController extends Controller{

	//excel表格上传功能
	public function uploadExcel(){
		$info = I('attach_path','');
		if (empty($info)) {
			$this->error("请上传Excel文件");
		}
		$ext = substr(strrchr($info, '.'), 1);
		if ($ext!='xls' && $ext!='xlsx') {
			$this->error("上传的文件格式不正确");
		}
		if(!file_exists('.'.$info)){
			return $this->error("Excel文件不存在");
		}
		$array = $this->importExecl('.'.$info);
		$content = $array['data'][0]['Content'];
		if(!$content){
			$this->error('请在Excel中填写需要上传的数据');
		}
		unset($content[1]);
		$num = 0; //用户上传数量
		$alldata = array();
		$is_add = true;//是否可以向数据库插入数据
		$error ='';
		foreach($content as $k => $v){
			if ($v[2] == '') {
				continue;//手机号为空
			}
			$data = array();
			$data['real_name'] = $v[0];
			$data['username'] = $v[1];
			
			$result_u = $this->_checkName($data['username']);
			if (!$result_u) {
				$is_add = false;
				$error = '第'.($num+1).'行的用户名重复。';
				break;
			}
			$data['phone'] = $v[2];
			$result = $this->_checkPhone($data['phone']);
			if (!$result) {
				$is_add = false;
				$error = '第'.($num+1).'行的用户手机号重复。';
				break;
			}
			$dept = $v[3];
			$dept_id = D('UserDepartment')->getUserDepartmentIdByName($dept);
			if ($dept_id > 0) {
				$data['department_id'] = $dept_id;
			} else {
				$is_add = false;
				$error = '第'.($num+1).'行的用户数据的部门存在问题。';
				break;
			}

			$position = $v[4];
			$position_id = D('Position')->getPositionIdByName($position);
			if ($position_id > 0) {
				$data['position_id'] = $position_id;
			} else {
				$is_add = false;
				$error = '第'.($num+1).'行的用户数据的职务存在问题。';
				break;
			}

			$area = $v[5];
			$area_id = D('Area')->getAreaIdByName($area);
			if ($area_id > 0) {
				$data['area_id'] = $area_id;
			} else {
				$is_add = false;
				$error = '第'.($num+1).'行的用户数据的签到地址存在问题。';
				break;
			}
			$data['financial_code'] = $v[6];
			$data['file_no'] = $v[7];
			$data['attendance_number'] = $v[8];
			$post_status = $v[9];
			$post_status = show_post_status_value($post_status);
			if ($post_status == '') {
				$is_add = false;
				$error = '第'.($num+1).'行的用户数据的用户状态存在问题。';
				break;
			}
			$data['post_status'] = $post_status;
			$data['password'] = sha1('123456');
			$data['pay_password'] = sha1('123456');
			$data['isAdmin'] = 1;
			$data['isService'] = 1;
			$data['isUser'] = 0;

			$alldata[] = $data;
			$num++;
		}
		if (!$is_add) {
			$this->error($error);
			exit;
		}
		$member = D('Member');
		M()->startTrans();
		foreach ($alldata as $key => $value) {
			$result = $member->add($value);
			if ($result<=0) {
				$this->error($member->getError());
				M()->rollback(); // 事务回滚
			}
		}
		M()->commit();
		//删除该该件路径
		//$this->deldir($info);
		$this->success('成功上传'.$num.'条业务员信息');
		exit;
	}

	// 判断手机号码是否已经有了, 判断时不判断自已
	private function _checkPhone($data){
		$where['phone'] = $data;
		// $where['status']= array('eq',0);
		//$where['disabled']= array('eq',0);
		$count = M('Member')->where($where)->count();
		if ($count > 0) {
			return false;
		}
		return true;
	}
	private function _checkName($data){
		$firstCode = substr($data, 0, 1);
		if (ctype_alpha($firstCode)) {
			if (ctype_alnum($data)) {
				//判断是否重复
				$where['username'] = $data;
				// $where['status']= array('eq',0);
				//$where['disabled']= array('eq',0);
				$count = M('Member')->where($where)->count();
				if ($count > 0) {
					return false;
				}
				return true;
			}
		}
		return false;
	}

	//excel表格考试试题上传功能
	public function uploadExamExcel(){
		$info = I('attach_path','');
		if (empty($info)) {
			$this->error("请上传Excel文件");
		}
		$ext = substr(strrchr($info, '.'), 1);
		if ($ext!='xls' && $ext!='xlsx') {
			$this->error("上传的文件格式不正确");
		}
		if(!file_exists('.'.$info)){
			return $this->error("Excel文件不存在");
		}
		$array = $this->importExecl('.'.$info);
		$content = $array['data'][0]['Content'];
		if(!$content){
			$this->error('请在Excel中填写需要上传的数据');
		}
		unset($content[1]);
		$num = 0; //试题上传数量
		$alldata = array();
		$is_add = true;//是否可以向数据库插入数据
		$error ='';
		$ExamClassModel = D('ExamClass');
		foreach($content as $k => $v){
			if (empty($v[2])) {
				continue;
			}
			$data = array();
			$class_id = $ExamClassModel->getExamClassIdByName(trim($v[0]));

			
			if ($class_id == 0) {
				$is_add = false;
				$error = '第'.($num+1).'行的所属题库不存在。';
				break;
			}
			$data['class_id'] = $class_id;
			$type = show_exam_value_value($v[1]);
			if ($type == 0) {
				$is_add = false;
				$error = '第'.($num+1).'行的题型无法识别。';
				break;
			}
			$data['type'] = $type;
			if(strlen($v[2])>=255){
				$is_add = false;
				$error = '第'.($num+1).'行的题目名称过长。';
				break;
			}
			$data['title'] = $v[2];

			//处理考试的选项问题
			$answer = trim($v[3]);//处理答案
			$answer = explode('|',$answer);
			if (empty($answer)) {
				$is_add = false;
				$error = '第'.($num+1).'行的默认答案未设置。';
				break;
			}
			$answer_right = array();
			foreach ($answer as $key => $value) {
				$answer_right[$value] = 1;
			}
			$answer_data = array();
			if ($type ==  1) {//判断单独处理
				if ($answer_right['A'] == 1) {
					$answer_data[0]['is_right'] = 1;
				}
				if ($answer_right['B'] == 1) {
					$answer_data[0]['is_right'] = 0;
				}
			} else {
				if(strlen($v[4])>=255){
					$is_add = false;
					$error = '第'.($num+1).'行的选项A名称过长。';
					break;
				}
				if (!empty($v[4])) {
					if ($answer_right['A'] == 1) {
						$answer_data['A']['is_right'] = 1;
					}
					$answer_data['A']['title'] = $v[4];
				}
				
				if(strlen($v[5])>=255){
					$is_add = false;
					$error = '第'.($num+1).'行的选项B名称过长。';
					break;
				}
				if (!empty($v[5])) {
					if ($answer_right['B'] == 1) {
						$answer_data['B']['is_right'] = 1;
					}
					$answer_data['B']['title'] = $v[5];
				}
				if(strlen($v[6])>=255){
					$is_add = false;
					$error = '第'.($num+1).'行的选项C名称过长。';
					break;
				}
				if (!empty($v[6])) {
					if ($answer_right['C'] == 1) {
						$answer_data['C']['is_right'] = 1;
					}
					$answer_data['C']['title'] = $v[6];
				}
				if(strlen($v[7])>=255){
					$is_add = false;
					$error = '第'.($num+1).'行的选项D名称过长。';
					break;
				}
				if (!empty($v[7])) {
					if ($answer_right['D'] == 1) {
						$answer_data['D']['is_right'] = 1;
					}
					$answer_data['D']['title'] = $v[7];
				}
				if(strlen($v[8])>=255){
					$is_add = false;
					$error = '第'.($num+1).'行的选项E名称过长。';
					break;
				}
				if (!empty($v[8])) {
					if ($answer_right['E'] == 1) {
						$answer_data['E']['is_right'] = 1;
					}
					$answer_data['E']['title'] = $v[48];
				}
				if(strlen($v[9])>=255){
					$is_add = false;
					$error = '第'.($num+1).'行的选项F名称过长。';
					break;
				}
				if (!empty($v[9])) {
					if ($answer_right['F'] == 1) {
						$answer_data['F']['is_right'] = 1;
					}
					$answer_data['F']['title'] = $v[9];
				}
				if(strlen($v[10])>=255){
					$is_add = false;
					$error = '第'.($num+1).'行的选项G名称过长。';
					break;
				}
				if (!empty($v[10])) {
					if ($answer_right['G'] == 1) {
						$answer_data['G']['is_right'] = 1;
					}
					$answer_data['G']['title'] = $v[10];
				}
				if(strlen($v[11])>=255){
					$is_add = false;
					$error = '第'.($num+1).'行的选项H名称过长。';
					break;
				}
				if (!empty($v[11])) {
					if ($answer_right['H'] == 1) {
						$answer_data['H']['is_right'] = 1;
					}
					$answer_data['H']['title'] = $v[11];
				}
			}
			$answer_data = restore_array($answer_data);
			$data['answer_data'] = $answer_data;
			$alldata[] = $data;
			$num++;
		}
		if (!$is_add) {
			$this->error($error);
			exit;
		}
		$exam_model = D('Exam');
		$exam_answer_model = D('ExamAnswer');
		M()->startTrans();
		foreach ($alldata as $key => $value) {
			$id = $exam_model->data($value)->add();
			if ($id ===false) {
				M()->rollback(); // 事务回滚
				$this->error(V(0,$exam_model->getError()));
				exit;
			}
			//导入试题答案
			foreach ($value['answer_data'] as $k => $v) {
				$value['answer_data'][$k]['exam_id'] = $id;
				$exam_answer_model->add($value['answer_data'][$k]);
			}
		}
		M()->commit();
		//删除该该件路径
		//$this->deldir($info);
		$this->success('成功上传'.$num.'条试题信息');
		exit;
	}

	//导入EXCEL
	public function importExecl($file){
		if(!file_exists($file)){
			return array("error"=>0,'message'=>'file not found!');
		}
		Vendor("PHPExcel.PHPExcel.IOFactory");
		$objReader = \PHPExcel_IOFactory::createReader('Excel5');
		try{
			$PHPReader = $objReader->load($file);
		}catch(Exception $e){}
		if(!isset($PHPReader)) return array("error"=>0,'message'=>'read error!');
		$allWorksheets = $PHPReader->getAllSheets();
		$i = 0;
		foreach($allWorksheets as $objWorksheet){
			$sheetname=$objWorksheet->getTitle();
			$allRow = $objWorksheet->getHighestRow();//how many rows
			$highestColumn = $objWorksheet->getHighestColumn();//how many columns
			$allColumn = \PHPExcel_Cell::columnIndexFromString($highestColumn);
			// $array[$i]["Title"] = $sheetname;
			// $array[$i]["Cols"] = $allColumn;
			// $array[$i]["Rows"] = $allRow;
			$arr = array();
			$isMergeCell = array();
			foreach ($objWorksheet->getMergeCells() as $cells) {//merge cells
				foreach (\PHPExcel_Cell::extractAllCellReferencesInRange($cells) as $cellReference) {
					$isMergeCell[$cellReference] = true;
				}
			}
			for($currentRow = 1 ;$currentRow<=$allRow;$currentRow++){
				$row = array();
				for($currentColumn=0;$currentColumn<$allColumn;$currentColumn++){;
				$cell =$objWorksheet->getCellByColumnAndRow($currentColumn, $currentRow);
				$afCol = \PHPExcel_Cell::stringFromColumnIndex($currentColumn+1);
				$bfCol = \PHPExcel_Cell::stringFromColumnIndex($currentColumn-1);
				$col = \PHPExcel_Cell::stringFromColumnIndex($currentColumn);
				$address = $col.$currentRow;
				$value = $objWorksheet->getCell($address)->getValue();
				if(is_object($value))  $value= $value->__toString();
				if(substr($value,0,1)=='='){
					return array("error"=>0,'message'=>'can not use the formula!');
					exit;
				}
				if($cell->getDataType()==\PHPExcel_Cell_DataType::TYPE_NUMERIC){
					$cellstyleformat=$cell->getParent()->getStyle( $cell->getCoordinate() )->getNumberFormat();
					$formatcode=$cellstyleformat->getFormatCode();
					if (preg_match('/^([$[A-Z]*-[0-9A-F]*])*[hmsdy]/i', $formatcode)) {
						$value=gmdate("Y-m-d", \PHPExcel_Shared_Date::ExcelToPHP($value));
					}else{
						$value=\PHPExcel_Style_NumberFormat::toFormattedString($value,$formatcode);
					}
				}
				if($cell->getDataType()==\PHPExcel_Cell_DataType::TYPE_NUMERIC){
					$cellstyleformat=$cell->getParent()->getStyle( $cell->getCoordinate() )->getNumberFormat();
					$formatcode=$cellstyleformat->getFormatCode();
					if (preg_match('/^([$[A-Z]*-[0-9A-F]*])*[hmsdy]/i', $formatcode)) {
						$value=gmdate("Y-m-d", \PHPExcel_Shared_Date::ExcelToPHP($value));
					}else{
						$value=\PHPExcel_Style_NumberFormat::toFormattedString($value,$formatcode);
					}
				}
				if($isMergeCell[$col.$currentRow]&&$isMergeCell[$afCol.$currentRow]&&!empty($value)){
					$temp = $value;
				}elseif($isMergeCell[$col.$currentRow]&&$isMergeCell[$col.($currentRow-1)]&&empty($value)){
					$value=$arr[$currentRow-1][$currentColumn];
				}elseif($isMergeCell[$col.$currentRow]&&$isMergeCell[$bfCol.$currentRow]&&empty($value)){
					$value=$temp;
				}
				$row[$currentColumn] = $value;
				}
				$arr[$currentRow] = $row;
			}
			$array[$i]["Content"] = $arr;
			$i++;
		}
		// spl_autoload_register(array('Think','autoload'));//must, resolve ThinkPHP and PHPExcel conflicts
		unset($objWorksheet);
		unset($PHPReader);
		unset($PHPExcel);
		unlink($file);

		return array("error"=>1,"data"=>$array);
	}

	private function deldir($path){  
	    //给定的目录不是一个文件夹  
	    if(!is_dir($path)) 
	        return null;  
	    $fh = opendir($path);  
	    while(($row = readdir($fh)) !== false){  
	        //过滤掉虚拟目录  
	        if($row == '.' || $row == '..'){  
	            continue;  
	        }  
	        if(!is_dir($path.'/'.$row)){  
	            unlink($path.'/'.$row);  
	        }  
	        $this->deldir($path.'/'.$row);      
	    }  
	    //关闭目录句柄，否则出Permission denied  
	    closedir($fh);  
	    //删除文件之后再删除自身  
	    rmdir($path) ;  
	}

}