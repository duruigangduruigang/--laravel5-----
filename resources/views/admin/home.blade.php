<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Weike Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Dustin Curtis."/>
<link href="{{ asset('/Index/css/pure-0.5.0-min.css') }}" rel="stylesheet">
<!--   <link href="http://dustincurtis.com/stylesheets/normalize.css" media="all" rel="stylesheet" />
  <link href="http://dustincurtis.com/stylesheets/master.css" media="all" rel="stylesheet" />
<link rel="stylesheet" href="http://daneden.github.io/animate.css/animate.min.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script> -->
  <link href="{{ asset('/Admins/normalize.css') }}" media="all" rel="stylesheet" />
  <link href="{{ asset('/Admins/master.css') }}" media="all" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('/Admins/animate.min.css') }}">
<script type="text/javascript" src="{{ asset('/Admins/jquery-2.1.4.min.js') }}"></script>


<link rel="stylesheet" href="{{ asset('/Admins/category/sample.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('/Admins/category/dd.css') }}" />
<script src="{{ asset('/Admins/category/jquery.dd.js') }}"></script>
</head>
<body>
<style type="text/css">
  #hello,#feedback,#users,#messages,#logout,#category{
    height:400px;
    width:800px;
    /*border:1px dotted green;*/
    padding: 30px;
    display: none;
    margin: auto;
    margin-top: 100px;
  }

  #show_hello,#show_feedback,#show_users,#show_messages,#show_logout,#show_category{
    cursor:pointer;
  }
  .zoomIn
  {
    position: absolute;
    left: 25%;
  }
</style>
    <style scoped>

        .button-success,
        .button-error,
        .button-warning,
        .button-secondary {
            color: white;
            border-radius: 4px;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
        }

        .button-success {
            background: rgb(28, 184, 65); /* this is a green */
        }

        .button-error {
            background: rgb(202, 60, 60); /* this is a maroon */
        }

        .button-warning {
            background: rgb(223, 117, 20); /* this is an orange */
        }

        .button-secondary {
            background: rgb(66, 184, 221); /* this is a light blue */
        }
.button-xsmall {
            font-size: 70%;
        }

        .button-small {
            font-size: 85%;
        }

        .button-large {
            font-size: 110%;
        }

        .button-xlarge {
            font-size: 125%;
        }
tr:hover #tr_id{
  background: #F7F7F7;
}
#tp{
      display: block;
    float: left;
    margin-top: 5px;
    margin-right: 4px;
    height: 12px;
    width: 12px;
    opacity: 0.8;
    border-radius: 6px;
}
    </style>
<script type="text/javascript">
$(document).ready(function() {
// 使用 jQuery异步提交表单
  $('#myForm').submit(function() {
      jQuery.ajax({
        url:"{{ URL('admin/update_admin' )}}",
        data:$('#myForm').serialize(),
        type:"POST",
        beforeSend:function()
        {  
            $('#tip').addClass(' ');
            $('#submitButton').hide();
            $('#loading').show();
        },
        success:function()
        {
            $('#submitButton').show();
            $('#loading').hide();
            $('#tip').addClass('lightSpeedIn animated');
            $('#tip').show();
            $('#tip').addClass('lightSpeedOut animated');
        }
      });
    return false;
  });
});
function  aa (obj){
  $(".zoomIn").hide();
  if(obj == 'hello'){hello();}
  if(obj == 'feedback'){feedback();}
  if(obj == 'users'){users();}
  if(obj == 'messages'){messages();}
  if(obj == 'category'){category();}
  if(obj == 'logout'){logout();}
  // $("#"+obj).show();
};

var category = function(){
  //获取分类信息
  $("#category_data").empty();
  $.ajax({ url: "{{URL('admin/category')}}", type:"GET",context: document.body, success: function(data){
    // alert(data);return;
    to_category(data);
  }});
}



function to_category(data)
{
      var html;
      for(var i = 0; i<data.length;i++){
        html += '<tr class="fadeInRight animated ttr" id="cate_update';
        html += data[i].id;
        html += '">';
        html += '<td>';
        html += data[i].id;
        html += '</td>';
        html += '<td>';
        html += '<span style="background: rgb(';
        html += data[i].color;
        html += ');" id="tp"></span>';
        html += data[i].name;
        html += '</div>';
        html += '</td>';
        html += '<td>';
        html += data[i].messages_num;
        html += '<input type="hidden" id="messages_num';
        html +=  data[i].id;
        html += '" value="';
        html += data[i].messages_num;
        html += '">';
        html += '</td>';
        html += '<td><button onclick="category_edit(\'';
        html += data[i].id;
        html += '\')"  class="button-xsmall button-warning pure-button">编辑</button>';
        html += '</td>';
        html += '</tr>';
      }
        html += '<tr class="fadeInRight animated ttr">';
        html += '<td>';
        html += '</td>';
        html += '<td>';
        html += '<input id="add_name" style="width:90px;padding-left:5px;border-radius:3px;border:1px solid #CCC;" type="text" placeholder="Name">';
        html += '</td>';

        html += '<td>';
        html += '<select style="width:50px" id="add_color" class="tech" name="color" onchange="showValue(this)">';
        html += '<option value="81,187,232" data-image="{{asset('/Admins/category/blue.png')}}"></option>';
        html += '<option value="97,196,111" data-image="{{asset('/Admins/category/green.png')}}"></option>';
        html += '<option value="249,169,74" data-image="{{asset('/Admins/category/orange.png')}}"></option>';
        html += '<option value="132,87,166" data-image="{{asset('/Admins/category/purple.png')}}"></option>';
        html += '<option value="65,185,177" data-image="{{asset('/Admins/category/powderblue.png')}}"></option>';
        html += '</select>';
        html += '</td>';

        html += '<td>';
        html += '<button onclick="category_add()" class="button-xsmall button-success pure-button">新增</button>';
        html += '</td>';
        html += '</tr>';
      $("#category_data").append(html);
      //更改样式
      $("select").msDropdown({roundedBorder:false});
      $("#category").show();
}
function category_edit(id)
{
  var messages_num = $("#messages_num"+id).val();
  $.ajax({ url: "{{URL('admin/category_edit')}}/"+id, type:"GET",context: document.body, success: function(data){
      // alert(id);return;
      $("#cate_update"+id).empty();
      var html;
      html += '<td>';
      html += data.id;
      html += '</td>';
      html += '<input type="hidden" id="messages_num';
      html +=  id;
      html += '" value="';
      html += messages_num
      html += '">';
      html += '<td>';
      html += '<input class="bounceIn animated" id="category_update_name';
      html += data.id;
      html += '" style="width:90px;padding-left:5px;border-radius:3px;border:1px solid #CCC;" type="text" placeholder="';
      html += data.name;
      html += '">';
      html += '</td>';



      // html += '<td>';
      // html += '<input class="bounceIn animated" id="category_update_color';
      // html += data.id;
      // html += '" style="width:90px;padding-left:5px;border-radius:3px;border:1px solid #CCC;" type="text" placeholder="';
      // html += data.color;
      // html += '">';
      // html += '</td>';
      html += '<td>';
      html += '<select style="width:50px" id="category_update_color';
      html += data.id;
      html += '" class="tech" name="color" onchange="showValue(this)"';
      // html += data.id
      // html += '" name="color">';
      html += '>';
      // html += '<option value="color1"><span id="tt" style="background: rgb(202, 60, 60);">紫色</span></option>';
      html += '<option value="81,187,232" data-image="{{asset('/Admins/category/blue.png')}}"></option>';
      html += '<option value="97,196,111" data-image="{{asset('/Admins/category/green.png')}}"></option>';
      html += '<option value="249,169,74" data-image="{{asset('/Admins/category/orange.png')}}"></option>';
      html += '<option value="132,87,166" data-image="{{asset('/Admins/category/purple.png')}}"></option>';
      html += '<option value="65,185,177" data-image="{{asset('/Admins/category/powderblue.png')}}"></option>';
      html += '</select>';
      html += '</td>';

      html += '<td>';
      html += '<button onclick="category_update_all(';
      html += data.id;
      html += ')" class="button-xsmall button-success pure-button">修改</button>';
      html += '</td>';
      $("#cate_update"+id).append(html);
      //更改样式
      $("select").msDropdown({roundedBorder:false});
  }});
}


function category_update_all(id)
{
  //获取要修改的信息
  var name = $('#category_update_name'+id).val();
  var color = $('#category_update_color'+id).val();
  var messages_num = $('#messages_num'+id).val();
   $.ajax({
     type: "GET",
     url: "{{URL('admin/category_update')}}",
     data: {id:id,name:name, color:color},
     dataType: "json",
     success: function(data){
      if(data){
        //更新成功数据
        var html;
        html += '<td>';
        html += id;
        html += '</td>';

        html += '<input type="hidden" id="messages_num';
        html +=  id;
        html += '" value="';
        html += messages_num
        html += '">';

        html += '<td>';
        html += '<span style="background: rgb(';
        html += color;
        html += ');" class="bounceIn animated" id="tp"></span>';
        html += name;
        html += '</div>';
        html += '</td>';
        html += '<td class="bounceIn animated">';
        html += messages_num;
        html += '</td>';
        html += '<td><button onclick="category_edit(\'';
        html += id;
        html += '\')"  class="button-xsmall button-warning pure-button">编辑</button>';
        html += '</td>';
        $("#cate_update"+id).empty();
        $("#cate_update"+id).append(html);
      }
    }
  });
}
function category_add()
{
  var name = $('#add_name').val();
  var color = $('#add_color').val();
  // 异步
  $.ajax({ url: "{{URL('admin/category_add')}}/"+name+"/"+color, type:"GET",context: document.body, success: function(data){
    category();
  }});
}








//获取管理信息
var hello = function(){
  // get email
  $.ajax({ url: "{{URL('admin/admin_info')}}", type:"GET",context: document.body, success: function(data){
   $('#user').val(data);
   $("#hello").show();
  }});
}
// -----------------------------------------获取用户反馈----------------------------------------------------
var feedback = function(){
  $("#feedback_data").empty();
  $.ajax({ url: "{{URL('admin/feedback')}}", type:"GET",dataType:'json',context: document.body, 
    success: function(data){
      to_feedback(data);
    }
  });
}

function to_feedback(data)
{

      var html;

      for(var i = 0; i<data.data.length;i++){
        html += '<tr class="fadeInRight animated ttr" ';
        // html += 'onclick="feedback_info(';
        // html += data.data[i].id;
        // html += ')"';
        html += '>';
        html += '<td title="';
        html += data.data[i].feed;
        html += '">';
        html += data.data[i].feed.substring(0,20);
        html += '...';
        html += '</td>';
        html += '<td>';
        html += data.data[i].created_at.substring(0,10).replace(/-/,".").replace(/-/,".");
        html += '</td>';
        html += '</tr>';
      }
      html += '<tr style="display:none;">';
      html += '<td>';
      html += '<input id="feed_next_page" value="';
      html += data.next_page_url;
      html += '">';
      html += '</td>';
      html += '<td>';
      html += '<input id="feed_prev_page" value="';
      html += data.prev_page_url;
      html += '">';
      html += '</td>';
      html += '</tr>';
      $("#feedback_data").append(html);
      $("#feedback").show();
}
function feedback_info(id)
{
  $.ajax({ url: "{{URL('admin/feedback_info')}}/"+id, type:"GET",dataType:'json',context: document.body, 
    success: function(data){
      alert(data);
    }
  });
}
function feedback_page(obj)
{
  // 获取#obj中的内容
  var u = $('#'+obj).val();

  if(u == 'null')
  {
    // alert('没有了');return;
    return;
  }
  // 删除旧的
  $("#feedback_data").empty();

  //异步新的
  // u = http://localhost:8000/admin/feedback/?page=2
    $.ajax({ url: u, type:"GET",dataType:'json',context: document.body, 
    success: function(data){
      to_feedback(data);
    }
  });
}
// --------------------------------------END---获取用户反馈----------------------------------------------------

// -----------------------------------------用户管理----------------------------------------------------

var users = function(){
  $("#users_data").empty();
  $.ajax({ url: "{{URL('admin/users')}}", type:"GET",dataType:'json',context: document.body, 
    success: function(data){
      to_users(data);
    }
  });
}
function to_users(data)
{
      var html;
      for(var i = 0; i<data.data.length;i++){
        html += '<tr class="fadeInRight animated" >';
        html += '<td id="tr_id">';
        html += data.data[i].id;
        html += '</td>';
        html += '<td>';
        html += data.data[i].email;
        html += '</td>';
        html += '<td>';
        html += '<a';
        html += ' target="_blank';
        html += '" href="';
        html += data.data[i].homepage;
        html += '">';
        html += data.data[i].name;
        html += '</a>';
        html += '</td>';
        html += '<td>';
        html += data.data[i].last_time;
        html += '</td>';
        html += '</tr>';
      }
      html += '<tr style="display:none;">';
      html += '<td>';
      html += '<input id="users_next_page" value="';
      html += data.next_page_url;
      html += '">';
      html += '</td>';
      html += '<td>';
      html += '<input id="users_prev_page" value="';
      html += data.prev_page_url;
      html += '">';
      html += '</td>';
      html += '</tr>';

      $("#users_data").append(html);
      $("#users").show();
}

function users_page(obj)
{
  // 获取#obj中的内容
  var u = $('#'+obj).val();
  // alert(u);return;
  if(u == 'null')
  {
    // alert('没有了');return;
    return;
  }
  // 删除旧的
  $("#users_data").empty();

  //异步新的
  // u = http://localhost:8000/admin/feedback/?page=2
    $.ajax({ url: u, type:"GET",dataType:'json',context: document.body, 
    success: function(data){
      to_users(data);
    }
  });
}
// -------------------------------------END--获取用户管理-----------------------------------------------

// ---------------------------------------帖子管理-----------------------------------------------

var messages = function(){
  $("#messages_data").empty();
  $.ajax({ url: "{{URL('admin/messages')}}", type:"GET",dataType:'json',context: document.body, 
    success: function(data){
      to_messages(data);
    }
  });
}
function to_messages(data)
{
      var html;
      for(var i = 0; i<data.data.length;i++){
        html += '<tr class="fadeInRight animated" id="';
        html += data.data[i].id;
        html += '">';
        html += '<td id="tr_id">';
        html += data.data[i].id;
        html += '</td>';
        html += '<td title="'
        html += data.data[i].title;
        html += '"><a target="_blank" href="';
        html += data.data[i].homepage;
        html += '">'
        html += data.data[i].title.substring(0,13);
        html += '...';
        html += '</a>';
        html += '</td>';
        html += '<td>';
        html += '<span style="background: rgb(';
        html += data.data[i].Categorys_color;
        html += ');" id="tp"></span>';
        html += data.data[i].Category;
        html += '</div>';
        html += '</td>';
        html += '<td>';
        html += '<a';
        html += ' target="_blank';
        html += '" href="';
        html += data.data[i].userhomepage;
        html += '">';
        html += data.data[i].name;
        html += '</a>';
        html += '</td>';
        html += '<td>';
        html += data.data[i].last_time;
        html += '</td>';
        html += '<td title="其评论也将一并删除">';
        html += '<button onclick="del_message(\'';
        html += data.data[i].id;
        html += '\')" class="button-xsmall button-warning pure-button">删除</button>';
        html += '</td>';
        html += '</tr>';
      }
      html += '<tr style="display:none;">';
      html += '<td>';
      html += '<input id="messages_next_page" value="';
      html += data.next_page_url;
      html += '">';
      html += '</td>';
      html += '<td>';
      html += '<input id="messages_prev_page" value="';
      html += data.prev_page_url;
      html += '">';
      html += '</td>';
      html += '</tr>';

      $("#messages_data").append(html);
      $("#messages").show();
}
function del_message(obj)
{
  //删除消息与其评论
  $.ajax({ url: "{{URL('/admin/del_message')}}/"+obj, type:"GET",dataType:'json',context: document.body, 
    success: function(data){
      $("#"+data).addClass('fadeOutRight animated');
    }
  });
}
function messages_page(obj)
{
  // 获取#obj中的内容
  var u = $('#'+obj).val();
  // alert(u);return;
  if(u == 'null')
  {
    // alert('没有了');return;
    return;
  }
  // 删除旧的
  $("#messages_data").empty();

  //异步新的
  // u = http://localhost:8000/admin/feedback/?page=2
    $.ajax({ url: u, type:"GET",dataType:'json',context: document.body, 
    success: function(data){
      to_messages(data);
    }
  });
}
// -----------------------------------END----帖子管理-----------------------------------------------
</script>

<style type="text/css">
  #tt{
    border: 1px solid red;
    height: 100px;
    width: 100px;
  }
</style>

  <section id="card">
    <h1><span onclick="aa('hello')" id="show_hello" href="javascript:void(0);">Hello</span></h1>
    <!-- <h2>.</h2> -->
    <ul id="contact">
      <li><span onclick="aa('feedback')" id="show_feedback" href="javascript:void(0);">Feedback</span></li>
      <li><span onclick="aa('users')" id="show_users" href="javascript:void(0);">Users</span></li>
      <li><span onclick="aa('messages')" id="show_messages" href="javascript:void(0);">Messages</span></li>
      <li><span onclick="aa('category')" id="show_category" href="javascript:void(0);">Category</span></li>
      <li><a id="show_logout" href="{{ URL('admin/logout') }}">Logout</a></li>
    </ul>
  </section>

<!-- *************************************             管理信息            ************************************************** -->
  <div id="hello" class="zoomIn animated">
    <form id="myForm" action="{{ URL('admin/update_admin') }}" method="post" name="myForm" class="pure-form pure-form-stacked">
      <fieldset>
        <legend class="slideInLeft animated">管理信息</legend>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="pure-control-group">
          <input type="text" id="user" required="required" placeholder=" User" name="name" value="">
        </div>
        <div class="pure-control-group">
          <input type="text" required="required" placeholder=" Pass" name="pass" value="default">
        </div>
        <input type="submit" id="submitButton" name="sub" value="Update" class="pure-button pure-button-default">
        <img id="loading" style="display:none;" src="{{asset('/img/1.gif')}}">
        <span id="tip" style="display:none;">更新成功</span>
      <fieldset>
    </form>
  </div>
<!-- *************************************           END  管理信息            *********************************************** -->

<!-- *************************************           用户反馈            **************************************************** -->
  <div id="feedback" class="zoomIn animated" style="height:500px;">
    <table class="pure-table pure-table-bordered">
        <h2 class="content-subhead slideInLeft animated" id="default-table">用户反馈</h2>
        <thead>
            <tr>
                <th>Text</th>
                <th>Year</th>
            </tr>
        </thead>

        <tbody id="feedback_data">

        </tbody>
    </table>


<style type="text/css">
  
  #feedback_prev_page,#feedback_next_page{
    float: left;
    margin-top: 20px;
    cursor:pointer;
    margin-right: 10px;
  }
</style>
<div onclick="feedback_page('feed_prev_page')" id="feedback_prev_page" class="button-xsmall button-success pure-button zoomInRight animated">上一页</div>
<div onclick="feedback_page('feed_next_page')" id="feedback_next_page" class="button-xsmall button-success pure-button zoomInRight animated">下一页</div>


</div>
<!-- *************************************        END   用户反馈            ************************************************ -->


<!-- *************************************             用户管理             ************************************************ -->
  <div id="users" class="zoomIn animated">
    <table class="pure-table pure-table-bordered">
        <h2 class="content-subhead slideInLeft animated" id="default-table">用户管理</h2>
        <thead>
            <tr>
                <th>#</th>
                <th>登陆账号</th>
                <th>昵称</th>
                <th>最后一次活动</th>
            </tr>
        </thead>

        <tbody id="users_data">

        </tbody>
    </table>

<div onclick="users_page('users_prev_page')" id="feedback_prev_page" class="button-xsmall button-success pure-button zoomInRight animated">上一页</div>
<div onclick="users_page('users_next_page')" id="feedback_next_page" class="button-xsmall button-success pure-button zoomInRight animated">下一页</div>

  </div>
<!-- *************************************        END     用户管理             ************************************************ -->


 <!-- *************************************        帖子管理             ************************************************ -->
  <div id="messages" class="zoomIn animated">
    <table class="pure-table pure-table-bordered">
        <h2 class="content-subhead slideInLeft animated" id="default-table">帖子管理</h2>
        <thead>
            <tr>
                <th>#</th>
                <th>标题</th>
                <th>分类</th>
                <th>作者</th>
                <th>时间</th>
                <th>操作</th>
            </tr>
        </thead>

        <tbody id="messages_data">

        </tbody>
    </table>

    <div onclick="messages_page('messages_prev_page')" id="feedback_prev_page" class="button-xsmall button-success pure-button zoomInRight animated">上一页</div>
    <div onclick="messages_page('messages_next_page')" id="feedback_next_page" class="button-xsmall button-success pure-button zoomInRight animated">下一页</div>
  </div>
<!-- *************************************     END   帖子管理             ************************************************ -->
 <!-- *************************************        分类管理             ************************************************ -->
  <div id="category" class="zoomIn animated">
    <table class="pure-table pure-table-bordered">
        <h2 class="content-subhead slideInLeft animated" id="default-table">分类管理</h2>
        <thead>
            <tr>
                <th>#</th>
                <th>分类</th>
                <th>消息</th>
                <th>操作</th>
            </tr>
        </thead>

        <tbody id="category_data">

        </tbody>
    </table>

    <!-- <div onclick="category_update('category_update')" id="feedback_prev_page" class="button-xsmall button-success pure-button zoomInRight animated">更新</div> -->
  </div>
<!-- ****************************************** END **** 分类管理 ************************************************************* -->
</body>
</html>