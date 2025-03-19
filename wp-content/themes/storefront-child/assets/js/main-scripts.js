var arrow_direita = '<div class="slick-next"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 14.7" xml:space="preserve"><path d="M19.7 6.7 13.3.3c-.4-.4-1-.4-1.4 0-.4.4-.4 1 0 1.4l4.7 4.7H0v2h16.6L11.9 13c-.4.4-.4 1 0 1.4.4.4 1 .4 1.4 0L19.7 8c.4-.3.4-1 0-1.3z"/></svg></div>';
var arrow_esquerda = '<div class="slick-prev"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 14.7" xml:space="preserve"><path d="M20 6.4H3.4l4.7-4.7c.4-.4.4-1 0-1.4-.4-.4-1-.4-1.4 0L.3 6.7c-.4.4-.4 1 0 1.4l6.4 6.4c.4.4 1 .4 1.4 0 .4-.4.4-1 0-1.4L3.4 8.4H20v-2z"/></svg></div>';

jQuery(document).ready(function ($) {

    $('body').on('click', '.menu-hamburger__wrapper', function () {
        $(this).toggleClass('active');
        $('.menu-principal__wrapper').toggleClass('active');
    });

    if ($(window).width() < 960) {
        if ($('.beneficios__wrapper')) {
            $('.beneficios__wrapper').slick({
                centerMode: false,
                lazyLoad: 'ondemand',
                centerPadding: '0',
                infinite: true,
                slidesToShow: 2,
                autoplay: true,
                responsive: [
                    {
                        breakpoint: 4000,
                        settings: "unslick"
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            dots: true,
                            centerMode: false,
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            dots: true,
                            centerMode: false,
                            slidesToShow: 1
                        }
                    }
                ]
            });
        }
    }


    // if($('body').hasClass('page-template-template-produtos')){

    // }
    
    if ($('.lista-produtos .produto > .fotos')) {
        $('.lista-produtos .produto > .fotos').slick({
            centerMode: false,
            lazyLoad: 'ondemand',
            centerPadding: '0',
            infinite: false,
            dots: true,
            prevArrow: arrow_esquerda,
            nextArrow: arrow_direita,
            arrows: true,
            slidesToShow: 1
        });
    }

    if($('.aromas_selecionados-wrapper').length){
        
        $('.wccpf_fields_table.aromas_selecionados-wrapper').after('<p class="contador-aromas"></p>')


        $('body').on('click', '.wccpf-field-layout-horizontal li label .wccpf-field', function(){
            var total_selecionado = $('.wccpf-field:checked').length;

            if(total_selecionado >= 5){
                $('.wccpf-field-layout-horizontal li label').addClass('disabled')
            }else{
                $('.wccpf-field-layout-horizontal li label').removeClass('disabled')
            }

            if(total_selecionado >= 6){
                $(this).parent().removeClass('active');
                this.checked = false;
            }else{
                if(!$(this).parent().hasClass('active')){
                    $(this).parent().addClass('active');
                }else{
                    $(this).parent().removeClass('active');
                }
            }

            if(total_selecionado >= 1){
                $('.contador-aromas').show()

                if(total_selecionado == 1){
                    $('.contador-aromas').html("<b>" + total_selecionado + "</b> aroma selecionado")
                }else{
                    $('.contador-aromas').html("<b>" + total_selecionado + "</b> aromas selecionados")
                }
            }else{
                $('.contador-aromas').hide()
            }

            
        })
    }


    if($('body').hasClass('blog')){
        if ($(window).width() < 960) {
            if ($('.slider-post-destaques')) {
                $('.slider-post-destaques').slick({
                    centerMode: false,
                    lazyLoad: 'ondemand',
                    infinite: false,
                    slidesToShow: 1,
                    arrows: false,
                    dots: true
                });
            }
            if ($('.most-read-list .row')) {
                $('.most-read-list .row').slick({
                    centerMode: false,
                    lazyLoad: 'ondemand',
                    infinite: false,
                    slidesToShow: 1,
                    arrows: false,
                    dots: true
                });
            }
            

        }
    }


    $('#load-more').click(function(){
        var button = $(this),
        data = {
            'action': 'loadmore',
            'query': load_more_params.posts,
            'page' : load_more_params.current_page
        };


        $.ajax({
            url : load_more_params.ajaxurl,
            data:data,
            type:'POST',
            beforeSend: function( xhr ){
                button.text('carregando...'); // Mudança de texto no botão enquanto carrega
            },
            success:function(data){
                if( data ) {
                    $('#posts-container').append(data);
                    load_more_params.current_page++;
                    button.html('carregar mais <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" xml:space="preserve"><path d="M18 8h-8V0H8v8H0v2h8v8h2v-8h8z"/></svg>');
                    if ( load_more_params.current_page == load_more_params.max_page )
                        button.remove(); // Remove o botão se for a última página
                } else {
                    button.remove(); // Remove o botão se não houver mais posts
                }
            }
        });
    });


});