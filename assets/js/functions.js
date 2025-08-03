// SAP Consulting Platform - Main JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuToggle = document.createElement('button');
    mobileMenuToggle.innerHTML = '☰';
    mobileMenuToggle.className = 'mobile-menu-toggle';
    mobileMenuToggle.style.cssText = `
        display: none;
        background: none;
        border: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 0.25rem;
    `;
    
    const navbar = document.querySelector('.navbar');
    const navLinks = document.querySelector('.nav-links');
    
    if (navbar && navLinks) {
        navbar.insertBefore(mobileMenuToggle, navLinks);
        
        // Mobile menu functionality
        mobileMenuToggle.addEventListener('click', function() {
            const isVisible = navLinks.style.display === 'flex';
            navLinks.style.display = isVisible ? 'none' : 'flex';
            navLinks.style.flexDirection = 'column';
            navLinks.style.position = 'absolute';
            navLinks.style.top = '100%';
            navLinks.style.left = '0';
            navLinks.style.right = '0';
            navLinks.style.background = '#1f2937';
            navLinks.style.padding = '1rem';
            navLinks.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
        });
        
        // Mobile menu toggle on small screens
        function checkScreenSize() {
            if (window.innerWidth <= 768) {
                mobileMenuToggle.style.display = 'block';
                navLinks.style.display = 'none';
            } else {
                mobileMenuToggle.style.display = 'none';
                navLinks.style.display = 'flex';
                navLinks.style.flexDirection = 'row';
                navLinks.style.position = 'static';
                navLinks.style.background = 'none';
                navLinks.style.padding = '0';
                navLinks.style.boxShadow = 'none';
            }
        }
        
        window.addEventListener('resize', checkScreenSize);
        checkScreenSize();
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
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

    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            let firstInvalidField = null;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = '#ef4444';
                    isValid = false;
                    if (!firstInvalidField) firstInvalidField = field;
                } else {
                    field.style.borderColor = '';
                }
            });
            
            // Email validation
            const emailFields = form.querySelectorAll('input[type="email"]');
            emailFields.forEach(field => {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (field.value && !emailRegex.test(field.value)) {
                    field.style.borderColor = '#ef4444';
                    isValid = false;
                    if (!firstInvalidField) firstInvalidField = field;
                }
            });
            
            // Phone number validation (for bKash)
            const phoneFields = form.querySelectorAll('input[type="tel"]');
            phoneFields.forEach(field => {
                const phoneRegex = /^01[3-9]\d{8}$/;
                if (field.value && !phoneRegex.test(field.value)) {
                    field.style.borderColor = '#ef4444';
                    isValid = false;
                    if (!firstInvalidField) firstInvalidField = field;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                if (firstInvalidField) {
                    firstInvalidField.focus();
                }
                showAlert('Please fill in all required fields correctly.', 'danger');
            }
        });
    });

    // Add loading state to buttons
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (this.tagName === 'BUTTON' || this.tagName === 'A') {
                // Don't add loading state for navigation links
                if (this.getAttribute('href') && this.getAttribute('href').includes('.php')) {
                    return;
                }
                
                const originalContent = this.innerHTML;
                this.innerHTML = '<span class="loading"></span> Processing...';
                this.disabled = true;
                
                setTimeout(() => {
                    this.innerHTML = originalContent;
                    this.disabled = false;
                }, 2000);
            }
        });
    });

    // Payment method toggle
    const cardRadio = document.querySelector('input[value="card"]');
    const bkashRadio = document.querySelector('input[value="bkash"]');
    const cardDetails = document.getElementById('card-details');
    const bkashDetails = document.getElementById('bkash-details');
    
    if (cardRadio && bkashRadio && cardDetails && bkashDetails) {
        cardRadio.addEventListener('change', function() {
            if (this.checked) {
                cardDetails.style.display = 'block';
                bkashDetails.style.display = 'none';
            }
        });
        
        bkashRadio.addEventListener('change', function() {
            if (this.checked) {
                bkashDetails.style.display = 'block';
                cardDetails.style.display = 'none';
            }
        });
    }

    // Cost calculation
    const costCalculator = {
        init: function() {
            const userSelect = document.getElementById('user_type');
            const expertiseSelect = document.getElementById('required_expertise');
            const urgentCheckbox = document.getElementById('is_urgent');
            const baseCostInput = document.getElementById('base_cost');
            const totalCostInput = document.getElementById('total_cost');
            const upfrontPaymentInput = document.getElementById('upfront_payment');
            
            if (userSelect && expertiseSelect && baseCostInput && totalCostInput && upfrontPaymentInput) {
                [userSelect, expertiseSelect, urgentCheckbox].forEach(element => {
                    element.addEventListener('change', this.calculateCost.bind(this));
                });
                
                // Initial calculation
                this.calculateCost();
            }
        },
        
        calculateCost: function() {
            const userType = document.getElementById('user_type').value;
            const expertiseLevel = document.getElementById('required_expertise').value;
            const isUrgent = document.getElementById('is_urgent')?.checked || false;
            
            const rates = {
                'FREE': {'NEWBIE': 50, 'MEDIUM': 100, 'EXPERT': 200},
                'PRO': {'NEWBIE': 75, 'MEDIUM': 150, 'EXPERT': 300},
                'PREMIUM': {'NEWBIE': 100, 'MEDIUM': 200, 'EXPERT': 400}
            };
            
            let baseCost = rates[userType]?.[expertiseLevel] || 100;
            
            // Add 5% for urgent deadline (premium users only)
            if (isUrgent && userType === 'PREMIUM') {
                baseCost *= 1.05;
            }
            
            const totalCost = baseCost;
            const upfrontPayment = totalCost * 0.5;
            
            document.getElementById('base_cost').value = baseCost.toFixed(2);
            document.getElementById('total_cost').value = totalCost.toFixed(2);
            document.getElementById('upfront_payment').value = upfrontPayment.toFixed(2);
        }
    };

    // Initialize cost calculator
    costCalculator.init();

    // Issue status auto-update simulation
    function simulateIssueStatusUpdates() {
        const statusElements = document.querySelectorAll('.status-badge');
        statusElements.forEach(element => {
            if (Math.random() > 0.9) {
                element.style.animation = 'pulse 1s ease-in-out';
                setTimeout(() => {
                    element.style.animation = '';
                }, 1000);
            }
        });
    }

    // Run simulation every 10 seconds
    setInterval(simulateIssueStatusUpdates, 10000);

    // Countdown timer for issue resolution
    function initCountdownTimers() {
        const deadlineElements = document.querySelectorAll('[data-deadline]');
        deadlineElements.forEach(element => {
            const deadline = new Date(element.getAttribute('data-deadline'));
            const updateCountdown = () => {
                const now = new Date();
                const timeLeft = deadline - now;
                
                if (timeLeft > 0) {
                    const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    
                    element.textContent = `${days}d ${hours}h ${minutes}m`;
                    
                    if (days <= 1) {
                        element.className = 'text-danger';
                    } else if (days <= 3) {
                        element.className = 'text-warning';
                    }
                } else {
                    element.textContent = 'Overdue';
                    element.className = 'text-danger';
                }
            };
            
            updateCountdown();
            setInterval(updateCountdown, 60000); // Update every minute
        });
    }

    initCountdownTimers();

    // File upload preview
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const preview = document.getElementById(this.id + '_preview');
                if (preview) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width: 200px; max-height: 200px;">`;
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
    });

    // Dynamic form fields
    function addDynamicField(containerId, fieldType = 'text') {
        const container = document.getElementById(containerId);
        if (container) {
            const fieldDiv = document.createElement('div');
            fieldDiv.className = 'dynamic-field';
            
            let fieldHTML = '';
            switch(fieldType) {
                case 'text':
                    fieldHTML = `<input type="text" name="dynamic_${Date.now()}" class="form-control" placeholder="Enter value">`;
                    break;
                case 'email':
                    fieldHTML = `<input type="email" name="dynamic_${Date.now()}" class="form-control" placeholder="Enter email">`;
                    break;
                case 'select':
                    fieldHTML = `
                        <select name="dynamic_${Date.now()}" class="form-control">
                            <option value="">Select option</option>
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                        </select>
                    `;
                    break;
            }
            
            fieldDiv.innerHTML = `
                ${fieldHTML}
                <button type="button" class="btn btn-sm btn-danger remove-field" onclick="this.parentElement.remove()">×</button>
            `;
            
            container.appendChild(fieldDiv);
        }
    }

    // Make addDynamicField available globally
    window.addDynamicField = addDynamicField;

    // Auto-resize textarea
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });

    // Tooltip functionality
    function initTooltips() {
        const tooltipElements = document.querySelectorAll('[data-tooltip]');
        tooltipElements.forEach(element => {
            element.addEventListener('mouseenter', function() {
                const tooltipText = this.getAttribute('data-tooltip');
                const tooltip = document.createElement('div');
                tooltip.className = 'tooltip';
                tooltip.textContent = tooltipText;
                tooltip.style.cssText = `
                    position: absolute;
                    background: #1f2937;
                    color: white;
                    padding: 0.5rem 1rem;
                    border-radius: 0.25rem;
                    font-size: 0.875rem;
                    z-index: 1000;
                    white-space: nowrap;
                    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                `;
                
                document.body.appendChild(tooltip);
                
                const rect = this.getBoundingClientRect();
                tooltip.style.top = rect.top - tooltip.offsetHeight - 5 + 'px';
                tooltip.style.left = rect.left + (rect.width - tooltip.offsetWidth) / 2 + 'px';
                
                this.tooltip = tooltip;
            });
            
            element.addEventListener('mouseleave', function() {
                if (this.tooltip) {
                    this.tooltip.remove();
                    this.tooltip = null;
                }
            });
        });
    }

    initTooltips();

    // Chart initialization (for demo purposes)
    function initCharts() {
        const chartContainers = document.querySelectorAll('.chart-container');
        chartContainers.forEach(container => {
            const chartType = container.getAttribute('data-chart-type');
            const data = JSON.parse(container.getAttribute('data-chart-data') || '[]');
            
            // Simple chart rendering for demo
            const canvas = document.createElement('canvas');
            canvas.width = container.offsetWidth;
            canvas.height = 200;
            container.appendChild(canvas);
            
            const ctx = canvas.getContext('2d');
            
            // Draw simple bar chart
            if (chartType === 'bar' && data.length > 0) {
                const barWidth = canvas.width / data.length;
                const maxValue = Math.max(...data.map(d => d.value));
                
                data.forEach((item, index) => {
                    const barHeight = (item.value / maxValue) * (canvas.height - 40);
                    const x = index * barWidth + 10;
                    const y = canvas.height - barHeight - 20;
                    
                    ctx.fillStyle = '#3b82f6';
                    ctx.fillRect(x, y, barWidth - 20, barHeight);
                    
                    ctx.fillStyle = '#1f2937';
                    ctx.font = '12px Inter';
                    ctx.textAlign = 'center';
                    ctx.fillText(item.label, x + (barWidth - 20) / 2, canvas.height - 5);
                });
            }
        });
    }

    initCharts();

    // Search functionality
    function initSearch() {
        const searchInput = document.getElementById('search');
        const searchResults = document.getElementById('search-results');
        
        if (searchInput && searchResults) {
            let searchTimeout;
            
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const query = this.value.toLowerCase();
                
                if (query.length < 2) {
                    searchResults.style.display = 'none';
                    return;
                }
                
                searchTimeout = setTimeout(() => {
                    // Simulate search results
                    const results = [
                        { title: 'SAP Material Master Issue', type: 'issue' },
                        { title: 'Sales Order Processing', type: 'issue' },
                        { title: 'Expert Consultant', type: 'consultant' },
                        { title: 'Payment Processing', type: 'guide' }
                    ].filter(item => item.title.toLowerCase().includes(query));
                    
                    if (results.length > 0) {
                        searchResults.innerHTML = results.map(result => `
                            <div class="search-result-item">
                                <div class="result-title">${result.title}</div>
                                <div class="result-type">${result.type}</div>
                            </div>
                        `).join('');
                        searchResults.style.display = 'block';
                    } else {
                        searchResults.innerHTML = '<div class="no-results">No results found</div>';
                        searchResults.style.display = 'block';
                    }
                }, 300);
            });
            
            // Hide search results when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.style.display = 'none';
                }
            });
        }
    }

    initSearch();

    // Notification system
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <span class="notification-message">${message}</span>
                <button class="notification-close" onclick="this.parentElement.parentElement.remove()">×</button>
            </div>
        `;
        
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            min-width: 300px;
            animation: slideIn 0.3s ease-out;
        `;
        
        document.body.appendChild(notification);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 5000);
    }

    // Make showNotification available globally
    window.showNotification = showNotification;

    // Alert system (replacement for browser alerts)
    function showAlert(message, type = 'info') {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type}`;
        alertDiv.innerHTML = `
            ${message}
            <button class="alert-close" onclick="this.parentElement.remove()">×</button>
        `;
        
        alertDiv.style.cssText = `
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1001;
            min-width: 300px;
            max-width: 500px;
            animation: fadeIn 0.3s ease-out;
        `;
        
        document.body.appendChild(alertDiv);
        
        // Auto-remove after 3 seconds
        setTimeout(() => {
            if (alertDiv.parentElement) {
                alertDiv.remove();
            }
        }, 3000);
    }

    // Make showAlert available globally
    window.showAlert = showAlert;

    // Add CSS animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .notification {
            border-left: 4px solid;
        }
        
        .notification-info { border-left-color: #3b82f6; }
        .notification-success { border-left-color: #10b981; }
        .notification-warning { border-left-color: #f59e0b; }
        .notification-danger { border-left-color: #ef4444; }
        
        .notification-content {
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .notification-close,
        .alert-close {
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            color: #6b7280;
            padding: 0;
            margin-left: 1rem;
        }
        
        .notification-close:hover,
        .alert-close:hover {
            color: #1f2937;
        }
        
        .search-result-item {
            padding: 0.75rem;
            border-bottom: 1px solid #e5e7eb;
            cursor: pointer;
        }
        
        .search-result-item:hover {
            background: #f9fafb;
        }
        
        .result-title {
            font-weight: 500;
            color: #1f2937;
        }
        
        .result-type {
            font-size: 0.875rem;
            color: #6b7280;
            text-transform: uppercase;
        }
        
        .no-results {
            padding: 0.75rem;
            text-align: center;
            color: #6b7280;
        }
        
        .dynamic-field {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            align-items: center;
        }
        
        .dynamic-field input,
        .dynamic-field select {
            flex: 1;
        }
        
        .tooltip {
            pointer-events: none;
        }
        
        .chart-container {
            position: relative;
            height: 200px;
            margin: 1rem 0;
        }
    `;
    document.head.appendChild(style);

    // Initialize tooltips on dynamic content
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.addedNodes.length) {
                initTooltips();
            }
        });
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });

    // Form field validation on input
    const formFields = document.querySelectorAll('input, select, textarea');
    formFields.forEach(field => {
        field.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                this.style.borderColor = '#ef4444';
            } else if (this.type === 'email' && this.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                this.style.borderColor = emailRegex.test(this.value) ? '' : '#ef4444';
            } else {
                this.style.borderColor = '';
            }
        });
    });

    // Confirm dialog for destructive actions
    const confirmButtons = document.querySelectorAll('[data-confirm]');
    confirmButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const message = this.getAttribute('data-confirm') || 'Are you sure?';
            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });

    // Print functionality
    const printButtons = document.querySelectorAll('[data-print]');
    printButtons.forEach(button => {
        button.addEventListener('click', function() {
            const printTarget = document.querySelector(this.getAttribute('data-print'));
            if (printTarget) {
                window.print();
            }
        });
    });

    // Export functionality (demo)
    const exportButtons = document.querySelectorAll('[data-export]');
    exportButtons.forEach(button => {
        button.addEventListener('click', function() {
            const format = this.getAttribute('data-export');
            showNotification(`Exporting as ${format.toUpperCase()}...`, 'info');
            setTimeout(() => {
                showNotification(`Export completed successfully!`, 'success');
            }, 2000);
        });
    });

    console.log('SAP Consulting Platform JavaScript initialized successfully!');
});

// Utility functions
function formatCurrency(amount) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
    }).format(amount);
}

function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
}

function formatDateTime(dateString) {
    return new Date(dateString).toLocaleString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Make utility functions available globally
window.formatCurrency = formatCurrency;
window.formatDate = formatDate;
window.formatDateTime = formatDateTime;