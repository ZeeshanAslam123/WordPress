<?php
/**
 * Plugin Page Template - Your Custom Design
 * 
 * This template displays the plugin landing page with your exact styling
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get plugin data
$plugin_name = get_post_meta($post->ID, '_plugin_name', true) ?: $post->post_title;
$plugin_price = get_post_meta($post->ID, '_plugin_price', true) ?: '29';
$plugin_original_price = get_post_meta($post->ID, '_plugin_original_price', true) ?: '';
$hero_subtitle = get_post_meta($post->ID, '_hero_subtitle', true) ?: 'Organize your LearnDash courses like a pro — cleaner, faster, smarter.';
$buy_now_shortcode = get_post_meta($post->ID, '_buy_now_shortcode', true) ?: '';
$featured_image = get_the_post_thumbnail_url($post->ID, 'large') ?: plugin_dir_url(__FILE__) . '../assets/images/plugin-preview.png';

// Get features
$plugin_features = get_post_meta($post->ID, '_plugin_features', true);
if (empty($plugin_features) || !is_array($plugin_features)) {
    $plugin_features = array(
        array('title' => 'Super Lightweight', 'description' => 'No jQuery, ultra-fast loading speed and tiny footprint.', 'icon' => 'lightning'),
        array('title' => 'Sleek Design', 'description' => 'Matches your LearnDash theme perfectly for a native feel.', 'icon' => 'pen'),
        array('title' => 'Smart State Save', 'description' => 'Remembers open/closed sections automatically across visits.', 'icon' => 'save'),
        array('title' => 'Fully Accessible', 'description' => 'Keyboard + screen reader friendly interactions out-of-the-box.', 'icon' => 'circle')
    );
}

$plugin_testimonials = get_post_meta($post->ID, '_plugin_testimonials', true);
if (empty($plugin_testimonials) || !is_array($plugin_testimonials)) {
    $plugin_testimonials = array(
        array('content' => 'Saved me hours of layout work — simple & reliable.', 'author' => 'Ayesha F.', 'title' => 'Course Creator', 'rating' => 5),
        array('content' => 'Lightweight plugin that just works with my custom theme.', 'author' => 'Hamza K.', 'title' => 'Dev', 'rating' => 5),
        array('content' => 'Students love the clearer navigation. 10/10.', 'author' => 'Maria G.', 'title' => 'Instructor', 'rating' => 5)
    );
}

$plugin_faq = get_post_meta($post->ID, '_plugin_faq', true);
if (empty($plugin_faq) || !is_array($plugin_faq)) {
    $plugin_faq = array(
        array('question' => 'Is this compatible with LearnDash latest version?', 'answer' => 'Yes — the plugin is designed to work with LearnDash 3.x and forward compatible updates.'),
        array('question' => 'Can I style the sections to match my theme?', 'answer' => 'Absolutely. It exposes CSS classes and hooks for easy customization.'),
        array('question' => 'Does it remember open/closed state for users?', 'answer' => 'Yes — it uses localStorage for per-user state-saving and falls back gracefully.')
    );
}

$plugin_checklist = get_post_meta($post->ID, '_plugin_checklist', true);
if (empty($plugin_checklist) || !is_array($plugin_checklist)) {
    $plugin_checklist = array(
        'Collapse/Expand Sections',
        'Auto Save State', 
        'Theme Compatibility',
        'Developer Friendly Hooks'
    );
}

// Function to get feature icon SVG
function get_feature_icon($icon_type) {
    switch($icon_type) {
        case 'lightning':
            return '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13 2L3 14h7l-1 8 10-12h-7l1-8z" fill="#4a8bbd"/></svg>';
        case 'pen':
            return '<svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25z" fill="#4a8bbd"/><path d="M20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" fill="#82bfe4"/></svg>';
        case 'save':
            return '<svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M17 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7l-4-4z" fill="#4a8bbd"/><path d="M17 3v4H7V3" fill="#82bfe4"/></svg>';
        case 'circle':
        default:
            return '<svg width="22" height="22" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" fill="#bcdff6"/></svg>';
    }
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title><?php echo esc_html($plugin_name); ?> — Plugin Landing</title>

<!-- Google Font (close to the image feel) -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<style>
  :root{
    --page-bg: #fbfdff;
    --card-bg: #ffffff;
    --muted:#6b747b;
    --accent:#5fa0d8; /* blue used in image */
    --accent-dark:#4a8bbd;
    --text:#1f2b33;
    --soft:#f3f7fb;
    --shadow: 0 10px 30px rgba(29,42,63,0.06);
    --glass: linear-gradient(180deg, rgba(243,247,251,1) 0%, rgba(255,255,255,1) 100%);
    font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
  }

  html,body{
    height:100%;
    margin:0;
    background:var(--page-bg);
    color:var(--text);
    -webkit-font-smoothing:antialiased;
    -moz-osx-font-smoothing:grayscale;
    line-height:1.45;
  }

  .container{
    max-width:1150px;
    margin:40px auto;
    padding:24px;
  }

  /* HERO */
  .hero{
    display:flex;
    gap:48px;
    align-items:center;
    padding:28px;
  }

  .hero-left{
    flex:1;
    min-width:280px;
  }

  .logo-row{
    display:flex;
    gap:12px;
    align-items:center;
    margin-bottom:16px;
  }
  .logo-mark{
    width:48px;height:48px;border-radius:8px;
    display:inline-grid;place-items:center;
    background:var(--soft);
    box-shadow:var(--shadow);
  }
  .logo-mark svg{opacity:0.95}

  .rating{
    margin-bottom:16px;
    display:inline-flex;
    gap:10px;
    align-items:center;
    background:rgba(255,255,255,0.9);
    padding:6px 12px;
    border-radius:12px;
    box-shadow: 0 4px 10px rgba(20,30,40,0.04);
    font-weight:600;
    color:var(--muted);
  }
  .rating .stars{display:inline-flex;gap:4px; color:#f5c158; font-weight:700; font-size:14px}

  h1.title{
    font-size:44px;
    margin:6px 0 12px;
    font-weight:800;
    letter-spacing:-0.6px;
    color:var(--text);
  }

  p.lead{
    margin:0 0 22px;
    color:var(--muted);
    font-size:16px;
    max-width:620px;
  }

  .hero-ctas{
    display:flex;
    gap:14px;
    margin-top:6px;
  }

  .btn{
    display:inline-flex;
    align-items:center;
    gap:10px;
    border:0;
    cursor:pointer;
    padding:12px 20px;
    border-radius:12px;
    font-weight:700;
    box-shadow:var(--shadow);
    text-decoration:none;
  }

  .btn-primary{
    background:var(--accent);
    color:white;
    box-shadow: 0 8px 18px rgba(79,136,183,0.18);
  }

  .btn-ghost{
    background:transparent;
    border:1px solid rgba(30,40,50,0.06);
    color:var(--accent-dark);
    font-weight:600;
  }

  /* hero right mock device */
  .hero-right{
    width:420px;
    max-width:46%;
    min-width:260px;
    display:flex;
    justify-content:center;
  }

  .device{
    width:100%;
    border-radius:18px;
    padding:28px;
    background:var(--glass);
    box-shadow: 0 18px 40px rgba(25,45,65,0.06);
    transform:rotate(-6deg);
    position:relative;
  }

  .device .device-inner{
    background:white;
    border-radius:10px;
    padding:20px;
    box-shadow:0 6px 20px rgba(29,42,63,0.04);
  }

  .device h3{
    margin:0 0 12px;
    font-size:20px;
    font-weight:600;
  }

  .section-row{
    background:#fbfdff;
    padding:12px 16px;
    border-radius:8px;
    margin-bottom:10px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    color:#4f5b61;
    border:1px solid rgba(16,24,32,0.02);
  }

  /* spacing between main sections - matched to image */
  section.spaced{
    margin-top:48px;
    padding:30px 0;
    border-top:1px solid rgba(16,24,32,0.02);
  }

  /* "Why You'll Love It" and feature items */
  .features-grid{
    display:grid;
    grid-template-columns: repeat(2, 1fr);
    gap:22px 40px;
    align-items:start;
  }

  .feature-card{
    display:flex;
    gap:14px;
    align-items:flex-start;
  }

  .feature-icon{
    width:54px;height:54px;border-radius:12px;
    background:var(--soft);
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:var(--shadow);
    flex-shrink:0;
  }
  .feature-title{font-weight:700;margin:0 0 6px}
  .feature-desc{margin:0;color:var(--muted);font-size:14px}

  /* Powerful features list (checklist) */
  .checklist{
    margin-top:18px;
    display:grid;
    gap:12px;
  }
  .check{
    display:flex;
    gap:12px;
    align-items:center;
    background:white;
    padding:12px 16px;
    border-radius:12px;
    box-shadow: 0 6px 18px rgba(20,30,40,0.03);
  }
  .check svg{min-width:22px;min-height:22px}

  /* Screenshots (carousel mock) */
  .screens{
    display:flex;
    gap:16px;
    flex-wrap:wrap;
    margin-top:16px;
  }
  .ss{
    background:white;
    border-radius:14px;
    padding:14px;
    min-width:220px;
    flex:1 1 220px;
    box-shadow: 0 12px 30px rgba(29,42,63,0.04);
  }
  .ss img{display:block;width:100%;border-radius:8px;border:1px solid rgba(0,0,0,0.03)}

  /* Testimonials */
  .testimonials{
    display:grid;
    grid-template-columns:repeat(3, 1fr);
    gap:18px;
    margin-top:14px;
  }
  .test-card{
    background:white;padding:18px;border-radius:12px;box-shadow:var(--shadow);
  }
  .quote{font-weight:600;margin:0 0 8px;color:var(--text)}
  .quote-meta{font-size:13px;color:var(--muted)}

  /* FAQ */
  .faq-list{margin-top:14px;display:grid;gap:10px}
  .faq-item{
    background:white;padding:14px;border-radius:10px;box-shadow: 0 8px 20px rgba(24,36,48,0.03);
  }
  .faq-q{display:flex;justify-content:space-between;align-items:center;cursor:pointer;font-weight:700}
  .faq-a{margin-top:8px;color:var(--muted);display:none}
  .faq-open .faq-a{display:block}

  /* Bottom CTA */
  .bottom-cta{
    margin-top:30px;
    padding:26px;border-radius:14px;
    background:linear-gradient(90deg, rgba(95,160,216,0.06) 0%, rgba(95,160,216,0.02) 100%);
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:12px;
  }

  /* Responsive adjustments */
  @media (max-width:980px){
    .hero{flex-direction:column-reverse; align-items:flex-start;padding:16px}
    .hero-right{width:100%;max-width:none;transform:none}
    .device{transform:none;margin-top:10px}
    .features-grid{grid-template-columns:1fr}
    .testimonials{grid-template-columns:1fr}
    .hero-left{width:100%}
    .container{padding:16px}
  }

  @media (max-width:520px){
    h1.title{font-size:34px}
    .device{padding:18px}
    .logo-mark{width:44px;height:44px}
    .rating{font-size:13px}
    .btn{padding:10px 14px;font-size:14px}
  }
</style>
</head>
<body>

<div class="container">

  <!-- HERO -->
  <section class="hero" aria-label="Hero">
    <div class="hero-left">
      <div class="logo-row">
        <div class="logo-mark" aria-hidden="true">
          <!-- simple 3-lines mark -->
          <svg width="28" height="24" viewBox="0 0 28 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="2" y="2" width="20" height="4" rx="2" fill="#5fa0d8"/>
            <rect x="2" y="10" width="16" height="4" rx="2" fill="#82bfe4"/>
            <rect x="2" y="18" width="12" height="4" rx="2" fill="#bcdff6"/>
          </svg>
        </div>
        <div>
          <div style="font-weight:800;letter-spacing:0.2px">COLLAPSIBLE<br>SECTIONS</div>
        </div>
      </div>

      <div class="rating" aria-hidden="true">
        <div class="stars">★ ★ ★ ★ ★</div>
        <div style="font-size:15px">5.0</div>
      </div>

      <h1 class="title"><?php echo esc_html($plugin_name); ?></h1>
      <p class="lead"><?php echo esc_html($hero_subtitle); ?></p>

      <div class="hero-ctas">
        <?php if ($buy_now_shortcode): ?>
            <?php echo do_shortcode($buy_now_shortcode); ?>
        <?php else: ?>
            <button class="btn btn-primary">Buy Now - $<?php echo esc_html($plugin_price); ?></button>
        <?php endif; ?>
        <a href="#" class="btn btn-ghost">Live Demo</a>
      </div>
    </div>

    <div class="hero-right" aria-hidden="true">
      <div class="device" role="img" aria-label="Product preview">
        <div class="device-inner">
          <h3>Introduction to LearnDash</h3>

          <div class="section-row">Getting Started <span>▾</span></div>
          <div class="section-row">The Basics <span>▾</span></div>
          <div class="section-row">Setting Up Your Course <span>▾</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- WHY YOU'LL LOVE IT -->
  <section class="spaced" aria-label="Why You'll Love It">
    <div style="display:flex;gap:28px;align-items:flex-start;flex-wrap:wrap;">
      <div style="flex:1;min-width:320px;">
        <h2 style="font-size:32px;margin:4px 0 18px;font-weight:800">Why You'll Love It</h2>

        <div class="features-grid">
          <?php foreach ($plugin_features as $feature): ?>
          <div class="feature-card">
            <div class="feature-icon" aria-hidden="true">
              <?php echo get_feature_icon($feature['icon']); ?>
            </div>
            <div>
              <p class="feature-title"><?php echo esc_html($feature['title']); ?></p>
              <p class="feature-desc"><?php echo esc_html($feature['description']); ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div style="flex:0 0 320px; min-width:260px;">
        <div style="background:white;padding:18px;border-radius:14px;box-shadow:var(--shadow);">
          <h4 style="margin:0 0 12px">The Basics</h4>

          <div style="background:var(--soft);padding:12px;border-radius:10px;margin-bottom:8px">
            <strong>Setting Up</strong>
            <div style="color:var(--muted);margin-top:8px">Your Course</div>
          </div>

          <div style="background:var(--soft);padding:12px;border-radius:10px">
            <strong>Custom Styles</strong>
            <div style="color:var(--muted);margin-top:8px">Match your look</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- POWERFUL FEATURES -->
  <section class="spaced" aria-label="Powerful Features">
    <h2 style="font-size:30px;margin:0 0 12px;font-weight:800;">Powerful Features That Simplify Your Course Layout</h2>

    <div class="checklist">
      <?php foreach ($plugin_checklist as $item): ?>
      <div class="check">
        <svg viewBox="0 0 24 24" width="20" height="20">
          <circle cx="12" cy="12" r="10" fill="#eaf6fc"/>
          <path d="M9 12.5l1.8 1.8L15 10" stroke="#2b7fb3" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        </svg>
        <div style="font-weight:700"><?php echo esc_html($item); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- SCREENSHOTS -->
  <section class="spaced" aria-label="Screenshots">
    <h3 style="font-size:24px;margin:0 0 12px;font-weight:800">Screenshots & Demo Preview</h3>

    <div class="screens" aria-hidden="true">
      <div class="ss"><img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='600' height='380'><rect width='100%' height='100%' fill='%23f7fbff'/><text x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' fill='%239bbfe0' font-family='Inter' font-size='20'>Screenshot 1</text></svg>" alt="screenshot 1"></div>
      <div class="ss"><img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='600' height='380'><rect width='100%' height='100%' fill='%23f7fbff'/><text x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' fill='%239bbfe0' font-family='Inter' font-size='20'>Screenshot 2</text></svg>" alt="screenshot 2"></div>
      <div class="ss"><img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='600' height='380'><rect width='100%' height='100%' fill='%23f7fbff'/><text x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' fill='%239bbfe0' font-family='Inter' font-size='20'>Screenshot 3</text></svg>" alt="screenshot 3"></div>
    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section class="spaced" aria-label="Testimonials">
    <h3 style="font-size:24px;margin:0 0 12px;font-weight:800">What People Are Saying</h3>

    <div class="testimonials" role="list">
      <?php foreach ($plugin_testimonials as $testimonial): ?>
      <div class="test-card" role="listitem">
        <div class="quote">"<?php echo esc_html($testimonial['content']); ?>"</div>
        <div class="quote-meta">— <?php echo esc_html($testimonial['author']); ?>, <?php echo esc_html($testimonial['title']); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- FAQ -->
  <section class="spaced" aria-label="FAQ">
    <h3 style="font-size:24px;margin:0 0 12px;font-weight:800">FAQ</h3>

    <div class="faq-list">
      <?php foreach ($plugin_faq as $index => $faq): ?>
      <div class="faq-item" id="f<?php echo $index + 1; ?>">
        <div class="faq-q"><?php echo esc_html($faq['question']); ?> <span>+</span></div>
        <div class="faq-a"><?php echo esc_html($faq['answer']); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- BOTTOM CTA -->
  <section class="spaced" aria-label="Purchase CTA">
    <div class="bottom-cta">
      <div>
        <div style="font-weight:800;font-size:18px">Ready to organize your courses?</div>
        <div style="color:var(--muted);margin-top:6px">Buy now and get updates + support for one year.</div>
      </div>

      <div style="display:flex;gap:12px;align-items:center">
        <?php if ($buy_now_shortcode): ?>
            <?php echo do_shortcode($buy_now_shortcode); ?>
        <?php else: ?>
            <button class="btn btn-primary">Buy Now - $<?php echo esc_html($plugin_price); ?></button>
        <?php endif; ?>
        <a href="#" class="btn btn-ghost">Live Demo</a>
      </div>
    </div>
  </section>

</div>

<script>
  // FAQ accordion simple behavior
  document.querySelectorAll('.faq-item').forEach(item=>{
    item.querySelector('.faq-q').addEventListener('click',()=>{
      const isOpen = item.classList.contains('faq-open');
      // close others
      document.querySelectorAll('.faq-item').forEach(i=>i.classList.remove('faq-open'));
      if(!isOpen) item.classList.add('faq-open');
    });
  });

  // small focus styles for keyboard
  document.querySelectorAll('.btn').forEach(b=>{
    b.addEventListener('keydown', e=>{
      if(e.key === 'Enter' || e.key === ' '){
        e.preventDefault();
        b.click();
      }
    });
  });
</script>
</body>
</html>

