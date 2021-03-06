<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Message extends Model
{
    public static function storeMsg($user_id, $leave_at, $content)
    {
        $msg = new Message();
        $msg->user_id = $user_id;
        $msg->leave_at = $leave_at;
        $msg->content = $content;
        return $msg->save();
    }

    public static function getAllMsg()
    {
        $user_id = session('user_id');
//        $message = Message::select('id','content','leave_at','leave_id','user_id')->where('user_id', $user_id)->paginate(10);
        $message = DB::table('usermsgs')
            ->join('messages', 'messages.user_id', '=', 'usermsgs.user_id')
            ->join('heads', 'heads.id', '=', 'usermsgs.head_id')
            ->select('messages.id', 'heads.headpath', 'usermsgs.username', 'messages.content', 'messages.leave_at')
            ->orderby('leave_at', 'desc')
            ->paginate(10);

        return $message;
    }

    public static function getAllMessage()
    {
        return Message::select('id', 'content', 'leave_at')->paginate(6);
    }

    public static function getMessageCount()
    {
        return Message::count();
    }

    public static function messageDel($id)
    {
        return Message::destroy($id);
    }

}
