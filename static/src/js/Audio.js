let audioPlaying = null;
let restart = false;

function reproducir(audioElement, startTime) {
    const audio = audioElement;
    if (audioPlaying && audioPlaying !== audio) {
        audioPlaying.pause();
    }
    if (audio.paused || restart) {
        audio.currentTime = restart ? startTime : audio.currentTime;
        audio.play();
        audioPlaying = audio;
        restart = false;

        const duracionMaxima = 25;
        audio.ontimeupdate = function() {
            if (audio.currentTime >= startTime + duracionMaxima) {
                audio.pause();
                audio.currentTime = startTime;  
                audioPlaying = null;
            }
        };
    }
}


function reiniciar(audioElement, startTime) {
    const audio = audioElement;
    audio.currentTime = startTime;
    if (audio.paused) {
        restart = true;
        audio.play();
        audioPlaying = audio;
    }
}

function pausar(audioElement) {
    const audio = audioElement;
    if (audio === audioPlaying) {
        audio.pause();
        audio.currentTime = audio.currentTime - 0.01; 
        audioPlaying = null;
    }
}

