<div class="fixed inset-0 bg-white text-primary z-50 flex flex-col items-center">
  <!-- Header -->
  <header class="w-full flex justify-between items-center px-10 py-4 border-b border-gray-200">
    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 cursor-pointer">
      <div class="font-extrabold text-4xl text-primary">D</div>
      <div class="text-3xl font-normal text-primary">FORM</div>
    </a>
    <button wire:click="toggleSettings" aria-label="Settings"
      class="text-primary text-2xl focus:outline-none cursor-pointer hover:text-gray-600">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37A1.724 1.724 0 0010.325 4.317z">
        </path>
      </svg>
    </button>
  </header>

  <main class="w-full max-w-5xl mx-auto px-6 py-8 flex-1">
    <h1 class="text-4xl font-bold text-primary text-center">
      {{ $event->name }}
    </h1>
    <p class="text-center mt-3 text-primary text-lg">
      <span class="font-bold">{{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('l') }},</span>
      {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y') }}
    </p>

    @if ($errorMessage)
      <div class="mt-4 p-4 bg-red-100 text-red-800 rounded-lg text-center">
        {{ $errorMessage }}
      </div>
    @endif

    <section class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Participant and Event Info box -->
      <div class="border-2 border-primary rounded-lg p-6 flex flex-col items-center space-y-8">
        <div class="text-xl font-bold text-primary">Participants</div>
        <div class="flex items-center space-x-2">
          <div class="bg-primary text-white font-bold text-xl rounded-md px-4 py-2 select-none">
            {{ $checkedInCount }}
          </div>
          <div class="text-2xl font-bold text-primary select-none">/</div>
          <div class="bg-primary text-white font-bold text-xl rounded-md px-4 py-2 select-none">
            {{ $totalParticipants }}
          </div>
        </div>
        <div class="text-xl font-bold text-primary">Starting at</div>
        <div class="text-2xl font-bold text-primary select-none">
          {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}
        </div>
      </div>

      <!-- QR Code Scanner Area -->
      <div
        class="bg-primary rounded-lg aspect-square flex flex-col items-center justify-center overflow-hidden relative">
        @if ($hasPermission === false)
          <div class="absolute inset-0 flex flex-col items-center justify-center bg-primary z-20 p-4">
            <p class="text-white text-center mb-4">Camera access denied</p>
            <button wire:click="startScanning" class="bg-white text-primary px-4 py-2 rounded-lg font-medium">
              Allow Camera Access
            </button>
          </div>
        @elseif($hasPermission === null && !$isScanning)
          <div wire:click="startScanning"
            class="absolute inset-0 flex flex-col items-center justify-center bg-primary z-20 cursor-pointer hover:bg-gray-700 transition duration-300">
            <p class="text-white text-center mb-4">Tap to scan QR code</p>
            <div class="w-16 h-14 border-2 border-white rounded-lg flex items-center justify-center">
              <p class="text-white text-2xl">QR</p>
            </div>
          </div>
        @endif

        <video id="video" class="absolute inset-0 w-full h-full object-cover" autoplay playsinline muted></video>

        @if ($isScanning)
          <div class="absolute inset-0 z-10">
            <div class="relative w-full h-full">
              <!-- Scanning line animation -->
              <div class="absolute left-0 w-full h-1 bg-white opacity-70 animate-pulse"
                style="top: 50%; animation: scan 2s linear infinite;"></div>
              <!-- Scanner frame overlay -->
              <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-4/5 h-4/5 border-2 border-white border-opacity-60 rounded-lg"></div>
              </div>
            </div>
          </div>
        @endif
      </div>

      <!-- Latest Participants box -->
      <div class="border-2 border-primary rounded-lg p-6 flex flex-col space-y-4">
        <div class="text-xl font-bold text-primary mb-6 text-center">
          Latest Check-Ins
        </div>
        <div class="flex flex-col gap-y-2 overflow-y-auto max-h-48">

          @forelse($latestCheckIns as $checkIn)
            <div
              class="flex justify-between items-center {{ $loop->first ? 'bg-primary text-white' : 'border border-gray-300 text-primary' }} rounded-lg px-4 py-3 text-base font-normal focus:outline-none">
              <span>{{ $checkIn['name'] }}</span>
              <span
                class="{{ $loop->first ? 'text-gray-300' : 'text-gray-400' }} font-normal">{{ $checkIn['time'] }}</span>
            </div>
          @empty
            <div class="text-center text-primary">No check-ins yet</div>
          @endforelse
        </div>
      </div>
    </section>

    {{-- back button a href admin.event-detail $event->id --}}
    <div class="mt-8 flex justify-center">
      <a href="{{ route('admin.event-detail', $event->id) }}">
        <button
          class="bg-primary text-white px-4 py-2 rounded-lg font-medium hover:bg-gray-700 transition duration-300 cursor-pointer">
          Back to Event
        </button>
      </a>
    </div>

  </main>

  <!-- Settings Modal -->
  @if ($isSettingsOpen)
    <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-center items-center mb-4">
          <h2 class="text-2xl font-bold text-primary">Settings</h2>
        </div>
        <div class="mb-6">
          <label class="block text-sm font-medium text-primary mb-2">
            Input Source
          </label>
          <div class="relative">
            <select wire:model.live="inputSource"
              class="bg-gray-200 p-3 pr-12 rounded-lg w-full text-primary focus:ring-1 focus:ring-primary appearance-none">
              @foreach ($cameraDevices as $device)
                <option value="{{ $device['deviceId'] }}">{{ $device['label'] ?: 'Camera ' . ($loop->index + 1) }}
                </option>
              @endforeach
              @if (empty($cameraDevices))
                <option value="">No cameras detected</option>
              @endif
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-primary">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
              </svg>
            </div>
          </div>
        </div>
        <div class="flex justify-center space-x-3">
          <button wire:click="toggleSettings"
            class="px-4 py-2 font-medium border-2 border-primary text-primary rounded-lg hover:bg-gray-100">
            Cancel
          </button>
          <button wire:click="toggleSettings"
            class="px-6 py-2 font-medium bg-primary text-white rounded-lg hover:bg-gray-700">
            Save
          </button>
        </div>
      </div>
    </div>
  @endif

  <!-- Success Modal -->
  @if ($showSuccessModal)
    <div class="fixed inset-0 bg-primary/80 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4 relative overflow-hidden">
        <button wire:click="closeSuccessModal"
          class="absolute top-2 right-4 text-black hover:text-primary text-xl cursor-pointer">
          ×
        </button>
        <div class="flex justify-center pt-8 pb-4">
          <div class="bg-primary rounded-full p-4">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
          </div>
        </div>
        <div class="text-center">
          <h2 class="text-3xl font-bold text-primary mb-6">You're Already Here!</h2>
          <div class="absolute left-1/2 -translate-x-1/2 -translate-y-1/2 w-6 h-6 bg-white rotate-45"></div>
          <div class="bg-primary py-8 px-6 text-white text-xl text-center font-normal">
            {{ $scannedUser }}
          </div>
        </div>
      </div>
    </div>
  @endif

  <!-- Styles -->
  <style>
    @keyframes scan {
      0% {
        top: 20%;
      }

      50% {
        top: 80%;
      }

      100% {
        top: 20%;
      }
    }
  </style>

  <!-- JavaScript for QR Scanning -->
  <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
 <script>
  document.addEventListener('livewire:initialized', () => {
    let video = document.getElementById('video');
    let stream = null;
    let scanning = @json($isScanning);
    let inputSource = @json($inputSource);
    let isProcessing = false;
    let lastScannedCode = '';
    let lastScanTime = 0;

    async function enumerateCameras() {
      try {
        const devices = await navigator.mediaDevices.enumerateDevices();
        const videoDevices = devices
          .filter(device => device.kind === 'videoinput')
          .map(device => ({
            deviceId: device.deviceId,
            label: device.label || `Camera ${devices.indexOf(device) + 1}`
          }));
        @this.call('updateCameraDevices', videoDevices);
        return videoDevices;
      } catch (err) {
        console.error('Error enumerating devices:', err);
        @this.set('errorMessage', 'Unable to access camera devices');
        return [];
      }
    }

    async function startCamera() {
      if (!inputSource) {
        const devices = await enumerateCameras();
        if (devices.length > 0) {
          inputSource = devices[0].deviceId;
          @this.set('inputSource', inputSource);
        } else {
          @this.set('errorMessage', 'No cameras available');
          return;
        }
      }

      const constraints = {
        video: {
          deviceId: inputSource ? { exact: inputSource } : undefined,
          facingMode: 'environment'
        }
      };

      try {
        stream = await navigator.mediaDevices.getUserMedia(constraints);
        video.srcObject = stream;
        video.onloadedmetadata = () => {
          video.play();
          scanQR();
        };
      } catch (err) {
        console.error('Camera error:', err);
        @this.set('hasPermission', false);
        @this.set('errorMessage', 'Failed to access camera: ' + err.message);
      }
    }

    function stopCamera() {
      if (stream) {
        stream.getTracks().forEach(track => track.stop());
        stream = null;
        video.srcObject = null;
      }
    }

    function scanQR() {
      if (!scanning || isProcessing) {
        // Continue the loop even if processing, but skip processing QR codes
        if (scanning) {
          requestAnimationFrame(scanQR);
        }
        return;
      }

      if (video.readyState < 2 || video.videoWidth === 0 || video.videoHeight === 0) {
        setTimeout(scanQR, 100);
        return;
      }

      const canvas = document.createElement('canvas');
      const context = canvas.getContext('2d');
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;

      try {
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
        const code = jsQR(imageData.data, imageData.width, imageData.height);

        if (code) {
          const currentTime = Date.now();
          if (lastScannedCode === code.data && (currentTime - lastScanTime) < 3000) {
            requestAnimationFrame(scanQR);
            return;
          }

          isProcessing = true;
          lastScannedCode = code.data;
          lastScanTime = currentTime;
          @this.call('checkIn', code.data);
        }
      } catch (err) {
        console.error('QR scan error:', err);
        @this.set('errorMessage', 'Failed to process QR code: ' + err.message);
      }

      if (scanning) {
        requestAnimationFrame(scanQR);
      }
    }

    enumerateCameras();

    @this.on('start-scanning', () => {
      scanning = true;
      startCamera();
    });

    @this.on('stop-scanning', () => {
      scanning = false;
      stopCamera();
    });

    @this.on('resetProcessingAfterDelay', () => {
      setTimeout(() => {
        isProcessing = false; // Reset client-side isProcessing
        @this.call('resetProcessing');
      }, 2000);
    });

    @this.on('inputSourceUpdated', (newSource) => {
      inputSource = newSource;
      if (scanning) {
        stopCamera();
        startCamera();
      }
    });

    Livewire.watch('inputSource', (newSource) => {
      inputSource = newSource;
      if (scanning) {
        stopCamera();
        startCamera();
      }
      @this.dispatch('inputSourceUpdated', newSource);
    });

    window.addEventListener('beforeunload', () => {
      stopCamera();
    });
  });
</script>
</div>
