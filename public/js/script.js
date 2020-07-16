var manage = document.getElementById('change'),
    done = document.getElementById('restor')
    homepage = document.getElementById('first-section-visibility'),
    managepage = document.getElementById('second-section-visibility');

if (manage && done && homepage && managepage) {

    manage.addEventListener('click', function() {
        homepage.setAttribute('class', 'visibility-none');
        managepage.removeAttribute('class');
    });
    
    done.addEventListener('click', function() {
        managepage.setAttribute('class', 'visibility-none');
        homepage.removeAttribute('class');
    })
}


// --------------------------------------------- video play hover ------------------------------------------------------ \\

var   images = document.getElementsByClassName('imgs'),
      vds = document.getElementsByClassName('vds'),
      sources = document.getElementsByClassName('source'),
      medias  = document.getElementsByClassName('position');


      
if (images && medias && vds && sources) {

          
    Array.from(medias).forEach(media => {
            
            
        media.addEventListener('mouseover', function(e) {
            
            if(e.target.getAttribute('class') === 'brows-media imgs') {
                
                e.target.setAttribute('class', 'brows-media imgs media-hidden');
                
                var sourcesArr = Array.from(sources);
                var autovid = Array.from(vds);
                
                for(let i = 0; i < sourcesArr.length; i++ ) {

                    data = e.target.getAttribute('data');
                    src = sourcesArr[i].getAttribute('src');
                    if (src === data) {
                        autovid[i].removeAttribute('media-hidden')
                        autovid[i].setAttribute('class', 'brows-media vds')
                        autovid[i].addEventListener('click', function() {

                            if (autovid[i].paused) 
                                autovid[i].play(); 
                            else 
                                autovid[i].pause(); 

                        })
                    }
                    
                }
                
            }

            
        });
        
        media.addEventListener('mouseout', function(e) {

        if(e.target.getAttribute('class') === 'brows-media vds') {
    
            e.target.setAttribute('class', 'brows-media vds media-hidden');
    
            var sourcesArr = Array.from(sources);
            var imags = Array.from(images);
            var autovid = Array.from(vds);
            
            for(let i = 0; i < sourcesArr.length; i++ ) {
                
                // data = imags.getAttribute('data');
                src = sourcesArr[i].getAttribute('src');
                if (src === data) {
                    imags[i].removeAttribute('media-hidden');
                    imags[i].setAttribute('class', 'brows-media imgs');
                    autovid[i].removeAttribute('autoplay');
                }
                
            }
    
        }

    });

            
    });

}


// ----------------------------------------------- insert to myList with ajax------------------------------------------ \\

var likes = document.getElementsByClassName('btn-like'),
    dislikes = document.getElementsByClassName('btn-dislike');
    // like_icons = document.getElementsByClassName('fa-thumbs-up'),
    // icons = Array.from(like_icons);
    

if (likes && dislikes) {

    Array.from(likes).forEach(like => {
    
        like.addEventListener('click', function(e) {
    
            var data_like = like.getAttribute('data-like');
            var profil_id = like.getAttribute('data-profilId');
            var movie_id = like.getAttribute('data-movieId');
            movie_id = movie_id.slice(0,-2);
    
            // alert(data_like);
            e.preventDefault();
    
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    data_like: data_like,
                    movie_id: movie_id,
                    profil_id: profil_id,
                    _token: token
    
                },
    
                success:function (data) {
    
                    
    
                        
                        if (data.is_like == 1) {
                            
                            $('*[icon-movieId="'+ movie_id +'_l"]').addClass('like');
                            $('*[icon-movieId="'+ movie_id +'_d"]').removeClass('dislike');
                        }
    
                        if (data.is_like == 0) {
    
                            $('*[icon-movieId="'+ movie_id +'_l"]').removeClass('like');
    
                        }
    
                    // console.log(data.movie_id);
                }
    
            })
        });
    
    });
    
    
    Array.from(dislikes).forEach(dislike => {
    
    
        dislike.addEventListener('click', function(e) {
    
            var data_like = dislike.getAttribute('data-like');
            var profil_id = dislike.getAttribute('data-profilId');
            var movie_id = dislike.getAttribute('data-movieId');
            movie_id = movie_id.slice(0,-2);
    
            // alert(data_like);
            e.preventDefault();
    
            $.ajax({
                type: 'POST',
                url: url_dis,
                data: {
                    data_like: data_like,
                    movie_id: movie_id,
                    profil_id: profil_id,
                    _token: token
    
                },
    
                success:function (data) {
                        
                        if (data.is_dislike == 0) {
                            
                            $('*[icon-movieId="'+ movie_id +'_d"]').addClass('dislike');
                            $('*[icon-movieId="'+ movie_id +'_l"]').removeClass('like');
                        }
    
                        if (data.is_dislike == 1) {
    
                            $('*[icon-movieId="'+ movie_id +'_d"]').removeClass('dislike');
    
                        }
    
                    // console.log(data.movie_id);
                }
    
            })
        });
    
    });
}







