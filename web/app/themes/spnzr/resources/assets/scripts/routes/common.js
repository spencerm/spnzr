var methods = require('../helpers.js');

export default {
  init() {
    const bgImage = document.getElementById('bg-image');
    let windowWidth = methods.getWindowWidth();
    if (bgImage && windowWidth > 600){
      document.querySelector('body').style.backgroundImage = "url(" + bgImage.dataset.bgImage + ")";
      document.querySelector('body').style.backgroundAttachment = "fixed";
    }
  },
  finalize() {
    
    var stories = [],
        storyState = "opened",
        addStory = function(post){
            for (var i = 0, length = stories.length; i < length; i++) {
                if(stories[i].id === post.id){
                  // console.log("match!");
                  return false;
                }
            }
            var newStory = {};
            newStory.top = Math.ceil($(post).offset().top);
            newStory.bottom = Math.ceil($(post).innerHeight()) + newStory.top;
            newStory.id = $(post).attr('id');
            stories.push(newStory);
            // console.log("added story: " + newStory.id + " @ h:" + newStory.bottom );
        };

    if( $("body").hasClass('front-page') ){
        var newStory = {};
        newStory.top = 100;
        newStory.bottom = 660;
        newStory.id = '#chips-ahoy';
        newStory.title = 'index index';
    }
    
    $( '.post').each( function(){
        addStory( this );
    });

    $(window).scroll(function(){
      var scrollTop = $(window).scrollTop();
      for (var i = 0; i < stories.length; i++) {
        var focusedPost = document.getElementById(stories[i].id);
        /* on the post */
        if(storyState !== stories[i].id && scrollTop > stories[i].top && scrollTop < stories[i].bottom - methods.getWindowHeight() ) {
          focusedPost.classList.add('bg-fixed');
          storyState = stories[i].id;
          // console.log("1 story change to "+storyState);
          return;
        /* going down */
        } else if (storyState === stories[i].id && scrollTop > stories[i].bottom - methods.getWindowHeight() ){
          focusedPost.classList.remove('bg-fixed');
          focusedPost.classList.add('bg-bottom');
          storyState = "transition";
          // console.log("2 story change to "+storyState);
          return;
        /* going up */
        } else if (storyState === stories[i].id && scrollTop < stories[i].top ){
          focusedPost.classList.remove('bg-fixed');
          focusedPost.classList.add('bg-top');
          storyState = "transition";
          // console.log("3 story change to "+storyState);
          return;
        }
        }
      });
  },
};
