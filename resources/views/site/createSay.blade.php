@extends('common.layout')

@section('siteleft')
@include('auth.errors')
	<form class="layui-form layui-form-pane">
    {!! csrf_field() !!}
    <input type="hidden" name="hidden" value="{{ url('say/store') }}">
  	<div class="layui-form-item layui-form-text">
    <label class="layui-form-label">说说内容:</label>
    	<div class="layui-input-block">
			@if(!isset($say))
      			<textarea name="content" id="say" placeholder="请输入内容" class="layui-textarea">{{ old('content') }}</textarea>
			@else
				<textarea name="content" id="say" class="layui-textarea">{{ $say->content }}</textarea>
			@endif
    	</div>
  	</div>
  	<div class="layui-form-item">
    	<div class="layui-input-block">
      		<button class="btn btn-primary" lay-submit lay-filter="addSay">保存</button>
      		<button type="reset" class="btn btn-primary">重置</button>
          <a href="#" onclick="history.back(-1)" class="btn btn-primary">返回</a>
    	</div>
  	</div>
	</form>
@endsection