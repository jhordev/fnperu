"use strict";

(function () {

    const ITEMS_PER_PAGE = 9;
    let currentFilter = 'todos';
    let currentPage   = 1;

    const grid          = document.getElementById('cursos_grid');
    const paginationEl  = document.getElementById('cursos_pagination');
    const countEl       = document.getElementById('resultado-count');
    const emptyEl       = document.getElementById('empty-filter');
    const filterBtns    = document.querySelectorAll('[data-filter]');

    if (!grid) return;

    const allCards = Array.from(grid.querySelectorAll('.item-card'));

    /* ── Leer param de URL (?filter=0 o ?filter=1) ── */
    const urlParam = new URLSearchParams(window.location.search).get('filter');
    if (urlParam === '0' || urlParam === '1') {
        currentFilter = urlParam;
    }

    function getVisible() {
        if (currentFilter === 'todos') return allCards;
        return allCards.filter(c => c.dataset.tipo === currentFilter);
    }

    function render() {
        const visible    = getVisible();
        const total      = visible.length;
        const totalPages = Math.max(1, Math.ceil(total / ITEMS_PER_PAGE));

        if (currentPage > totalPages) currentPage = 1;

        const start = (currentPage - 1) * ITEMS_PER_PAGE;
        const end   = start + ITEMS_PER_PAGE;

        allCards.forEach(c => { c.style.display = 'none'; });
        visible.slice(start, end).forEach(c => { c.style.display = ''; });

        if (countEl) {
            countEl.textContent = total === 0 ? '' :
                total + (total === 1 ? ' resultado' : ' resultados');
        }

        if (emptyEl) {
            emptyEl.classList.toggle('d-none', total > 0);
        }

        renderPagination(totalPages, total);
    }

    function renderPagination(totalPages, total) {
        if (!paginationEl) return;
        if (totalPages <= 1) { paginationEl.innerHTML = ''; return; }

        let html = '<ul class="pagination justify-content-center flex-wrap gap-1">';

        if (currentPage > 1) {
            html += `<li class="page-item">
                <button class="page-link" data-page="${currentPage - 1}" aria-label="Anterior">
                    <i class="fa-solid fa-chevron-left"></i>
                </button></li>`;
        }

        for (let i = 1; i <= totalPages; i++) {
            html += `<li class="page-item${i === currentPage ? ' active' : ''}">
                <button class="page-link" data-page="${i}">${i}</button>
            </li>`;
        }

        if (currentPage < totalPages) {
            html += `<li class="page-item">
                <button class="page-link" data-page="${currentPage + 1}" aria-label="Siguiente">
                    <i class="fa-solid fa-chevron-right"></i>
                </button></li>`;
        }

        html += '</ul>';
        paginationEl.innerHTML = html;

        paginationEl.querySelectorAll('.page-link[data-page]').forEach(btn => {
            btn.addEventListener('click', function () {
                currentPage = parseInt(this.dataset.page);
                render();
                grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });
    }

    /* ── Sincronizar botones activos con estado inicial ── */
    function syncFilterBtns() {
        filterBtns.forEach(btn => {
            btn.classList.toggle('active', btn.dataset.filter === currentFilter);
        });
    }

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentFilter = this.dataset.filter;
            currentPage   = 1;
            render();
        });
    });

    syncFilterBtns();
    render();

})();
