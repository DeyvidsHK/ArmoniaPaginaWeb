let audioPlaying = null;

function reproducir(audioElement, startTime) {
    const audio = audioElement;
    if (audioPlaying && audioPlaying !== audio) {
        audioPlaying.pause();
    }
    if (audio.paused) {
        audio.currentTime = startTime;
        audio.play();
        audioPlaying = audio;
    }
}

function reiniciar(audioElement, startTime) {
    const audio = audioElement;
    if (audio === audioPlaying) {
        audio.pause();
        audio.currentTime = startTime;
        audio.play();
    }
}

function pausar(audioElement) {
    const audio = audioElement;
    if (audio === audioPlaying) {
        audio.pause();
        audioPlaying = null;
    }
}



