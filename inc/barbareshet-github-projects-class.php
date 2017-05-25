<?php

/**
 * Class barbareshet_github_projects_class
 */
class barbareshet_github_projects extends WP_Widget {


//Create Widget
function __construct(){
parent::__construct(
    'bargp_github_projects', //Base ID
    __('My Personal GitHub Projects', 'bargp'),
    array(
        'description'   =>  __('My GitHub projects widget', 'bargp')
    )
);

}

//Frontend display
public function widget($args, $instance){
    //get the values
    $title = apply_filters('widget_title', $instance['title']);
    $username = esc_attr($instance['username']);
    $count = esc_attr($instance['count']);


    echo $args['before_widget'];

    if(!empty($title)){
        echo $args['before_title'] . $title .$args['after_title'];
    }
    echo $this->show_my_repos($title, $username, $count);

    echo $args['after_widget'];
}


//Backend Form
public function form($instance){
    if(isset($instance['title'])){
        $title = $instance['title'];
    }else{
        $title = __('My Latest Github Projects','bargp');
    }

    //Get username
    if(isset($instance['username'])){
        $username = $instance['username'];
    }else{
        $username = __('barbareshet','bargp');
    }

    //Get count
    if(isset($instance['count'])){
        $count = $instance['count'];
    }else{
        $count = 6;
    }

    //Frontend Widget Form
    ?>
    <p>
        <labal for="<?php echo $this->get_field_id('title');?>"><?php echo _e('Title', 'bargp');?></labal>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" value="<?php echo esc_html__($title);?>">
    </p>
    <p>
        <labal for="<?php echo $this->get_field_id('username');?>"><?php echo _e('User Name', 'bargp');?></labal>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('username');?>" name="<?php echo $this->get_field_name('username');?>" value="<?php echo esc_html__($username);?>">
    </p>
    <p>
        <labal for="<?php echo $this->get_field_id('count');?>"><?php echo _e('Count', 'bargp');?></labal>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('count');?>" name="<?php echo $this->get_field_name('count');?>" value="<?php echo esc_html__($count);?>">
    </p>
<?php
}
//Update widget values
public function update($new_instance, $old_instance){
    $instance = array();
    $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
    $instance['username'] = (!empty($new_instance['username'])) ? strip_tags($new_instance['username']) : '';
    $instance['count'] = (!empty($new_instance['count'])) ? strip_tags($new_instance['count']) : '';

    return $instance;
}
//Show Repositories
    public function show_my_repos($title, $username, $count){
        $url = 'https://api.github.com/users/' . $username . '/repos?sort=created&per_page='.$count;
        $options = array(
          'http'    =>  array(
              'user_agent'  =>  $_SERVER['HTTP_USER_AGENT']
          )
        );
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $repos = json_decode($response);

        //Build the output
        $output  = '<div id="repos" class="container">';//wrapper div
        $output .= '<div class="row">';
            //Loop the repos
            foreach ($repos as $repo){

                $output .= '<div class="col-md-3 col-sm-6 col-xs-12 bargp-project text-center">';//wrapper div for a repo
                $output .= '<div class="thumbnail">';//wrapper
                $output .=      '<div class="project-img-wrap">';//title wrapper
                $output .=          '<span class="devicons devicons-github"></span>';//the repo title
                $output .=      '</div>';//title wrapper closing tag
                $output .=      '<div class="project-title-wrap">';//title wrapper
                $output .=          '<p>'. $repo->name .'</p>';//the repo title
                $output .=      '</div>';//title wrapper closing tag
                $output .=      '<div class="project-desc">'. $repo->description .'</div>';//repo description from GitHub
                $output .=      '<div class="project-btn-wrap">';//btn wrapper
                $output .=          '<a href="https://github.com/barbareshet/'. $repo->name .'" class="btn btn-default" aria-label="Follow @'. $repo->username .' on GitHub" target="_blank"> <span class="fa fa-code-fork" aria-hidden="true" aria-hidden="true"></span>&nbsp'. __('Follow Me') .'</a>';
                $output .=      '</div>';//btn wrapper closing tag
                $output .= '</div>';//thumbnail closing tag for a repo
                $output .= '</div>';//wrapper closing tag for a repo


            }
        $output .= '</div>';
        $output .= '</div>';//closing div
        return $output;
    }

}


