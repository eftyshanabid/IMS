
<form action="{{ route('attributes.update', $attribute->id) }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-3">
            <label for="code"><strong>{{ __('Attribute Code') }}:<span class="text-danger">&nbsp;*</span></strong></label>
            <div class="input-group input-group-md mb-3 d-">
                <input type="text" name="code" id="code" value="{{ old('code', $attribute->code) }}" class="form-control rounded">
            </div>
        </div>
        <div class="col-md-6">
            <label for="name"><strong>{{ __('Attribute Name') }}:<span class="text-danger">&nbsp;*</span></strong></label>
            <div class="input-group input-group-md mb-3 d-">
                <input type="text" name="name" id="name" value="{{ old('name', $attribute->name) }}" class="form-control rounded">
            </div>
        </div>
        <div class="col-md-3">
            <label for="searchable"><strong>{{ __('Searchable ?') }}<span class="text-danger">&nbsp;*</span></strong></label>
            <div class="select-search-group input-group input-group-md mb-3 d-">
                <select name="searchable" id="searchable" class="form-control rounded select2" required>
                    <option value="yes" {{ $attribute->searchable == "yes" ? 'selected' : '' }}>Yes</option>
                    <option value="no" {{ $attribute->searchable == "no" ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <label for="description"><strong>{{ __('Attribute Description') }}:</strong></label>
            <div class="input-group input-group-md mb-3 d-">
                <input type="text" name="description" id="description" value="{{ old('description', $attribute->description) }}" class="form-control rounded">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-success btn-md"><i class="la la-save"></i>&nbsp;Update Attribute</button>
        </div>
    </div>
