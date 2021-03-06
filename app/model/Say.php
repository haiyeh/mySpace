<?php

namespace App\model;

use App\model\Say;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Say extends Model
{
    public static function getAllSay()
    {
    	$say = Say::orderby('published_at', 'desc')->paginate(6);
    	return $say;
    }

    public static function getAdminSay()
    {
        return Say::orderby('id')->paginate(3);
    }

    public static function getSayCount()
    {
    	$count = Say::count();
    	return $count;
    }

    public static function addSay($content)
    {
    	$say = new Say;
    	$say->content = $content;
    	$say->published_at = time();
    	$res = $say->save();
    	if ($res) {
    		return true;
    	}else{
    		return false;
    	}
    }

    public static function getOneSay($id)
    {
        return Say::where('id', $id)->first();
    }

    public static function sayDelete($id)
    {
        return Say::destroy($id);
    }
}
