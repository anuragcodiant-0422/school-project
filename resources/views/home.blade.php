@extends('layouts.app')

@section('content')
<section class="hero">
    <div class="container-site hero-grid">
        <div class="hero-copy">
            <p class="kicker">Welcome to Noida</p>
            <h1>A little world of <em>big beginnings</em></h1>
            <p>Children learn by doing, wondering and belonging. At Manthan, every classroom is a studio, a garden and a place to be known.</p>
            <div class="hero-actions">
                <a class="btn-main" href="#enquire">Book a campus visit</a>
                <a class="btn-ghost" href="#programmes">Explore programmes</a>
            </div>
        </div>
        <div class="hero-photo">
            <span class="blob blob-pink"></span>
            <span class="blob blob-sky"></span>
            <img src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?auto=format&fit=crop&w=1400&q=80" alt="Young children playing with colourful toys">
            <div class="float-chip left">Playgroup to Class 5</div>
            <div class="float-chip right">Noida campus</div>
        </div>
    </div>
</section>

<section class="section section-pink" id="programmes">
    <div class="container-site center">
        <p class="kicker white">The right beginning for every stage</p>
        <h2 class="section-title">A childhood filled with wonder, discovery and possibility</h2>
        <div class="stage-grid">
            @foreach ([
                ['Playgroup', '18 months+', 'https://images.unsplash.com/photo-1587654780291-39c9404d746b?auto=format&fit=crop&w=700&q=80'],
                ['Nursery', 'Age 3', 'https://images.unsplash.com/photo-1544776193-352d25ca82cd?auto=format&fit=crop&w=700&q=80'],
                ['LKG', 'Age 4', 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=700&q=80'],
                ['UKG', 'Age 5', 'https://images.unsplash.com/photo-1606092195730-5d7b9af1efc5?auto=format&fit=crop&w=700&q=80'],
                ['Primary', 'Class 1–5', 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?auto=format&fit=crop&w=700&q=80'],
            ] as $stage)
                <article class="photo-card">
                    <img src="{{ $stage[2] }}" alt="{{ $stage[0] }} learners">
                    <div class="body">
                        <h4>{{ $stage[0] }}</h4>
                        <p>{{ $stage[1] }} · Small groups, rich play and language.</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section" id="about">
    <div class="container-site why-wrap">
        <div>
            <p class="kicker">Why the Manthan School</p>
            <h2 class="section-title">Experiential learning for holistic growth</h2>
            <p>We design days that balance movement, making, stories and quiet. Children practise independence without losing the comfort of a close community.</p>
            <ul>
                <li>Inquiry-led classrooms instead of rote drills</li>
                <li>Specialist time for music, art, sport and kitchen garden</li>
                <li>Pastoral care that knows every child by name</li>
            </ul>
            <a class="btn-main mt-3" href="#enquire">Talk to admissions</a>
        </div>
        <div class="why-art">
            <img src="https://images.unsplash.com/photo-1596464716127-f2a82984de30?auto=format&fit=crop&w=1200&q=80" alt="Children collaborating on a classroom project">
        </div>
    </div>
</section>

<section class="section section-navy">
    <div class="container-site">
        <p class="kicker white">A day at Manthan</p>
        <h2 class="section-title">Learning that feels like a good day</h2>
        <div class="day-grid mt-4">
            <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=1200&q=80" alt="Bright school corridor and classrooms">
            <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&w=800&q=80" alt="Teacher reading with children">
            <img src="https://images.unsplash.com/photo-1472162072942-cd5147eb3902?auto=format&fit=crop&w=800&q=80" alt="Outdoor play on campus">
        </div>
    </div>
</section>

<section class="section section-soft">
    <div class="container-site center">
        <p class="kicker">Signature programmes</p>
        <h2 class="section-title">More than a timetable</h2>
        <div class="program-grid">
            @foreach ([
                ['Atelier studio', 'Clay, light, collage and recycled materials every week.', 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=800&q=80'],
                ['Kitchen garden', 'Sow, harvest and cook seasonal food from our beds.', 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?auto=format&fit=crop&w=800&q=80'],
                ['Movement', 'Yoga, play and athletics designed for growing bodies.', 'https://images.unsplash.com/photo-1471295253337-3ceaaedca402?auto=format&fit=crop&w=800&q=80'],
                ['Story workshop', 'Reading, drama and writing in two languages.', 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=800&q=80'],
            ] as $item)
                <article class="photo-card">
                    <img src="{{ $item[2] }}" alt="{{ $item[0] }}">
                    <div class="body">
                        <h4>{{ $item[0] }}</h4>
                        <p>{{ $item[1] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section section-navy">
    <div class="container-site">
        <p class="kicker white">Care first</p>
        <h2 class="section-title">How we keep your child safe</h2>
        <div class="safety-grid">
            <div class="safety-item"><div class="icon">1</div><h4>Secure entry</h4><p>Badge access, visitor logs and a named adult at every handover.</p></div>
            <div class="safety-item"><div class="icon">2</div><h4>Health desk</h4><p>On-campus nurse, allergy plans and first-aid trained staff.</p></div>
            <div class="safety-item"><div class="icon">3</div><h4>Safe ratios</h4><p>Small groups so teachers can see, hear and respond quickly.</p></div>
            <div class="safety-item"><div class="icon">4</div><h4>Transport checks</h4><p>GPS buses, attendants and two-step parent confirmation.</p></div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container-site">
        <p class="kicker">Spaces</p>
        <h2 class="section-title">The rooms your child will be in</h2>
        <div class="rooms-grid mt-4">
            <img src="https://images.unsplash.com/photo-1588075592446-265fd1e6e76f?auto=format&fit=crop&w=1200&q=80" alt="Activity classroom with natural light">
            <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=800&q=80" alt="Library corner">
            <img src="https://images.unsplash.com/photo-1560785477-d43d2b34e0df?auto=format&fit=crop&w=800&q=80" alt="Art studio table">
        </div>
    </div>
</section>

<section class="section section-soft">
    <div class="container-site vision">
        <img src="https://images.unsplash.com/photo-1595113316349-9fa4eb24f884?auto=format&fit=crop&w=1000&q=80" alt="Educator with children in a bright classroom">
        <div>
            <p class="kicker">The vision</p>
            <h2 class="section-title">Behind the Manthan experience</h2>
            <p>We believe childhood is not a race. Our educators plan provocations, document learning and partner with families so each child grows in confidence, language and kindness.</p>
            <div class="cta-band mt-4">
                <div>
                    <strong>Bring your child into the Manthan world.</strong>
                    <div>Tours run Tuesday to Saturday by appointment.</div>
                </div>
                <a class="btn-main" href="#enquire">Reserve a slot</a>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container-site center">
        <p class="kicker">What parents say</p>
        <h2 class="section-title">Voices from our community</h2>
        <div class="quotes">
            @foreach ([
                ['https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=200&q=80', 'Ananya M.', 'Nursery parent', 'Drop-off feels calm. My daughter comes home talking about worms, colours and her friends by name.'],
                ['https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80', 'Rohit S.', 'Class 2 parent', 'Teachers share learning stories, not just marks. We finally understand how our son thinks.'],
                ['https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?auto=format&fit=crop&w=200&q=80', 'Neha K.', 'LKG parent', 'The campus is beautiful, but the real difference is how gently they settle new children.'],
            ] as $quote)
                <article class="quote">
                    <img src="{{ $quote[0] }}" alt="{{ $quote[1] }}">
                    <p>“{{ $quote[3] }}”</p>
                    <strong>{{ $quote[1] }}</strong>
                    <div>{{ $quote[2] }}</div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section section-pink" id="diary">
    <div class="container-site center">
        <p class="kicker white">Stay close</p>
        <h2 class="section-title">The Event Diary</h2>
        <p>Latest news, events and achievements from campus.</p>
        <div class="card-grid">
            @forelse ($latestItems as $item)
                <a class="photo-card" href="{{ route('news-events.show', $item->slug) }}">
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}">
                    <div class="body">
                        <div class="event-meta">{{ $item->category }} · {{ $item->item_date->format('d M Y') }}</div>
                        <h4>{{ $item->title }}</h4>
                        <p>{{ $item->short_description }}</p>
                    </div>
                </a>
            @empty
                <p>News will appear here once published from the admin panel.</p>
            @endforelse
        </div>
        <a class="btn-yellow mt-4" href="{{ route('news-events.index') }}">View all</a>
    </div>
</section>

<section class="section" id="enquire">
    <div class="container-site split-2">
        <div>
            <p class="kicker">Questions parents ask</p>
            <h2 class="section-title">Let’s make the first visit easy</h2>
            @foreach ([
                ['What age groups do you admit?', 'Playgroup (18 months+) through Class 5. Mid-year seats depend on group size.'],
                ['How do campus tours work?', 'Share your details in the form. Admissions will confirm a weekday slot by phone or email.'],
                ['Is the enquiry form the application?', 'It is the first step. After the visit we share the application pack and fee sheet.'],
            ] as $faq)
                <div class="faq-item">
                    <button type="button" class="faq-toggle">{{ $faq[0] }}</button>
                    <div class="faq-body">{{ $faq[1] }}</div>
                </div>
            @endforeach
        </div>
        <div class="enquiry-card">
            <h3>Book a campus visit</h3>
            <p>Tell us about your child. We reply within one working day.</p>
            <div class="form-success" id="enquirySuccess"></div>
            <form id="enquiryForm">
                <div class="form-grid">
                    <div>
                        <input name="parent_name" placeholder="Parent name *" required>
                        <div class="field-error" data-error="parent_name"></div>
                    </div>
                    <div>
                        <input name="student_name" placeholder="Student name *" required>
                        <div class="field-error" data-error="student_name"></div>
                    </div>
                    <div>
                        <select name="class_applying_for" required>
                            <option value="">Class applying for *</option>
                            @foreach (config('school.classes') as $class)
                                <option value="{{ $class }}">{{ $class }}</option>
                            @endforeach
                        </select>
                        <div class="field-error" data-error="class_applying_for"></div>
                    </div>
                    <div>
                        <input name="mobile" placeholder="Mobile *" maxlength="10" required>
                        <div class="field-error" data-error="mobile"></div>
                    </div>
                    <div class="full">
                        <input name="email" type="email" placeholder="Email (optional)">
                        <div class="field-error" data-error="email"></div>
                    </div>
                    <div class="full">
                        <textarea name="message" rows="3" placeholder="Message (optional)"></textarea>
                        <div class="field-error" data-error="message"></div>
                    </div>
                </div>
                <button class="btn-main mt-3 w-100" type="submit" id="enquirySubmit">Send enquiry</button>
            </form>
        </div>
    </div>
</section>

<section class="section section-soft" id="campus">
    <div class="container-site">
        <p class="kicker">Come and see the campus</p>
        <h2 class="section-title">Noida, designed for young learners</h2>
        <div class="campus mt-4">
            <img src="https://images.unsplash.com/photo-1594608661623-aa0bd3a69d98?auto=format&fit=crop&w=1200&q=80" alt="School campus exterior">
            <iframe title="Campus map" src="https://maps.google.com/maps?q=Noida%20Sector%20128&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
        </div>
    </div>
</section>
@endsection
