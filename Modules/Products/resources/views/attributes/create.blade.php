
<form action="{{ route('attributes.store') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <label for="code"><strong>{{ __('Attribute Code') }}:<span class="text-danger">&nbsp;*</span></strong></label>
            <div class="input-group input-group-md mb-3 d-">
                <input type="text" name="code" id="code" value="{{ old('code') }}" class="form-control rounded">
            </div>
        </div>
        <div class="col-md-6">
            <label for="name"><strong>{{ __('Attribute Name') }}:<span class="text-danger">&nbsp;*</span></strong></label>
            <div class="input-group input-group-md mb-3 d-">
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control rounded">
            </div>
        </div>
        <div class="col-md-3">
            <label for="searchable"><strong>{{ __('Searchable ?') }}<span class="text-danger">&nbsp;*</span></strong></label>
            <div class="select-search-group input-group input-group-md mb-3 d-">
                <select name="searchable" id="searchable" class="form-control rounded select2" required>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <label for="description"><strong>{{ __('Attribute Description') }}:</strong></label>
            <div class="input-group input-group-md mb-3 d-">
                <input type="text" name="description" id="description" value="{{ old('description') }}" class="form-control rounded">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-success btn-md"><i class="la la-save"></i>&nbsp;Save Attribute</button>
        </div>
    </div>
</form>
