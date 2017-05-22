<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">

    <title>用户留言首页</title>

    <meta name="viewport"  content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="css/index.css">

    <link rel="stylesheet" href="css/header.css">

    <script src="js/jquery.min.js"></script>

</head>

<body>

<header>

    <nav class="header">

        <h1><a href="./">{{ \Illuminate\Support\Facades\Config::get('webconfig.WEB_NAME')}}</a></h1>

        <br/><br/>

        @if ( isset($name) )

           <span  class="log"  >欢迎您 {{ $name }}</span> <a href="logout.html" class="log" >退出</a>

        @else

            <a class="log"  href="reg.html">注册</a>

            <a class="log"  href="login.html" >登录</a>

        @endif

    </nav>

</header>

<h2> {{ \Illuminate\Support\Facades\Config::get('webconfig.PUBLIC') }}</h2>



<article>



    @foreach($ly as $ly_v)

         <section>

             <img src="{{ file_exists( 'image/users/'.$ly_v -> user.'.jpg')? 'image/users/'.$ly_v -> user.'.jpg' : 'image/users/default.jpg'}}" alt="头像">

             <div class="content">

            <?php

               $a = preg_replace( '/\[(.+)\]/' , '<img src="face/\1.gif"/>',$ly_v -> content);

                     echo $a;

            ?>

            </div>

            <div class="contetnt_footer">

                楼层 : {{$ly_v -> id}} 层 &nbsp;&nbsp;&nbsp;&nbsp; 用户ID : {{ $ly_v -> user }}

            </div>



            <div class="mob_footer">

                {{$ly_v -> id}}  #

            </div>

        </section>

    @endforeach

</article>



{{-- 用户评论模板 --}}

@if( isset ($name))



<div id="Demo" style="text-align:center;">

    <div class="Main">

        <div class="Input_Box">

            <textarea maxlength="20"  class="Input_text"></textarea>

            <div class="faceDiv"> </div>

            <div class="Input_Foot">

                <a class="imgBtn" href="javascript:void(0);"></a>

                <span style="color:red;line-height:35px;">内容不能为空</span>

                <a class="postBtn">确定</a> </div>

        </div>

    </div>

</div>



@else

<h2>登录以后才能留言</h2>

@endif

<!-- #respond -->



{{-- 页脚信息 --}}

<footer>
Homework_Redrock

</footer>

<script src="js/pl.js"></script>

</body>

</html>