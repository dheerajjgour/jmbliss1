<?php
/*  ----------------------------------------------------------------------------
    Newspaper V6.3+ Child theme - Please do not use this child theme with older versions of Newspaper Theme

    What can be overwritten via the child theme:
     - everything from /parts folder
     - all the loops (loop.php loop-single-1.php) etc
	 - please read the child theme documentation: http://forum.tagdiv.com/the-child-theme-support-tutorial/


     - the rest of the theme has to be modified via the theme api:
       http://forum.tagdiv.com/the-theme-api/

 */




/*  ----------------------------------------------------------------------------
    add the parent style + style.css from this folder
 */
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 1001);
function theme_enqueue_styles() {
    wp_enqueue_style('td-theme', get_template_directory_uri() . '/style.css', '', TD_THEME_VERSION, 'all' );
    wp_enqueue_style('td-theme-child', get_stylesheet_directory_uri() . '/style.css', array('td-theme'), TD_THEME_VERSION . 'c', 'all' );

}


function add_search(){
   dynamic_sidebar( 'searchform' );
}
add_action( 'td_wp_booster_after_header', 'add_search');
add_shortcode( 'search_form', 'add_search' );

function add_script(){
    ?>
    <link rel="stylesheet" type="text/css" href="/wp-content/themes/Newspaper-child/css/style-form.css" />
        <link rel="stylesheet" type="text/css" href="/wp-content/themes/Newspaper-child/css/style-result.css" />
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
 <script type="text/javascript" src="/wp-content/themes/Newspaper-child/js/jquery-ui-1.12.1.js"></script>
 <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
 <script type="text/javascript">
                jQuery(document).ready(function($){
    $.widget( "custom.catcomplete", $.ui.autocomplete, {
      _create: function() {
        this._super();
        this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
      },
      _renderMenu: function( ul, items ) {
        var that = this,
          currentCategory = "";
        $.each( items, function( index, item ) {
          var li;
          if ( item.category != currentCategory ) {
            ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
            currentCategory = item.category;
          }
          li = that._renderItemData( ul, item );
          if ( item.category ) {
            li.attr( "aria-label", item.category + " : " + item.label );
          }
        });
      }
    });
                    $(".gmw-address-1").catcomplete({ // myevent_name is the id of the textbox on which we are applying auto complete process
                        delay: 0,
                        source:'/wp-content/themes/Newspaper-child/my_result.php', // sunil_results.php is the 
                       
                    });

$('#hotel_group-tax , #reward_program-tax').each(function () {

    // Cache the number of options
    var $this = $(this),
        numberOfOptions = $(this).children('option').length;

    // Hides the select element
    $this.addClass('s-hidden');

    // Wrap the select element in a div
    $this.wrap('<div class="select"></div>');

    // Insert a styled div to sit over the top of the hidden select element
    $this.after('<div class="styledSelect"></div>');

    // Cache the styled div
    var $styledSelect = $this.next('div.styledSelect');

    // Show the first select option in the styled div
    $styledSelect.text($this.children('option').eq(0).text());

    // Insert an unordered list after the styled div and also cache the list
    var $list = $('<ul />', {
        'class': 'options'
    }).insertAfter($styledSelect);

    // Insert a list item into the unordered list for each select option
    for (var i = 0; i < numberOfOptions; i++) {
        $('<li />', {
            text: $this.children('option').eq(i).text(),
            rel: $this.children('option').eq(i).val()
        }).appendTo($list);
    }

    // Cache the list items
    var $listItems = $list.children('li');

    // Show the unordered list when the styled div is clicked (also hides it if the div is clicked again)
    $styledSelect.click(function (e) {
        e.stopPropagation();
        $('div.styledSelect.active').each(function () {
            $(this).removeClass('active').next('ul.options').hide();
        });
        $(this).toggleClass('active').next('ul.options').toggle();
    });

    // Hides the unordered list when a list item is clicked and updates the styled div to show the selected list item
    // Updates the select element to have the value of the equivalent option
    $listItems.click(function (e) {
        e.stopPropagation();
        $styledSelect.text($(this).text()).removeClass('active');
        $this.val($(this).attr('rel'));
        $list.hide();
        /* alert($this.val()); Uncomment this for demonstration! */
    });

    // Hides the unordered list when clicking outside of it
    $(document).click(function () {
        $styledSelect.removeClass('active');
        $list.hide();
    });


//clear button
$("#gmw-address-field-wrapper-1").each(function() {
  
  var $inp = $(this).find("input:text"),
      $cle = $(this).find(".clearable__clear");

  $inp.on("input", function(){
    $cle.toggle(!!this.value);
  });
  
  $cle.on("touchstart click", function(e) {
    e.preventDefault();
    $inp.val("").trigger("input");
  });
  
});

});



});

        </script>
<style type="text/css">

</style>
<?php
}
add_action ( 'wp_head', 'add_script' );

/*
** For Reset Search Result
*   @author D;
*/
function seeallacript(){
  ?>
  <script>
   function seeall() {
     jQuery("#gmw-address-1").removeClass('mandatory');
   var keyw = jQuery(".gmw-address-1").val();
   if(keyw === ''){
    var keyw = jQuery(".new-search-form .gmw-address-1").val();
   }
   jQuery(".keyword").val(keyw);
  jQuery("#gmw-address-1").val('');
  jQuery("#gmw-submit-1").click();
};


/*
** For Change url every filter
*   @author D;
*/
 function myfun(key, value) {
  baseUrl = [location.protocol, '//', location.host, location.pathname].join('');
  //var key = 'tax_hotel_group';
  //var value = '0';
  urlQueryString = document.location.search;
  var newParam = key + '=' + value,
  params = '?' + newParam;

  // If the "search" string exists, then build params from it
  if (urlQueryString) {
    keyRegex = new RegExp('([\?&])' + key + '[^&]*');
    // If param exists already, update it
    if (urlQueryString.match(keyRegex) !== null) {
      params = urlQueryString.replace(keyRegex, "$1" + newParam);
    } else { // Otherwise, add it to end of query string
      params = urlQueryString + '&' + newParam;
    }
  }
  window.history.replaceState({}, "", baseUrl + params);
}
/*
*
* URL remove function
*/
 function removefilters(key, value) {
var urlValue=document.location.href;
  
  //Get query string value
  var searchUrl=location.search;
  
  if(key!="") {
    oldValue = getParameterByName(key);
    removeVal=key+"="+oldValue;
    if(searchUrl.indexOf('?'+removeVal+'&')!= "-1") {
      urlValue=urlValue.replace('?'+removeVal+'&','?');
    }
    else if(searchUrl.indexOf('&'+removeVal+'&')!= "-1") {
      urlValue=urlValue.replace('&'+removeVal+'&','&');
    }
    else if(searchUrl.indexOf('?'+removeVal)!= "-1") {
      urlValue=urlValue.replace('?'+removeVal,'');
    }
    else if(searchUrl.indexOf('&'+removeVal)!= "-1") {
      urlValue=urlValue.replace('&'+removeVal,'');
    }
  }
  else {
    var searchUrl=location.search;
    urlValue=urlValue.replace(searchUrl,'');
  }
  history.pushState({state:1, rand: Math.random()}, '', urlValue);
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
/*
*
*remove functions end
*/
// dropdown js
jQuery(document).ready(function(){
jQuery('.dropdown-togg').click(function(){
  jQuery(this).next('.dropdown').slideToggle("fast");
});
//Hide dropdown on page click
jQuery(document).on('click', function (e) {
    if(!jQuery(".dropdown-togg").is(e.target) && !jQuery(".dropdown-togg").has(e.target).length){
        jQuery('.dropdown').slideUp("fast");
    }                       
});
});



 function chfun(select){
  var key = "gmw_orderby";
  var value = select.options[select.selectedIndex].getAttribute("value");
    baseUrl = [location.protocol, '//', location.host, location.pathname].join('');
  //var key = 'tax_hotel_group';
  //var value = '0';
  urlQueryString = document.location.search;
  var newParam = key + '=' + value,
  params = '?' + newParam;

  // If the "search" string exists, then build params from it
  if (urlQueryString) {
    keyRegex = new RegExp('([\?&])' + key + '[^&]*');
    // If param exists already, update it
    if (urlQueryString.match(keyRegex) !== null) {
      params = urlQueryString.replace(keyRegex, "$1" + newParam);
    } else { // Otherwise, add it to end of query string
      params = urlQueryString + '&' + newParam;
    }
  }
  window.history.replaceState({}, "", baseUrl + params);
 location.reload();
}

/*
* Search Buttons SCript 
*
*/
jQuery("#dest").click(function(){
jQuery(".gmw-single-taxonomy-wrapper").hide();
jQuery(".address-locator-wrapper").show();
jQuery(".gmw-dropdown-taxonomy").val('');
jQuery(".sl-btn").removeClass('active');
        // add active class
jQuery(this).addClass('active');
jQuery(".gmw-full-address").addClass('mandatory');

});

jQuery("#rew-pro").click(function(){
jQuery("#gmw-address-1").val('');
jQuery(".address-locator-wrapper").hide();
jQuery(".gmw-single-taxonomy-wrapper").hide();
jQuery(".gmw-dropdown-taxonomy").val('');
jQuery(".gmw-dropdown-reward_program-wrapper").show();
jQuery(".sl-btn").removeClass('active');
jQuery(".gmw-full-address").removeClass('mandatory');
jQuery(this).addClass('active');
});

jQuery("#lux-col").click(function(){
jQuery("#gmw-address-1").val('');
jQuery(".gmw-dropdown-taxonomy").val('');
jQuery(".address-locator-wrapper").hide();
jQuery(".gmw-single-taxonomy-wrapper").hide();
jQuery(".gmw-dropdown-hotel_group-wrapper").show();
jQuery(".sl-btn").removeClass('active');
jQuery(".gmw-full-address").removeClass('mandatory');
jQuery(this).addClass('active');
});
  </script>

<?php
}
add_action ( 'wp_footer', 'seeallacript' );

remove_filter( 'gmw_pt_tax_query', 'gmw_pt_query_taxonomies', 10, 2 );
function my_gmw_pt_query_taxonomies( $tax_args, $gmw ) {

    if ( !isset( $gmw['search_form']['taxonomies'] ) || empty( $gmw['search_form']['taxonomies'] ) )
        return $tax_args;

    $ptc = ( isset( $_GET[$gmw['url_px'].'post'] ) ) ? count( explode( " ", $_GET[$gmw['url_px'].'post'] ) ) : count( $gmw['search_form']['post_types'] );

    if ( isset( $ptc ) && $ptc > 1 )
        return $tax_args;

    $rr       = 0;
    $get_tax  = false;
    $args     = array( 'relation' => 'AND' );
    $postType = $gmw['search_form']['post_types'][0];
    
    if ( empty( $gmw['search_form']['taxonomies'][$postType] ) )
      return;
    
    foreach ( $gmw['search_form']['taxonomies'][$postType] as $tax => $values ) {

      if ( $values['style'] == 'drop' ) {
         
        $get_tax = false;

        if ( isset( $_GET['tax_' . $tax] ) ){
          $get_tax =  $_GET['tax_' . $tax] ;
          $str = implode(",", array_values($get_tax));
        }

        if ( !empty($get_tax) ) {
          if( $str != 0 ){
          $rr++;
           $myterm = $get_tax;
          $args[] = array(
              'taxonomy' => $tax,
              'field'    => 'id',
              'terms'    => $myterm,
              'operator' => 'IN'
          );
          $get_tax = false;
        }
        }
      } 
    }

    if ( $rr == 0 )
        $args = false;

    return $args;

}
add_filter( 'gmw_pt_tax_query', 'my_gmw_pt_query_taxonomies', 10, 2 );

/*
*
*For Meta query filters (Featured)
*
*/
add_filter( 'gmw_pt_meta_query', 'my_meta_query', 10, 2 );
function my_meta_query( $tax_args, $gmw ){

    $ptc = ( isset( $_GET[$gmw['url_px'].'post'] ) ) ? count( explode( " ", $_GET[$gmw['url_px'].'post'] ) ) : count( $gmw['search_form']['post_types'] );

    if ( isset( $ptc ) && $ptc > 1 )
        return $mta_args;

        $fcrd = 0;

        if ( isset( $_GET['show_featured'] ) ){
          $fcrd =  $_GET['show_featured'] ;
        }

        if ( !empty($fcrd) ) {
          $metaargs = array(
                        'relation'      => 'AND',
                        array(
                            'key'       => 'tr_picks',
                            'value'     => array(1),
                        ),
                             );
    } 
     if ( isset( $_GET['region'] ) ){
          $reg =  $_GET['region'] ;
        }

        if ( !empty($reg) ) {
          $metaargs = array(
                        'relation'      => 'AND',
                        array(
                            'key'       => 'region',
                            'value'     => $reg,
                        ),
                             );
    }
    return $metaargs;
}

/*
** For Show FIlters that are available in search result
*   @author D;
*/
function show_avail_filters(){
  $ftr = '';
//Show keyword
  // if ( !empty( $_GET['keyword'] ) ){
  // $keyword = sanitize_text_field( $_GET['keyword'] );
  // $ftr .= '<span class="search-filter-term">'.$keyword.'</span>';
  // }

//For Show Address
  // if ( !empty( $_GET['gmw_address'] ) ){
  // $address =  $_GET['gmw_address'];
  // if ( $address[0] != 0 || $address[0] != "" ) {
  // $ftr .= '<span class="search-filter-term">'.$address[0].'</span>';
  // }
  // }


//Show Hotel REward Program
  // if ( !empty( $_GET['tax_reward_program'] ) && isset( $_GET['adfilter'] )){
  // $rprg =  $_GET['tax_reward_program'];
  // foreach ($rprg as $rpkey => $rpvalue) {
  // $ftr .= '<span class="search-filter-term">'.get_the_category_by_ID( $rpvalue ).'<a href="" onclick="removefilters(\'tax_reward_program%5B'.$rpkey.'%5D\', '.$rpvalue.')"> x</a></span>';
  //   }
  // }


//Show Hotel Brand
  if ( !empty( $_GET['tax_hotel_brand'] ) ){
  $hbrand = $_GET['tax_hotel_brand'];
   foreach ($hbrand as $hbkey => $hbvalue) {
  $ftr .= '<span class="search-filter-term">'.get_the_category_by_ID( $hbvalue ).'<a href="" onclick="removefilters(\'tax_hotel_brand%5B'.$hbkey.'%5D\', '.$hbvalue.')"> x</a></span>';
  }
}


//Show Hotel Tier
  if ( !empty( $_GET['tax_hotel_tier'] ) ){
  $htier = $_GET['tax_hotel_tier'];
   foreach ($htier as $htkey => $htvalue) {
  $ftr .= '<span class="search-filter-term">'.get_the_category_by_ID( $htvalue ).'<a href="" onclick="removefilters(\'tax_hotel_tier%5B'.$htkey.'%5D\', '.$htvalue.')"> x</a></span>';
  }
}

  //Show Featured By Filter
  if ( !empty( $_GET['show_featured'] ) ){
  $keyword = sanitize_text_field( $_GET['show_featured'] );
  $ftr .= '<span class="search-filter-term">Featured<a href="" onclick="myfun(\'show_featured\', 0)"> x</a></span>';
  }

   return $ftr;
 }
add_shortcode( 'show_avail_filters', 'show_avail_filters' );


/*
** For SHortBy Dropdown
*   @author D;
*/
function gmw_orderby_dropdown( $gmw ) {
  $odby = "";
  if( isset( $_GET['gmw_orderby'] ) && !empty( $_GET['gmw_orderby'] ) ){
    $odby = sanitize_text_field( $_GET['gmw_orderby'] );
  }
     ?>
<div class="short-div">
        <span class="odby-text">Sort by</span>
        <div class="btn-group-sort" id="div-sort" >
          <!-- 
          *
          * if featured selected
          *
          *-->
         <?php if( $odby == 'featured' ) { ?> 
          <a class="sort-first asort sortfill" href="" type="button" onclick="myfun('gmw_orderby', '')">FEATURED
            <span class="pull-right"></span>
          </a>
           <?php } 
           else { ?>
           <a class="sort-first asort" href="" type="button" onclick="myfun('gmw_orderby', 'featured')">FEATURED
            <span class="pull-right"></span>
          </a>
          <?php } ?>
          <!-- 
          *
          * If Points selected
          *
          * -->
         <?php if( $odby == 'points_decending' ) { ?>
          <a class="sort-second asort" href="" onclick="myfun('gmw_orderby', 'points_ascending')" type="button">POINTS/NIGHT (BY CHAIN)<span class="fas fa-chevron-down sort-last"></span>
          </a>
          <?php } 
           else if( $odby == 'points_ascending' ) { ?>
          <a class="sort-second asort" href="" onclick="myfun('gmw_orderby', 'points_decending')" type="button">POINTS/NIGHT (BY CHAIN)<span class="fas fa-chevron-up sort-last"></span>
          </a>
          <?php } 
           else { ?>
          <a class="sort-second asort sempty" href="" onclick="myfun('gmw_orderby', 'points_ascending')" type="button">POINTS/NIGHT (BY CHAIN)</a>
          <?php } ?>

        </div>
</div>
    <?php
}
 //add_action( 'gmw_search_form_before_distance', 'gmw_orderby_dropdown', 20 );
add_shortcode('show_short_by','gmw_orderby_dropdown');


/*
** For Orderby query
*   @author D;
*/
function gmw_orderby_filter( $clauses, $gmw ) {
  global $wpdb;

  //check if order-by value was submitted. If it was we will use its value otherwise we set the default value to 'distance'
  $orderby_value = ( isset( $_GET['gmw_orderby'] ) && !empty( $_GET['gmw_orderby'] ) ) ? $_GET['gmw_orderby'] : 'distance';
   
  //check the value of the order-by and modify the clause based on that
  //when order-by distance
  if ( $orderby_value == 'distance' ) {
    /*
     * when we do order-by distance we must check an address was entered.
     * we cannot order results by distance when ther is no address to calculate distance to
     * and so we will rsults with an error.
     * So we check for the address and if address found we will order results by distance.
     * Otherwise, we can order results by a different value. In this example i use post_title
     */
    if ( isset( $gmw['org_address'] ) && !empty( $gmw['org_address'] ) ) {
      //order by distance when address entered
      $clauses['orderby'] = 'distance';
    } else {
      //if no address order by post title
      $clauses['orderby'] = $wpdb->prefix.'posts.post_title';
    }
  } elseif ( $orderby_value == 'post_title' ) {
    $clauses['orderby'] = $wpdb->prefix.'posts.post_title';
  } 
 elseif ( $orderby_value == 'featured' ) {
   $clauses['join'] .= " LEFT JOIN {$wpdb->prefix}postmeta AS pmeta ON({$wpdb->prefix}posts.ID = pmeta.post_id AND pmeta.meta_key = 'tr_picks')";
  $clauses['orderby'] = 'ABS(pmeta.meta_value) DESC';
  }

  elseif ( $orderby_value == 'points_ascending' ) {
     $clauses['join'] .= " LEFT JOIN {$wpdb->prefix}postmeta AS pmeta ON({$wpdb->prefix}posts.ID = pmeta.post_id AND pmeta.meta_key = 'point_sort')";
  $clauses['orderby'] = 'LENGTH(pmeta.meta_value), pmeta.meta_value';
    //$clauses['orderby'] = $wpdb->prefix.'posts.post_date';
  } elseif ( $orderby_value == 'points_decending' ) {
     $clauses['join'] .= " LEFT JOIN {$wpdb->prefix}postmeta AS pmeta ON({$wpdb->prefix}posts.ID = pmeta.post_id AND pmeta.meta_key = 'point_sort')";
  $clauses['orderby'] = 'LENGTH(pmeta.meta_value), pmeta.meta_value DESC';
  } elseif ( $orderby_value == 'post_id' ) {
     $clauses['orderby'] = $wpdb->prefix.'posts.ID DESC';
  }
        
        //return modified clauses
  return $clauses;
}
add_filter( 'gmw_pt_location_query_clauses', 'gmw_orderby_filter', 20, 2 );

//Filter by cutom fields
function order_gmw_results($clauses, $gmwQuery) {
  global $wpdb;

  $clauses['join'] .= " LEFT JOIN {$wpdb->prefix}postmeta AS pmeta ON({$wpdb->prefix}posts.ID = pmeta.post_id AND pmeta.meta_key = 'points')";
  $clauses['orderby'] = 'pmeta.meta_value';
  return $clauses;
}
// add_filter('gmw_pt_location_query_clauses', 'order_gmw_results',10,2);

// For insert Location In table by WP-Import
add_action('pmxi_saved_post', 'post_saved', 10, 1);

function post_saved($import_id) {
    global $wpdb;
 $title =  get_post_field('post_title', $import_id);
 $street = get_field('street', $import_id);
 $city = get_field('city', $import_id);
 $state = get_field('state', $import_id);
 $country = get_field('country', $import_id);
 $address = get_field('full_address', $import_id);
 $lat = get_field('latitude', $import_id);
 $long = get_field('longitude', $import_id);



$wpdb->insert("wpzv_places_locator", array(
   "post_id" => $import_id,
   "feature" => '0',
   "post_status" => 'public',
   "post_type" => 'hotel_listing',
   "post_title" => $title,
   "lat" => $lat,
   "long" => $long,
   "street_name" => $street ,
   "street" => $street ,
   "city" => $city ,
   "state" => $state ,
   "state_long" => $state ,
   "country" => $country ,
   "country_long" => $country ,
   "address" => $address ,
   "formatted_address" => $address ,
   "map_icon" => '_default.png' ,

),
array(
      '%d', //data type is string
      '%s',
      '%s',
      '%s',
      '%s', 
      '%s',
      '%s',
      '%s',
      '%s', 
      '%s',
      '%s',
      '%s',
      '%s',
      '%s',
      '%s'
 )
);
}

/*
*
* For Remove Your Location in Search result Map
*/
function gmw_remove_user_map_marker( $args ) {

  $args['userPosition']['lng'] = false;
  $args['userPosition']['lat'] = false;

  return $args;
}
add_filter( 'gmw_map_element', 'gmw_remove_user_map_marker', 99 );

/*
*
* For Add Button on search Form
*/
add_action( 'gmw_before_search_form_template', 'my_button_show' );
  function my_button_show(){
    $opt =  '<div class="search-left">
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor </p>
  <div class="sl-seby">
    <h3 class="sc-by">Search by: </h3>  
  </div>
  <div class="sl-btn-group">
  <div class="sl-item" >
    <button class="sl-btn active" id="dest">Destination</button>
  </div>
  <div class="sl-item">
    <button class="sl-btn" id="rew-pro">Reward Programs</button>
  </div>
  <div class="sl-item">
    <button class="sl-btn" id="lux-col">Luxury Collections</button>
  </div>
  </div>
</div>';
    echo  $opt;
  }

/*
*
** Use "wp_dropdown_categories()" for multiple categories
*
*/
add_filter( 'wp_dropdown_cats', 'wp_dropdown_cats_multiple', 10, 2 );
function wp_dropdown_cats_multiple( $output, $r ) {

    if( isset( $r['multiple'] ) && $r['multiple'] ) {

         $output = preg_replace( '/^<select/i', '<select multiple', $output );

        $output = str_replace( "name='{$r['name']}'", "name='{$r['name']}[]'", $output );

        foreach ( array_map( 'trim', explode( ",", $r['selected'] ) ) as $value )
            $output = str_replace( "value=\"{$value}\"", "value=\"{$value}\" selected", $output );

    }

    return $output;
}

/*
*
** Function for show 'found XX results' on result page
*
*/
function show_search_for(){
  $opt = "";

  //For Show Address
  if( isset( $_GET['gmw_address'] ) && !empty( $_GET['gmw_address'] ) ){
      $distance = $_GET['gmw_distance'];
      $getaddr =  $_GET['gmw_address'];
      $address = $getaddr[0];
      if ( $address != 0 || $address != "" ) {
      $opt = 'within '.$distance.' miles of '.$address;
    }
  }

  //Show keyword
  if ( !empty( $_GET['keyword'] ) ){
  $keyword = sanitize_text_field( $_GET['keyword'] );
   if ( $keyword != 0 || $keyword != "" ) {
  $opt = ' for '.$keyword;
  }
  }


// FOr reward program
if ( !empty( $_GET['tax_reward_program'] )  ){
  $rprg =  $_GET['tax_reward_program'];
  foreach ($rprg as $rpkey => $rpvalue) {
     $opt = ' for '.get_the_category_by_ID( $rpvalue );
    }
  }

// FOr Hotel Group
if ( !empty( $_GET['tax_hotel_group'] ) && !isset( $_GET['adfilter'] ) ){
  $hgroup =  $_GET['tax_hotel_group'];
  foreach ($hgroup as $hgkey => $hgvalue) {
     $opt = ' for '.get_the_category_by_ID( $hgvalue );
    }
  }

return $opt;
}
add_shortcode( 'search_for', 'show_search_for' );
