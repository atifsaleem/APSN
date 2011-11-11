<?php
/**
 * @package WordPress
 * @subpackage Adventure_Journal
 */
?>
<?php 
    //Get the selected layout option
    $layout = get_option('ctx-adventurejournal-options');

    switch ($layout['layout']) {
        case 'col-2-left':
        case 'col-2-right':
            //Check if the current page is a non blog related page
            if (is_page()){
                //If so then generate the normal website sidebar
                ctx_aj_build_sidebar('col-left','Page Sidebar');
            } else  {
                //If this is a blog or blog related page then generate the blog sidebar
                ctx_aj_build_sidebar('col-left','Blog Sidebar');
            }
        break;
        case 'col-3':
            //Check if the current page is a non blog related page
            if (is_page()){
                //If so then generate the normal website sidebars
                ctx_aj_build_sidebar('col-left','Page Sidebar (Left)');
                ctx_aj_build_sidebar('col-right','Page Sidebar (Right)');
            } else  {
                //If this is a blog or blog related page then generate the blog sidebar
                ctx_aj_build_sidebar('col-left','Blog Sidebar (Left)');
                ctx_aj_build_sidebar('col-right','Blog Sidebar (Right)');
            }
        break;
        case 'col-3-left':
            //Check if the current page is a non blog related page
            if (is_page()){
                //If so then generate the normal website sidebars
                ctx_aj_build_sidebar('col-left','Page Sidebar (Left)');
                ctx_aj_build_sidebar('col-right','Page Sidebar (Right)');
            } else  {
                //If this is a blog or blog related page then generate the blog sidebar
                ctx_aj_build_sidebar('col-left','Blog Sidebar (Left)');
                ctx_aj_build_sidebar('col-right','Blog Sidebar (Right)');
            }
        break;
        case 'col-1':
        default:
            //Do nothing - no sidebar support
        break;

    }
?>