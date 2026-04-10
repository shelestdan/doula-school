import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

// Register Alpine plugins
Alpine.plugin(collapse);

// Make Alpine available globally
window.Alpine = Alpine;
Alpine.start();

// ============================================================
// Animate on scroll
// ============================================================
document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
});

// ============================================================
// Sticky booking bar (appears after scrolling past hero)
// ============================================================
document.addEventListener('DOMContentLoaded', () => {
    const bar = document.getElementById('sticky-booking-bar');
    if (!bar) return;

    const hero = document.querySelector('[data-hero]');
    if (!hero) return;

    const io = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            bar.classList.toggle('visible', !entry.isIntersecting);
        });
    }, { threshold: 0.1 });

    io.observe(hero);
});

// ============================================================
// UTM capture — store UTM params in sessionStorage for forms
// ============================================================
(function() {
    const params = new URLSearchParams(window.location.search);
    const utmKeys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term'];
    utmKeys.forEach(key => {
        if (params.has(key)) {
            sessionStorage.setItem(key, params.get(key));
        }
    });
})();

// ============================================================
// Phone mask (simple, no dependency)
// ============================================================
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[data-phone]').forEach(input => {
        input.addEventListener('input', (e) => {
            let val = e.target.value.replace(/\D/g, '');
            if (val.startsWith('8')) val = '7' + val.slice(1);
            if (val.startsWith('7')) {
                val = '+7 (' + val.slice(1, 4) + ') ' + val.slice(4, 7) + '-' + val.slice(7, 9) + '-' + val.slice(9, 11);
            }
            e.target.value = val;
        });
    });
});
