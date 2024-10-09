<!---->
$allData = Medicine::skip(1)->take(PHP_INT_MAX)->get(); <!--Skip the first record and get the collection-->
$allData = Medicine::all()->slice(1);<!-- Skip the first record in the collection-->
$allData = Medicine::all()->slice(1,10);<!-- take 1 to 10 record in the collection and skip all others-->