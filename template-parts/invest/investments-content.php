<?php
/**
 * Component: Investments Content
 */
?>
<section class="investments-page bg-white min-h-screen">
    <!-- Section 1: Premium Hero Header -->
    <?php get_template_part('template-parts/invest/hero', 'banner'); ?>

    <div class="py-20 bg-[#f8fafc]">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-12">
                
                <!-- Sidebar Filters (Left) -->
                <?php get_template_part('template-parts/invest/filters', 'sidebar'); ?>

                <!-- Main Section (Right) -->
                <main class="lg:w-3/4">
                    <?php 
                    $portfolio_handler = new \Estatery\Core\InvestPortfolioHandler();
                    $all_investments = [];
                    $current_lang = \Estatery\Core\Translator::getInstance()->getLang();

                    // 1a. Load DB Items
                    $db_items = $portfolio_handler->get_all();
                    foreach ($db_items as $row) {
                        $raw = $portfolio_handler->map_to_frontend($row);
                        $mapped = \Estatery\Core\Translator::map_property_data($raw, $current_lang);
                        $mapped['is_investment'] = true;
                        $mapped['unix_date'] = strtotime($row['created_at'] ?? 'now');
                        $mapped['category'] = strtolower($raw['type'][0] ?? '');
                        $all_investments[] = $mapped;
                    }

                    // 1b. Load JSON Properties
                    $json_file = get_template_directory() . '/data/investments.json';
                    if (file_exists($json_file)) {
                        $json_data = file_get_contents($json_file);
                        $parsed_data = json_decode($json_data, true);
                        $raw_properties = $parsed_data['root']['property'] ?? [];
                        
                        $db_external_ids = array_column($all_investments, 'id');

                        foreach ($raw_properties as $prop) {
                            if (!in_array($prop['id'][0], $db_external_ids)) {
                                $mapped = \Estatery\Core\Translator::map_property_data($prop, $current_lang);
                                $mapped['is_investment'] = true;
                                $mapped['unix_date'] = strtotime($prop['date'][0] ?? 'now');
                                $mapped['category'] = strtolower($prop['type'][0] ?? '');
                                $all_investments[] = $mapped;
                            }
                        }
                    }
                    
                    // 1.5 Apply Filters
                    $search       = strtolower($_GET['search'] ?? '');
                    $status       = $_GET['status']   ?? 'all';
                    $types        = isset($_GET['types']) ? array_filter(explode(',', $_GET['types'])) : [];
                    $budget_range = $_GET['budget_range'] ?? '';
                    $budget_map   = [
                        'range_1' => ['min' => 1000000,  'max' => 10000000],
                        'range_2' => ['min' => 10000000, 'max' => 50000000],
                        'range_3' => ['min' => 50000000, 'max' => 0],
                    ];
                    if ($budget_range && isset($budget_map[$budget_range])) {
                        $min_price = (float)$budget_map[$budget_range]['min'];
                        $max_price = (float)$budget_map[$budget_range]['max'];
                    } else {
                        $min_price = (float)($_GET['min_price'] ?? 0);
                        $max_price = (float)($_GET['max_price'] ?? 0);
                    }
                    $beds  = (int)($_GET['beds']  ?? 0);
                    $baths = (int)($_GET['baths'] ?? 0);

                     $all_investments = array_filter($all_investments, function($item) use ($search, $status, $types, $min_price, $max_price, $beds, $baths) {
                        if ($search !== '' && stripos($item['location'], $search) === false) return false;
                        if ($status !== 'all') {
                            if ($status === 'new_build') { if (!$item['new_build']) return false; }
                            elseif ($status === 'resale') { if (!$item['resale']) return false; }
                            elseif (strtolower($item['type']) !== strtolower($status)) return false;
                        }
                        if (!empty($types) && !in_array(strtolower($item['category'] ?? ''), array_map('strtolower', $types))) return false;
                        if ($min_price > 0 && $item['raw_price'] < $min_price) return false;
                        if ($max_price > 0 && $item['raw_price'] > $max_price) return false;
                        if ($beds > 0) {
                            if ($beds === 4) { if ($item['beds'] < 4) return false; }
                            else { if ((int)$item['beds'] !== $beds) return false; }
                        }
                        if ($baths > 0) {
                            if ($baths === 4) { if ($item['baths'] < 4) return false; }
                            else { if ((int)$item['baths'] !== $baths) return false; }
                        }
                        return true;
                    });
                    
                    $current_sort  = $_GET['sort'] ?? 'newest';
                    $current_view  = $_GET['view'] ?? 'grid';

                    usort($all_investments, function($a, $b) use ($current_sort) {
                        switch ( $current_sort ) {
                            case 'newest': return $b['unix_date'] <=> $a['unix_date'];
                            case 'oldest': return $a['unix_date'] <=> $b['unix_date'];
                            case 'price_asc': return $a['raw_price'] <=> $b['raw_price'];
                            case 'price_desc': return $b['raw_price'] <=> $a['raw_price'];
                            case 'area_asc': return $a['raw_sqft'] <=> $b['raw_sqft'];
                            case 'area_desc': return $b['raw_sqft'] <=> $a['raw_sqft'];
                            default: return $b['unix_date'] <=> $a['unix_date'];
                        }
                    });

                    $per_page      = 9; 
                    $total_results = count($all_investments);
                    $paged         = get_query_var('paged') ?: (get_query_var('page') ?: 1);
                    $total_pages   = ceil($total_results / $per_page);
                    $current_page  = max(1, min(max(1, $total_pages), (int)$paged));
                    $offset = ($current_page - 1) * $per_page;
                    $paged_properties = array_slice($all_investments, $offset, $per_page);
                    ?>

                    <!-- AJAX Target Container -->
                    <div id="properties-results-container" class="relative min-h-[400px] transition-all duration-300">
                        
                        <!-- Loading Overlay -->
                        <div id="properties-loading" class="absolute inset-0 bg-white/60 backdrop-blur-[2px] z-20 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-10 h-10 border-4 border-primary/20 border-t-primary rounded-full animate-spin"></div>
                                <span class="text-[11px] font-bold text-primary uppercase tracking-widest"><?php echo esc_html( t('js.loading') ?? 'Loading...' ); ?></span>
                            </div>
                        </div>

                        <div id="properties-content-ajax">
                            <?php 
                            get_template_part('template-parts/properties/grid', 'header', [
                                'total_results' => $total_results,
                                'current_page'  => $current_page,
                                'per_page'      => $per_page,
                                'current_sort'  => $current_sort,
                                'current_view'  => $current_view
                            ]); 

                            get_template_part('template-parts/properties/grid', 'results', [
                                'properties' => $paged_properties,
                                'view'       => $current_view
                            ]); 

                            get_template_part('template-parts/properties/pagination', null, [
                                'current_page' => $current_page,
                                'total_pages'  => $total_pages
                            ]); 
                            ?>
                        </div>
                    </div>
                </main>

            </div>
        </div>
    </div>

    <!-- Section 4.5: Dynamic FAQ Section -->
    <?php get_template_part('template-parts/common/faq-section', null, ['perspective' => 'invest']); ?>

    <!-- Section 5: Call to Action -->
    <?php get_template_part('template-parts/properties/cta', 'block'); ?>
</section>
