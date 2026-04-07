<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BrewLog — Home Coffee Brewing Journal for Hobbyists</title>
    <meta name="description" content="BrewLog is a home coffee brewing journal for hobbyists. Log beans, brew recipes, ratings and taste notes for V60, Aeropress, espresso and more.">
    <link rel="canonical" href="https://brewlog.app/">

    <meta property="og:title" content="BrewLog — Home Coffee Brewing Journal for Hobbyists">
    <meta property="og:description" content="Log beans, brew recipes, ratings and taste notes. BrewLog helps home baristas learn what they actually like in the cup.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://brewlog.app/">
    <meta property="og:image" content="https://brewlog.app/og-image.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="BrewLog — Home Coffee Brewing Journal for Hobbyists">
    <meta name="twitter:description" content="Log beans, brew recipes, ratings and taste notes. BrewLog helps home baristas learn what they actually like in the cup.">
    <meta name="twitter:image" content="https://brewlog.app/og-image.png">

    @verbatim
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "Organization",
          "name": "BrewLog",
          "url": "https://brewlog.app/",
          "logo": "https://brewlog.app/logo.svg",
          "description": "BrewLog is a home coffee brewing journal that helps hobbyists log beans, brew recipes, and taste notes to learn what they like."
        },
        {
          "@type": "SoftwareApplication",
          "name": "BrewLog",
          "applicationCategory": "LifestyleApplication",
          "operatingSystem": "Web",
          "url": "https://brewlog.app/",
          "description": "BrewLog is a home coffee brewing journal for hobbyists. Track beans, dose, yield, time, ratio, ratings and taste notes across V60, Aeropress, espresso, French Press and Chemex.",
          "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "USD"
          },
          "featureList": [
            "Log beans with roaster, origin and roast level",
            "Record brew recipes with dose, yield, time and ratio",
            "Rate every cup 1 to 5 with taste notes",
            "Supports V60, Aeropress, Espresso, French Press and Chemex",
            "Timeline view to spot patterns across brews"
          ]
        },
        {
          "@type": "FAQPage",
          "mainEntity": [
            {
              "@type": "Question",
              "name": "What is a good brew ratio for V60?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "A 1:16 dose-to-water ratio is the standard starting point for Hario V60 pour-over. BrewLog calculates the ratio live as you log dose and yield so you can dial in from there."
              }
            },
            {
              "@type": "Question",
              "name": "How do I track my coffee brewing?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "With BrewLog you log the bean, then record each brew's method, dose, yield, time and grind. BrewLog calculates the ratio, stores your 1-to-5 rating and taste notes, and shows the history so you can spot patterns."
              }
            },
            {
              "@type": "Question",
              "name": "Is BrewLog free?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes — log as many beans and brews as you like."
              }
            },
            {
              "@type": "Question",
              "name": "Does BrewLog work for espresso and pour-over?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Both. V60, Aeropress, Espresso, French Press, and Chemex are first-class brew methods in BrewLog."
              }
            },
            {
              "@type": "Question",
              "name": "Is my BrewLog data private?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Your journal is yours. Only you can see your beans and brews."
              }
            },
            {
              "@type": "Question",
              "name": "Do I need an account?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Only to save brews. The marketing page is open to all."
              }
            }
          ]
        }
      ]
    }
    </script>
    @endverbatim

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|fraunces:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-cream-50 text-espresso-700 selection:bg-caramel-300 selection:text-espresso-900">

<div class="relative overflow-x-clip">
<main>

    {{-- Floating glass nav --}}
    <header class="fixed top-4 inset-x-0 z-50 px-4">
        <nav class="max-w-6xl mx-auto flex items-center justify-between rounded-2xl px-5 py-3 bg-cream-50/60 backdrop-blur-xl border border-cream-200/70 shadow-[0_8px_32px_-12px_rgba(74,49,32,0.25)]">
            <a href="/" class="flex items-center gap-2 group">
                <span class="w-9 h-9 rounded-full bg-gradient-to-br from-espresso-400 to-espresso-700 grid place-items-center text-cream-100 font-serif text-lg shadow-inner transition-transform duration-500 group-hover:rotate-12">B</span>
                <span class="font-serif text-xl text-espresso-700 tracking-tight">BrewLog</span>
            </a>
            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-espresso-500">
                <a href="#features" class="relative hover:text-espresso-700 transition-colors after:absolute after:left-0 after:-bottom-1 after:h-px after:w-0 after:bg-caramel-500 hover:after:w-full after:transition-all">Features</a>
                <a href="#how" class="relative hover:text-espresso-700 transition-colors after:absolute after:left-0 after:-bottom-1 after:h-px after:w-0 after:bg-caramel-500 hover:after:w-full after:transition-all">How it works</a>
                <a href="#faq" class="relative hover:text-espresso-700 transition-colors after:absolute after:left-0 after:-bottom-1 after:h-px after:w-0 after:bg-caramel-500 hover:after:w-full after:transition-all">FAQ</a>
            </div>
            <div class="flex items-center gap-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium rounded-xl bg-espresso-600 text-cream-50 hover:bg-espresso-700 active:scale-95 transition-all">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:inline px-3 py-2 text-sm font-medium text-espresso-600 hover:text-espresso-800 transition-colors">Sign in</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium rounded-xl bg-espresso-600 text-cream-50 hover:bg-espresso-700 hover:shadow-lg hover:shadow-espresso-500/30 active:scale-95 transition-all">Get started</a>
                @endauth
            </div>
        </nav>
    </header>

    {{-- HERO --}}
    <section class="relative min-h-screen flex items-center pt-32 pb-24 px-6">
        <div data-parallax="0.25" class="pointer-events-none absolute -top-20 -left-32 w-[520px] h-[520px] rounded-full bg-caramel-300/30 blur-3xl"></div>
        <div data-parallax="0.45" class="pointer-events-none absolute top-40 -right-24 w-[420px] h-[420px] rounded-full bg-espresso-300/30 blur-3xl"></div>
        <div class="absolute inset-0 bg-noise opacity-[0.35] mix-blend-multiply pointer-events-none"></div>

        <div class="relative max-w-6xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <span data-reveal style="opacity:0" class="inline-flex items-center gap-2 px-3 py-1 text-xs font-medium tracking-wide uppercase rounded-full bg-cream-100 border border-cream-200 text-espresso-500">
                    <span class="w-1.5 h-1.5 rounded-full bg-caramel-500 animate-pulse"></span> A journal for home baristas
                </span>
                <h1 data-reveal style="opacity:0" class="mt-6 font-serif text-5xl sm:text-6xl lg:text-7xl leading-[1.05] text-espresso-700 tracking-tight">
                    Every pour,<br>
                    <span class="italic text-espresso-500">remembered.</span>
                </h1>
                <p data-reveal style="opacity:0" class="mt-6 max-w-lg text-lg text-espresso-500 leading-relaxed">
                    BrewLog is a home coffee brewing journal that helps hobbyists log beans, brew recipes, and taste notes to learn what they like. Track every pour, dial in your grind, and finally taste the difference between Tuesday and Wednesday.
                </p>
                <div data-reveal style="opacity:0" class="mt-10 flex flex-wrap items-center gap-4">
                    <a href="{{ auth()->check() ? route('dashboard') : route('register') }}"
                       data-magnetic
                       class="group relative inline-flex items-center gap-2 px-7 py-4 rounded-2xl bg-espresso-600 text-cream-50 font-medium shadow-[0_12px_30px_-10px_rgba(74,49,32,0.6)] hover:shadow-[0_18px_40px_-10px_rgba(74,49,32,0.7)] hover:bg-espresso-700 active:scale-[0.97] transition-all duration-300">
                        Start brewing
                        <span class="inline-block transition-transform duration-300 group-hover:translate-x-1.5">&rarr;</span>
                    </a>
                    <a href="#how" class="px-5 py-4 rounded-2xl text-espresso-600 font-medium hover:bg-cream-100 transition-colors">
                        See how it works
                    </a>
                </div>

                <div data-reveal style="opacity:0" class="mt-12 flex items-center gap-6 text-xs text-espresso-400 uppercase tracking-widest">
                    <span>V60</span><span class="w-1 h-1 rounded-full bg-caramel-400"></span>
                    <span>Aeropress</span><span class="w-1 h-1 rounded-full bg-caramel-400"></span>
                    <span>Espresso</span><span class="w-1 h-1 rounded-full bg-caramel-400"></span>
                    <span>Chemex</span>
                </div>
            </div>

            <div data-reveal style="opacity:0" class="relative">
                <div data-parallax="0.15" class="relative mx-auto w-full max-w-md aspect-[4/5] rounded-[2.5rem] overflow-hidden bg-gradient-to-br from-espresso-500 via-espresso-600 to-espresso-800 shadow-[0_40px_80px_-20px_rgba(35,22,13,0.6)] border border-espresso-400/40">
                    <div class="absolute inset-0 bg-noise opacity-30 mix-blend-overlay"></div>

                    <div class="absolute top-6 left-1/2 -translate-x-1/2 flex gap-3">
                        <span class="w-1.5 h-10 rounded-full bg-cream-100/40 blur-sm animate-steam"></span>
                        <span class="w-1.5 h-10 rounded-full bg-cream-100/40 blur-sm animate-steam" style="animation-delay:.8s"></span>
                        <span class="w-1.5 h-10 rounded-full bg-cream-100/40 blur-sm animate-steam" style="animation-delay:1.6s"></span>
                    </div>

                    <div class="absolute bottom-6 left-6 right-6 rounded-2xl p-5 bg-cream-50/15 backdrop-blur-md border border-cream-100/25 text-cream-100 animate-float">
                        <div class="flex items-center justify-between text-[11px] uppercase tracking-widest text-cream-200/80">
                            <span>Today&rsquo;s brew</span>
                            <span>V60 &middot; 1:16</span>
                        </div>
                        <div class="mt-2 font-serif text-2xl">Ethiopia Yirgacheffe</div>
                        <div class="mt-1 text-sm text-cream-200/80">Jasmine &middot; bergamot &middot; honey</div>
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex gap-1 text-caramel-300">
                                @for($i=0;$i<5;$i++)<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.17c.969 0 1.371 1.24.588 1.81l-3.374 2.45a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.374-2.45a1 1 0 00-1.176 0l-3.374 2.45c-.784.57-1.838-.196-1.539-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.05 9.394c-.783-.57-.38-1.81.588-1.81h4.17a1 1 0 00.95-.69l1.286-3.967z"/></svg>@endfor
                            </div>
                            <span class="text-xs text-cream-200/70">18g &rarr; 288g &middot; 2:45</span>
                        </div>
                    </div>
                </div>

                <div data-parallax="0.6" class="absolute -top-4 -left-4 px-4 py-3 rounded-2xl bg-cream-50/70 backdrop-blur-xl border border-cream-200 shadow-xl animate-float" style="animation-delay:.4s">
                    <div class="text-[10px] uppercase tracking-widest text-espresso-400">Avg rating</div>
                    <div class="font-serif text-2xl text-espresso-700">4.6 <span class="text-caramel-500 text-sm">/5</span></div>
                </div>
                <div data-parallax="0.5" class="absolute -bottom-2 -right-2 px-4 py-3 rounded-2xl bg-cream-50/70 backdrop-blur-xl border border-cream-200 shadow-xl animate-float" style="animation-delay:1.2s">
                    <div class="text-[10px] uppercase tracking-widest text-espresso-400">This week</div>
                    <div class="font-serif text-2xl text-espresso-700">12 brews</div>
                </div>
            </div>
        </div>
    </section>

    {{-- FEATURES --}}
    <section id="features" class="relative py-28 px-6">
        <div class="max-w-6xl mx-auto">
            <div data-reveal style="opacity:0" class="max-w-2xl">
                <span class="text-xs uppercase tracking-[0.2em] text-caramel-600 font-medium">Why BrewLog</span>
                <h2 class="mt-3 font-serif text-4xl sm:text-5xl text-espresso-700 leading-tight">A quiet ritual, finally written down.</h2>
            </div>

            <div class="mt-16 grid md:grid-cols-3 gap-6">
                @php
                    $features = [
                        ['Log','Capture every parameter — beans, dose, yield, time, temperature — without breaking your flow.','M4 4h12a2 2 0 012 2v12l-4-2-4 2-4-2-4 2V6a2 2 0 012-2z'],
                        ['Rate','Score each cup 1 to 5 and write the taste notes you actually remember tomorrow.','M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.17c.969 0 1.371 1.24.588 1.81l-3.374 2.45a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.374-2.45a1 1 0 00-1.176 0l-3.374 2.45c-.784.57-1.838-.196-1.539-1.118l1.287-3.966a1 1 0 00-.364-1.118L4.05 9.394c-.783-.57-.38-1.81.588-1.81h4.17a1 1 0 00.95-.69l1.286-3.967z'],
                        ['Learn','Spot patterns across roasts, ratios, and methods so your dial-in keeps getting sharper.','M3 3v18h18M7 14l3-3 4 4 5-6'],
                    ];
                @endphp
                @foreach($features as $i => $f)
                    <article data-reveal style="opacity:0;transition-delay:{{ $i * 80 }}ms" class="group relative p-7 rounded-3xl bg-cream-100/60 backdrop-blur-sm border border-cream-200 hover:border-caramel-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-espresso-500/10 transition-all duration-500">
                        <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-caramel-300/0 to-caramel-300/0 group-hover:from-caramel-300/10 transition-all duration-500 pointer-events-none"></div>
                        <div class="w-12 h-12 rounded-2xl bg-espresso-600 text-cream-50 grid place-items-center group-hover:rotate-6 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $f[2] }}"/></svg>
                        </div>
                        <h3 class="mt-6 font-serif text-2xl text-espresso-700">{{ $f[0] }}</h3>
                        <p class="mt-2 text-espresso-500 leading-relaxed">{{ $f[1] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- HOW IT WORKS --}}
    <section id="how" class="relative py-28 px-6 bg-espresso-700 text-cream-100 overflow-hidden">
        <div data-parallax="0.3" class="absolute -top-32 -left-20 w-[480px] h-[480px] rounded-full bg-caramel-500/20 blur-3xl"></div>
        <div class="absolute inset-0 bg-noise opacity-30 mix-blend-overlay pointer-events-none"></div>

        <div class="relative max-w-6xl mx-auto">
            <div data-reveal style="opacity:0" class="max-w-2xl">
                <span class="text-xs uppercase tracking-[0.2em] text-caramel-300 font-medium">How it works</span>
                <h2 class="mt-3 font-serif text-4xl sm:text-5xl leading-tight text-cream-50">Three steps. Then it&rsquo;s habit.</h2>
            </div>

            <ol class="mt-16 grid md:grid-cols-3 gap-10">
                @foreach([
                    ['Add a bean','Roaster, origin, roast level, your tasting impression.'],
                    ['Log the brew','Method, dose, yield, time. Watch the ratio appear in real time.'],
                    ['Find your pattern','Browse the timeline. The good cups start telling a story.'],
                ] as $i => $step)
                    <li data-reveal style="opacity:0;transition-delay:{{ $i * 100 }}ms" class="relative">
                        <div class="font-serif text-6xl text-caramel-300/80">0{{ $i+1 }}</div>
                        <h3 class="mt-2 font-serif text-2xl text-cream-50">{{ $step[0] }}</h3>
                        <p class="mt-2 text-cream-200/80 leading-relaxed">{{ $step[1] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- FAQ --}}
    <section id="faq" class="relative py-28 px-6">
        <div class="max-w-3xl mx-auto">
            <div data-reveal style="opacity:0" class="text-center">
                <span class="text-xs uppercase tracking-[0.2em] text-caramel-600 font-medium">FAQ</span>
                <h2 class="mt-3 font-serif text-4xl sm:text-5xl text-espresso-700">The short answers.</h2>
            </div>

            <div class="mt-12 space-y-3" x-data="{ open: 0 }">
                @foreach([
                    ['What is a good brew ratio for V60?','A 1:16 dose-to-water ratio is the standard starting point for Hario V60 pour-over. BrewLog calculates the ratio live as you log dose and yield so you can dial in from there.'],
                    ['How do I track my coffee brewing?','With BrewLog you log the bean, then record each brew\'s method, dose, yield, time and grind. BrewLog calculates the ratio, stores your 1-to-5 rating and taste notes, and shows the history so you can spot patterns.'],
                    ['Is BrewLog free?','Yes — log as many beans and brews as you like.'],
                    ['Does BrewLog work for espresso and pour-over?','Both. V60, Aeropress, Espresso, French Press, and Chemex are first-class brew methods in BrewLog.'],
                    ['Is my BrewLog data private?','Your journal is yours. Only you can see your beans and brews.'],
                    ['Do I need an account?','Only to save brews. The marketing page is open to all.'],
                ] as $i => $q)
                    <div data-reveal style="opacity:0" class="rounded-2xl border border-cream-200 bg-cream-50 hover:border-caramel-300 transition-colors">
                        <button @click="open = open === {{ $i }} ? null : {{ $i }}" class="w-full flex items-center justify-between gap-4 px-6 py-5 text-left">
                            <span class="font-medium text-espresso-700">{{ $q[0] }}</span>
                            <span class="w-7 h-7 rounded-full bg-cream-100 grid place-items-center text-espresso-500 transition-transform duration-300" :class="open === {{ $i }} ? 'rotate-45 bg-caramel-500 text-cream-50' : ''">+</span>
                        </button>
                        <div x-show="open === {{ $i }}" x-collapse>
                            <p class="px-6 pb-5 -mt-1 text-espresso-500 leading-relaxed">{{ $q[1] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA FOOTER --}}
    <section class="relative px-6 pb-16">
        <div data-reveal style="opacity:0" class="relative max-w-6xl mx-auto rounded-[2.5rem] overflow-hidden bg-gradient-to-br from-espresso-600 to-espresso-800 px-8 py-20 sm:p-20 text-center">
            <div class="absolute inset-0 bg-noise opacity-30 mix-blend-overlay"></div>
            <div data-parallax="0.4" class="absolute -top-20 left-1/4 w-96 h-96 rounded-full bg-caramel-500/30 blur-3xl pointer-events-none"></div>
            <h2 class="relative font-serif text-4xl sm:text-6xl text-cream-50 leading-tight">Pour something worth remembering.</h2>
            <p class="relative mt-5 text-cream-200/80 max-w-xl mx-auto">Start your journal in under a minute. Your future self &mdash; the one chasing yesterday&rsquo;s perfect cup &mdash; will thank you.</p>
            <a href="{{ auth()->check() ? route('dashboard') : route('register') }}"
               data-magnetic
               class="relative inline-flex items-center gap-2 mt-10 px-8 py-4 rounded-2xl bg-cream-50 text-espresso-700 font-medium hover:shadow-[0_18px_50px_-10px_rgba(255,240,210,0.4)] hover:bg-cream-100 active:scale-[0.97] transition-all duration-300 group">
                Start brewing
                <span class="inline-block transition-transform duration-300 group-hover:translate-x-1.5">&rarr;</span>
            </a>
        </div>
    </section>
</main>
        <footer class="max-w-6xl mx-auto mt-10 px-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-sm text-espresso-400">
            <span>&copy; {{ date('Y') }} BrewLog. Brewed with care.</span>
            <span class="font-serif italic">&ldquo;Life is too short for bad coffee.&rdquo;</span>
        </footer>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (window.Lenis) {
            const lenis = new Lenis({ lerp: 0.09, smoothWheel: true });
            const raf = (t) => { lenis.raf(t); requestAnimationFrame(raf); };
            requestAnimationFrame(raf);
            document.querySelectorAll('a[href^="#"]').forEach(a => {
                a.addEventListener('click', (e) => {
                    const id = a.getAttribute('href');
                    if (id.length > 1) {
                        const el = document.querySelector(id);
                        if (el) { e.preventDefault(); lenis.scrollTo(el, { offset: -80 }); }
                    }
                });
            });
        }

        if (window.gsap && window.ScrollTrigger) {
            gsap.registerPlugin(ScrollTrigger);
            gsap.utils.toArray('[data-reveal]').forEach((el) => {
                gsap.fromTo(el,
                    { y: 40, opacity: 0 },
                    { y: 0, opacity: 1, duration: 1.1, ease: 'power3.out',
                      scrollTrigger: { trigger: el, start: 'top 88%' } });
            });
            gsap.utils.toArray('[data-parallax]').forEach((el) => {
                const speed = parseFloat(el.dataset.parallax) || 0.3;
                gsap.to(el, { yPercent: -speed * 60, ease: 'none',
                    scrollTrigger: { trigger: el, start: 'top bottom', end: 'bottom top', scrub: true } });
            });
        } else {
            document.querySelectorAll('[data-reveal]').forEach(el => { el.style.opacity = 1; });
        }

        document.querySelectorAll('[data-magnetic]').forEach((btn) => {
            const strength = 18;
            btn.addEventListener('mousemove', (e) => {
                const r = btn.getBoundingClientRect();
                const x = e.clientX - r.left - r.width / 2;
                const y = e.clientY - r.top - r.height / 2;
                btn.style.transform = `translate(${(x / r.width) * strength}px, ${(y / r.height) * strength}px)`;
            });
            btn.addEventListener('mouseleave', () => { btn.style.transform = ''; });
        });
    });
</script>
</body>
</html>
