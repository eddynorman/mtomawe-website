/**
 * Admin panel bundle: shared Bootstrap/FA styles plus Quill editors on CMS screens.
 */
import '../css/app.css';
import '../css/admin.css';
import * as bootstrap from 'bootstrap';
import Quill from 'quill';

window.bootstrap = bootstrap;

/**
 * Attach a Quill instance to a container and sync HTML into a hidden input for form posts.
 *
 * @param {string} containerSelector CSS selector for the editor mount node
 * @param {string} hiddenInputId Hidden input id that receives serialized HTML
 */
window.initQuillEditor = function initQuillEditor(containerSelector, hiddenInputId) {
    const container = document.querySelector(containerSelector);
    const hidden = document.getElementById(hiddenInputId);
    if (! container || ! hidden) {
        return;
    }

    const quill = new Quill(container, {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ list: 'ordered' }, { list: 'bullet' }],
                [{ align: [] }],
                ['link', 'clean'],
            ],
        },
    });

    const initial = hidden.value || '';
    if (initial.trim() !== '') {
        quill.root.innerHTML = initial;
    }

    const sync = () => {
        hidden.value = quill.root.innerHTML;
    };

    quill.on('text-change', sync);
    sync();
};

window.Quill = Quill;

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('main .alert.alert-success.alert-dismissible').forEach((alertEl) => {
        window.setTimeout(() => {
            window.bootstrap?.Alert?.getOrCreateInstance(alertEl)?.close();
        }, 4500);
    });
});
