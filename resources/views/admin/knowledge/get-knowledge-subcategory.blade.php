@foreach($subcategories as $subcategory)
    <option value="{{$subcategory->id}}" >{{__($subcategory->name)}}</option>
    {{--<option value="{{$subcategory->id}}" {{ $knowledge?(($knowledge->sub_categories_id==$subcategory->id)?'selected':''):''}}>{{__($subcategory->name)}}</option>--}}
@endforeach