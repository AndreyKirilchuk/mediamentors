const banner = document.getElementById('banner');
const content = document.getElementById('content');
const header_burger = document.querySelector('.header_burger');
const burger_menu = document.querySelector('.burger-menu');
const servis = document.querySelector('.servis');
const text_anim = document.querySelectorAll('.text-anim');
const main_video_btn = document.getElementById('main_video_btn');
const playButtons = document.querySelectorAll('.playButtons');
const muteButton = document.getElementById('muteButton');
const title_link = document.querySelectorAll('.title-link');
const link_reverse = document.querySelector('.link_reverse');
const body = document.querySelector('body');
const header_container = document.querySelector('.header_container');
const main_array_card = document.querySelectorAll('.main_array-card');
const servisLinkContainer = document.getElementById('servisLinkContainer');
let linkButtonBoolean = false;

if(banner){
    body.classList.add('active');
}

window.addEventListener('scroll', () => {

    //Размеры для заливки шапки
    let razmer = 850;
    if(window.innerWidth < 1200){
        razmer = 550;
    }
    if(window.innerWidth < 1024){
        razmer = 400;
    }
    if(window.innerWidth < 768){
        razmer = 200;
    }   

    if(window.innerWidth < 480){
        if(scrollY < (razmer - 700)){
            link_reverse.style.opacity = '0'
            link_reverse.style.background = 'none';
        }else{
            link_reverse.style.opacity = '1'
            link_reverse.style.background = 'black';
        }
    }

    if(scrollY < (razmer - 700)){
        servisLinkContainer.style.opacity = '0'
        linkButtonBoolean = false
    }else{
        servisLinkContainer.style.opacity ='1'
        linkButtonBoolean = true;
    }

    //Шапка заливается черным
    if (scrollY > razmer ) {
        header_container.classList.add('active');
    }
    if( scrollY < razmer ){
        header_container.classList.remove('active');
    }
});


main_array_card.forEach(card => {
    card.addEventListener('touchstart', function() {
      this.classList.add('hover');
      this.querySelector('.hoverMedia').classList.add('hover');
    });
    
    card.addEventListener('touchend', function() {
      this.classList.remove('hover');
      this.querySelector('.hoverMedia').classList.remove('hover');
    });
})

//Анимация пропадания плашки
async function scrollBanner ()  {
    banner.style.opacity = "0";
    banner.style.zIndex = "-999";

    body.classList.remove('active');
    
    const main_banner_video = document.getElementById('main_banner_video');
    
    if(window.innerWidth < 640){
        main_banner_video.src = 'video/MediaMentorsVideo_mobile.mp4';
    }else{
        main_banner_video.src ='video/MediaMentorsVideo.mp4';
    }
    
    main_banner_video.play();
}




if(banner){
    //Скрытие заставки спустя время которое работает гифка
    setTimeout(() => {
        scrollBanner();
    },3000);
}

//Бургер меню
let burgerMenu = false;

function toggleMenu(){
    header_burger.classList.toggle('active');
    burger_menu.classList.toggle('active');
    //Запрещаю прокрутку внутри бургера
    body.classList.toggle('active');

    if(banner){
        banner.classList.toggle('active');
    }

    if(!burgerMenu && linkButtonBoolean){
        link_reverse.style.opacity = '0'
        servisLinkContainer.style.opacity = '0'
        burgerMenu = true;
    }else{
        link_reverse.style.opacity = '1'
        servisLinkContainer.style.opacity = '1'
        burgerMenu = false;
    }
}

//Открытие плашки с услугами
function openServis(){
    servis.classList.add('active');
    //Анимация плавного выдвижения текста
    text_anim.forEach(item =>{
        item.classList.add('active');
    });

    body.classList.add('active');

    link_reverse.style.opacity = '1'
    servisLinkContainer.style.opacity = '1'
}

//Закрытие плашки с услугами и бургер меню
function closeServis(){
    servis.classList.remove('active');
    header_burger.classList.remove('active');
    burger_menu.classList.remove('active');
    body.classList.remove('active');
    //Анимация плавного выдвижения текста
    text_anim.forEach(item =>{
        item.classList.remove('active');
    });


    if(!linkButtonBoolean){
        link_reverse.style.background = 'none';
        servisLinkContainer.style.opacity = '0';
    }

}

//Включение и выключение main_video, а также переключение кастомных кнопок
const playVideo = () => {
    const main_banner_video = document.getElementById('main_banner_video');
    if (main_banner_video.paused) {
        main_banner_video.play();
        main_video_btn.classList.remove('active');
    } else {
        main_banner_video.pause();
        main_video_btn.classList.add('active');
    }
}

//Включение и выключение звука
const muteToggle = () => {
    const main_banner_video = document.getElementById('main_banner_video');
    if (main_banner_video.muted) {
        main_banner_video.muted = false;
        muteButton.classList.add('active');
    } else {
        main_banner_video.muted = true;
        muteButton.classList.remove('active');
    }
};


let count = 0;
let texts = []
//Берем заголовки с сайта и записываем в массив
title_link.forEach(item=>{
    texts.push(item.innerHTML);
});

const view = 'Смотреть еще';

//Анимация смены заголовков
const titleAnim = () => {
    title_link.forEach((item, index) => {
        let newHTML = '';
        if (count % 2 !== 0) {
            let letters = texts[index];
            newHTML = `
            <span class="jt --debug">
                <span class="jt__row">
                    <span class="jt__text">${letters}</span>
                </span>
                <span class="jt__row jt__row--sibling" aria-hidden="true">
                    <span class="jt__text">${letters}</span>
                </span>
                <span class="jt__row jt__row--sibling" aria-hidden="true">
                    <span class="jt__text">${letters}</span>
                </span>
                <span class="jt__row jt__row--sibling" aria-hidden="true">
                    <span class="jt__text">${letters}</span>
                </span>
            </span>

            `;
            item.innerHTML = newHTML;
        } else {
            let letters = "Смотреть еще";
            newHTML = `
            <span class="jt --debug">
                <span class="jt__row">
                    <span class="jt__text">${letters}</span>
                </span>
                <span class="jt__row jt__row--sibling" aria-hidden="true">
                    <span class="jt__text">${letters}</span>
                </span>
                <span class="jt__row jt__row--sibling" aria-hidden="true">
                    <span class="jt__text">${letters}</span>
                </span>
                <span class="jt__row jt__row--sibling" aria-hidden="true">
                    <span class="jt__text">${letters}</span>
                </span>
            </span>

            `;
            item.innerHTML = newHTML;
        }
    });
    count++;
}

setInterval(titleAnim, 5000);

titleAnim();

const dialogs = document.querySelectorAll('dialog');
const btn_dialog = document.querySelectorAll('.btn_dialog');
const cross = document.querySelectorAll('.cross');

btn_dialog.forEach( e=>{
    e.addEventListener('click', function (){
        this.nextElementSibling.showModal();
    })
})

cross.forEach( e=> {
    e.addEventListener('click', function (){
        dialogs.forEach(e=>{
            e.close();
        })
    })
})

//Кнопка связаться
function showServisLink(){
    servisLinkContainer.innerHTML = `
            <a href="https://t.me/ohmyproducer" target="_blank"> 
                <button class="btn">
                    ${window.innerWidth > 480 ? 'TG' : 'Telegram'}
                </button>
            </a>
            <a href="https://wa.me/+79955092409" target="_blank">  
                <button class="btn">
                    ${window.innerWidth > 480 ? 'WA' : 'WhatsApp'}
                </button>
            </a>
        `;
    setTimeout(() => {
        servisLinkContainer.innerHTML = `
            <button class="portfolio_card-btn btn" onClick="showServisLink()">
              Связаться
            </button>
        `;
    },7000)
}

