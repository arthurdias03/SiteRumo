// Funcionalidades interativas para a página de publicações

document.addEventListener('DOMContentLoaded', function() {
    
    // Inicializar funcionalidades
    initializeFilters();
    initializeSearch();
    initializeTableInteractions();
    initializeAccessibility();
    initializeAnimations();
    
    // Sistema de filtros dinâmicos
    function initializeFilters() {
        const filterSelects = document.querySelectorAll('.form-select');
        const filterButton = document.querySelector('.btn-filter');
        
        // Adicionar contador de filtros ativos
        const filtersTitle = document.querySelector('.filters-title');
        const filterCounter = document.createElement('span');
        filterCounter.className = 'badge bg-primary ms-2';
        filterCounter.style.display = 'none';
        filtersTitle.appendChild(filterCounter);
        
        filterSelects.forEach(select => {
            select.addEventListener('change', function() {
                updateFilterCounter();
                highlightActiveFilters();
            });
        });
        
        function updateFilterCounter() {
            let activeFilters = 0;
            filterSelects.forEach(select => {
                if (select.selectedOptions.length > 0) {
                    activeFilters += select.selectedOptions.length;
                }
            });
            
            if (activeFilters > 0) {
                filterCounter.textContent = activeFilters;
                filterCounter.style.display = 'inline-block';
                filterButton.innerHTML = '<i class="fas fa-search me-1"></i>Aplicar Filtros (' + activeFilters + ')';
            } else {
                filterCounter.style.display = 'none';
                filterButton.innerHTML = '<i class="fas fa-search me-1"></i>Aplicar Filtros';
            }
        }
        
        function highlightActiveFilters() {
            filterSelects.forEach(select => {
                const filterGroup = select.closest('.filter-group');
                if (select.selectedOptions.length > 0) {
                    filterGroup.classList.add('active-filter');
                } else {
                    filterGroup.classList.remove('active-filter');
                }
            });
        }
        
        // Botão para limpar todos os filtros
        const clearFiltersBtn = document.createElement('button');
        clearFiltersBtn.type = 'button';
        clearFiltersBtn.className = 'btn btn-outline-secondary btn-sm mt-2';
        clearFiltersBtn.innerHTML = '<i class="fas fa-times me-1"></i>Limpar Filtros';
        clearFiltersBtn.style.width = '100%';
        clearFiltersBtn.addEventListener('click', function() {
            filterSelects.forEach(select => {
                select.selectedIndex = -1;
            });
            updateFilterCounter();
            highlightActiveFilters();
        });
        
        document.querySelector('form').appendChild(clearFiltersBtn);
        
        // Inicializar contador
        updateFilterCounter();
    }
    
    // Sistema de busca em tempo real
    function initializeSearch() {
        const searchContainer = document.createElement('div');
        searchContainer.className = 'mb-3';
        searchContainer.innerHTML = `
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" class="form-control" id="searchInput" 
                       placeholder="Buscar por título, autor ou descrição...">
                <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        const publicationsHeader = document.querySelector('.publications-header');
        publicationsHeader.appendChild(searchContainer);
        
        const searchInput = document.getElementById('searchInput');
        const clearSearchBtn = document.getElementById('clearSearch');
        const tableRows = document.querySelectorAll('.table tbody tr');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            let visibleRows = 0;
            
            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                    visibleRows++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            updateSearchResults(visibleRows);
        });
        
        clearSearchBtn.addEventListener('click', function() {
            searchInput.value = '';
            tableRows.forEach(row => {
                row.style.display = '';
            });
            updateSearchResults(tableRows.length);
        });
        
        function updateSearchResults(count) {
            let resultInfo = document.querySelector('.search-results-info');
            if (!resultInfo) {
                resultInfo = document.createElement('div');
                resultInfo.className = 'search-results-info text-muted small mb-2';
                document.querySelector('.table-responsive').parentNode.insertBefore(resultInfo, document.querySelector('.table-responsive'));
            }
            
            if (searchInput.value) {
                resultInfo.innerHTML = `<i class="fas fa-info-circle me-1"></i>Mostrando ${count} resultado(s) para "${searchInput.value}"`;
            } else {
                resultInfo.innerHTML = '';
            }
        }
    }
    
    // Melhorias na interação com a tabela
    function initializeTableInteractions() {
        const table = document.querySelector('.table');
        const rows = table.querySelectorAll('tbody tr');
        
        // Adicionar números de linha
        rows.forEach((row, index) => {
            if (!row.querySelector('.no-results')) {
                const firstCell = row.querySelector('td');
                if (firstCell) {
                    firstCell.innerHTML = `<span class="row-number">${index + 1}</span>`;
                }
            }
        });
        
        // Adicionar funcionalidade de ordenação
        const headers = table.querySelectorAll('thead th');
        headers.forEach((header, index) => {
            if (index < headers.length - 1) { // Não adicionar ordenação na coluna de ações
                header.style.cursor = 'pointer';
                header.innerHTML += ' <i class="fas fa-sort text-muted"></i>';
                
                header.addEventListener('click', function() {
                    sortTable(index);
                });
            }
        });
        
        let sortDirection = 'asc';
        let lastSortedColumn = -1;
        
        function sortTable(columnIndex) {
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr')).filter(row => !row.querySelector('.no-results'));
            
            if (lastSortedColumn === columnIndex) {
                sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                sortDirection = 'asc';
            }
            
            rows.sort((a, b) => {
                const aText = a.cells[columnIndex].textContent.trim();
                const bText = b.cells[columnIndex].textContent.trim();
                
                // Verificar se é número
                const aNum = parseFloat(aText);
                const bNum = parseFloat(bText);
                
                if (!isNaN(aNum) && !isNaN(bNum)) {
                    return sortDirection === 'asc' ? aNum - bNum : bNum - aNum;
                } else {
                    return sortDirection === 'asc' ? 
                        aText.localeCompare(bText) : 
                        bText.localeCompare(aText);
                }
            });
            
            // Atualizar ícones de ordenação
            headers.forEach((header, index) => {
                const icon = header.querySelector('i');
                if (icon) {
                    if (index === columnIndex) {
                        icon.className = `fas fa-sort-${sortDirection === 'asc' ? 'up' : 'down'} text-primary`;
                    } else {
                        icon.className = 'fas fa-sort text-muted';
                    }
                }
            });
            
            // Reordenar linhas
            rows.forEach(row => tbody.appendChild(row));
            lastSortedColumn = columnIndex;
        }
        
        // Adicionar hover effects melhorados
        rows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.01)';
                this.style.zIndex = '10';
                this.style.boxShadow = '0 4px 15px rgba(0,0,0,0.1)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.zIndex = '';
                this.style.boxShadow = '';
            });
        });
    }
    
    // Melhorias de acessibilidade
    function initializeAccessibility() {
        // Adicionar navegação por teclado
        const focusableElements = document.querySelectorAll('a, button, select, input');
        
        focusableElements.forEach(element => {
            element.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && this.tagName === 'SELECT') {
                    this.click();
                }
            });
        });
        
        // Adicionar indicadores de foco melhorados
        const style = document.createElement('style');
        style.textContent = `
            .focus-visible {
                outline: 2px solid var(--primary-color) !important;
                outline-offset: 2px !important;
                box-shadow: 0 0 0 4px rgba(44, 90, 160, 0.2) !important;
            }
        `;
        document.head.appendChild(style);
        
        // Adicionar skip link
        const skipLink = document.createElement('a');
        skipLink.href = '#main-content';
        skipLink.textContent = 'Pular para o conteúdo principal';
        skipLink.className = 'sr-only sr-only-focusable';
        skipLink.style.cssText = `
            position: absolute;
            top: -40px;
            left: 6px;
            z-index: 1000;
            color: white;
            background: var(--primary-color);
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
        `;
        skipLink.addEventListener('focus', function() {
            this.style.top = '6px';
        });
        skipLink.addEventListener('blur', function() {
            this.style.top = '-40px';
        });
        
        document.body.insertBefore(skipLink, document.body.firstChild);
        
        // Adicionar ID ao conteúdo principal
        document.querySelector('.main-content').id = 'main-content';
    }
    
    // Animações e efeitos visuais
    function initializeAnimations() {
        // Intersection Observer para animações on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);
        
        // Observar elementos para animação
        document.querySelectorAll('.filter-group, .table tbody tr').forEach(el => {
            observer.observe(el);
        });
        
        // Efeito de loading nos botões
        document.querySelectorAll('button[type="submit"]').forEach(button => {
            button.addEventListener('click', function() {
                if (this.form && this.form.checkValidity()) {
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Carregando...';
                    this.disabled = true;
                }
            });
        });
        
        // Smooth scroll para links internos
        document.querySelectorAll('a[href^="#"]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }
    
    // Adicionar estilos CSS dinâmicos
    const dynamicStyles = document.createElement('style');
    dynamicStyles.textContent = `
        .active-filter {
            background: linear-gradient(135deg, rgba(44, 90, 160, 0.05), rgba(23, 162, 184, 0.05));
            border-radius: 0.5rem;
            padding: 0.5rem;
            margin: -0.5rem;
            border-left: 3px solid var(--primary-color);
        }
        
        .row-number {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .animate-in {
            animation: fadeInUp 0.6s ease-out;
        }
        
        .search-results-info {
            padding: 0.5rem;
            background: rgba(44, 90, 160, 0.05);
            border-radius: 0.375rem;
            border-left: 3px solid var(--accent-color);
        }
        
        .input-group .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.25);
        }
        
        .sr-only {
            position: absolute !important;
            width: 1px !important;
            height: 1px !important;
            padding: 0 !important;
            margin: -1px !important;
            overflow: hidden !important;
            clip: rect(0, 0, 0, 0) !important;
            white-space: nowrap !important;
            border: 0 !important;
        }
        
        .sr-only-focusable:focus {
            position: static !important;
            width: auto !important;
            height: auto !important;
            padding: inherit !important;
            margin: inherit !important;
            overflow: visible !important;
            clip: auto !important;
            white-space: normal !important;
        }
    `;
    document.head.appendChild(dynamicStyles);
    
    // Notificação de carregamento completo
    console.log('✅ Página de publicações carregada com todas as funcionalidades ativas');
    
    // Adicionar indicador visual de carregamento completo
    setTimeout(() => {
        document.body.classList.add('loaded');
    }, 100);
});

// Função para exportar dados da tabela (funcionalidade extra)
function exportTableData(format = 'csv') {
    const table = document.querySelector('.table');
    const rows = table.querySelectorAll('tr');
    let data = [];
    
    rows.forEach(row => {
        const cells = row.querySelectorAll('th, td');
        const rowData = [];
        cells.forEach(cell => {
            // Remover botões e elementos não textuais
            const text = cell.textContent.replace(/\s+/g, ' ').trim();
            if (!text.includes('Visualizar')) {
                rowData.push(text);
            }
        });
        if (rowData.length > 0) {
            data.push(rowData);
        }
    });
    
    if (format === 'csv') {
        const csv = data.map(row => row.map(cell => `"${cell}"`).join(',')).join('\n');
        downloadFile(csv, 'publicacoes.csv', 'text/csv');
    }
}

function downloadFile(content, filename, contentType) {
    const blob = new Blob([content], { type: contentType });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = filename;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
}

