<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Log;

class ProcessController extends Controller{

	public function index(){
		return view('Process.index');
	}

	public function checkNumber(Request $request){
		$number = '';
		if($request->ajax()){
			$data = $request->get('data');
			$arr_data = str_split($data, 1);
			$checkLength = strlen($data) % 2;
			//Mang chua cac so
			$arr_unique= array();
			foreach(array_unique($arr_data) as $tmp){
				array_push($arr_unique, $tmp);
			}
			//Kiem tra truong hop so cac so cua chuoi la so chan hoac le
			switch ($checkLength) {
				case 0:
					//Dem so lan xuat hien cua cac phan tu trong mang
					$arr_count = array_count_values($arr_data);
					//get half number
					$number = $this->__processNumber($arr_count, $arr_unique);
					if(!$number) return response()->json(false);
					$number .= strrev($number);
					return response()->json($number);
					break;
				default:
					//So xuat hien le lan trong mang (999222 check_number = 2)
					$check_number = 0;
					//So lan xuat hien cua so (999 -> $mid_number = 3)
					$mid_number;
					//Gia tri cua $mid_number (999 -> $value_mid_number = 9)
					$value_mid_number;
					$arr_count = array_count_values($arr_data);

					foreach ($arr_count as $key => &$val){
						if(($val % 2) != 0){
							$check_number = $check_number + 1;
							$mid_number = $val;
							$value_mid_number = $key;
						}
					}
					if($check_number > 1) return response()->json(false);

					if($mid_number == 1){
						unset($arr_count[$value_mid_number]);
						$number = $this->__processNumber($arr_count, $arr_unique);
						$strrev_number = strrev($number);
						$number .= $value_mid_number;
						$number .= $strrev_number;
						return response()->json($number);
					}

					$arr_count[$value_mid_number] = $mid_number - 1;
					$number = $this->__processNumber($arr_count, $arr_unique);
					$strrev_number = strrev($number);
					$number .= $value_mid_number;
					$number .= $strrev_number;
					return response()->json($number);
					break;
			}
		}
	}

	/*
	* @Params $arr_count: mang chua so lan xuat hien cua cac phan tu
	* @Params $arr_unique: mang chua cac phan tu khong trung nhau
	* @Return string
	*
	*/

	private function __processNumber($arr_count, $arr_unique){
		$result= array();
		$number = '';
		foreach ($arr_count as &$val){
			//for only case = 0
			if(($val % 2) != 0){
				return false;
			}
			$val = $val/2;
		}

		//Sap xep cac phan tu trong mang tu lon nhat den be nhat
		for($i = 0; $i < (count($arr_unique) - 1); $i++){
			for($j = $i +1; $j < count($arr_unique); $j++){
				if($arr_unique[$i] < $arr_unique[$j]){
					$tmp = $arr_unique[$i];
					$arr_unique[$i] = $arr_unique[$j];
					$arr_unique[$j] = $tmp;
				}
			}
		}
		//mang moi voi gia tri key & value
		foreach($arr_count as $key => $obj){
			$tmp = array();
			array_push($tmp, $key);
			array_push($tmp, $obj);
			array_push($result, $tmp);
		}

		//Lay ra nua chuoi so
		foreach($arr_unique as $arr_unique){
			foreach($result as $k => $v){
				if($arr_unique == $v[0]){
					for($m = 0; $m < (int)$v[1]; $m++){
						$number .= $v[0];
					}
				}
			}
		}

		return $number;
	}
}

?>