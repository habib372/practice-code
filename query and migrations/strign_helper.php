use Illuminate\Support\Str;


Str::random(10),

<!-- limit -->
{!! strip_tags(Illuminate\Support\Str::limit($singleNews->excerpt, 200)) !!}

<!-- no limit -->
{!!$singleNews->excerpt!!}