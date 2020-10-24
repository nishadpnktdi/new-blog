<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id', $categoryItems, null, ['class' => 'form-control select-category']) !!}
</div>

<!-- Tag Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tags', 'Tags:') !!}
    {!! Form::select('tags[]', $tagItems, null, ['class' => 'form-control select-tags-basic-multiple', 'multiple' => 'multiple']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6 hide">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id', $userItems, null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Images Field -->
<div class="form-group col-sm-12">
    <div class="inline-block">
    @if(isset($images))
        @foreach($images as $image)
            <img src='{{$image->getUrl()}}' class="img-rounded" width="200" />
        @endforeach
    @endif
    </div>
    {!! Form::label('images', 'Images:') !!}
    <input type="file" class="featured" name="images[]" value="{{ old('image') }}" multiple/>
    <sub>*First selected image will be the featured image.</sub>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('posts.index') }}" class="btn btn-default">Cancel</a>
</div>
