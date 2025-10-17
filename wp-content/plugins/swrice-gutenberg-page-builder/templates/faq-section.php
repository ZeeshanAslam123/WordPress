<?php
/**
 * FAQ Section Template
 */

if (!defined('ABSPATH')) exit;

$faq_heading = isset($attributes['faqHeading']) ? $attributes['faqHeading'] : 'FAQ';
$faq_icon = isset($attributes['faqIcon']) ? $attributes['faqIcon'] : '❓';
$faq_items = isset($attributes['faqItems']) ? $attributes['faqItems'] : array();

if (empty($faq_items) || !is_array($faq_items)) return;
?>

<section class="sppm-section sppm-faq-section">
    <div class="sppm-container">
        <div class="sppm-section-header">
            <h2 class="sppm-section-title">
                <?php if (!empty($faq_icon)): ?>
                    <span class="sppm-section-icon"><?php echo esc_html($faq_icon); ?></span>
                <?php endif; ?>
                <?php echo esc_html($faq_heading); ?>
            </h2>
        </div>
        
        <div class="sppm-faq-list">
            <?php foreach ($faq_items as $index => $item): ?>
                <?php if (!empty($item['question']) && !empty($item['answer'])): ?>
                    <div class="sppm-faq-item">
                        <div class="sppm-faq-question" onclick="toggleFaq(<?php echo $index; ?>)">
                            <h3><?php echo esc_html($item['question']); ?></h3>
                            <span class="sppm-faq-toggle">+</span>
                        </div>
                        <div class="sppm-faq-answer" id="faq-answer-<?php echo $index; ?>">
                            <p><?php echo esc_html($item['answer']); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
