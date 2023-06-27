@extends('layouts.dashboard')
@section('styles')

@endsection
@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 pb-5" style="border:1px solid black">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">ایجاد مقاله</h1>
        </div>
        <div class="row">
            <div class="col-md-12 p-3 " style="background-color: white">
                <table id="example" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>عنوان</th>
                        <th>نویسنده</th>
                        <th>وضعیت</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td><a href="{{url('/admin/articles/'.$article->slug)}}">{{$article->title}}</a></td>
                            <td>{{$article->author}}</td>
                            <td>
                                @if($article->status == 1)
                                    <a href="{{url('/admin/articles/'.$article->slug.'/activation')}}">فعال</a>
                                @elseif($article->status == 0)
                                    <a href="{{url('/admin/articles/'.$article->slug.'/activation')}}">غیر فعال</a>
                                @endif
                            </td>
                            <td><a href="{{url('/admin/articles/'.$article->slug.'/edit')}}"><img
                                        src="{{url('image/edit_FILL0_wght400_GRAD0_opsz48.png')}}" width="25"
                                        height="25"></a></td>
                            <td><a href="{{url('/admin/articles/'.$article->slug.'/delete')}}"><img
                                        src="{{url('image/delete_FILL0_wght400_GRAD0_opsz48.png')}}" width="25"
                                        height="25"></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </main>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').DataTable({
                "language": {
                    "processing": "{{ trans('general.processing') }}",
                    "search": "{{ trans('general.search') }}: ",
                    "lengthMenu": "{{ trans('general.lengthMenu', [ 'menu' => '_MENU_']) }}",
                    "info": "{{ trans('general.info', [ 'start' => '_START_', 'end' => '_END_', 'total' => '_TOTAL_']) }}",
                    "infoEmpty": "{{ trans('general.infoEmpty') }}",
                    "infoFiltered": "{{ trans('general.infoFiltered', [ 'max' => '_MAX_']) }}",
                    "infoPostFix": "",
                    "loadingRecords": "{{ trans('general.loadingRecords') }}",
                    "zeroRecords": "{{ trans('general.zeroRecords') }}",
                    "emptyTable": "{{ trans('general.emptyTable') }}",
                    "paginate": {
                        "first": "{{ trans('general.first') }}",
                        "last": "{{ trans('general.last') }}",
                        "next": "{{ trans('general.next') }}",
                        "previous": "{{ trans('general.previous') }}",
                    },

                }
            })
        })
    </script>
@endsection
