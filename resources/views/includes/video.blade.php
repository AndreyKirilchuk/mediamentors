        <!-- Начальное видео -->
        <div class="video_banner_container" id="reverse">
            <div class="video-container" id="video-reverse">
                <video muted  class="main_video" loop id="main_banner_video" width="100%" onclick="playVideo()" poster="{{asset('images/Loadvideo.png')}}" >
                    <h1>Ваш бразуер не поддерживает видео</h1>
                </video>
                <button title="playstop" class="playButtons" id="main_video_btn" onclick="playVideo()">
                    <img src="{{asset('images/playButton.svg')}}" alt="" width="100%">
                    <img src="{{asset('images/pauseButton.svg')}}" alt="" width="100%">
                </button>
                <button title="volume" class="MuteButton" id="muteButton" onclick="muteToggle()">
                    <img src="{{asset('images/mute.svg')}}" alt="" width="100%">
                    <img src="{{asset('images/unmute.svg')}}" alt="" width="100%">
                </button>
            </div>
        </div>
