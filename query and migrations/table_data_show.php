	@foreach($products as $product)
	<tr>
	    <td>{{$i++}}</td>
	    <td>{{$product->connect_category->category_name??'Null'}}</td>
	    <td>{{$product->product_name??'Null'}}</td>
	    <td>{{$product->price??'Null'}}&#2547;</td>
	    <td><img src="{{asset('uploads/product')}}/{{$product->image}}" alt="" width="80px;"></td>
    </tr>