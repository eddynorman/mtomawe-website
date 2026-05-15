/**
 * Public + guest auth entry: Bootstrap bundle for interactive components (carousels, modals, nav toggler).
 */
import '../css/app.css';
import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;

/**
 * Lightweight intersection observer for .reveal-up elements on marketing pages.
 */
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (! prefersReducedMotion) {
    const reveal = () => {
        document.querySelectorAll('.reveal-up').forEach((el) => {
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight - 60) {
                el.classList.add('is-visible');
            }
        });
    };
    window.addEventListener('scroll', reveal, { passive: true });
    window.addEventListener('load', reveal);
}

document.addEventListener('DOMContentLoaded', () => {
    const el = document.getElementById('deleteUserModal');
    if (el?.dataset.showOnLoad === '1' && window.bootstrap?.Modal) {
        window.bootstrap.Modal.getOrCreateInstance(el).show();
    }
});
