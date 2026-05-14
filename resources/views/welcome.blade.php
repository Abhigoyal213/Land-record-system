@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative h-[420px] w-full overflow-hidden flex flex-col justify-end p-6">
    <div class="absolute inset-0 z-0">
        <img alt="Farmland" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAXL5JoEBSvy8BbPONiRtYR66I6GQQu8ycHPPbMLXXKqWAmVzXtThkGtjKWAzlcUpS1qL9GZiXa8kl4nx-_uoc7CuATRnp3x8FP96nBYN8AA0sFIJbJmwNZZQl5PFT6gwamIck1ntTZSrpQ5OfVyD-Vmh-oR8O6wlipKlCGXwTaR_5O2aTycACVKrrz-qeTAUOnDA5550a5pONa6coTI8CmueCQsSlTfebybmoOcgJEU9tymQSGZ5wJCeGTm3oM31eV9iYUZL8Rkw"/>
        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/40 to-transparent"></div>
    </div>
    <div class="relative z-10 space-y-4">
        <h1 class="font-h1 text-white leading-tight">Official Land Records & Property Tax Portal</h1>
        <p class="font-body-md text-primary-fixed-dim max-w-md">Secure, transparent, and digital access to state land ownership and tax assessment services.</p>
        <div class="pt-4">
            <button class="bg-secondary-container text-on-secondary-container px-6 py-3 rounded-lg font-label-md shadow-lg flex items-center gap-2 w-fit">
                Start Search
                <span class="material-symbols-outlined text-sm" data-icon="arrow_forward">arrow_forward</span>
            </button>
        </div>
    </div>
</section>

<!-- Services Grid (Bento Style) -->
<section class="p-6 -mt-10 relative z-20">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Large Card -->
        <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm flex flex-col justify-between group hover:border-primary-container transition-all">
            <div>
                <div class="w-12 h-12 bg-primary-fixed rounded-lg flex items-center justify-center mb-4 text-primary-container">
                    <span class="material-symbols-outlined text-3xl" data-icon="description">description</span>
                </div>
                <h3 class="font-h3 text-primary mb-2">View Land Records</h3>
                <p class="font-body-sm text-on-surface-variant">Access digital copies of ownership deeds, survey numbers, and land parcel maps instantly.</p>
            </div>
            <div class="mt-8 flex items-center text-primary-container font-label-md gap-1">
                Search Now <span class="material-symbols-outlined transition-transform group-hover:translate-x-1" data-icon="chevron_right">chevron_right</span>
            </div>
        </div>
        <!-- Secondary Cards -->
        <div class="space-y-4">
            <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm flex items-center gap-4 group hover:border-secondary transition-all">
                <div class="w-12 h-12 bg-secondary-container/30 rounded-lg flex items-center justify-center text-secondary">
                    <span class="material-symbols-outlined text-2xl" data-icon="payments">payments</span>
                </div>
                <div class="flex-1">
                    <h4 class="font-label-md text-primary">Pay Property Tax</h4>
                    <p class="text-[12px] text-on-surface-variant">Settle outstanding dues securely</p>
                </div>
                <span class="material-symbols-outlined text-outline-variant group-hover:text-secondary transition-colors" data-icon="open_in_new">open_in_new</span>
            </div>
            <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm flex items-center gap-4 group hover:border-primary-container transition-all">
                <div class="w-12 h-12 bg-primary-container/10 rounded-lg flex items-center justify-center text-primary-container">
                    <span class="material-symbols-outlined text-2xl" data-icon="verified">verified</span>
                </div>
                <div class="flex-1">
                    <h4 class="font-label-md text-primary">Request Certificate</h4>
                    <p class="text-[12px] text-on-surface-variant">Official verified documentation</p>
                </div>
                <span class="material-symbols-outlined text-outline-variant group-hover:text-primary-container transition-colors" data-icon="open_in_new">open_in_new</span>
            </div>
        </div>
    </div>
</section>

<!-- Quick Access List -->
<section class="px-6 py-4">
    <div class="bg-surface-container-low rounded-xl p-6 border border-outline-variant/30">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-h3 text-primary text-xl">Recent Notifications</h3>
            <span class="text-xs font-label-md text-primary-container uppercase tracking-wider">View All</span>
        </div>
        <div class="space-y-6">
            <div class="flex gap-4">
                <div class="mt-1 flex-shrink-0 w-2 h-2 rounded-full bg-error"></div>
                <div>
                    <p class="font-label-md text-primary">Tax Deadline Approaching</p>
                    <p class="font-body-sm text-on-surface-variant">Complete your Quarter 3 assessment by Oct 31st to avoid penalties.</p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="mt-1 flex-shrink-0 w-2 h-2 rounded-full bg-secondary"></div>
                <div>
                    <p class="font-label-md text-primary">Mutation Request Approved</p>
                    <p class="font-body-sm text-on-surface-variant">Application #RE-8821 for Parcel 45B has been successfully processed.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Quick Access -->
<section class="px-6 py-4 mb-10">
    <div class="relative h-48 w-full rounded-xl overflow-hidden border border-outline-variant shadow-sm">
        <img alt="Survey Map" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBBcUOgcbH9byJi54fnwaIM_V5WIG1hriFmHXj9AVMmPzIGVkRl8hzBy6yCHXrWqtPAY57BKprW1-HAKJXDdkSbVJ6H_w1W0hphwnfkFBBfQeB-bW1HydzOEn1yB-Ml-JkUO6KBWYO4bmqCoNCUy9ibtlfyJWHbREMwclfrqNtOrvTvhV-IjvBAYTwO-yS0g0lXj-ix_7GeF-9zN8A6QKT8LocgOwobhAVN3VBM76uA_1AQKss7Hx_kOy1FrO9YH_h2zC6_4UxIDw"/>
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="absolute bottom-4 left-4 right-4 bg-white/90 backdrop-blur-md p-3 rounded-lg flex items-center justify-between">
            <div>
                <p class="font-label-md text-primary">Interactive Land Map</p>
                <p class="text-[10px] text-on-surface-variant uppercase">Explore Boundaries</p>
            </div>
            <span class="material-symbols-outlined text-primary-container" data-icon="map">map</span>
        </div>
    </div>
</section>
@endsection
