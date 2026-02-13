@php
    $hasChildren = $item->children && $item->children->count() > 0;
    $isDropdown = $item->type === 'dropdown' || $hasChildren;
    
    // Special handling for Careers dropdown - load careers dynamically
    $isCareers = strtolower($item->title) === 'career library' || strtolower($item->title) === 'careers';
    if ($isCareers && $isDropdown) {
        try {
            $allCareers = \App\Models\Career::where('is_active', true)->orderBy('order')->get();
        } catch (\Exception $e) {
            $allCareers = collect([]);
        }
    }

    // Special handling for All Test dropdown - load test pages dynamically
    $isAllTest = strtolower($item->title) === 'all test' || strtolower($item->title) === 'all tests' || strtolower($item->title) === 'tests';
    if ($isAllTest && $isDropdown) {
        try {
            $allTestPages = \App\Models\TestPage::where('is_active', true)->orderBy('order')->get();
        } catch (\Exception $e) {
            $allTestPages = collect([]);
        }
    }
    
    // Determine if this menu item is active
    $isActive = false;
    if ($item->link) {
        if ($item->type === 'scroll' && strpos($item->link, '#') === 0) {
            $isActive = request()->is('/') && request()->get('section') === substr($item->link, 1);
        } elseif (strpos($item->link, '/') === 0) {
            $isActive = request()->is(ltrim($item->link, '/')) || request()->is(ltrim($item->link, '/') . '/*');
        }
    }
    
    // Build the href
    $href = '#';
    if ($item->type === 'scroll' && $item->link) {
        $href = strpos($item->link, '#') === 0 ? route('home') . $item->link : $item->link;
    } elseif ($item->type === 'link' && $item->link) {
        $href = strpos($item->link, '/') === 0 ? $item->link : (strpos($item->link, 'http') === 0 ? $item->link : '/' . $item->link);
    } elseif ($isDropdown) {
        $href = '#';
    }
    
    $linkClass = $item->type === 'scroll' ? 'nav-link scrollto' : 'nav-link';
    if ($isActive) {
        $linkClass .= ' active';
    }
@endphp

<li class="{{ $isDropdown ? 'dropdown' : '' }}">
    <a href="{{ $href }}" class="{{ $linkClass }}" @if($isDropdown) aria-haspopup="true" aria-expanded="false" @endif>
        @if($item->icon)
            <i class="{{ $item->icon }}"></i>
        @endif
        <span>{{ $item->title }}</span>
        @if($isDropdown)
            <i class="bi bi-chevron-down"></i>
        @endif
    </a>
    
    @if($isDropdown)
        <ul>
            @if($isAllTest && isset($allTestPages))
                {{-- Dynamic All Test dropdown --}}
                @foreach($allTestPages as $testPage)
                    <li><a href="{{ route('test-pages.show', $testPage->slug) }}">{{ $testPage->title }}</a></li>
                @endforeach
                <li><a href="{{ route('test-pages.index') }}"><strong>View All Tests</strong></a></li>
            @elseif($isCareers && isset($allCareers) && $allCareers->count() > 0)
                {{-- Dynamic Careers dropdown --}}
                @foreach($allCareers as $career)
                    <li><a href="{{ route('careers.show', $career->slug) }}">{{ $career->title }}</a></li>
                @endforeach
                <li><a href="{{ route('careers.index') }}"><strong>View All Careers</strong></a></li>
            @elseif($isCareers && isset($allCareers))
                <li><a href="{{ route('careers.index') }}">Careers</a></li>
            @elseif($hasChildren)
                {{-- Regular menu item children --}}
                @foreach($item->children as $child)
                    @include('partials.menu-item', ['item' => $child])
                @endforeach
            @endif
        </ul>
    @endif
</li>
