@php
    $footerContact = \App\Models\ContactInfo::where('is_active', true)->first();
@endphp
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>The Psycho Math</h3>
                    <p>
                        @if($footerContact)
                            @if(!empty($footerContact->location))
                                <strong>Address:</strong> {{ $footerContact->location }}<br>
                            @endif
                            @if(!empty($footerContact->office_address))
                                <strong>Office Address:</strong> {{ $footerContact->office_address }}<br>
                            @endif
                            @if(!empty($footerContact->phone))
                                <strong>Phone:</strong> <a href="tel:{{ preg_replace('/\s+/', '', $footerContact->phone) }}">{{ $footerContact->phone }}</a><br>
                            @endif
                            @if(!empty($footerContact->email))
                                <strong>Email:</strong> <a href="mailto:{{ $footerContact->email }}">{{ $footerContact->email }}</a><br>
                            @endif
                            @if(empty($footerContact->location) && empty($footerContact->office_address) && empty($footerContact->phone) && empty($footerContact->email))
                                <span class="text-muted">Contact information not set.</span>
                            @endif
                        @else
                            <span class="text-muted">Contact information not set.</span>
                        @endif
                    </p>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}#hero">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}#about">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}#why-choose-us">Why Choose Us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('test-pages.index') }}">All Test</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}#team">Team</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}#contact">Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-links">
                    <h4>Our Test</h4>
                    <ul>
                        @php
                            try {
                                $allTestPages = \App\Models\TestPage::where('is_active', true)->orderBy('order')->limit(6)->get();
                            } catch (\Exception $e) {
                                $allTestPages = collect([]);
                            }
                        @endphp
                        @if($allTestPages->count() > 0)
                            @foreach($allTestPages as $testPage)
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('test-pages.show', $testPage->slug) }}">{{ $testPage->title }}</a></li>
                            @endforeach
                            @if(\App\Models\TestPage::where('is_active', true)->count() > 6)
                                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('test-pages.index') }}"><strong>View All Tests</strong></a></li>
                            @endif
                        @else
                            {{-- Fallback links if no test pages exist yet --}}
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('test-pages.show', 'aptitude-mappers') }}">Aptitude Mappers</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('test-pages.show', 'achievement-mappers') }}">Achievement Mappers</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('test-pages.show', 'attitude-mappers') }}">Attitude Mappers</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('test-pages.show', 'aspiration-mappers') }}">Aspiration Mappers</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('test-pages.show', 'aggression-mappers') }}">Aggression Mappers</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('test-pages.index') }}"><strong>View All Tests</strong></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">
        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>The Psycho Math</span></strong>. All Rights Reserved
            </div>
        </div>
    </div>
</footer>

