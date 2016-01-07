<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;


	/**
	 * 参数，时间
	 * return 与现在时间相差
	 */
	public function t_time($t)
	{
		$time = strtotime($t);
		$n_time = time() - $time;
		if ($n_time < 60) {
		  return '刚刚';
		 } else if ($n_time < 120) {
		  return '一分钟前';
		 } else if ($n_time < (45 * 60)) {
		  return floor($n_time / 60) . ' 分钟前';
		 } else if ($n_time < (90 * 60)) {
		  return '一个小时前';
		 } else if ($n_time < (24 * 60 * 60)) {
		  return '约 ' . floor($n_time / 3600) . ' 小时前';
		 } else if ($n_time < (48 * 60 * 60)) {
		  return '1 天前';
		 } else {
		  return floor($n_time / 86400) . ' 天前';
		 }
	}
}
