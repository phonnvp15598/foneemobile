@extends('admin_layout')
@section('admin_header')
    <h1>
        Bài viết
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.blank') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.blog.index') }}">Bài viết</a></li>
        <li class="active">Index</li>
    </ol>
@endsection
@section('admin_content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <a href="{{ route('admin.blog.add') }}" class="btn btn-warning">
                    <i class="fa fa-plus"></i> Thêm bài viết
                </a>
                <div class="box-header">
                    <h3 class="box-title">Danh sách bài viết</h3>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th><input type="checkbox" name="" id="select_all"></th>
                                    <th>Tên bài viết</th>
                                    <th>Ảnh</th>
                                    <th>Tác giả</th>
                                    <th>Ngày viết</th>
                                    <th>Nổi bật</th>
                                    <th>Thao tác</th>
                                </tr>
                                @foreach ($all_blog as $key => $blog)
                                    <tr>
                                        <td><input type="checkbox" class="checkbox" name="ids[]"
                                                value="{{ $blog->blog_id }}"></td>
                                        <td>{{ $blog->blog_title }}</td>
                                        <td><img src="{{ asset('/public/uploads/product/' . $blog->blog_thumb) }}" alt=""
                                                style="width: 50px"></td>
                                        <td>{{ $blog->users->name }}</td>
                                        <td>{{ $blog->created_at }}</td>
                                        <td>
                                            <?php
                                if($blog->blog_status == 1){ ?>
                                            <a style="color: red"
                                                href="{{ route('admin.blog.active', ['blog_id' => $blog->blog_id]) }}"><i
                                                    class="fa fa-thumbs-down"></i></a>
                                            <?php
                                }else { ?>
                                            <a href="{{ route('admin.blog.unactive', ['blog_id' => $blog->blog_id]) }}"><i
                                                    class="fa fa-thumbs-up"></i></a>
                                            <?php
                                }
                               
                          ?>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.blog.edit', ['blog_id' => $blog->blog_id]) }}"
                                                class="btn btn-success"><i class="fa fa-pencil"></i></a>
                                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa {{ $blog->blog_title }} không?')"
                                                href="{{ route('admin.blog.delete', ['blog_id' => $blog->blog_id]) }}"
                                                class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                {{ $all_blog->appends(Request::all())->links() }}
                            </ul>
                        </div>
                    </div>
                    </form>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    @endsection
    {{-- <script>
  $("#deleteSelected").click(function(e){
            e.preventDefault();
            var allids = [];
            $("input:checkbox[name=ids]:checked").each(function(){
               allids.push($(this).val());
            });
            $.ajax({
              url : "{{route('delete.selected')}}",
              type: 'DELETE',
              data : {
                ids : allids,
                _token : $("input[name=_token]").val()
              },
              success:function(response){
                $.each(allids, function(key, val)){
                  $('#pid'+val).remove();
                }
              }

            });
        });
</script> --}}
