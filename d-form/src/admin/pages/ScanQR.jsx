import React, { useState, useRef, useEffect } from 'react';
import { FaCog, FaArrowLeft, FaCheck } from 'react-icons/fa';
import { useNavigate } from 'react-router-dom';

const ScanQR = () => {
  const navigate = useNavigate();
  const [isSettingsOpen, setIsSettingsOpen] = useState(false);
  const [inputSource, setInputSource] = useState('Logitech C270');
  const [showSuccessModal, setShowSuccessModal] = useState(false);
  const [scannedUser, setScannedUser] = useState('Lorem Ipsum');
  const [hasPermission, setHasPermission] = useState(null);
  const [isScanning, setIsScanning] = useState(false);
  const videoRef = useRef(null);
  const streamRef = useRef(null);

  const toggleSettings = () => {
    setIsSettingsOpen(!isSettingsOpen);
  };

  // Function to request camera access and start video stream
  const startCamera = async () => {
    try {
      const constraints = {
        video: {
          facingMode: 'environment', // Use back camera if available
          deviceId: inputSource !== 'Logitech C270' ? { exact: inputSource } : undefined
        }
      };
      
      const stream = await navigator.mediaDevices.getUserMedia(constraints);
      streamRef.current = stream;
      
      if (videoRef.current) {
        videoRef.current.srcObject = stream;
        setHasPermission(true);
        setIsScanning(true);
      }
    } catch (error) {
      console.error('Error accessing camera:', error);
      setHasPermission(false);
    }
  };

  // Stop camera when component unmounts or when not scanning
  const stopCamera = () => {
    if (streamRef.current) {
      const tracks = streamRef.current.getTracks();
      tracks.forEach(track => track.stop());
      streamRef.current = null;
      if (videoRef.current) {
        videoRef.current.srcObject = null;
      }
      setIsScanning(false);
    }
  };

  // Effect to handle camera changes when input source changes
  useEffect(() => {
    if (isScanning) {
      stopCamera();
      startCamera();
    }
  }, [inputSource]);

  // Clean up on unmount
  useEffect(() => {
    return () => {
      stopCamera();
    };
  }, []);

  // Function to simulate a successful scan
  const handleScan = () => {
    if (!isScanning) {
      startCamera();
    } else {
      // In a real implementation, you would use a barcode detection library here
      // For now, we'll simulate a successful scan after a short delay
      setTimeout(() => {
        setShowSuccessModal(true);
        // Optionally stop the camera after successful scan
        // stopCamera();
      }, 1500);
    }
  };

  // Function to close success modal
  const closeSuccessModal = () => {
    setShowSuccessModal(false);
  };

  const handleCancel = () => {
    setShowSuccessModal(false);
  };

  return (
    <div className="fixed inset-0 bg-white text-[#343434] z-50 flex flex-col items-center">
      {/* Header */}
      <header className="w-full flex justify-between items-center px-10 py-4 border-b border-gray-200">
        <div
          onClick={() => navigate('/admin/dashboard')}
          className="flex items-center space-x-2 cursor-pointer"
        >
          <div className="font-extrabold text-4xl text-[#343434]">D</div>
          <div className="text-3xl font-normal text-[#343434]">FORM</div>
        </div>
        <button
          aria-label="Settings"
          className="text-[#343434] text-2xl focus:outline-none cursor-pointer hover:text-gray-600"
          onClick={toggleSettings}
        >
          <FaCog />
        </button>
      </header>

      <main className="w-full max-w-5xl mx-auto px-6 py-8 flex-1">
        <h1 className="text-4xl font-bold text-[#343434] text-center">
          Open Source on The School
        </h1>
        <p className="text-center mt-3 text-[#343434] text-lg">
          <span className="font-bold">Monday,</span> 21 October 2024
        </p>

        <section className="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
          {/* Participant and Countdown box */}
          <div className="border-2 border-[#343434] rounded-lg p-6 flex flex-col items-center space-y-8">
            <div className="text-xl font-bold text-[#343434]">Participant</div>
            <div className="flex items-center space-x-2">
              <div className="bg-[#343434] text-white font-bold text-xl rounded-md px-4 py-2 select-none">
                21
              </div>
              <div className="text-2xl font-bold text-[#343434] select-none">
                /
              </div>
              <div className="bg-[#343434] text-white font-bold text-xl rounded-md px-4 py-2 select-none">
                30
              </div>
            </div>

            <div className="text-xl font-bold text-[#343434]">Starting in</div>
            <div className="flex items-center space-x-2 select-none">
              <div className="bg-[#343434] text-white font-bold text-xl rounded-md px-4 py-2">
                00
              </div>
              <div className="text-2xl font-bold text-[#343434]">:</div>
              <div className="bg-[#343434] text-white font-bold text-xl rounded-md px-4 py-2">
                03
              </div>
              <div className="text-2xl font-bold text-[#343434]">:</div>
              <div className="bg-[#343434] text-white font-bold text-xl rounded-md px-4 py-2">
                21
              </div>
            </div>
          </div>

          {/* QR Code Scanner Area with Camera Access */}
          <div className="bg-[#343434] rounded-lg aspect-square flex flex-col items-center justify-center overflow-hidden relative">
            {hasPermission === false && (
              <div className="absolute inset-0 flex flex-col items-center justify-center bg-[#343434] z-20 p-4">
                <p className="text-white text-center mb-4">Camera access denied</p>
                <button
                  onClick={startCamera}
                  className="bg-white text-[#343434] px-4 py-2 rounded-lg font-medium"
                >
                  Allow Camera Access
                </button>
              </div>
            )}
            
            {hasPermission === null && !isScanning && (
              <div 
                className="absolute inset-0 flex flex-col items-center justify-center bg-[#343434] z-20 cursor-pointer hover:bg-[#2a2a2a] transition duration-300"
                onClick={handleScan}
              >
                <p className="text-white text-center mb-4">Tap to scan QR code</p>
                <div className="w-16 h-14 border-2 border-white rounded-lg flex items-center justify-center">
                  <p className="text-white text-2xl">QR</p>
                </div>
              </div>
            )}
            
            <video
              ref={videoRef}
              className="absolute inset-0 w-full h-full object-cover"
              autoPlay
              playsInline
              muted
            />
            
            {isScanning && (
              <>
                <div className="absolute inset-0 z-10">
                  <div className="relative w-full h-full">
                    {/* Scanning line animation */}
                    <div className="absolute left-0 w-full h-1 bg-white opacity-70 animate-pulse" 
                         style={{top: '50%', animation: 'scan 2s linear infinite'}}></div>
                    
                    {/* Scanner frame overlay */}
                    <div className="absolute inset-0 flex items-center justify-center">
                      <div className="w-4/5 h-4/5 border-2 border-white border-opacity-60 rounded-lg"></div>
                    </div>
                  </div>
                </div>
              </>
            )}
          </div>

          {/* Latest Participants box */}
          <div className="border-2 border-[#343434] rounded-lg p-6 flex flex-col space-y-4">
            <div className="text-xl font-bold text-[#343434] mb-6 text-center">
              Latest Participant
            </div>

            <button
              type="button"
              className="flex justify-between items-center bg-[#343434] text-white rounded-lg px-4 py-3 text-base font-normal focus:outline-none"
            >
              <span>Lorem Ipsum</span>
              <span className="text-gray-300 font-normal">09:10</span>
            </button>

            <button
              type="button"
              className="flex justify-between items-center border border-gray-300 rounded-lg px-4 py-3 text-base font-normal text-[#343434] focus:outline-none"
            >
              <span>Lorem Ipsum</span>
              <span className="text-gray-400 font-normal">09:08</span>
            </button>

            <button
              type="button"
              className="flex justify-between items-center border border-gray-300 rounded-lg px-4 py-3 text-base font-normal text-[#343434] focus:outline-none"
            >
              <span>Lorem Ipsum</span>
              <span className="text-gray-400 font-normal">09:05</span>
            </button>
          </div>
        </section>
      </main>

      {/* Settings Modal */}
      {isSettingsOpen && (
        <div className="fixed inset-0 bg-black/60 bg-opacity-50 flex items-center justify-center z-50">
          <div className="bg-white rounded-lg p-6 w-full max-w-md">
            <div className="flex justify-center items-center mb-4">
              <h2 className="text-2xl font-bold text-[#343434]">Settings</h2>
            </div>

            <div className="mb-6">
              <label className="block text-sm font-medium text-[#343434] mb-2">
                Input Source
              </label>
              <div className="relative">
                <select
                  value={inputSource}
                  onChange={(e) => setInputSource(e.target.value)}
                  className="bg-gray-200 p-3 pr-12 rounded-lg w-full text-[#343434] focus:ring-1 focus:ring-[#343434] appearance-none"
                >
                  <option value="Logitech C270">Logitech C270</option>
                  <option value="HD Webcam">HD Webcam</option>
                  <option value="Built-in Camera">Built-in Camera</option>
                  <option value="External USB Camera">
                    External USB Camera
                  </option>
                </select>
                <div className="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-[#343434]">
                  <svg
                    className="fill-current h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                  >
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                  </svg>
                </div>
              </div>
            </div>

            <div className="flex justify-center space-x-3">
              <button
                onClick={toggleSettings}
                className="px-4 py-2 font-medium border-2 border-[#343434] text-[#343434] rounded-lg hover:bg-gray-100"
              >
                Cancel
              </button>
              <button
                onClick={toggleSettings}
                className="px-6 py-2 font-medium bg-[#343434] text-white rounded-lg hover:bg-[#2a2a2a]"
              >
                Save
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Success Modal - Appears after scanning */}
      {showSuccessModal && (
        <div className="fixed inset-0 bg-[#343434]/80 flex items-center justify-center z-50">
          <div className="bg-white rounded-lg shadow-lg w-full max-w-md mx-4 relative overflow-hidden">
            {/* Close button (top right) */}
            <button
              onClick={handleCancel}
              className="absolute top-2 right-4 text-black hover:text-[#343434] text-xl cursor-pointer"
            >
              &times;
            </button>
            {/* Success checkmark */}
            <div className="flex justify-center pt-8 pb-4">
              <div className="bg-[#343434] rounded-full p-4">
                <FaCheck className="text-white text-2xl" />
              </div>
            </div>

            {/* Success message */}
            <div className="text-center">
              <h2 className="text-3xl font-bold text-gray-800 mb-6">
                You're Already Here!
              </h2>
              {/* Small Triangle */}
              <div className="absolute left-1/2 -translate-x-1/2 -translate-y-1/2 w-6 h-6 bg-white rotate-45"></div>
              <div className="bg-[#343434] py-8 px-6 text-white text-xl text-center font-normal">
                {scannedUser}
              </div>
            </div>
          </div>
        </div>
      )}

      {/* Add a style for the scanning animation */}
      <style jsx>{`
        @keyframes scan {
          0% { top: 20%; }
          50% { top: 80%; }
          100% { top: 20%; }
        }
      `}</style>
    </div>
  );
};

export default ScanQR;