/**
 * Main JavaScript for HungPhat WebService
 */

document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    // 1. STICKY HEADER & BACK TO TOP
    const header = document.getElementById('main-header');
    const backToTopBtn = document.getElementById('back-to-top');

    window.addEventListener('scroll', function () {
        const scrollPos = window.scrollY;

        if (header) {
            if (scrollPos > 40) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }

        if (backToTopBtn) {
            if (scrollPos > 400) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        }
    });

    if (backToTopBtn) {
        backToTopBtn.addEventListener('click', function () {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // 2. MOBILE MENU TOGGLE
    const mobileToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', function () {
            mobileMenu.classList.toggle('open');
            const isOpen = mobileMenu.classList.contains('open');
            mobileToggle.setAttribute('aria-expanded', isOpen);
        });

        // Close mobile menu when a nav link is clicked
        const mobileLinks = mobileMenu.querySelectorAll('.mobile-nav-link, .btn');
        mobileLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                mobileMenu.classList.remove('open');
            });
        });
    }

    // 3. SMOOTH SCROLL WITH HEADER OFFSET
    const internalLinks = document.querySelectorAll('a[href^="#"]');
    internalLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#' || targetId === '') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                const headerHeight = header ? header.offsetHeight : 70;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerHeight;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // 4. AUTO-SELECT SERVICE / PACKAGE IN FORM WHEN CLICKING CTAs
    const serviceSelect = document.getElementById('lead_service');
    const budgetSelect = document.getElementById('lead_budget');

    // Service card CTAs
    const selectServiceBtns = document.querySelectorAll('.select-service-btn');
    selectServiceBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            const serviceName = this.getAttribute('data-service');
            if (serviceSelect && serviceName) {
                for (let i = 0; i < serviceSelect.options.length; i++) {
                    if (serviceSelect.options[i].text.includes(serviceName) || serviceSelect.options[i].value.includes(serviceName)) {
                        serviceSelect.selectedIndex = i;
                        break;
                    }
                }
            }
        });
    });

    // Pricing package CTAs
    const selectPricingBtns = document.querySelectorAll('.select-pricing-btn');
    selectPricingBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            const packageName = this.getAttribute('data-package');
            if (budgetSelect && packageName) {
                for (let i = 0; i < budgetSelect.options.length; i++) {
                    if (budgetSelect.options[i].text.includes(packageName) || budgetSelect.options[i].value.includes(packageName)) {
                        budgetSelect.selectedIndex = i;
                        break;
                    }
                }
            }
        });
    });

    // 5. PORTFOLIO FILTER
    const filterBtns = document.querySelectorAll('.filter-btn');
    const portfolioCards = document.querySelectorAll('.portfolio-card');

    if (filterBtns.length > 0 && portfolioCards.length > 0) {
        filterBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filterValue = this.getAttribute('data-filter');

                portfolioCards.forEach(function (card) {
                    const cardCategory = card.getAttribute('data-category');
                    if (filterValue === 'all' || cardCategory === filterValue) {
                        card.style.display = 'flex';
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 50);
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(15px)';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 250);
                    }
                });
            });
        });
    }

    // 6. PORTFOLIO PREVIEW MODAL
    const modal = document.getElementById('project-modal');
    const modalBackdrop = document.getElementById('modal-backdrop');
    const modalClose = document.getElementById('modal-close');
    const modalBody = document.getElementById('modal-body-content');
    const demoBtns = document.querySelectorAll('.btn-preview-demo');

    function openModal(data) {
        if (!modal || !modalBody) return;

        let imgHtml = '';
        if (data.img) {
            imgHtml = `
                <div style="margin-bottom: 16px; border-radius: 8px; overflow: hidden; border: 1px solid #e2e8f0; max-height: 260px;">
                    <img src="${data.img}" alt="${data.title}" style="width: 100%; height: auto; display: block; object-fit: cover;">
                </div>
            `;
        }

        modalBody.innerHTML = `
            <div style="display: inline-block; padding: 4px 12px; background: #fff1f2; color: #ed1c24; font-weight: 700; border-radius: 999px; font-size: 0.8rem; margin-bottom: 12px;">
                ${data.cat || 'Dự Án Mẫu'}
            </div>
            ${imgHtml}
            <h3 style="font-size: 1.5rem; margin-bottom: 10px; color: #0f172a;">${data.title}</h3>
            <p style="color: #64748b; font-size: 0.95rem; line-height: 1.6; margin-bottom: 18px;">${data.desc}</p>
            
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                <div style="font-size: 0.8rem; font-weight: 700; color: #475569; text-transform: uppercase; margin-bottom: 6px;">Hiệu Quả Thực Tế:</div>
                <div style="font-size: 1.05rem; font-weight: 700; color: #10b981;">🚀 ${data.metrics}</div>
            </div>

            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="#tu-van" class="btn btn-primary btn-modal-select" style="flex: 1;">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Yêu Cầu Thiết Kế Giao Diện Tương Tự
                </a>
                <button type="button" class="btn btn-secondary modal-close-btn" style="padding: 12px 20px;">
                    Đóng
                </button>
            </div>
        `;

        modal.classList.add('active');
        document.body.style.overflow = 'hidden';

        // Connect modal CTA button
        const modalSelectBtn = modalBody.querySelector('.btn-modal-select');
        if (modalSelectBtn) {
            modalSelectBtn.addEventListener('click', function () {
                closeModal();
                if (serviceSelect) {
                    serviceSelect.selectedIndex = 0;
                }
            });
        }

        const modalCloseInner = modalBody.querySelector('.modal-close-btn');
        if (modalCloseInner) {
            modalCloseInner.addEventListener('click', closeModal);
        }
    }

    function closeModal() {
        if (!modal) return;
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }

    demoBtns.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            const data = {
                title: this.getAttribute('data-title'),
                cat: this.getAttribute('data-cat'),
                metrics: this.getAttribute('data-metrics'),
                desc: this.getAttribute('data-desc'),
                img: this.getAttribute('data-img')
            };
            openModal(data);
        });
    });

    if (modalBackdrop) modalBackdrop.addEventListener('click', closeModal);
    if (modalClose) modalClose.addEventListener('click', closeModal);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal && modal.classList.contains('active')) {
            closeModal();
        }
    });

    // 7. TOAST NOTIFICATION UTILITY
    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        
        const iconClass = type === 'success' ? 'fa-solid fa-circle-check' : 'fa-solid fa-triangle-exclamation';

        toast.innerHTML = `
            <i class="${iconClass} toast-icon"></i>
            <span class="toast-msg">${message}</span>
        `;

        container.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            toast.style.transition = 'all 0.3s ease';
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 5000);
    }

    // 8. CONSULTATION FORM AJAX SUBMISSION
    const form = document.getElementById('hungphat-consultation-form');
    const alertBox = document.getElementById('form-alert');
    const submitBtn = document.getElementById('btn-submit-lead');

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Clear alert
            if (alertBox) {
                alertBox.style.display = 'none';
                alertBox.className = 'form-alert';
                alertBox.innerHTML = '';
            }

            const fullname = form.querySelector('[name="fullname"]').value.trim();
            const phone = form.querySelector('[name="phone"]').value.trim();

            if (!fullname) {
                showAlert('Vui lòng nhập họ và tên của bạn.', 'error');
                form.querySelector('[name="fullname"]').focus();
                return;
            }

            if (!phone) {
                showAlert('Vui lòng nhập số điện thoại để chuyên viên tư vấn liên hệ.', 'error');
                form.querySelector('[name="phone"]').focus();
                return;
            }

            // Simple phone format check
            const phoneDigits = phone.replace(/[^0-9]/g, '');
            if (phoneDigits.length < 9 || phoneDigits.length > 12) {
                showAlert('Số điện thoại không hợp lệ. Vui lòng nhập từ 9 đến 11 chữ số.', 'error');
                form.querySelector('[name="phone"]').focus();
                return;
            }

            // Set loading state
            if (submitBtn) {
                submitBtn.disabled = true;
                const btnText = submitBtn.querySelector('.btn-text');
                const btnSpinner = submitBtn.querySelector('.btn-spinner');
                if (btnText) btnText.style.display = 'none';
                if (btnSpinner) btnSpinner.style.display = 'inline-block';
            }

            const formData = new FormData(form);
            formData.append('action', 'hungphat_submit_consultation');
            if (typeof hungphat_vars !== 'undefined') {
                formData.append('nonce', hungphat_vars.nonce);
            }

            const ajaxUrl = (typeof hungphat_vars !== 'undefined') ? hungphat_vars.ajax_url : '/wp-admin/admin-ajax.php';

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                resetSubmitBtn();

                if (data.success) {
                    showAlert(data.data.message || 'Gửi yêu cầu tư vấn thành công!', 'success');
                    showToast(data.data.message || 'Gửi yêu cầu tư vấn thành công!', 'success');
                    form.reset();
                } else {
                    const err = data.data && data.data.message ? data.data.message : 'Đã có lỗi xảy ra. Vui lòng thử lại sau.';
                    showAlert(err, 'error');
                    showToast(err, 'error');
                }
            })
            .catch(error => {
                resetSubmitBtn();
                console.error('Error submitting form:', error);
                const errMsg = 'Lỗi kết nối máy chủ. Vui lòng gọi trực tiếp hotline để được hỗ trợ.';
                showAlert(errMsg, 'error');
                showToast(errMsg, 'error');
            });
        });
    }

    function showAlert(message, type = 'success') {
        if (!alertBox) return;
        alertBox.className = `form-alert form-alert-${type}`;
        alertBox.innerHTML = message;
        alertBox.style.display = 'block';
    }

    function resetSubmitBtn() {
        if (!submitBtn) return;
        submitBtn.disabled = false;
        const btnText = submitBtn.querySelector('.btn-text');
        const btnSpinner = submitBtn.querySelector('.btn-spinner');
        if (btnText) btnText.style.display = 'inline-block';
        if (btnSpinner) btnSpinner.style.display = 'none';
    }

    // 8. HERO STATS COUNTER & SCROLL ANIMATION
    const statsGrid = document.querySelector('.hero-stats-grid');
    if (statsGrid) {
        const statCards = statsGrid.querySelectorAll('.stat-card');
        const statNumbers = statsGrid.querySelectorAll('.stat-number');
        let animated = false;

        function runStatsAnimation() {
            if (animated) return;
            animated = true;

            statCards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('stat-animate-in');
                }, index * 100);
            });

            statNumbers.forEach((el) => {
                const targetText = el.getAttribute('data-target') || el.textContent.trim();
                animateNumberText(el, targetText);
            });
        }

        function animateNumberText(el, targetText) {
            const duration = 1600;
            const startTime = performance.now();

            // Range format e.g. "7 - 10 Ngày"
            if (targetText.includes('-')) {
                const nums = targetText.match(/\d+/g);
                if (nums && nums.length >= 2) {
                    const n1 = parseInt(nums[0], 10);
                    const n2 = parseInt(nums[1], 10);
                    const suffix = targetText.replace(/^[0-9\s\-]+/, ' ');
                    function frame(now) {
                        const progress = Math.min((now - startTime) / duration, 1);
                        const ease = 1 - Math.pow(1 - progress, 3);
                        const cur1 = Math.floor(ease * n1);
                        const cur2 = Math.floor(ease * n2);
                        el.textContent = `${cur1} - ${cur2}${suffix}`;
                        if (progress < 1) {
                            requestAnimationFrame(frame);
                        } else {
                            el.textContent = targetText;
                        }
                    }
                    requestAnimationFrame(frame);
                    return;
                }
            }

            // Fraction format e.g. "24/7"
            if (targetText.includes('/')) {
                const parts = targetText.split('/');
                const n1 = parseInt(parts[0], 10) || 24;
                const n2 = parts[1] || '7';
                function frame(now) {
                    const progress = Math.min((now - startTime) / duration, 1);
                    const ease = 1 - Math.pow(1 - progress, 3);
                    const cur1 = Math.floor(ease * n1);
                    el.textContent = `${cur1}/${n2}`;
                    if (progress < 1) {
                        requestAnimationFrame(frame);
                    } else {
                        el.textContent = targetText;
                    }
                }
                requestAnimationFrame(frame);
                return;
            }

            // Standard numeric format e.g. "9+ Năm", "100%"
            const match = targetText.match(/\d+/);
            if (match) {
                const targetNum = parseInt(match[0], 10);
                const prefix = targetText.substring(0, match.index);
                const suffix = targetText.substring(match.index + match[0].length);
                function frame(now) {
                    const progress = Math.min((now - startTime) / duration, 1);
                    const ease = 1 - Math.pow(1 - progress, 3);
                    const cur = Math.floor(ease * targetNum);
                    el.textContent = `${prefix}${cur}${suffix}`;
                    if (progress < 1) {
                        requestAnimationFrame(frame);
                    } else {
                        el.textContent = targetText;
                    }
                }
                requestAnimationFrame(frame);
            }
        }

        // Trigger on Scroll or immediately if in view on load / F5
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        runStatsAnimation();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15 });
            observer.observe(statsGrid);
        } else {
            runStatsAnimation();
        }
    }
});
