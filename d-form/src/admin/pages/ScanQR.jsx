import React from 'react';
import { FaCog, FaArrowLeft } from 'react-icons/fa';
import { useNavigate } from 'react-router-dom';

const ScanQR = () => {
  const navigate = useNavigate();

  return (
    <div className="fixed inset-0 bg-white text-[#343434] z-50 flex flex-col items-center">
      {/* Header */}
      <header className="w-full flex justify-between items-center px-10 py-4 border-b border-gray-200">
        <div className="flex items-center space-x-2">
          <div className="font-extrabold text-4xl text-[#343434">D</div>
          <div className="text-3xl font-normal text-[#343434">FORM</div>
        </div>
        <button
          aria-label="Settings"
          className="text-[#343434] text-2xl focus:outline-none"
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
            <div className="text-xl font-bold text-[#343434]">
              Participant
            </div>
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

            <div className="text-xl font-bold text-[#343434]">
              Starting in
            </div>
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

          {/* QR Code Scanner Area */}
          <div className="bg-[#343434] rounded-lg aspect-square flex flex-col items-center justify-center overflow-hidden">
            {/* Camera component would be integrated here */}
            <div className="relative w-full h-full flex flex-col items-center justify-center">
              {/* This would be replaced with actual camera component */}
              <div className="absolute inset-0 bg-[#343434] opacity-70"></div>
              
              {/* Scanner overlay with frame indicators */}
              <div className="absolute inset-0 flex items-center justify-center z-10">
                <div className="w-7/8 h-7/8 border-2 border-white border-opacity-60 rounded-lg flex flex-col items-center justify-center">
                  {/* Scanner line animation */}
                  <div className="w-full h-1 bg-gray-300 opacity-70 animate-pulse"></div>
                </div>
              </div>
              
              {/* Camera instructions */}
              <div className="absolute bottom-0 left-0 right-0 text-center text-white z-20">
                <p className="text-[11px]">Center QR code in frame</p>
              </div>
            </div>
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
      
      {/* Back button positioned at bottom left */}
      <button
        onClick={() => navigate('/admin/dashboard')}
        className="absolute bottom-6 left-6 flex items-center text-[#343434 text-lg cursor-pointer"
      >
        <FaArrowLeft className="mr-2" /> 
      </button>
    </div>
  );
};

export default ScanQR;