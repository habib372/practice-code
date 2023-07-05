<a href="{{app()->getLocale() == 'en' ? route('lang.switch',['bn']) : route('lang.switch',['en'])}}">{{ __('Language') }} ({{app()->getLocale() == 'bn' ? 'English' : 'বাংলা'}})</a>

{{app()->getLocale() == 'en' ?  : }}