<?php
$stats = [
    ["count" => "800", "suffix" => "+", "label" => t('home.stats.listed')],
    ["count" => "1200", "suffix" => "+", "label" => t('home.stats.families')],
    ["count" => "15", "suffix" => "K", "label" => t('home.stats.visitors')],
    ["count" => "97", "suffix" => "%", "label" => t('home.stats.satisfaction')]
];
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<section class="py-20 bg-primary" id="stats-counter-section">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center text-white">
            <?php foreach ($stats as $stat): ?>
                <div class="stat-item">
                    <h3 class="text-4xl lg:text-5xl font-bold mb-2 flex items-center justify-center">
                        <span class="counter-value" data-target="<?php echo $stat['count']; ?>">0</span>
                        <span><?php echo $stat['suffix']; ?></span>
                    </h3>
                    <p class="text-blue-100 text-lg font-medium"><?php echo $stat['label']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Register ScrollTrigger
        gsap.registerPlugin(ScrollTrigger);

        const counters = document.querySelectorAll('.counter-value');

        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));

            gsap.to(counter, {
                innerText: target,
                duration: 2.5,
                ease: "power2.out",
                snap: {
                    innerText: 1 // Forces whole numbers
                },
                scrollTrigger: {
                    trigger: "#stats-counter-section",
                    start: "top 80%", // Triggers when section is 80% from top
                    toggleActions: "play none none none"
                },
                onUpdate: function() {
                    // Update the text content during animation
                    counter.innerHTML = Math.ceil(counter.innerText);
                }
            });
        });
    });
</script>

<style>
    .bg-primary {
        background-color: #3b82f6;
    }

    .text-blue-100 {
        color: #dbeafe;
    }

    .stat-item {
        transition: transform 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-5px);
    }
</style>