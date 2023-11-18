const RtcTokenBuilder = require('agora-access-token');
const fs = require('fs');

const APP_ID = 'YOUR_AGORA_APP_ID';
const APP_CERTIFICATE = 'YOUR_AGORA_APP_CERTIFICATE';
const CHANNEL_NAME = 'YOUR_CHANNEL_NAME';

const expirationTimeInSeconds = 3600; // 1 hour

// Generate token function
function generateToken(uid, role) {
    const key = RtcTokenBuilder.buildKey(APP_ID, APP_CERTIFICATE, CHANNEL_NAME, uid, role, expirationTimeInSeconds);
    const token = RtcTokenBuilder.buildTokenWithUid(APP_ID, APP_CERTIFICATE, CHANNEL_NAME, uid, role, expirationTimeInSeconds);

    return token;
}

// Example usage
const uid = 12345; // Replace with your user's unique ID
const role = RtcTokenBuilder.Role.PUBLISHER; // or RtcTokenBuilder.Role.SUBSCRIBER

const token = generateToken(uid, role);

console.log('Agora Token:', token);

// Save the token to a file or use it as needed
// fs.writeFileSync('agoraToken.txt', token);


const APP_ID = "8f08be250be84624af8a1b4d02521efa";
const TOKEN = "007eJxTYMivtuVOjFyo5eV4ObmiWWiyQ1m7tX2vT5PvvzcndElUq3AYJFmYJGUamRqkJRqYWJmZJKYZpFomGSSYmBkamSYmpZ4d3VoakMgI8POvn5mRgYIBPHZGUKCg3Rd8wIYGABjEx/J";
const CHANNEL = "TSR-EnP";
const APP_CERTIFICATE = "01d8a477c3f046ba9362c16f7374a757";

const client = AgoraRTC.createClient({mode:'rtc', codec:'vp8'})

let localTracks = []
let remoteUsers = {}

let joinAndDisplayLocalStream = async () => {

    client.on('user-published', handleUserJoined)

    client.on('user-left', handleUserLeft)

    let UID = await client.join(APP_ID, CHANNEL, TOKEN, null)

    localTracks = await AgoraRTC.createMicrophoneAndCameraTracks()

    let player = `<div class="video-container" id="user-container-${UID}">
                        <div class="video-player" id="user-${UID}"></div>
                  </div>`
    document.getElementById('video-streams').insertAdjacentHTML('beforeend', player)

    localTracks[1].play(`user-${UID}`)

    await client.publish([localTracks[0], localTracks[1]])
}

let joinStream = async () => {
    await joinAndDisplayLocalStream()
    document.getElementById('join-btn').style.display = 'none'
    document.getElementById('stream-controls').style.display = 'flex'
}

let handleUserJoined = async (user, mediaType) => {
    remoteUsers[user.uid] = user
    await client.subscribe(user, mediaType)

    if (mediaType === 'video'){
        let player = document.getElementById(`user-container-${user.uid}`)
        if (player != null){
            player.remove()
        }

        player = `<div class="video-container" id="user-container-${user.uid}">
                        <div class="video-player" id="user-${user.uid}"></div>
                 </div>`
        document.getElementById('video-streams').insertAdjacentHTML('beforeend', player)

        user.videoTrack.play(`user-${user.uid}`)
    }

    if (mediaType === 'audio'){
        user.audioTrack.play()
    }
}

let handleUserLeft = async (user) => {
    delete remoteUsers[user.uid]
    document.getElementById(`user-container-${user.uid}`).remove()
}

let leaveAndRemoveLocalStream = async () => {
    for(let i = 0; localTracks.length > i; i++){
        localTracks[i].stop()
        localTracks[i].close()
    }

    await client.leave()
    document.getElementById('join-btn').style.display = 'block'
    document.getElementById('stream-controls').style.display = 'none'
    document.getElementById('video-streams').innerHTML = ''
}

let toggleMic = async (e) => {
    if (localTracks[0].muted){
        await localTracks[0].setMuted(false)
        e.target.innerText = 'Mic on'
        e.target.style.backgroundColor = 'cadetblue'
    }else{
        await localTracks[0].setMuted(true)
        e.target.innerText = 'Mic off'
        e.target.style.backgroundColor = '#EE4B2B'
    }
}


let toggleCamera = async (e) => {
    if(localTracks[1].muted){
        await localTracks[1].setMuted(false)
        e.target.innerText = 'Camera on'
        e.target.style.backgroundColor = 'cadetblue'
    }else{
        await localTracks[1].setMuted(true)
        e.target.innerText = 'Camera off'
        e.target.style.backgroundColor = '#EE4B2B'
    }
}

document.getElementById('join-btn').addEventListener('click', joinStream)
document.getElementById('leave-btn').addEventListener('click', leaveAndRemoveLocalStream)
document.getElementById('mic-btn').addEventListener('click', toggleMic)
document.getElementById('camera-btn').addEventListener('click', toggleCamera)
