@extends('layouts.layouts')
@section('title')
    Permission
@endsection
@section('content')
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">News list</div>

        <div class="row">

            <div class="col-lg-6">
                <div class="input-group">
                    <select class="form-control" id='c_id'>
                        <option value="">--请选择--</option>
                        
                        @foreach($cart_info as $v)
                            <option value="{{ $v['c_id'] }}">{{ $v['c_name'] }}</option>
                        @endforeach
                    </select>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <div class="input-group">
                  <input type="text" class="form-control" id="title" placeholder="The title search...">
                  <span class="input-group-btn">
                        <button class="btn btn-default" id="search" type="button"> Search </button>
                  </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->

        <div id="show">
            <!-- Table -->
            <table class="table">
                <tr>
                    <td>news ID</td>
                    <td width="100">news names</td>
                    <td width="150">news desc</td>
                    <td>news cart</td>
                    <td>admin</td>
                    <td>operation</td>
                </tr>
                @foreach($data as $v)
                    <tr>
                        <td>{{ $v['n_id'] }}</td>
                        <td>{{ $v['n_name'] }}</td>
                        <td>{{ $v['n_desc'] }}</td>
                        <td>{{ $v['c_name'] }}</td>
                        <td>{{ $v['a_name'] }}</td>
                        <td>
                            <a href="javascript:;" class="del" n_id="{{ $v['n_id'] }}">delete</a>
                            <a href="javascript:;" class="update" n_id="{{ $v['n_id'] }}">update</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $data->links() }}
        </div>
    </div>
    <script>
        $(function () {
            $(document).on("click",".del",function () {
                var id=$(this).attr("n_id");
                $.ajax({
                    method:"POST",
                    url:"/admin/navigation/delete",
                    data:{id:id},
                    dataType: "json",
                    success:function (res) {
                        if (res==1){
                            location.href="/admin/news/show";
                        }else{
                            alert(res);
                        }
                    }
                })
            })

            $(document).on("click",".update",function () {
                var id=$(this).attr("n_id");
                location.href="/admin/news/edit?id="+id;
            })



            $(document).on("click","#search",function () {
                var data={};
                data.title=$("#title").val();
                data.c_id=$("#c_id").val();
                $.ajax({
                    method:"POST",
                    url:"/admin/news/search",
                    data:data,
                    success:function (res) {
                        $("#show").empty();
                        $("#show").html(res);
                    }
                })
            })
        })
    </script>
@endsection
