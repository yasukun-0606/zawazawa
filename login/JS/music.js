var audio = null;

function init(){
    audio = new Audio("");

    audio.autoplay = false;

    if(document.getElementById("music_name").value == "BH"){
        audio.src = "music/song_kei_burning_heart.mp3";
        console.log("Burning Heart");
    } else if(document.getElementById("music_name").value == "moon"){
        audio.src="music/song_kei_tsukito_ookami.mp3";
        console.log("月と狼");
    } else if(document.getElementById("music_name").value == "star"){
        audio.src="music/song_shiho_shining_star.mp3";
    } else if(document.getElementById("music_name").value == "you"){
        audio.src="music/song_kei_where_you_are.mp3";
    } else if(document.getElementById("music_name").value == "spring"){
        audio.src="music/20200530shinshun.mp3";
    }
}

function play(){
    audio.play();
    //window.location.href = 'test.html';
}

//先頭から再生
function playfromstart(){
    init();
    audio.load();
    audio.play();
}

function pause(){
    //init();
    audio.pause();
}

function stop(){
    if(!audio.ended){
    audio.pause();
    audio.currentTime = 0;
    }
}

function loop(){
    init();
    audio.loop = true;
    audio.play();
}

function music_start(){
    init();
    play();
}