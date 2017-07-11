<?php 

//	Portfolio Filter
if (!function_exists('cstheme_portfolio_filter')) {
    function cstheme_portfolio_filter($post_type_terms = "")
    {
        if (!isset($term_list)) {
            $term_list = '';
        }
        $permalink = get_permalink();
        $args = array('taxonomy' => 'Category', 'include' => $post_type_terms);
        $terms = get_terms('portfolio_category', $args);
        $count = count($terms);
        $i = 0;
        $iterm = 1;

        if ($count > 0) {
            $cape_list = '';
            if ($count > 1) {
                $term_list .= '<li class="' . (!isset($_GET['slug']) ? 'selected' : '') . '">';

                $args_for_count_all_terms = array(
                    'post_type' => 'portfolio',
                    'post_status' => 'publish'
                );
                $query_for_count_all_terms = new WP_Query($args_for_count_all_terms);

                $term_list .= '<a href="#filter" data-option-value="*" data-catname="all" data-title="' . $query_for_count_all_terms->post_count . '">' . esc_html__('All', 'voyager') . '</a>
				</li>';
            }
            $termcount = count($terms);
            if (is_array($terms)) {
                foreach ($terms as $term) {

                    $args_for_count_all_terms = array(
                        'post_type' => 'portfolio',
                        'post_status' => 'publish',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'portfolio_category',
                                'field' => 'id',
                                'terms' => $term->term_id
                            )
                        )
                    );
                    $query_for_count_all_terms = new WP_Query($args_for_count_all_terms);

                    $i++;
                    $permalink = esc_url(add_query_arg("slug", $term->term_id, $permalink));
                    $term_list .= '<li ';
                    if (isset($_GET['slug'])) {
                        $getslug = $_GET['slug'];
                    } else {
                        $getslug = '';
                    }

                    if (strnatcasecmp($getslug, $term->term_id) == 0) $term_list .= 'class="selected"';

                    $tempname = strtr($term->name, array(
                        ' ' => '-',
                    ));
                    $tempname = strtolower($tempname);
                    $term_list .= '><a data-option-value=".' . $tempname . '" data-catname="' . $tempname . '" href="#filter"  data-title="' . $query_for_count_all_terms->post_count . '">' . $term->name . '</a>
                </li>';
                    if ($count != $i) $term_list .= ' '; else $term_list .= '';

                    $iterm++;
                }
            }
            
			echo '<div class="filter_block heading_font"><ul data-option-key="filter" class="optionset">' . $term_list . '</ul></div>';
        }
    }
}


?>