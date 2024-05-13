<form action="{{ url()->full() }}" method="get" class="d-flex align-items-center">
    <label for="per_page">Show:&nbsp; </label>
    <select class="form-select" id="per_page" name="per_page" onchange="this.form.submit()">
        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
        <option value="250" {{ $perPage == 250 ? 'selected' : '' }}>250</option>
        <option value="500" {{ $perPage == 500 ? 'selected' : '' }}>500</option>
        <option value="1000" {{ $perPage == 1000 ? 'selected' : '' }}>1000</option>
    </select>
    <input type="hidden" name="sort_order" value="{{ request()->input('sort_order') }}" />
    <input type="hidden" name="sort_field" value="{{ request()->input('sort_field') }}" />
    <input type="hidden" name="keyword" value="{{ request()->input('keyword') }}" />
</form>
