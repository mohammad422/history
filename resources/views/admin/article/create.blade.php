@extends('layouts.dashboard')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 pb-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">ایجاد مقاله</h1>
        </div>
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            @endif
        </div>
        <div class="p-5" style="">
                <form action="{{url('/admin/articles/store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">عنوان</label>
                    <input type="text" name="title" value="{{old('title')? old('title') : (isset($article->title) ? $article->title : '') }}"
                           class="form-control" id="title" placeholder="عنوان">
                </div>
                <div class="form-group">
                    <label for="short_description">شرح کوتاه</label>
                    <input type="text" name="short_description"
                           value="{{old('short_description') ? old('short_description') : (isset($article->short_description) ? $article->short_description : '')}} " class="form-control"
                           id="short_description" placeholder="شرح کوتاه">
                </div>
                <div class="form-group">
                    <label for="author">نویسنده</label>
                    <input type="text" name="author" value="{{old('author') ? old('author') : (isset($article->author) ? $article->author : '')}} "
                           class="form-control" id="author" placeholder="نویسنده">
                </div>
                <div class="form-group">
                    <label for="textarea">متن مقاله</label>
                    <textarea name="body" id="textarea" class="form-control">
                        {{old('body') ? old('body') : (isset($article->body) ? $article->body : '')}}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="source">منبع</label>
                    <input type="text" name="source" value="{{old('source') ? old('source') : (isset($article->source) ? $article->source : '')}}"
                           class="form-control" id="source">
                </div>
                <div class="form-group">
                    <label for="image">تصویر</label>
                    <input type="file" name="image" class="form-control-file" id="image">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">انتخاب گروه</label>
                    <select name="category_id" class="form-control" id="exampleFormControlSelect1">
                        @if($categories !== null)
                            <option >انتخاب کنید</option>
                                @foreach($categories as $cat)
                                <option @if(old('category_id') !== null && old('category_id') == $cat->id)  selected
                                        @elseif(isset($category) && $category->id === $cat->id) selected @endif
                                        value="{{$cat->id}}">{{$cat->category_name}}</option>ve
                                @endforeach
                        @else
                            <option >انتخاب کنید</option>
                        @endif
                    </select>
                </div>
                    <div class="form-group">
                        <label >کلید واژه ها</label>
                        <input type="text" name="tags"
                               class="form-control visually-hidden" data-role="tagsinput"  />
                    </div>
                <button type="submit" class="btn btn-primary px-5">ثبت</button>
            </form>
        </div>

    </main>
@endsection

@section('scripts')
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
    <script  src="{{asset('js/tagsinput.js')}}"></script>
    <script type="text/javascript">
       tinymce.init({
           selector: 'textarea',
           directionality: "rtl",
           language: 'fa_IR',
           font_size_classes: "fontSize1, fontSize2, fontSize3, fontSize4, fontSize5, fontSize6",//i used this line for font sizes
           plugins: 'image code advlist autolink lists link charmap print preview anchor'+
           'searchreplace visualblocks code fullscreen textcolor'+
           'insertdatetime media table paste emoticons directionality',
           toolbar: 'localautosave forecolor backcolor | styleselect fontsizeselect bold italic underline removeformat |' +
               ' ltr rtl alignleft aligncenter alignright alignjustify | bullist numlist outdent indent link unlink image media quickupload |' +
               ' code fullscreen visualblocks emoticons | |undo redo | ',

           paste_as_text: true,
           paste_data_images: true,
           paste_enable_default_filters: true,

           /* without images_upload_url set, Upload tab won't show up*/
           images_upload_url: 'postAcceptor.php',

           /* we override default upload handler to simulate successful upload*/
           images_upload_handler: function (blobInfo, success, failure) {
               setTimeout(function () {
                   /* no matter what you upload, we will turn it into TinyMCE logo :)*/
                   success('http://moxiecode.cachefly.net/tinymce/v9/images/logo.png');
               }, 2000);
           },
           content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
       });
    </script>

@endsection
