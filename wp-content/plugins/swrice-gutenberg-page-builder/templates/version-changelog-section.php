<?php
/**
 * Version & Changelog Section Template
 */

if (!defined('ABSPATH')) exit;

$version_heading = isset($attributes['versionChangelogHeading']) ? $attributes['versionChangelogHeading'] : 'Version & Changelog';
$version_icon = isset($attributes['versionChangelogIcon']) ? $attributes['versionChangelogIcon'] : '📋';
$version_description = isset($attributes['versionChangelogDescription']) ? $attributes['versionChangelogDescription'] : '';
$current_version = isset($attributes['currentVersion']) ? $attributes['currentVersion'] : '1.0.0';
$upgrade_notice = isset($attributes['upgradeNotice']) ? $attributes['upgradeNotice'] : '';
$changelog_items = isset($attributes['changelogItems']) ? $attributes['changelogItems'] : array();

// Show section even if changelog is empty, but at least show current version
?>

<section class="sppm-section sppm-version-changelog-section">
    <div class="sppm-section-header">
        <h2 class="sppm-section-title">
            <?php if ($version_icon): ?><span class="sppm-section-icon"><?php echo $version_icon; ?></span><?php endif; ?>
            <?php echo esc_html($version_heading); ?>
        </h2>
        <?php if ($version_description): ?>
        <p class="sppm-section-description"><?php echo esc_html($version_description); ?></p>
        <?php endif; ?>
    </div>
    
    <!-- Current Version Display -->
    <div class="sppm-current-version-card">
        <div class="sppm-version-badge">
            <span class="sppm-version-icon">🆕</span>
            <span class="sppm-version-label">Current Version</span>
        </div>
        <div class="sppm-version-number"><?php echo esc_html($current_version); ?></div>
        <?php if ($upgrade_notice): ?>
        <div class="sppm-upgrade-notice">
            <div class="sppm-notice-icon">⚠️</div>
            <div class="sppm-notice-text"><?php echo esc_html($upgrade_notice); ?></div>
        </div>
        <?php endif; ?>
    </div>
    
    <?php if (is_array($changelog_items) && !empty($changelog_items)): ?>
    <!-- Changelog Timeline -->
    <div class="sppm-changelog-container">
        <h3 class="sppm-changelog-title">
            <span class="sppm-changelog-icon">📜</span>
            Release History
        </h3>
        
        <div class="sppm-changelog-timeline">
            <?php foreach ($changelog_items as $index => $item): ?>
                <?php
                $version = isset($item['version']) ? $item['version'] : '1.0.0';
                $release_date = isset($item['releaseDate']) ? $item['releaseDate'] : '';
                $changes = isset($item['changes']) ? $item['changes'] : '';
                $type = isset($item['type']) ? $item['type'] : 'minor';
                
                // Define type styling
                $type_config = array(
                    'major' => array('color' => '#dc3545', 'icon' => '🚀', 'label' => 'Major Release'),
                    'minor' => array('color' => '#007bff', 'icon' => '✨', 'label' => 'Minor Release'),
                    'patch' => array('color' => '#28a745', 'icon' => '🐛', 'label' => 'Bug Fix'),
                    'security' => array('color' => '#fd7e14', 'icon' => '🔒', 'label' => 'Security Update')
                );
                
                $config = isset($type_config[$type]) ? $type_config[$type] : $type_config['minor'];
                ?>
                
                <div class="sppm-changelog-item">
                    <div class="sppm-changelog-marker" style="background-color: <?php echo $config['color']; ?>">
                        <span class="sppm-marker-icon"><?php echo $config['icon']; ?></span>
                    </div>
                    
                    <div class="sppm-changelog-content">
                        <div class="sppm-changelog-header">
                            <div class="sppm-version-info">
                                <h4 class="sppm-changelog-version">Version <?php echo esc_html($version); ?></h4>
                                <?php if ($release_date): ?>
                                <span class="sppm-release-date"><?php echo esc_html($release_date); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="sppm-release-type" style="background-color: <?php echo $config['color']; ?>">
                                <?php echo $config['icon']; ?> <?php echo $config['label']; ?>
                            </div>
                        </div>
                        
                        <?php if ($changes): ?>
                        <div class="sppm-changelog-changes">
                            <?php 
                            // Convert line breaks to proper formatting
                            $formatted_changes = nl2br(esc_html($changes));
                            
                            // Convert bullet points if they exist
                            $formatted_changes = preg_replace('/^[\-\*\+]\s+/m', '<span class="sppm-bullet">•</span> ', $formatted_changes);
                            
                            echo $formatted_changes;
                            ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</section>

<style>
.sppm-version-changelog-section {
    max-width: 1000px;
    margin: 0 auto;
}

.sppm-current-version-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 40px;
    border-radius: 16px;
    text-align: center;
    margin-bottom: 50px;
    box-shadow: 0 10px 30px rgba(29,42,63,0.06);
    position: relative;
    overflow: hidden;
}

.sppm-current-version-card::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: shimmer 3s ease-in-out infinite;
}

@keyframes shimmer {
    0%, 100% { transform: rotate(0deg); }
    50% { transform: rotate(180deg); }
}

.sppm-version-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-bottom: 20px;
    font-size: 18px;
    font-weight: 500;
    opacity: 0.9;
}

.sppm-version-icon {
    font-size: 24px;
}

.sppm-version-number {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 20px;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.sppm-upgrade-notice {
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 8px;
    padding: 20px;
    display: flex;
    align-items: flex-start;
    gap: 15px;
    text-align: left;
    backdrop-filter: blur(10px);
}

.sppm-notice-icon {
    font-size: 20px;
    flex-shrink: 0;
}

.sppm-notice-text {
    line-height: 1.6;
    font-size: 16px;
}

.sppm-changelog-container {
    background: #fff;
    border-radius: 16px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(29,42,63,0.06);
}

.sppm-changelog-title {
    display: flex;
    align-items: center;
    gap: 15px;
    font-size: 28px;
    font-weight: 600;
    color: #1f2b33;
    margin: 0 0 40px 0;
    padding-bottom: 20px;
    border-bottom: 2px solid #f3f7fb;
}

.sppm-changelog-icon {
    font-size: 32px;
}

.sppm-changelog-timeline {
    position: relative;
    padding-left: 40px;
}

.sppm-changelog-timeline::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: linear-gradient(to bottom, #e9ecef, #dee2e6);
}

.sppm-changelog-item {
    position: relative;
    margin-bottom: 40px;
    padding-bottom: 40px;
}

.sppm-changelog-item:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
}

.sppm-changelog-marker {
    position: absolute;
    left: -28px;
    top: 8px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 2;
}

.sppm-marker-icon {
    font-size: 18px;
    color: white;
}

.sppm-changelog-content {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 30px;
    border-left: 4px solid #e9ecef;
    transition: all 0.3s ease;
}

.sppm-changelog-content:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(29,42,63,0.08);
}

.sppm-changelog-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 15px;
}

.sppm-version-info h4 {
    font-size: 22px;
    font-weight: 600;
    color: #1f2b33;
    margin: 0 0 8px 0;
}

.sppm-release-date {
    color: #6b747b;
    font-size: 14px;
    font-weight: 500;
}

.sppm-release-type {
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    white-space: nowrap;
}

.sppm-changelog-changes {
    color: #555;
    line-height: 1.8;
    font-size: 16px;
}

.sppm-bullet {
    color: #5fa0d8;
    font-weight: bold;
    margin-right: 8px;
}

@media (max-width: 768px) {
    .sppm-current-version-card {
        padding: 30px 20px;
    }
    
    .sppm-version-number {
        font-size: 36px;
    }
    
    .sppm-changelog-container {
        padding: 30px 20px;
    }
    
    .sppm-changelog-title {
        font-size: 24px;
    }
    
    .sppm-changelog-timeline {
        padding-left: 30px;
    }
    
    .sppm-changelog-marker {
        left: -23px;
        width: 32px;
        height: 32px;
    }
    
    .sppm-marker-icon {
        font-size: 14px;
    }
    
    .sppm-changelog-content {
        padding: 20px;
    }
    
    .sppm-changelog-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .sppm-version-info h4 {
        font-size: 20px;
    }
}

@media (max-width: 480px) {
    .sppm-upgrade-notice {
        flex-direction: column;
        text-align: center;
    }
    
    .sppm-changelog-timeline::before {
        left: 15px;
    }
    
    .sppm-changelog-timeline {
        padding-left: 25px;
    }
    
    .sppm-changelog-marker {
        left: -18px;
        width: 28px;
        height: 28px;
    }
    
    .sppm-marker-icon {
        font-size: 12px;
    }
}
</style>

