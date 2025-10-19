<?php
/**
 * Video Tutorial Section Template - Hero-Style Layout
 */

if (!defined('ABSPATH')) exit;

$video_heading = isset($attributes['videoTutorialHeading']) ? $attributes['videoTutorialHeading'] : 'Video Tutorial';
$video_icon = isset($attributes['videoTutorialIcon']) ? $attributes['videoTutorialIcon'] : '🎥';
$video_description = isset($attributes['videoTutorialDescription']) ? $attributes['videoTutorialDescription'] : '';
$video_url = isset($attributes['videoUrl']) ? $attributes['videoUrl'] : '';
$video_title = isset($attributes['videoTitle']) ? $attributes['videoTitle'] : 'Plugin Tutorial';
$video_duration = isset($attributes['videoDuration']) ? $attributes['videoDuration'] : '';
$video_thumbnail = isset($attributes['videoThumbnailUrl']) ? $attributes['videoThumbnailUrl'] : '';

if (empty($video_url)) return;

// Parse video URL to determine type and extract ID
$video_type = '';
$video_id = '';
$embed_url = '';

if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
    $video_type = 'youtube';
    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/', $video_url, $matches)) {
        $video_id = $matches[1];
        $embed_url = 'https://www.youtube.com/embed/' . $video_id;
        if (empty($video_thumbnail)) {
            $video_thumbnail = 'https://img.youtube.com/vi/' . $video_id . '/maxresdefault.jpg';
        }
    }
} elseif (strpos($video_url, 'vimeo.com') !== false) {
    $video_type = 'vimeo';
    if (preg_match('/vimeo\.com\/(\d+)/', $video_url, $matches)) {
        $video_id = $matches[1];
        $embed_url = 'https://player.vimeo.com/video/' . $video_id;
    }
} else {
    $video_type = 'direct';
    $embed_url = $video_url;
}
?>

<section class="sppm-section sppm-video-tutorial-section">
    <!-- Hero-Style Layout: Content Left, Video Right -->
    <div class="sppm-video-hero">
        <!-- Left Side: Content -->
        <div class="sppm-video-content">
            <div class="sppm-video-header">
                <h2 class="sppm-section-title">
                    <?php if ($video_icon): ?><span class="sppm-section-icon"><?php echo $video_icon; ?></span><?php endif; ?>
                    <?php echo esc_html($video_heading); ?>
                </h2>
                <?php if ($video_description): ?>
                <p class="sppm-section-description"><?php echo esc_html($video_description); ?></p>
                <?php endif; ?>
            </div>
            
            <div class="sppm-video-details">
                <h3 class="sppm-video-title"><?php echo esc_html($video_title); ?></h3>
                
                <div class="sppm-video-meta">
                    <?php if ($video_duration): ?>
                    <div class="sppm-meta-item">
                        <div class="sppm-meta-icon">⏱️</div>
                        <span>Duration: <?php echo esc_html($video_duration); ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <div class="sppm-meta-item">
                        <div class="sppm-meta-icon">
                            <?php if ($video_type === 'youtube'): ?>📺
                            <?php elseif ($video_type === 'vimeo'): ?>🎬
                            <?php else: ?>🎥<?php endif; ?>
                        </div>
                        <span>
                            <?php if ($video_type === 'youtube'): ?>YouTube Tutorial
                            <?php elseif ($video_type === 'vimeo'): ?>Vimeo Tutorial
                            <?php else: ?>Video Tutorial<?php endif; ?>
                        </span>
                    </div>
                </div>
                
                <div class="sppm-video-features">
                    <div class="sppm-feature-item">
                        <div class="sppm-feature-icon">✅</div>
                        <span>Step-by-step walkthrough</span>
                    </div>
                    <div class="sppm-feature-item">
                        <div class="sppm-feature-icon">🎯</div>
                        <span>Easy to follow along</span>
                    </div>
                    <div class="sppm-feature-item">
                        <div class="sppm-feature-icon">⚡</div>
                        <span>Quick setup guide</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Side: Video -->
        <div class="sppm-video-player-container">
            <div class="sppm-video-wrapper">
                <?php if ($video_type === 'direct'): ?>
                    <!-- Direct Video -->
                    <video class="sppm-video-player" controls poster="<?php echo esc_url($video_thumbnail); ?>">
                        <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                <?php else: ?>
                    <!-- Embedded Video with Custom Play Button -->
                    <div class="sppm-video-embed" id="video-embed">
                        <div class="sppm-video-thumbnail" onclick="loadVideo()">
                            <?php if ($video_thumbnail): ?>
                            <img src="<?php echo esc_url($video_thumbnail); ?>" alt="<?php echo esc_attr($video_title); ?>">
                            <?php endif; ?>
                            <div class="sppm-play-button">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                                    <path d="M8 5V19L19 12L8 5Z" fill="currentColor"/>
                                </svg>
                            </div>
                            <?php if ($video_duration): ?>
                            <div class="sppm-video-duration-badge"><?php echo esc_html($video_duration); ?></div>
                            <?php endif; ?>
                        </div>
                        <iframe id="video-iframe" 
                                src="" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen
                                style="display: none;"></iframe>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
function loadVideo() {
    const embedContainer = document.getElementById('video-embed');
    const thumbnail = embedContainer.querySelector('.sppm-video-thumbnail');
    const iframe = document.getElementById('video-iframe');
    
    // Set the iframe source and show it
    iframe.src = '<?php echo esc_js($embed_url); ?>?autoplay=1';
    iframe.style.display = 'block';
    
    // Hide the thumbnail
    thumbnail.style.display = 'none';
}
</script>

<style>
/* Video Tutorial Section - Hero-Style Layout */
.sppm-video-tutorial-section {
    background: var(--card-bg);
    border-radius: 20px;
    padding: 40px;
    box-shadow: var(--shadow);
    margin: 40px 0;
}

.sppm-video-hero {
    display: flex;
    gap: 60px;
    align-items: center;
    min-height: 500px;
}

.sppm-video-content {
    flex: 1;
    width: 50%;
}

.sppm-video-header .sppm-section-title {
    text-align: left;
    justify-content: flex-start;
    font-size: 36px;
    margin-bottom: 16px;
}

.sppm-video-header .sppm-section-description {
    color: var(--muted);
    font-size: 18px;
    line-height: 1.6;
    margin-bottom: 30px;
    text-align: left;
}

.sppm-video-details {
    margin-top: 20px;
}

.sppm-video-title {
    font-size: 24px;
    font-weight: 700;
    color: var(--text);
    margin: 0 0 20px 0;
}

.sppm-video-meta {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 30px;
}

.sppm-meta-item {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 16px;
    color: var(--muted);
}

.sppm-meta-icon {
    width: 32px;
    height: 32px;
    background: var(--soft);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}

.sppm-video-features {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.sppm-feature-item {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 16px;
    color: var(--text);
}

.sppm-feature-icon {
    width: 24px;
    height: 24px;
    background: var(--accent);
    color: white;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    flex-shrink: 0;
}

.sppm-video-player-container {
    flex: 1;
    width: 50%;
    display: flex;
    justify-content: center;
}

.sppm-video-wrapper {
    position: relative;
    width: 100%;
    max-width: 500px;
    background: var(--soft);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow);
}

.sppm-video-embed {
    position: relative;
    width: 100%;
    height: 0;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
}

.sppm-video-thumbnail {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #000;
    transition: all 0.3s ease;
}

.sppm-video-thumbnail:hover {
    transform: scale(1.02);
}

.sppm-video-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.sppm-play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    background: var(--card-bg);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    color: var(--accent);
}

.sppm-play-button:hover {
    background: var(--accent);
    color: white;
    transform: translate(-50%, -50%) scale(1.1);
}

.sppm-video-duration-badge {
    position: absolute;
    bottom: 15px;
    right: 15px;
    background: rgba(0,0,0,0.8);
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
}

#video-iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 16px;
}

.sppm-video-player {
    width: 100%;
    height: auto;
    border-radius: 16px;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .sppm-video-hero {
        gap: 40px;
    }
    
    .sppm-video-header .sppm-section-title {
        font-size: 32px;
    }
}

@media (max-width: 768px) {
    .sppm-video-tutorial-section {
        padding: 30px 20px;
    }
    
    .sppm-video-hero {
        flex-direction: column;
        gap: 40px;
        min-height: auto;
    }
    
    .sppm-video-content,
    .sppm-video-player-container {
        width: 100%;
    }
    
    .sppm-video-header .sppm-section-title {
        text-align: center;
        justify-content: center;
        font-size: 28px;
    }
    
    .sppm-video-header .sppm-section-description {
        text-align: center;
    }
    
    .sppm-play-button {
        width: 60px;
        height: 60px;
    }
    
    .sppm-video-duration-badge {
        bottom: 10px;
        right: 10px;
        padding: 4px 8px;
        font-size: 12px;
    }
}

@media (max-width: 480px) {
    .sppm-video-hero {
        gap: 30px;
    }
    
    .sppm-video-header .sppm-section-title {
        font-size: 24px;
    }
    
    .sppm-video-header .sppm-section-description {
        font-size: 16px;
    }
    
    .sppm-video-title {
        font-size: 20px;
    }
    
    .sppm-meta-item,
    .sppm-feature-item {
        font-size: 14px;
    }
}
</style>
