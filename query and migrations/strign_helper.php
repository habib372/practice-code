use Illuminate\Support\Str;


Str::random(10),

{!! strip_tags(Illuminate\Support\Str::limit($singleNews->excerpt, 200)) !!}