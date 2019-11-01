<div>
    <label for="sort">Sort By</label>
    <select class="form-control" name="sort" id="sort">
        <option value="" disabled {{ (!isset($_GET['published']) && (!isset($_GET['sort']))) ? 'selected' : '' }}>Select Sort Option</option>
        <option value="{{ \Illuminate\Support\Facades\URL::current() . "?published=desc" }}" {{ (isset($_GET['published']) && ($_GET['published'] === 'desc')) ? 'selected' : '' }}>Published new - old</option>
        <option value="{{ \Illuminate\Support\Facades\URL::current() . "?published=asc" }}" {{ (isset($_GET['published']) && ($_GET['published'] === 'asc')) ? 'selected' : '' }}>Published old - new</option>
        <option value="{{ \Illuminate\Support\Facades\URL::current() . "?sort=asc" }}" {{ (isset($_GET['sort']) && ($_GET['sort'] === 'asc')) ? 'selected' : '' }}>Title a - z</option>
        <option value="{{ \Illuminate\Support\Facades\URL::current() . "?sort=desc" }}" {{ (isset($_GET['sort']) && ($_GET['sort'] === 'desc')) ? 'selected' : '' }}>Title z - a</option>
    </select>
</div>
