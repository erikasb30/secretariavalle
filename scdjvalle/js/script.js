// Obtener elementos del DOM
const localVideo = document.getElementById('localVideo');
const toggleCameraBtn = document.getElementById('toggleCameraBtn');
const toggleMicBtn = document.getElementById('toggleMicBtn');
const requestPermissionsBtn = document.getElementById('requestPermissionsBtn');
const startRecordingBtn = document.getElementById('startRecordingBtn'); // Nuevo elemento agregado

// Obtener el cronómetro de grabación
const recordingTimer = document.getElementById('recordingTimer');

// Variables para controlar el cronómetro
let startTime;
let recordingInterval;

// Declarar variables para el objeto MediaRecorder y el blob de video
let mediaRecorder;
let recordedBlobs = [];

// Obtener el indicador visual de grabación
const recordingIndicator = document.getElementById('recordingIndicator');

// Función async para obtener acceso a la cámara y asignarla al elemento de video
async function getCameraStream() {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({ video: true });
        // Asignar el stream de la cámara al elemento de video
        localVideo.srcObject = stream;

        // Verificar si localVideo.srcObject está asignado
        if (localVideo.srcObject) {
            console.log('El objeto srcObject de localVideo está asignado correctamente.');
        } else {
            throw new Error('El objeto srcObject de localVideo es null. Verifica la asignación.');
        }
    } catch (error) {
        handleCameraError(error);
    }
}

// Llamar a la función para obtener acceso a la cámara al cargar la página
window.addEventListener('load', getCameraStream);

// Event listener para el botón de solicitud de permisos
requestPermissionsBtn.addEventListener('click', () => {
    requestMicPermission(); // Llama a la función requestMicPermission cuando se hace clic en el botón
});

// Función para verificar y solicitar permiso para acceder al micrófono
function requestMicPermission() {
    navigator.mediaDevices.getUserMedia({ audio: true })
        .then(stream => {
            // El usuario ha dado permiso, se puede activar el micrófono
            toggleMic();
        })
        .catch(error => {
            handleMicPermissionError(error);
        });
}

// Función para activar/desactivar el micrófono
function toggleMic() {
    if (localVideo.srcObject) {
        const tracks = localVideo.srcObject.getAudioTracks();
        tracks.forEach(track => {
            track.enabled = !track.enabled;
        });
    } else {
        handleMicToggleError('El objeto srcObject de localVideo es null');
    }
}

// Función para activar/desactivar la cámara
function toggleCamera() {
    if (localVideo.srcObject) {
        const tracks = localVideo.srcObject.getVideoTracks();
        tracks.forEach(track => {
            track.enabled = !track.enabled;
        });
    } else {
        handleCameraToggleError('El objeto srcObject de localVideo es null');
    }
}

// Event listener para el botón "Iniciar Grabación"
startRecordingBtn.addEventListener('click', () => {
    if (mediaRecorder && mediaRecorder.state === 'recording') {
        // Si la grabación ya está en curso, detener la grabación
        stopRecording();
        // Detener el cronómetro
        stopRecordingTimer();
        // Ocultar el indicador visual de grabación y el cronómetro
        recordingIndicator.style.display = 'none';
        recordingTimer.style.display = 'none';
    } else {
        // Si no hay grabación en curso, iniciar la grabación
        startRecording();
        // Iniciar el cronómetro
        startRecordingTimer();
        // Mostrar el indicador visual de grabación y el cronómetro
        recordingIndicator.style.display = 'block';
        recordingTimer.style.display = 'block';
    }
});

// Función para iniciar la grabación
function startRecording() {
    try {
        // Verificar si el stream de video está disponible
        if (localVideo.srcObject) {
            // Crear un nuevo objeto MediaRecorder para grabar el stream de video
            mediaRecorder = new MediaRecorder(localVideo.srcObject);

            // Event listener para cuando se recibe un nuevo chunk de datos de video
            mediaRecorder.ondataavailable = handleDataAvailable;

            // Iniciar la grabación
            mediaRecorder.start();
            console.log('Grabación iniciada.');
        } else {
            throw new Error('El objeto srcObject de localVideo es null. No se puede iniciar la grabación.');
        }
    } catch (error) {
        handleRecordingStartError(error);
    }
}

// Función para detener la grabación
function stopRecording() {
    if (mediaRecorder && mediaRecorder.state === 'recording') {
        // Detener la grabación
        mediaRecorder.stop();
        console.log('Grabación detenida.');

        // Reiniciar el MediaRecorder y el array de blobs grabados
        mediaRecorder = null;
        recordedBlobs = [];
    }
}
// Función para manejar errores al iniciar la grabación
function handleRecordingStartError(error) {
    console.error('Error al iniciar la grabación:', error);
}

// Función para manejar los datos disponibles durante la grabación
function handleDataAvailable(event) {
    if (event.data && event.data.size > 0) {
        // Agregar los datos al array de blobs grabados
        recordedBlobs.push(event.data);
    }
}

// Función para iniciar el cronómetro de grabación
function startRecordingTimer() {
    startTime = Date.now();
    recordingInterval = setInterval(updateRecordingTime, 1000);
}

// Función para actualizar el tiempo en el cronómetro de grabación
function updateRecordingTime() {
    const elapsedTime = Date.now() - startTime;
    const seconds = Math.floor(elapsedTime / 1000);
    const minutes = Math.floor(seconds / 60);
    const formattedTime = `${minutes}:${seconds % 60 < 10 ? '0' : ''}${seconds % 60}`;
    recordingTimer.textContent = formattedTime;
}
