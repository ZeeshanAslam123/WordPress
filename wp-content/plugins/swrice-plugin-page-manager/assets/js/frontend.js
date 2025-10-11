/**
 * Swrice Plugin Page Manager - Frontend JavaScript
 */

(function($) {
    'use strict';
    
    $(document).ready(function() {
        
        // Initialize animations
        initScrollAnimations();
        
        // Initialize smooth scrolling
        initSmoothScrolling();
        
        // Initialize FAQ toggles
        initFAQToggles();
        
        // Initialize pricing animations
        initPricingAnimations();
        
        // Initialize testimonial sliders
        initTestimonialSliders();
        
    });
    
    /**
     * Initialize scroll animations
     */
    function initScrollAnimations() {
        // Add fade-in class to sections
        $('.sppm-section').addClass('sppm-fade-in');
        
        // Intersection Observer for animations
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('sppm-visible');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            $('.sppm-fade-in').each(function() {
                observer.observe(this);
            });
        } else {
            // Fallback for older browsers
            $('.sppm-fade-in').addClass('sppm-visible');
        }
    }
    
    /**
     * Initialize smooth scrolling
     */
    function initSmoothScrolling() {
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 800, 'easeInOutQuad');
            }
        });
    }
    
    /**
     * Initialize FAQ toggles
     */
    function initFAQToggles() {
        // Create FAQ toggle functionality
        $('.sppm-faq-section').on('click', 'h3, h4', function() {
            const $this = $(this);
            const $content = $this.next('p, div');
            
            if ($content.length) {
                $content.slideToggle(300);
                $this.toggleClass('sppm-faq-open');
            }
        });
        
        // Style FAQ items
        $('.sppm-faq-section h3, .sppm-faq-section h4').css({
            'cursor': 'pointer',
            'position': 'relative',
            'padding-right': '30px'
        }).after('<span class="sppm-faq-toggle">+</span>');
        
        $('.sppm-faq-toggle').css({
            'position': 'absolute',
            'right': '0',
            'top': '50%',
            'transform': 'translateY(-50%)',
            'font-size': '1.5rem',
            'font-weight': 'bold',
            'transition': 'transform 0.3s ease'
        });
        
        // Hide FAQ content initially
        $('.sppm-faq-section h3 + p, .sppm-faq-section h4 + p, .sppm-faq-section h3 + div, .sppm-faq-section h4 + div').hide();
        
        // Update toggle icon
        $('.sppm-faq-section').on('click', 'h3, h4', function() {
            const $toggle = $(this).find('.sppm-faq-toggle');
            if ($(this).hasClass('sppm-faq-open')) {
                $toggle.text('-').css('transform', 'translateY(-50%) rotate(180deg)');
            } else {
                $toggle.text('+').css('transform', 'translateY(-50%) rotate(0deg)');
            }
        });
    }
    
    /**
     * Initialize pricing animations
     */
    function initPricingAnimations() {
        // Animate pricing card on scroll
        const $pricingCard = $('.sppm-pricing-card');
        
        if ($pricingCard.length) {
            $(window).on('scroll', function() {
                const scrollTop = $(window).scrollTop();
                const cardOffset = $pricingCard.offset().top;
                const windowHeight = $(window).height();
                
                if (scrollTop + windowHeight > cardOffset + 100) {
                    $pricingCard.addClass('sppm-pricing-animated');
                }
            });
        }
        
        // Add hover effects to buy buttons
        $('.sppm-buy-now-btn').hover(
            function() {
                $(this).css('transform', 'translateY(-3px) scale(1.05)');
            },
            function() {
                $(this).css('transform', 'translateY(0) scale(1)');
            }
        );
    }
    
    /**
     * Initialize testimonial sliders
     */
    function initTestimonialSliders() {
        const $testimonials = $('.sppm-testimonials-section .testimonial, .sppm-testimonials-section blockquote');
        
        if ($testimonials.length > 1) {
            let currentTestimonial = 0;
            
            // Hide all testimonials except first
            $testimonials.hide().first().show();
            
            // Auto-rotate testimonials
            setInterval(function() {
                $testimonials.eq(currentTestimonial).fadeOut(500, function() {
                    currentTestimonial = (currentTestimonial + 1) % $testimonials.length;
                    $testimonials.eq(currentTestimonial).fadeIn(500);
                });
            }, 5000);
        }
    }
    
    /**
     * Add custom easing function
     */
    $.easing.easeInOutQuad = function(x, t, b, c, d) {
        if ((t /= d / 2) < 1) return c / 2 * t * t + b;
        return -c / 2 * ((--t) * (t - 2) - 1) + b;
    };
    
    /**
     * Add scroll-to-top functionality
     */
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            if (!$('.sppm-scroll-top').length) {
                $('body').append('<button class="sppm-scroll-top">↑</button>');
                $('.sppm-scroll-top').css({
                    'position': 'fixed',
                    'bottom': '30px',
                    'right': '30px',
                    'width': '50px',
                    'height': '50px',
                    'border-radius': '50%',
                    'background': '#27ae60',
                    'color': 'white',
                    'border': 'none',
                    'font-size': '20px',
                    'cursor': 'pointer',
                    'z-index': '9999',
                    'transition': 'all 0.3s ease',
                    'box-shadow': '0 5px 15px rgba(39, 174, 96, 0.3)'
                }).hover(
                    function() {
                        $(this).css('transform', 'translateY(-3px)');
                    },
                    function() {
                        $(this).css('transform', 'translateY(0)');
                    }
                ).click(function() {
                    $('html, body').animate({scrollTop: 0}, 800);
                });
            }
        } else {
            $('.sppm-scroll-top').remove();
        }
    });
    
    /**
     * Add loading animation for buy buttons
     */
    $(document).on('click', '.sppm-buy-now-btn', function() {
        const $btn = $(this);
        const originalText = $btn.text();
        
        $btn.text('Processing...').prop('disabled', true);
        
        // Reset after 3 seconds (in case the redirect doesn't happen)
        setTimeout(function() {
            $btn.text(originalText).prop('disabled', false);
        }, 3000);
    });
    
    /**
     * Add parallax effect to hero section
     */
    $(window).scroll(function() {
        const scrolled = $(window).scrollTop();
        const $hero = $('.sppm-hero');
        
        if ($hero.length) {
            const rate = scrolled * -0.5;
            $hero.css('transform', 'translateY(' + rate + 'px)');
        }
    });
    
    /**
     * Add typing effect to hero title
     */
    function initTypingEffect() {
        const $title = $('.sppm-hero-title');
        if ($title.length && $title.data('typing') !== false) {
            const text = $title.text();
            $title.text('');
            
            let i = 0;
            const typeWriter = function() {
                if (i < text.length) {
                    $title.text($title.text() + text.charAt(i));
                    i++;
                    setTimeout(typeWriter, 50);
                }
            };
            
            setTimeout(typeWriter, 500);
        }
    }
    
    // Initialize typing effect after page load
    $(window).on('load', function() {
        initTypingEffect();
    });
    
    /**
     * Add countdown timer functionality
     */
    function initCountdownTimer() {
        const $countdown = $('.sppm-countdown');
        if ($countdown.length) {
            const endDate = new Date($countdown.data('end-date')).getTime();
            
            const timer = setInterval(function() {
                const now = new Date().getTime();
                const distance = endDate - now;
                
                if (distance < 0) {
                    clearInterval(timer);
                    $countdown.html('<span class="sppm-countdown-expired">Offer Expired!</span>');
                    return;
                }
                
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
                $countdown.html(
                    '<div class="sppm-countdown-item"><span>' + days + '</span><label>Days</label></div>' +
                    '<div class="sppm-countdown-item"><span>' + hours + '</span><label>Hours</label></div>' +
                    '<div class="sppm-countdown-item"><span>' + minutes + '</span><label>Minutes</label></div>' +
                    '<div class="sppm-countdown-item"><span>' + seconds + '</span><label>Seconds</label></div>'
                );
            }, 1000);
        }
    }
    
    initCountdownTimer();
    
})(jQuery);
