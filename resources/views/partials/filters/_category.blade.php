<div>
    <h4>Categorieën</h4>
    <ul>
        @foreach($categories as $category)
                <li>
                    <a
                        @if (isset($_GET['published']) || isset($_GET['sort']))
                                href="{{isset($_GET['category'])
                                ? str_replace($_GET['category'], $category->id, \Request::getRequestUri())
                                : \Request::getRequestUri() . "&category=$category->id" }}">
                        @else
                            href="{{ \Illuminate\Support\Facades\URL::current() . "?category=$category->id" }}">
                        @endif
                        {{ $category->name }}
                    </a>
                </li>
        @endforeach
    </ul>
</div>


