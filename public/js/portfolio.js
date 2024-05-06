main_array_card.forEach(e=>{
    if(e.addEventListener)
        e.addEventListener('click', function(event){
            const videoElement = this.querySelector('video');
            if(!videoElement) return;
            if (event.target === this.querySelector('.screenButtonImg')){
                // videoElement.style.objectFit = 'contain';
                if (videoElement.requestFullscreen) {
                    videoElement.requestFullscreen();
                } else if (videoElement.mozRequestFullScreen) { /* Firefox */
                    videoElement.mozRequestFullScreen();
                } else if (videoElement.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
                    videoElement.webkitRequestFullscreen();
                } else if (videoElement.msRequestFullscreen) { /* IE/Edge */
                    videoElement.msRequestFullscreen();
                }else if(videoElement.webkitEnterFullscreen) {
                    videoElement.webkitEnterFullscreen();
                } else {
                    alert('Полноэкранный режим не поддерживается на данном устройстве или браузере.');
                }
            }else if(event.target === this.querySelector('.MuteButtonImg') || event.target === this.querySelector('.MuteButtonImg2')){
                if(videoElement.muted){
                    videoElement.muted = false;
                    this.querySelector('.MuteButton').classList.add('active');
                } else {
                    videoElement.muted = true;
                    this.querySelector('.MuteButton').classList.remove('active');
                }
            }else{
                if(videoElement.paused){
                    videoElement.play();
                    this.querySelector('.playButtons').classList.remove('active');
                }else{
                    videoElement.pause();
                    this.querySelector('.playButtons').classList.add('active');
                }
            }
        })
})

//При выходе из полноэкранного режима видос становился cover

// document.addEventListener('fullscreenchange', (event) => {
//   if (!document.fullscreenElement) {
//     const allMainVideo = document.querySelectorAll('.main_video');
//     allMainVideo.forEach(e=>{
//         e.style.objectFit = 'cover';
//     });
//   }
// });

//Слайдер в портфолио, галерея
let swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    keyboard: {
      enabled: true,
    },
});

const sliderModal = document.querySelector('.sliderModal');
const portfolio_cards_mg  = document.querySelectorAll('.portfolio_card-img');
const sliderCross = document.querySelectorAll('.sliderCross');
let portfolioCountSlides = [];
let portfolioTotalSlides = [];
let portfolioOpen = []

portfolio_cards_mg.forEach((e, index) =>{
    portfolioTotalSlides.push(e.querySelectorAll('.showGalereySlider').length);
    portfolioCountSlides.push(e.querySelectorAll('.showGalereySlider').length / 3);
    portfolioOpen.push(3)
    
    e.querySelectorAll('.showGalereySlider').forEach( (item, itemIndex) => {
        if (itemIndex < 15) {
            item.style.display = 'block';
        }
        // if(itemIndex >= 12 && itemIndex < 15 ){
        //     item.style.maskImage = 'linear-gradient(to bottom, white 0%, transparent 100%)';
        // }
        item.addEventListener('click', function () {
            e.querySelector('.sliderDialog').showModal();
            e.querySelector('.sliderDialog').style.display ='flex';
        
            
            body.classList.add('active');

            let peremen = parseInt(item.id);
            
            e.querySelector('.sliderCross').style.display = 'block';
            sliderModal.style.display = 'block';
            swiper[index].slideToLoop(peremen,0, false);
        });
    });
});

    console.log(portfolioTotalSlides)

//Показывает больше слайдов
function showMoreSlides(indexSlide) {
    countSlide = portfolioCountSlides[indexSlide] + portfolioTotalSlides[indexSlide]/3;
       
    if(portfolioOpen[indexSlide] >= 3){
        //Добавление слайдов
        portfolioCountSlides[indexSlide] = countSlide;
        
        portfolio_cards_mg.forEach((e, index) => {
            if (index === indexSlide) { 
                e.querySelectorAll('.showGalereySlider').forEach((item, itemIndex) => {
                    //Если индекс элемента меньше макс слайда
                    if (itemIndex < countSlide) {
                        item.style.display = 'block';
                        item.style.maskImage = 'none';
                    };
                    
                    //  if(itemIndex >= countSlide - 3 && itemIndex < countSlide ){
                    //     item.style.maskImage = 'linear-gradient(to bottom, white 0%, transparent 100%)';
                    //     console.log('asd');
                    // }
                });
                
                portfolioOpen[indexSlide] = 2;
            }
        });
    }else if(portfolioOpen[indexSlide] === 2){
        //Скрытие кнопки
        const allButtons = document.querySelectorAll('.showMoreSlides');
        
        allButtons.forEach((e, index)=> {
           if(index === indexSlide){
            //  e.innerHTML = 'Cкрыть фото';
            e.style.display ='none';
            e.nextElementSibling.style.display = 'none';
           }
        });
        portfolio_cards_mg.forEach((e, index) => {
            if (index === indexSlide) { 
                e.querySelectorAll('.showGalereySlider').forEach((item, itemIndex) => {
                    //Если индекс элемента меньше макс слайда
                    if (itemIndex < countSlide) {
                        item.style.display = 'block';
                        item.style.maskImage = 'none';
                    };
                });
            }
            
            portfolioOpen[indexSlide] = 1;
            console.log(portfolioOpen[indexSlide])
        });
    }
    // }else{
    //     const allButtons = document.querySelectorAll('.showMoreSlides');
        
    //     allButtons.forEach((e, index)=> {
    //       if(index === indexSlide){
    //         e.innerHTML = 'Больше фото';
    //         e.nextElementSibling.style.display = 'block';
    //       }
    //     });
        
    //     portfolio_cards_mg.forEach((e, index) => {
    //         if (index === indexSlide) { 
    //             e.querySelectorAll('.showGalereySlider').forEach((item, itemIndex) => {
    //                 //Если индекс элемента меньше макс слайда
    //                 if (itemIndex > 0) {
    //                     item.style.display = 'none';
    //                     item.style.maskImage = 'none';
    //                 };
    //             });
    //         }
            
    //         portfolioOpen[indexSlide] = 4;
    //         console.log(portfolioOpen[indexSlide]);
    //         portfolioCountSlides[indexSlide] = portfolioTotalSlides[indexSlide]/3;
    //         console.log(portfolioCountSlides[indexSlide]);
    //     });
    // }
}

const sliderDialogs = document.querySelectorAll('.sliderDialog');

sliderDialogs.forEach( e=>{
    e.addEventListener('click', function(event) {
        if(event.target === e || event.target === e.querySelector('.sliderCross') ){
            e.close();
            e.querySelector('.sliderCross').style.display = 'none';
            e.style.display = 'none';
    
            body.classList.remove('active');
            sliderModal.style.display = 'none';
        }
    })
})

