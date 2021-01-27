<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Pagination Class
 *
 * @package   CodeIgniter
 * @link      http://codeigniter.com/user_guide/libraries/pagination.html
 * 
 * Modified by CodexWorld.com
 * @Ajax pagination functionality has added with this library. 
 * @It will helps to integrate Ajax pagination with loading image in CodeIgniter application.
 * @TutorialLink http://www.codexworld.com/ajax-pagination-in-codeigniter-framework/
 */
class Ajax_pagination{

    var $base_url        = ''; // The page we are linking to
    var $total_rows      = ''; // Total number of items (database results)
    var $per_page        = 10; // Max number of items you want shown per page
    var $num_links       =  5; // Number of "digit" links to show before/after the currently viewed page
    var $cur_page        =  0; // The current page being viewed
    var $first_link         = 'First';
    var $next_link          = 'Next';
    var $prev_link          = 'Prev';
    var $last_link          = 'Last';
    var $uri_segment        = 3;
    var $full_tag_open   = '<nav aria-label="Page navigation"><ul class="pagination">';
    var $full_tag_close  = '</ul></nav>';
    var $first_tag_open     = '<li class="page-item">';
    var $first_tag_close    = '</li>';
    var $last_tag_open      = '<li class="page-item">';
    var $last_tag_close     = '</li>';
    var $first_url          = ''; // Alternative URL for the First Page.
    var $cur_tag_open       = '<li class="page-item active"><a>';
    var $cur_tag_close      = '</a></li>';
    var $next_tag_open      = '<li class="page-item">';
    var $next_tag_close     = '</li>';
    var $prev_tag_open      = '<li class="page-item">';
    var $prev_tag_close     = '</li>';
    var $num_tag_open       = '<li class="page-item">';
    var $num_tag_close      = '</li>';
    var $target          = '';
    var $anchor_class    = '';
    var $show_count      = false;
    var $show_total      = true;
    var $link_func       = 'getData';
    var $loading         = '.loading';
    var $keyword         = '#keyword';

    /**
     * Constructor
     * @access    public
     * @param    array    initialization parameters
     */
    function CI_Pagination($params = array()){
        if (count($params) > 0){
            $this->initialize($params);        
        }
        log_message('debug', "Pagination Class Initialized");
    }

    /**
     * Initialize Preferences
     * @access    public
     * @param    array    initialization parameters
     * @return    void
     */
    function initialize($params = array()){
        if (count($params) > 0){
            foreach ($params as $key => $val){
                if (isset($this->$key)){
                    $this->$key = $val;
                }
            }        
        }

        // Apply class tag using anchor_class variable, if set.
        if ($this->anchor_class != ''){
            $this->anchor_class = 'class="' . $this->anchor_class . '" ';
        }
    }

    /**
     * Generate the pagination links
     * @access    public
     * @return    string
     */   
    function create_script()
    {
        return '
        <script>
        var aj;
        function '.$this->link_func.'(page){ 
            key = $("'.$this->keyword.'").val();
            var a = $(".filter");
            var field = [];
            var val = [];
            j = 0;
            for (i=0; i < a.length; i++) { 
                if ($(a[i]).attr("name") != undefined) {
                    field[j] = $(a[i]).attr("name");
                    val[j] = $(a[i]).val();
                    j++;
                }
            }

            if (aj!=undefined) {
                aj.abort();
            }

            desc = true; limit = true; 
            if($("input[name=ckdesc]")!=undefined){
                desc = $("input[name=ckdesc]").is(":checked");
            }
            if($("input[name=cklimit]")!=undefined){
                limit = $("input[name=cklimit]").is(":checked");
            }

            aj = $.ajax({
                method: "POST",
                url: "'.$this->base_url.'/"+page,
                data: { page: page, keyword: key, name: field, value: val, desc: desc, limit:limit},
                beforeSend: function(){
                   $(".loader").show();
                   },
                   success: function(data){
                    $(".loader").fadeOut("slow");
                    $("'.$this->target.'").html(data);

                    $(".tr-click").dblclick(function() {
                        window.location = $(this).data("href");
                        });
                        },
                        error: function(jqXHR, exception)
                        {
                            if (exception!="abort") {
                                console.log(jqXHR.responseText);
                            }
                            $(".loader").fadeOut("slow");
                        }
                        });
                    }
                    $( document ).ready(function() {
                        $("'.$this->keyword.'").keypress(function(e) {
                            if(e.which == 13) {
                                '.$this->link_func.'(0);
                            }
                            });


                            });

                            </script>';
                        }

    /**
     * Generate the pagination links
     * @access    public
     * @return    string
     */    
    function create_links(){
        // If our item count or per-page total is zero there is no need to continue.
        if ($this->total_rows == 0 OR $this->per_page == 0){
           return '';
       }

        // Calculate the total number of pages
       $num_pages = ceil($this->total_rows / $this->per_page);

        // Is there only one page? Hm... nothing more to do here then.
       if ($num_pages == 1){
        //$info = 'Showing : ' . $this->total_rows;
        $info = '<nav aria-label="Page navigation"><ul class="pagination"><li class="page-item active"><a class="page-link" href="#">Total Record: '.$this->total_rows.'</a></li></ul></nav>';
        return $info;
    }

        // Determine the current page number.        
    $CI =& get_instance();    
    if ($CI->uri->segment($this->uri_segment) != 0){
        $this->cur_page = $CI->uri->segment($this->uri_segment);   
            // Prep the current page - no funny business!
        $this->cur_page = (int) $this->cur_page;
    }

    $this->num_links = (int)$this->num_links;
    if ($this->num_links < 1){
        show_error('Your number of links must be a positive number.');
    }

    if ( ! is_numeric($this->cur_page)){
        $this->cur_page = 0;
    }

        // Is the page number beyond the result range?
        // If so we show the last page
    if ($this->cur_page > $this->total_rows){
        $this->cur_page = ($num_pages - 1) * $this->per_page;
    }

    $uri_page_number = $this->cur_page;
    $this->cur_page = floor(($this->cur_page/$this->per_page) + 1);

        // Calculate the start and end numbers. These determine
        // which number to start and end the digit links with
    $start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
    $end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

        // Add a trailing slash to the base URL if needed
    $this->base_url = rtrim($this->base_url, '/') .'/';

        // And here we go...
    $output = '';

        // SHOWING LINKS
    if ($this->show_count){
        $curr_offset = $CI->uri->segment($this->uri_segment);
        $info = 'Showing ' . ( $curr_offset + 1 ) . ' to ' ;

        if( ( $curr_offset + $this->per_page ) < ( $this->total_rows -1 ) )
            $info .= $curr_offset + $this->per_page;
        else
            $info .= $this->total_rows;

        $info .= ' of ' . $this->total_rows . ' | ';
        $output .= $info;
    }

        // Render the "First" link
    if  ($this->cur_page > $this->num_links){
        $output .= $this->first_tag_open 
        . $this->getAJAXlink( '' , $this->first_link)
        . $this->first_tag_close;
    }

        // Render the "previous" link
    if  ($this->cur_page != 1){
        $i = $uri_page_number - $this->per_page;
        if ($i == 0) $i = '';
        $output .= $this->prev_tag_open 
        . $this->getAJAXlink( $i, $this->prev_link )
        . $this->prev_tag_close;
    }

        // Write the digit links
    for ($loop = $start -1; $loop <= $end; $loop++){
        $i = ($loop * $this->per_page) - $this->per_page;    
        if ($i >= 0){
            if ($this->cur_page == $loop){
                    $output .= $this->cur_tag_open.$loop.$this->cur_tag_close; // Current page
                }else{
                    $n = ($i == 0) ? '' : $i;
                    $output .= $this->num_tag_open
                    . $this->getAJAXlink( $n, $loop )
                    . $this->num_tag_close;
                }
            }
        }

        // Render the "next" link
        if ($this->cur_page < $num_pages){
            $output .= $this->next_tag_open 
            . $this->getAJAXlink( $this->cur_page * $this->per_page , $this->next_link )
            . $this->next_tag_close;
        }

        // Render the "Last" link
        if (($this->cur_page + $this->num_links) < $num_pages){
            $i = (($num_pages * $this->per_page) - $this->per_page);
            $output .= $this->last_tag_open . $this->getAJAXlink( $i, $this->last_link ) . $this->last_tag_close;
        }

        // Kill double slashes.  Note: Sometimes we can end up with a double slash
        // in the penultimate link so we'll kill all double slashes.
        $output = preg_replace("#([^:])//+#", "\\1/", $output);


        // Add the wrapper HTML if exists
        if ($this->show_total) {
            $this->full_tag_close = "<li class='active'><a>Total Record: ".$this->total_rows."</a></li>".$this->full_tag_close; 
        } 
        $output = $this->full_tag_open.$output.$this->full_tag_close;

        

        return $output;
    }

    function getAJAXlink($count, $text) {
        $pageCount = $count?$count:0;
        return '<a href="javascript:void(0);"' . $this->anchor_class . ' onclick="'.$this->link_func.'('.$pageCount.')">'. $text .'</a>';
    }
}
// END Pagination Class