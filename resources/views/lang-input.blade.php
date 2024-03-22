@if(isset(languages()[0]))
@foreach(languages() as $language)
    <div class="col-md-{{ isset($col) ? $col : '12' }}">
        @if(isset($textarea) && $textarea)
            <div class="form-group mt-2">
                <label for="{{ $name }}-{{ $language->id }}" class="col-form-label"><strong>{{ translate($text) }} ({{ translate($language->name) }}) {!! isset($required) && $required ? '<span class="text-danger">*</span>' : '' !!}</strong></label>
                <textarea id="{{ $name }}-{{ $language->id }}" class="form-control summernote" {!! isset($required) && $required ? 'required' : '' !!} placeholder="{{ translate($text) }}" name="{{ $name }}" cols="50" rows="10" spellcheck="true">{{ languageValue($input, $language->code) }}</textarea>
            </div>
        @else
            @if(isset($inline) && $inline)
                <div class="form-group row mt-2">
                    <label for="{{ $name }}-{{ $language->id }}" class="col-3 col-form-label text-right"><strong>{{ translate($text) }} ({{ translate($language->name) }}) {!! isset($required) && $required ? '<span class="text-danger">*</span>' : '' !!}</strong></label>
                    <div class="col-6">
                        <input placeholder="{{ translate($text) }} ({{ translate($language->name) }})" class="form-control mt-1 {{ isset($classes) ? $classes : '' }}" {!! isset($required) && $required ? 'required' : '' !!} id="{{ $name }}-{{ $language->id }}" name="{{ $name }}[{{ $language->code }}]" type="text" value="{{ languageValue($input, $language->code) }}">

                        @if ($errors->has($name.'.'.$language->code))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first($name.'.'.$language->code) }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            @else
                <div class="form-group mt-2">
                    <label for="{{ $name }}-{{ $language->id }}"><strong>{{ translate($text) }} ({{ translate($language->name) }}) {!! isset($required) && $required ? '<span class="text-danger">*</span>' : '' !!}</strong></label>
                    <input placeholder="{{ translate($text) }} ({{ translate($language->name) }})" class="form-control mt-1 {{ isset($classes) ? $classes : '' }}" {!! isset($required) && $required ? 'required' : '' !!} id="{{ $name }}-{{ $language->id }}" name="{{ $name }}[{{ $language->code }}]" type="text" value="{{ languageValue($input, $language->code) }}">

                    @if ($errors->has($name.'.'.$language->code))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first($name.'.'.$language->code) }}</strong>
                        </span>
                    @endif
                </div>
            @endif
        @endif
    </div>
@endforeach
@endif